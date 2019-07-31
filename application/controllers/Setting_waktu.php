<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setting_waktu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Setting_waktu_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'setting_waktu?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'setting_waktu?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'setting_waktu';
            $config['first_url'] = base_url() . 'setting_waktu';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Setting_waktu_model->total_rows($q);
        $setting_waktu = $this->Setting_waktu_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'setting_waktu_data' => $setting_waktu,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Setting Waktu';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Setting Waktu' => '',
        ];
        $data['code_js'] = 'setting_waktu/codejs';
        $data['page'] = 'setting_waktu/Setting_waktu_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Setting_waktu_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_setting_waktu' => $row->id_setting_waktu,
		'nama' => $row->nama,
		'waktu_awal' => date('d-m-Y',strtotime($row->waktu_awal)),
		'waktu_akhir' => date('d-m-Y',strtotime($row->waktu_akhir))
	    );
        $data['title'] = 'Setting Waktu';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'setting_waktu/Setting_waktu_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('setting_waktu'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('setting_waktu/create_action'),
	    'id_setting_waktu' => set_value('id_setting_waktu'),
	    'nama' => set_value('nama'),
	    'waktu_awal' => set_value('waktu_awal'),
	    'waktu_akhir' => set_value('waktu_akhir'),
	);
        $data['title'] = 'Setting Waktu';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];
        $data['code_js'] = 'setting_waktu/codejs';
        $data['page'] = 'setting_waktu/Setting_waktu_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $waktu_awal=date('Y-m-d', strtotime($this->input->post('waktu_awal',TRUE)));
            $waktu_akhir=date('Y-m-d', strtotime($this->input->post('waktu_akhir',TRUE)));
            $data = array(
		'id_setting_waktu' => $this->input->post('id_setting_waktu',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'waktu_awal' => $waktu_awal,
		'waktu_akhir' => $waktu_akhir
	    );
if(! $this->Setting_waktu_model->is_exist($this->input->post('id_setting_waktu'))){
                $this->Setting_waktu_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('setting_waktu'));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, id_setting_waktu is exist');
            }}
    }
    
    public function update($id) 
    {
        $row = $this->Setting_waktu_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('setting_waktu/update_action'),
		'id_setting_waktu' => set_value('id_setting_waktu', $row->id_setting_waktu),
		'nama' => set_value('nama', $row->nama),
		'waktu_awal' => set_value('waktu_awal', $row->waktu_awal),
		'waktu_akhir' => set_value('waktu_akhir', $row->waktu_akhir),
	    );
            $data['title'] = 'Setting Waktu';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];
        $data['code_js'] = 'setting_waktu/codejs';
        $data['page'] = 'setting_waktu/Setting_waktu_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('setting_waktu'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_setting_waktu', TRUE));
        } else {
        echo    $waktu_awal=date('Y-m-d', strtotime($this->input->post('waktu_awal',TRUE)));
        echo    $waktu_akhir=date('Y-m-d', strtotime($this->input->post('waktu_akhir',TRUE)));
            $data = array(
		'id_setting_waktu' => $this->input->post('id_setting_waktu',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'waktu_awal' => $waktu_awal,
		'waktu_akhir' => $waktu_akhir,
	    );

            $this->Setting_waktu_model->update($this->input->post('id_setting_waktu', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('setting_waktu'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Setting_waktu_model->get_by_id($id);

        if ($row) {
            $this->Setting_waktu_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('setting_waktu'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('setting_waktu'));
        }
    }

    public function deletebulk(){
        $delete = $this->Setting_waktu_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	// $this->form_validation->set_rules('id_setting_waktu', 'id setting waktu', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('waktu_awal', 'waktu awal', 'trim|required');
	$this->form_validation->set_rules('waktu_akhir', 'waktu akhir', 'trim|required');

	$this->form_validation->set_rules('id_setting_waktu', 'id_setting_waktu', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Setting_waktu.php */
/* Location: ./application/controllers/Setting_waktu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-20 17:44:40 */
/* http://harviacode.com */