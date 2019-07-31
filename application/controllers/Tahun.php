<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tahun extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Tahun_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Tahun';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Tahun' => '',
        ];
        $data['code_js'] = 'tahun/codejs';
        $data['page'] = 'tahun/Tahun_list';
        $this->load->view('template/backend', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tahun_model->json();
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tahun/create_action'),
	    'id_tahun' => set_value('id_tahun'),
	    'tahun' => set_value('tahun'),
	    'aktif' => set_value('aktif'),
	);
        $data['title'] = 'Tahun';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'tahun/Tahun_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'tahun' => $this->input->post('tahun',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );$this->Tahun_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tahun'));}
    }
    
    public function update($id) 
    {
        $row = $this->Tahun_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tahun/update_action'),
		'id_tahun' => set_value('id_tahun', $row->id_tahun),
		'tahun' => set_value('tahun', $row->tahun),
		'aktif' => set_value('aktif', $row->aktif),
	    );
            $data['title'] = 'Tahun';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'tahun/Tahun_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tahun'));
        }
    }

    public function set($id) 
    {
        $row = $this->Tahun_model->get_by_id($id);

        if ($row) {
            $data = array(
                'aktif' => '1'
            );
            $this->Tahun_model->update($id, $data);
            $data2 = array(
                'aktif' => '0'
            );
            $this->Tahun_model->update2($id, $data2);
            $this->session->set_flashdata('message', 'Set Record Success');
            redirect(site_url('tahun'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tahun'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_tahun', TRUE));
        } else {
            $data = array(
		'tahun' => $this->input->post('tahun',TRUE),
		'aktif' => $this->input->post('aktif',TRUE),
	    );

            $this->Tahun_model->update($this->input->post('id_tahun', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tahun'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tahun_model->get_by_id($id);

        if ($row) {
            $this->Tahun_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tahun'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tahun'));
        }
    }

    public function deletebulk(){
        $delete = $this->Tahun_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
	$this->form_validation->set_rules('aktif', 'aktif', 'trim|required');

	$this->form_validation->set_rules('id_tahun', 'id_tahun', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Tahun.php */
/* Location: ./application/controllers/Tahun.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-12 18:11:28 */
/* http://harviacode.com */