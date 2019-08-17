<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bulan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Bulan_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Bulan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Bulan' => '',
        ];
        $data['code_js'] = 'bulan/codejs';
        $data['page'] = 'bulan/Bulan_list';
        $this->load->view('template/backend', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Bulan_model->json();
    }

    public function read($id) 
    {
        $row = $this->Bulan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_bulan' => $row->id_bulan,
		'bulan' => $row->bulan,
	    );
        $data['title'] = 'Bulan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'bulan/Bulan_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bulan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('bulan/create_action'),
	    'id_bulan' => set_value('id_bulan'),
	    'bulan' => set_value('bulan'),
	);
        $data['title'] = 'Bulan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'bulan/Bulan_form';
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
		'bulan' => $this->input->post('bulan',TRUE),
	    );
if(! $this->Bulan_model->is_exist($this->input->post('id_bulan'))){
                $this->Bulan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('bulan'));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, id_bulan is exist');
            }}
    }
    
    public function update($id) 
    {
        $row = $this->Bulan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('bulan/update_action'),
		'id_bulan' => set_value('id_bulan', $row->id_bulan),
		'bulan' => set_value('bulan', $row->bulan),
	    );
            $data['title'] = 'Bulan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'bulan/Bulan_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bulan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_bulan', TRUE));
        } else {
            $data = array(
		'id_bulan' => $this->input->post('id_bulan',TRUE),
		'bulan' => $this->input->post('bulan',TRUE),
	    );

            $this->Bulan_model->update($this->input->post('id_bulan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('bulan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Bulan_model->get_by_id($id);

        if ($row) {
            $this->Bulan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('bulan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bulan'));
        }
    }

    public function deletebulk(){
        $delete = $this->Bulan_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('id_bulan', 'id bulan', 'trim|required');
	$this->form_validation->set_rules('bulan', 'bulan', 'trim|required');

	$this->form_validation->set_rules('id_bulan', 'id_bulan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Bulan.php */
/* Location: ./application/controllers/Bulan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-13 01:23:32 */
/* http://harviacode.com */