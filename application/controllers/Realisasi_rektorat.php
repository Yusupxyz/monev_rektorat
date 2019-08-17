<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Realisasi_rektorat extends CI_Controller
{
    public $user="";
    public $tahun ="";
    public $group_id="";
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Realisasi_rektorat_model');
        $this->load->model('Unit_model');
        $this->load->model('Users_model');
        $this->load->model('Tahun_model');
        $this->load->model('M_dat_model');
        $this->load->model('Kegiatan_model');
        $this->load->model('Komponen_model');
        $this->load->model('Sub_komponen_rektorat_model');
        $this->load->model('Sub_komponen_model');
        $this->load->model('Komponen_rektorat_model');
        $this->load->model('Kegiatan_rektorat_model');
        $this->load->model('Setting_waktu_model');
        $this->load->library('form_validation');
        $this->user = $this->ion_auth->user()->row();
        $this->tahun = $this->Tahun_model->get_by_aktif()->id_tahun;
    }

    public function index($id_subkomponen=null)
    {
        $user = $this->ion_auth->user()->row();
        $this->group_id=$this->Users_model->get_group_id($user->id)->group_id;
        if(!$this->Realisasi_rektorat_model->is_exist($id_subkomponen)){
            for($i=1;$i<13;$i++){
                $data = array(
                    'id_subkomponen' => $id_subkomponen,
                    'id_bulan' => $i,
                    'id_unit' => $this->user->id_unit,
                    'ukuran_keberhasilan' => '-',
                    'uraian_hasil' => '-',
                    'kendala' => '-',
                    'keterangan' => '-'
                );
                $this->Realisasi_rektorat_model->insert($data);
            }
        }

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        $id_unit = $this->user->id_unit;
        $unit = $this->Unit_model->get_by_id($id_unit);
        $tahun = $this->Tahun_model->get_by_id($this->tahun)->tahun;
        $waktu_rencana = $this->Setting_waktu_model->get_by_nama('Waktu Pengisian Rencana Capaian');
        $waktu_realisasi = $this->Setting_waktu_model->get_by_nama('Waktu Pengisian Realisasi Capaian Fisik');
        $kegiatan = $this->Sub_komponen_rektorat_model->get_all_by_id($id_subkomponen);
        if ($q <> '') {
            $config['base_url'] = base_url() . 'realisasi?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'realisasi?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'realisasi';
            $config['first_url'] = base_url() . 'realisasi';
        }
        $config['per_page'] = 12;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Realisasi_rektorat_model->total_rows($q,$id_subkomponen)->count;
        $realisasi = $this->Realisasi_rektorat_model->get_limit_data($config['per_page'], $start, $q,$id_subkomponen);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'realisasi_data' => $realisasi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'tahun' => $tahun,
            'unit' => $unit,
            'kegiatan' => $kegiatan,
            'group_id' => $this->group_id,
            'waktu_rencana' => $waktu_rencana,
            'waktu_realisasi' => $waktu_realisasi
        );
        $data['title'] = 'Realisasi';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Realisasi' => '',
        ];
        $data['code_js'] = 'realisasi_rektorat/codejs';
        $data['page'] = 'realisasi_rektorat/Realisasi_rektorat_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Realisasi_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_realisasi' => $row->id_realisasi,
		'id_bulan' => $row->id_bulan,
		'id_subkomponen' => $row->id_subkomponen,
		'rencana_capaian' => $row->rencana_capaian,
		'ukuran_keberhasilan' => $row->ukuran_keberhasilan,
		'realisasi_capaian' => $row->realisasi_capaian,
		'realisasi_jumlah' => $row->realisasi_jumlah,
		'uraian_hasil' => $row->uraian_hasil,
		'kendala' => $row->kendala,
		'keterangan' => $row->keterangan,
	    );
        $data['title'] = 'Realisasi';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'realisasi/Realisasi_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('realisasi'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('realisasi/create_action'),
	    'id_realisasi' => set_value('id_realisasi'),
	    'id_bulan' => set_value('id_bulan'),
	    'id_subkomponen' => set_value('id_subkomponen'),
	    'rencana_capaian' => set_value('rencana_capaian'),
	    'ukuran_keberhasilan' => set_value('ukuran_keberhasilan'),
	    'realisasi_capaian' => set_value('realisasi_capaian'),
	    'realisasi_jumlah' => set_value('realisasi_jumlah'),
	    'uraian_hasil' => set_value('uraian_hasil'),
	    'kendala' => set_value('kendala'),
	    'keterangan' => set_value('keterangan'),
	);
        $data['title'] = 'Realisasi';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'realisasi/Realisasi_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_bulan' => $this->input->post('id_bulan',TRUE),
		'id_subkomponen' => $this->input->post('id_subkomponen',TRUE),
		'rencana_capaian' => $this->input->post('rencana_capaian',TRUE),
		'ukuran_keberhasilan' => $this->input->post('ukuran_keberhasilan',TRUE),
		'realisasi_capaian' => $this->input->post('realisasi_capaian',TRUE),
		'realisasi_jumlah' => $this->input->post('realisasi_jumlah',TRUE),
		'uraian_hasil' => $this->input->post('uraian_hasil',TRUE),
		'kendala' => $this->input->post('kendala',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
	    );$this->Realisasi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('realisasi'));}
    }
    
    public function update($id) 
    {
        $row = $this->Realisasi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('realisasi/update_action'),
		'id_realisasi' => set_value('id_realisasi', $row->id_realisasi),
		'id_bulan' => set_value('id_bulan', $row->id_bulan),
		'id_subkomponen' => set_value('id_subkomponen', $row->id_subkomponen),
		'rencana_capaian' => set_value('rencana_capaian', $row->rencana_capaian),
		'ukuran_keberhasilan' => set_value('ukuran_keberhasilan', $row->ukuran_keberhasilan),
		'realisasi_capaian' => set_value('realisasi_capaian', $row->realisasi_capaian),
		'realisasi_jumlah' => set_value('realisasi_jumlah', $row->realisasi_jumlah),
		'uraian_hasil' => set_value('uraian_hasil', $row->uraian_hasil),
		'kendala' => set_value('kendala', $row->kendala),
		'keterangan' => set_value('keterangan', $row->keterangan),
	    );
            $data['title'] = 'Realisasi';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'realisasi/Realisasi_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('realisasi'));
        }
    }
    
    public function update_action($id_realisasi=null) 
    {
        $this->_rules();

        $id_subkomponen=$this->input->post('id_subkomponen',TRUE);

        if ($this->form_validation->run() == FALSE) {            
            $this->session->set_flashdata('message', 'Update Record Failed');
            redirect(site_url('realisasi/'.$id_subkomponen));
        } else {
            $data = array(
                'rencana_capaian' => $this->input->post('rencana_capaian',TRUE),
                'ukuran_keberhasilan' => $this->input->post('ukuran_keberhasilan',TRUE),
                'realisasi_capaian' => $this->input->post('realisasi_capaian',TRUE),
                'realisasi_jumlah' => $this->input->post('realisasi_jumlah',TRUE),
                'uraian_hasil' => $this->input->post('uraian_hasil',TRUE),
                'kendala' => $this->input->post('kendala',TRUE),
                'keterangan' => $this->input->post('keterangan',TRUE),
            );

            $this->Realisasi_rektorat_model->update($id_realisasi, $data);

            //update capaian sub komponen rektorat
            $data_capaian = array(
                'rencana_capaian' => $this->Realisasi_rektorat_model->sum_by_idsubkomponen($id_subkomponen)->sum_rencana,
                'capaian' => $this->Realisasi_rektorat_model->sum_by_idsubkomponen($id_subkomponen)->sum_realisasi,
                'jumlah_capaian' => $this->Realisasi_rektorat_model->sum_by_idsubkomponen($id_subkomponen)->sum_jumlah
            );
            $this->Sub_komponen_rektorat_model->update($id_subkomponen, $data_capaian);           
            
            //update capaian komponen dengan sum sub komponen unit
            $id_komponen=$this->Sub_komponen_rektorat_model->get_idkomponen($id_subkomponen)->id_komponen;
            $kode_komponen=$this->Sub_komponen_rektorat_model->get_idkomponen($id_subkomponen)->kode;
            //sum rencana capaian unit ditambah sum rektorat
            $rencana_capaian_unit=$this->Sub_komponen_model->sum_by_kodekomponen($kode_komponen)->sum_rencana;
            $rencana_capaian_rektorat=$this->Sub_komponen_rektorat_model->sum_by_idkomponen($id_komponen)->sum_rencana;
            $rencana_capaian=$rencana_capaian_unit+$rencana_capaian_rektorat;
            //sum capaian unit ditambah sum rektorat
            $capaian_unit=$this->Sub_komponen_model->sum_by_kodekomponen($kode_komponen)->sum_realisasi;
            $capaian_rektorat=$this->Sub_komponen_rektorat_model->sum_by_idkomponen($id_komponen)->sum_realisasi;
            $capaian=$capaian_unit+$capaian_rektorat;
            //sum jumlah capaian unit ditambah sum rektorat
            $jumlah_capaian_unit=$this->Sub_komponen_model->sum_by_kodekomponen($kode_komponen)->sum_jumlah;
            $jumlah_capaian_rektorat=$this->Sub_komponen_rektorat_model->sum_by_idkomponen($id_komponen)->sum_jumlah;
            $jumlah_capaian=$jumlah_capaian_unit+$jumlah_capaian_rektorat;

            $data_subkomponen = array(
                'rencana_capaian' => $rencana_capaian,
                'capaian' => $capaian,
                'jumlah_capaian' => $jumlah_capaian
            );
            $this->Komponen_rektorat_model->update($id_komponen, $data_subkomponen);

            //update capaian sub_output
            $id_suboutput=$this->Komponen_rektorat_model->get_idsuboutput($id_komponen)->id_kegiatan;
            $data_komponen = array(
                'rencana_capaian' => $this->Komponen_rektorat_model->sum_by_idsuboutput($id_suboutput)->sum_rencana,
                'capaian' => $this->Komponen_rektorat_model->sum_by_idsuboutput($id_suboutput)->sum_realisasi,
                'jumlah_capaian' => $this->Komponen_rektorat_model->sum_by_idsuboutput($id_suboutput)->sum_jumlah
            );
            $this->Kegiatan_rektorat_model->update($id_suboutput, $data_komponen);

            //update capaian kegiatan jenis 3/2
            $jenis=$this->Kegiatan_rektorat_model->get_by_id_join($id_suboutput)->jenis;
            $kode=$this->Kegiatan_rektorat_model->get_by_id_join($id_suboutput)->induk;
            $this->update_capaian_kegiatan($jenis,$kode);

            // //update capaian kegiatan jenis 2/1
            $jenis2=$this->M_dat_model->get_by_id($kode)->jenis;
            $kode2=$this->M_dat_model->get_by_id($kode)->induk;
            $this->update_capaian_kegiatan($jenis2,$kode2);

            // //update capaian kegiatan jenis 1/false
            $jenis3=$this->M_dat_model->get_by_id($kode2)->jenis;
            $kode3=$this->M_dat_model->get_by_id($kode2)->induk;
            $this->update_capaian_kegiatan($jenis3,$kode3);

            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('realisasi_rektorat/'.$this->input->post('id_subkomponen',TRUE)));
        }
    }

    private function update_capaian_kegiatan($jenis,$kode){
        if ($jenis!=1){
            $id_unit= $this->user->id_unit;
            $data_kegiatan = array(
                'rencana_capaian' => $this->Kegiatan_rektorat_model->sum_by_induk($kode)->sum_rencana,
                'capaian' => $this->Kegiatan_rektorat_model->sum_by_induk($kode)->sum_realisasi,
                'jumlah_capaian' => $this->Kegiatan_rektorat_model->sum_by_induk($kode)->sum_jumlah
            );
            $this->Kegiatan_rektorat_model->update_bykode($kode, $data_kegiatan,$id_unit);
        }
    }

    public function delete($id) 
    {
        $row = $this->Realisasi_model->get_by_id($id);

        if ($row) {
            $this->Realisasi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('realisasi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('realisasi'));
        }
    }

    public function deletebulk(){
        $delete = $this->Realisasi_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {

	$this->form_validation->set_rules('rencana_capaian', 'rencana capaian', 'trim|required');
	$this->form_validation->set_rules('ukuran_keberhasilan', 'ukuran keberhasilan', 'trim|required');
	$this->form_validation->set_rules('realisasi_capaian', 'realisasi capaian', 'trim|required');
	$this->form_validation->set_rules('realisasi_jumlah', 'realisasi jumlah', 'trim|required');
	$this->form_validation->set_rules('uraian_hasil', 'uraian hasil', 'trim|required');
	$this->form_validation->set_rules('kendala', 'kendala', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

	$this->form_validation->set_rules('id_realisasi', 'id_realisasi', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Realisasi.php */
/* Location: ./application/controllers/Realisasi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-14 10:58:25 */
/* http://harviacode.com */