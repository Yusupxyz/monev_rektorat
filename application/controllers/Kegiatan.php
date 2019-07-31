<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kegiatan extends CI_Controller
{
    public $tahun ="";
    public $group_id="";

    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Kegiatan_model');
        $this->load->model('Komponen_model');
        $this->load->model('Sub_komponen_model');
        $this->load->model('Tahun_model');
        $this->load->model('Users_model');
        $this->load->library('form_validation');
        $this->tahun = $this->Tahun_model->get_by_aktif()->id_tahun;
    }

    public function index($b=null,$view=null)
    {
        //route untuk setiap kegiatan unit
        if ($b==null && $view==null){
            $user = $this->ion_auth->user()->row();
            $b=$user->id_unit;
            $this->group_id=$this->Users_model->get_group_id($user->id)->group_id;
        }elseif($view=='view'){
            $user = $this->ion_auth->user()->row();
            $this->group_id=$this->Users_model->get_group_id($user->id)->group_id;
        }
       
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'kegiatan?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kegiatan?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'kegiatan';
            $config['first_url'] = base_url() . 'kegiatan';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kegiatan_model->total_rows($q,$b,$this->tahun);
        $kegiatan = $this->Kegiatan_model->get_limit_data($config['per_page'], $start, $q,$b,$this->tahun);
        $title = $this->db->query("select * from unit where id_unit = $b")->result();


        // print_r($this->tahun);
        for ($i=0;$i<$this->Kegiatan_model->count_kegiatan($b,$this->tahun)->count;$i++){
            $count_child[] =$this->Kegiatan_model->count_child($i,$b,$this->tahun);
            $komponen[] = $this->Komponen_model->get_by_id_kegiatan($i,$b,$this->tahun);
        }

        for ($i=0;$i<$this->Komponen_model->count_komponen($b)->count;$i++){
            $count_child_komponen[] =$this->Komponen_model->count_child($i,$b);
            $subkomponen[] = $this->Sub_komponen_model->get_by_id_komponen($i,$b,$this->tahun);
        }

        // echo "<pre>"; print_r($this->Kegiatan_model->count_kegiatan($b,$this->tahun)->count);echo"</pre>";
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kegiatan_data' => $kegiatan,
            'q' => $q,
            'title' => $title,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'count_child' => $count_child,
            'count_child_komponen' => $count_child_komponen,
            'komponen' => $komponen,
            'subkomponen' => $subkomponen,
            'group_id' => $this->group_id,
            'id_unit' => $b
        );
        $data['title'] = $title;
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Kegiatan' => '',
        ];
        $data['code_js'] = 'kegiatan/codejs';
        $data['page'] = 'kegiatan/Kegiatan_list';
        if ($this->group_id==1 ){
            redirect(site_url('kegiatan_rektorat'));
            // $data['page'] = 'notfound';
        }
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Kegiatan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kegiatan' => $row->id_kegiatan,
		'kode_m_dat' => $row->kode_m_dat,
		'ket' => $row->ket,
		'volume' => $row->volume,
		'satuan' => $row->satuan,
		'jumlah' => $row->jumlah,
		'id_unit' => $row->id_unit,
		'jenis' => $row->jenis,
	    );
        $data['title'] = 'Kegiatan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'kegiatan/Kegiatan_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kegiatan'));
        }
    }

    public function create($id_unit,$page=null,$id=null) 
    {
        $data = array(
            'button' => 'Tambah',
             'action' => site_url('kegiatan/create_action/'.$id_unit),
	    'id_kegiatan' => set_value('id_kegiatan'),
	    'kode_m_dat' => set_value('kode_m_dat'),
	    'volume' => set_value('volume'),
	    'satuan' => set_value('satuan'),
	    'jumlah' => set_value('jumlah'),
	    'id_unit' => set_value('id_unit'),
        'id_tahun' => $this->tahun
	);
       // print_r($id_unit);
        $data['title'] = 'Kegiatan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];
		$this->load->model('m_dat_model');
        if ($page=='program'){
            $data['m_data'] = $this->m_dat_model->get_m_dat_induk('2');
            $data['page'] = 'kegiatan/Kegiatan_form_program';
        }elseif ($page=='sub_program'){
            $data['m_data'] = $this->m_dat_model->get_m_dat_induk('3');
            $data['page'] = 'kegiatan/Kegiatan_form_sub';
        }elseif ($page=='sub_output'){
            $data['m_data'] = $this->m_dat_model->get_m_dat_induk('4');
            $data['page'] = 'kegiatan/Kegiatan_form_sub_output';
        }elseif ($page=='komponen'){
            $data['action'] =site_url('kegiatan/create_action_komponen/'.$id_unit.'/'.$id);
            $data['page'] = 'kegiatan/Kegiatan_form_komponen';
        }elseif ($page=='subkomponen'){
            $data['action'] =site_url('kegiatan/create_action_subkomponen/'.$id_unit.'/'.$id);
            $data['page'] = 'kegiatan/Kegiatan_form_subkomponen';
        }else{
            $data['m_data'] = $this->m_dat_model->get_m_dat_induk('1');
            $data['page'] = 'kegiatan/Kegiatan_form';
           // $data['action'] =site_url('kegiatan/create_action/'.$id_unit);
        }
    
        $this->load->view('template/backend', $data);
    }
    
    public function create_action($id_unit) 
    {
        $this->_rules();
        $user = $this->ion_auth->user()->row();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {    
            $data = array(
		'kode_m_dat' => $this->input->post('kode_m_dat',TRUE),
		'volume' => $this->input->post('volume',TRUE),
		'satuan' => $this->input->post('satuan',TRUE),
		'jumlah' => '-',
		'id_unit' => $id_unit,
        'id_tahun' => $this->tahun

	    );

        //print_r($id_unit);
        if(! $this->Kegiatan_model->is_exist($this->input->post('id_kegiatan'))){
                $this->Kegiatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kegiatan/'.$id_unit));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, id_kegiatan is exist');
            }
        }
    }

    public function create_action_komponen($id_unit,$id=null) 
    {
        $this->_rules();
        $user = $this->ion_auth->user()->row();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {    
            $data = array(
                'kode_komponen' => $this->input->post('kode_komponen',TRUE),
                'id_kegiatan' => $id,
                'uraian_kegiatan' => $this->input->post('uraian_kegiatan',TRUE),
                'volume' => $this->input->post('volume',TRUE),
                'satuan' => $this->input->post('satuan',TRUE),
                'jumlah' => '-'
            );

        if(!$this->Komponen_model->is_exist($this->input->post('id_subkomponen'))){
                $this->Komponen_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('kegiatan/'.$id_unit));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, id_kegiatan is exist');
            }
        }
    }

    public function create_action_subkomponen($id_unit,$id=null) 
    {
        $this->_rules();
        $user = $this->ion_auth->user()->row();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {    
            $data = array(
        'kode_subkomponen' => $this->input->post('kode_subkomponen',TRUE),
		'id_komponen' => $id,
		'uraian_kegiatan' => $this->input->post('uraian_kegiatan',TRUE),
		'volume' => $this->input->post('volume',TRUE),
		'satuan' => $this->input->post('satuan',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE)
	    );
        if(! $this->Sub_komponen_model->is_exist($this->input->post('id_subkomponen'))){
            $this->Sub_komponen_model->insert($data);
          
            //update komponen
            $id_komponen=$this->Komponen_model->get_id_komponen($id_unit);
            foreach ($id_komponen as $key => $value) {
                if (!isset($this->Sub_komponen_model->sum_komponen($value->id_komponen)->sum)){
                    $sum_komponen = array(
                        'jumlah' => '0'
                    );
                }else{
                    $sum_komponen = array(
                        'jumlah' => $this->Sub_komponen_model->sum_komponen($value->id_komponen)->sum
                    );
                }
                $this->Komponen_model->update($value->id_komponen,$sum_komponen);
            }
            
            //update sub output
            $id_kegiatan=$this->Komponen_model->get_id_kegiatan($id_unit);
            foreach ($id_kegiatan as $key => $value) {
                $sum_sub_output = array(
                    'jumlah' => $this->Komponen_model->sum_sub_output($value->id_kegiatan)->sum
                );
                $this->Kegiatan_model->update($value->id_kegiatan,$sum_sub_output);
            }

            //update kegiatan
            for ($i=4;$i>1;$i--){
                $sum = array(
                    'jumlah' => $this->Kegiatan_model->sum($i,$id_unit)->sum
                );
                $id_kegiatan= $this->Kegiatan_model->get_id_kegiatan($i-1,$id_unit)->id_kegiatan;
                $this->Kegiatan_model->update($id_kegiatan,$sum);
            }

            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kegiatan/'.$id_unit));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, id_kegiatan is exist');
            }}
    }
    
    public function update($id) 
    {
        $row = $this->Kegiatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kegiatan/update_action'),
		'id_kegiatan' => set_value('id_kegiatan', $row->id_kegiatan),
		'kode_m_dat' => set_value('kode_m_dat', $row->kode_m_dat),
		'volume' => set_value('volume', $row->volume),
		'satuan' => set_value('satuan', $row->satuan),
		'jumlah' => set_value('jumlah', $row->jumlah),
		'id_unit' => set_value('id_unit', $row->id_unit),
	    );
            $data['title'] = 'Kegiatan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'kegiatan/Kegiatan_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kegiatan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kegiatan', TRUE));
        } else {
            $data = array(
		'id_kegiatan' => $this->input->post('id_kegiatan',TRUE),
		'kode_m_dat' => $this->input->post('kode_m_dat',TRUE),
		'volume' => $this->input->post('volume',TRUE),
		'satuan' => $this->input->post('satuan',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
		'id_unit' => $this->input->post('id_unit',TRUE),
	    );

            $this->Kegiatan_model->update($this->input->post('id_kegiatan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kegiatan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kegiatan_model->get_by_id($id);

        if ($row) {
            $this->Kegiatan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kegiatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kegiatan'));
        }
    }

    public function deletebulk(){
        $delete = $this->Kegiatan_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	// $this->form_validation->set_rules('id_kegiatan', 'id kegiatan', 'trim|required');
	// $this->form_validation->set_rules('kode_m_dat', 'kode m dat', 'trim|required');
	$this->form_validation->set_rules('volume', 'volume', 'trim|required');
	$this->form_validation->set_rules('satuan', 'satuan', 'trim|required');

	// $this->form_validation->set_rules('id_kegiatan', 'id_kegiatan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Kegiatan.php */
/* Location: ./application/controllers/Kegiatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-08 18:29:18 */
/* http://harviacode.com */