<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Realisasi extends CI_Controller
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
        $this->load->model('Realisasi_model');
        $this->load->model('Unit_model');
        $this->load->model('Users_model');
        $this->load->model('Tahun_model');
        $this->load->model('M_dat_model');
        $this->load->model('Kegiatan_model');
        $this->load->model('Komponen_model');
        $this->load->model('Sub_komponen_model');
        $this->load->model('Setting_waktu_model');
        $this->load->library('form_validation');
        $this->user = $this->ion_auth->user()->row();
        $this->tahun = $this->Tahun_model->get_by_aktif()->id_tahun;
    }

    public function index($id_subkomponen=null,$id_unit=null)
    {
        $user = $this->ion_auth->user()->row();
        $this->group_id=$this->Users_model->get_group_id($user->id)->group_id;
        if(!$this->Realisasi_model->is_exist($id_subkomponen)){
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
                $this->Realisasi_model->insert($data);
            }
        }

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        if ($id_unit==null){
            $id_unit = $this->user->id_unit;
        }
        $unit = $this->Unit_model->get_by_id($id_unit);
        $tahun = $this->Tahun_model->get_by_id($this->tahun)->tahun;
        $waktu_rencana = $this->Setting_waktu_model->get_by_nama('Waktu Pengisian Rencana Capaian');
        $waktu_realisasi = $this->Setting_waktu_model->get_by_nama('Waktu Pengisian Realisasi Capaian Fisik');
        $kegiatan = $this->Sub_komponen_model->get_all_by_id($id_subkomponen,$id_unit);
        if ($q <> '') {
            $config['base_url'] = base_url() . 'realisasi?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'realisasi?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'realisasi';
            $config['first_url'] = base_url() . 'realisasi';
        }
        $config['per_page'] = 12;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Realisasi_model->total_rows($q,$id_subkomponen)->count;
        $realisasi = $this->Realisasi_model->get_limit_data($config['per_page'], $start, $q,$id_subkomponen);

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
        $data['code_js'] = 'realisasi/codejs';
        $data['page'] = 'realisasi/Realisasi_list';
        $this->load->view('template/backend', $data);
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

            $this->Realisasi_model->update($id_realisasi, $data);

            //update capaian sub komponen
            $data_capaian = array(
                'rencana_capaian' => $this->Realisasi_model->sum_by_idsubkomponen($id_subkomponen)->sum_rencana,
                'capaian' => $this->Realisasi_model->sum_by_idsubkomponen($id_subkomponen)->sum_realisasi,
                'jumlah_capaian' => $this->Realisasi_model->sum_by_idsubkomponen($id_subkomponen)->sum_jumlah
            );
            $this->Sub_komponen_model->update($id_subkomponen, $data_capaian);         

            //update capaian komponen
            $id_komponen=$this->Sub_komponen_model->get_idkomponen($id_subkomponen)->id_komponen;
            $child_id_komponen=$this->Sub_komponen_model->count_id_komponen($id_komponen)->jumlah;
            $data_subkomponen = array(
                'rencana_capaian' => $this->Sub_komponen_model->sum_by_idkomponen($id_komponen)->sum_rencana/$child_id_komponen,
                'capaian' => $this->Sub_komponen_model->sum_by_idkomponen($id_komponen)->sum_realisasi/$child_id_komponen,
                'jumlah_capaian' => $this->Sub_komponen_model->sum_by_idkomponen($id_komponen)->sum_jumlah
            );
            $this->Komponen_model->update($id_komponen, $data_subkomponen); 

            //update capaian sub_output
            $id_suboutput=$this->Komponen_model->get_idsuboutput($id_komponen)->id_kegiatan;
            $child_id_suboutput=$this->Komponen_model->count_id_suboutput($id_suboutput)->jumlah;
            $data_komponen = array(
                'rencana_capaian' => $this->Komponen_model->sum_by_idsuboutput($id_suboutput)->sum_rencana/$child_id_suboutput,
                'capaian' => $this->Komponen_model->sum_by_idsuboutput($id_suboutput)->sum_realisasi/$child_id_suboutput,
                'jumlah_capaian' => $this->Komponen_model->sum_by_idsuboutput($id_suboutput)->sum_jumlah

            );
            $this->Kegiatan_model->update($id_suboutput, $data_komponen);

            //update capaian kegiatan jenis 3/2
            $jenis=$this->Kegiatan_model->get_by_id_join($id_suboutput)->jenis;
            $kode=$this->Kegiatan_model->get_by_id_join($id_suboutput)->induk;
            $this->update_capaian_kegiatan($jenis,$kode,$this->user->id_unit);

            // //update capaian kegiatan jenis 2/1
            $jenis2=$this->M_dat_model->get_by_id($kode)->jenis;
            $kode2=$this->M_dat_model->get_by_id($kode)->induk;
            $this->update_capaian_kegiatan($jenis2,$kode2,$this->user->id_unit);

            // //update capaian kegiatan jenis 1/false
            $jenis3=$this->M_dat_model->get_by_id($kode2)->jenis;
            $kode3=$this->M_dat_model->get_by_id($kode2)->induk;
            $this->update_capaian_kegiatan($jenis3,$kode3,$this->user->id_unit);

            //rektorat
            // //update capaian komponen dengan sum sub komponen unit
            //  $kode_komponen=$this->Sub_komponen_model->get_idkomponen($id_subkomponen)->kode;
            //  $id_komponen_rektorat=$this->Komponen_model->get_by_kode_komponen($kode_komponen)->id_komponen;

            // //  $id_komponen_rektorat=$this->Komponen_model->get_by_kode($kode_komponen)->id_komponen;
            //  $child=$this->Sub_komponen_model->count_kode_komponen($kode_komponen)->jumlah;
             
            //  //sum rencana capaian unit ditambah sum rektorat
            //  $rencana_capaian=$this->Sub_komponen_model->sum_by_kodekomponen($kode_komponen)->sum_rencana;

            //  //sum capaian unit ditambah sum rektorat
            //  $capaian=$this->Sub_komponen_model->sum_by_kodekomponen($kode_komponen)->sum_realisasi;
             
            //  //sum jumlah capaian unit ditambah sum rektorat
            //  $jumlah_capaian=$this->Sub_komponen_model->sum_by_kodekomponen($kode_komponen)->sum_jumlah;

            //  $data_subkomponen_rektorat = array(
            //      'rencana_capaian' => $rencana_capaian/$child,
            //      'capaian' => $capaian/$child,
            //      'jumlah_capaian' => $jumlah_capaian
            //  );
            //  $this->Komponen_model->update($id_komponen_rektorat, $data_subkomponen_rektorat);

            //update capaian sub_output rektorat
            // $id_suboutput_rektorat=$this->Komponen_rektorat_model->get_idsuboutput($id_komponen_rektorat)->id_kegiatan;
            // $child_id_suboutput=$this->Komponen_rektorat_model->count_id_suboutput($id_suboutput_rektorat)->jumlah;
            // $data_komponen_rektorat = array(
            //     'rencana_capaian' => $this->Komponen_rektorat_model->sum_by_idsuboutput($id_suboutput_rektorat)->sum_rencana/$child_id_suboutput,
            //     'capaian' => $this->Komponen_rektorat_model->sum_by_idsuboutput($id_suboutput_rektorat)->sum_realisasi/$child_id_suboutput,
            //     'jumlah_capaian' => $this->Komponen_rektorat_model->sum_by_idsuboutput($id_suboutput_rektorat)->sum_jumlah
            // );
            // $this->Kegiatan_rektorat_model->update($id_suboutput_rektorat, $data_komponen_rektorat);

            // //update capaian kegiatan jenis 3/2
            // $jenis_rektorat=$this->Kegiatan_rektorat_model->get_by_id_join($id_suboutput_rektorat)->jenis;
            // $kode_rektorat=$this->Kegiatan_rektorat_model->get_by_id_join($id_suboutput_rektorat)->induk;
            // $this->update_capaian_kegiatan_rektorat($jenis_rektorat,$kode_rektorat);

            // //update capaian kegiatan jenis 2/1
            // $jenis2_rektorat=$this->M_dat_model->get_by_id($kode_rektorat)->jenis;
            // $kode2_rektorat=$this->M_dat_model->get_by_id($kode_rektorat)->induk;
            // $this->update_capaian_kegiatan_rektorat($jenis2_rektorat,$kode2_rektorat);

            // // //update capaian kegiatan jenis 1/false
            // $jenis3_rektorat=$this->M_dat_model->get_by_id($kode2_rektorat)->jenis;
            // $kode3_rektorat=$this->M_dat_model->get_by_id($kode2_rektorat)->induk;
            // $this->update_capaian_kegiatan_rektorat($jenis3_rektorat,$kode3_rektorat);

            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('realisasi/'.$this->input->post('id_subkomponen',TRUE)));
        }
    }

    private function update_capaian_kegiatan($jenis,$kode,$id_unit){
        if ($jenis!=1){
            $id_unit= $this->user->id_unit;
            $data_kegiatan = array(
                'rencana_capaian' => $this->Kegiatan_model->sum_by_induk($kode,$id_unit)->sum_rencana,
                'capaian' => $this->Kegiatan_model->sum_by_induk($kode,$id_unit)->sum_realisasi,
                'jumlah_capaian' => $this->Kegiatan_model->sum_by_induk($kode,$id_unit)->sum_jumlah
            );
            $this->Kegiatan_model->update_bykode($kode, $data_kegiatan,$id_unit);
        }
    }

    private function update_capaian_kegiatan_rektorat($jenis,$kode){
        if ($jenis!=1){
            echo $this->Kegiatan_rektorat_model->sum_by_induk($kode)->sum_rencana;echo '.';
            // echo    $id_unit= $this->user->id_unit;
            $data_kegiatan = array(
                'rencana_capaian' => $this->Kegiatan_rektorat_model->sum_by_induk($kode)->sum_rencana,
                'capaian' => $this->Kegiatan_rektorat_model->sum_by_induk($kode)->sum_realisasi,
                'jumlah_capaian' => $this->Kegiatan_rektorat_model->sum_by_induk($kode)->sum_jumlah
            );
            $this->Kegiatan_rektorat_model->update_bykode($kode, $data_kegiatan);
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