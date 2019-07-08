<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_dat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('M_dat_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'm_dat?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'm_dat?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'm_dat';
            $config['first_url'] = base_url() . 'm_dat';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->M_dat_model->total_rows($q);
        $m_dat = $this->M_dat_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'm_dat_data' => $m_dat,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'M Dat';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'M Dat' => '',
        ];
        $data['code_js'] = 'm_dat/codejs';
        $data['page'] = 'm_dat/M_dat_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->M_dat_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kode' => $row->kode,
		'ket' => $row->ket,
		'induk' => $row->induk,
		'jenis' => $row->jenis,
	    );
        $data['title'] = 'M Dat';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'm_dat/M_dat_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m_dat'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('m_dat/create_action'),
	    'kode' => set_value('kode'),
	    'ket' => set_value('ket'),
	    'induk' => set_value('induk'),
	    'jenis' => set_value('jenis'),
	);
        $data['title'] = 'M Dat';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'm_dat/M_dat_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode' => $this->input->post('kode',TRUE),
		'ket' => $this->input->post('ket',TRUE),
		'induk' => $this->input->post('induk',TRUE),
		'jenis' => $this->input->post('jenis',TRUE),
	    );
if(! $this->M_dat_model->is_exist($this->input->post('kode'))){
                $this->M_dat_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('m_dat'));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, kode is exist');
            }}
    }
    
    public function update($id) 
    {
        $row = $this->M_dat_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('m_dat/update_action'),
		'kode' => set_value('kode', $row->kode),
		'ket' => set_value('ket', $row->ket),
		'induk' => set_value('induk', $row->induk),
		'jenis' => set_value('jenis', $row->jenis),
	    );
            $data['title'] = 'M Dat';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'm_dat/M_dat_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m_dat'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode', TRUE));
        } else {
            $data = array(
		'kode' => $this->input->post('kode',TRUE),
		'ket' => $this->input->post('ket',TRUE),
		'induk' => $this->input->post('induk',TRUE),
		'jenis' => $this->input->post('jenis',TRUE),
	    );

            $this->M_dat_model->update($this->input->post('kode', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('m_dat'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->M_dat_model->get_by_id($id);

        if ($row) {
            $this->M_dat_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('m_dat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m_dat'));
        }
    }

    public function deletebulk(){
        $delete = $this->M_dat_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('kode', 'kode', 'trim|required');
	$this->form_validation->set_rules('ket', 'ket', 'trim|required');
	$this->form_validation->set_rules('induk', 'induk', 'trim|required');
	$this->form_validation->set_rules('jenis', 'jenis', 'trim|required');

	$this->form_validation->set_rules('kode', 'kode', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

  public function printdoc(){
        $data = array(
            'm_dat_data' => $this->M_dat_model->get_all(),
            'start' => 0
        );
        $this->load->view('m_dat/m_dat_print', $data);
    }

}

/* End of file M_dat.php */
/* Location: ./application/controllers/M_dat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-05 02:23:18 */
/* http://harviacode.com */