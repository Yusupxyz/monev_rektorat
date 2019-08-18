<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Set_unit_chart extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Set_unit_chart_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'set_unit_chart?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'set_unit_chart?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'set_unit_chart';
            $config['first_url'] = base_url() . 'set_unit_chart';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Set_unit_chart_model->total_rows($q);
        $set_unit_chart = $this->Set_unit_chart_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'set_unit_chart_data' => $set_unit_chart,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Set Unit Chart';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Set Unit Chart' => '',
        ];
        $data['code_js'] = 'set_unit_chart/codejs';
        $data['page'] = 'set_unit_chart/Set_unit_chart_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Set_unit_chart_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_unit' => $row->id_unit,
	    );
        $data['title'] = 'Set Unit Chart';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'set_unit_chart/Set_unit_chart_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('set_unit_chart'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('set_unit_chart/create_action'),
	    'id' => set_value('id'),
	    'id_unit' => set_value('id_unit'),
	);
        $data['title'] = 'Set Unit Chart';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'set_unit_chart/Set_unit_chart_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id' => $this->input->post('id',TRUE),
		'id_unit' => $this->input->post('id_unit',TRUE),
	    );
if(! $this->Set_unit_chart_model->is_exist($this->input->post('id'))){
                $this->Set_unit_chart_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('set_unit_chart'));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, id is exist');
            }}
    }
    
    public function update($id) 
    {
        $row = $this->Set_unit_chart_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('set_unit_chart/update_action'),
		'id' => set_value('id', $row->id),
		'id_unit' => set_value('id_unit', $row->id_unit),
	    );
            $data['title'] = 'Set Unit Chart';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'set_unit_chart/Set_unit_chart_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('set_unit_chart'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            header('Content-Type: application/json');
            echo json_encode("gagal");
        } else {
            $data = array(
		'id_unit' => $this->input->post('id_unit',TRUE),
	    );

            $this->Set_unit_chart_model->update('1', $data);
            // $this->session->set_flashdata('message', 'Update Record Success');
            header('Content-Type: application/json');
            echo json_encode("sukses");

            // redirect(site_url('dashboard'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Set_unit_chart_model->get_by_id($id);

        if ($row) {
            $this->Set_unit_chart_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('set_unit_chart'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('set_unit_chart'));
        }
    }

    public function deletebulk(){
        $delete = $this->Set_unit_chart_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	// $this->form_validation->set_rules('id', 'id', 'trim|required');
	$this->form_validation->set_rules('id_unit', 'id unit', 'trim|required');

	// $this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Set_unit_chart.php */
/* Location: ./application/controllers/Set_unit_chart.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-08-18 19:47:46 */
/* http://harviacode.com */