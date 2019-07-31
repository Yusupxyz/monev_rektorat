<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sub_komponen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Sub_komponen_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'sub_komponen?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'sub_komponen?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'sub_komponen';
            $config['first_url'] = base_url() . 'sub_komponen';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Sub_komponen_model->total_rows($q);
        $sub_komponen = $this->Sub_komponen_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'sub_komponen_data' => $sub_komponen,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Sub Komponen';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Sub Komponen' => '',
        ];
        $data['code_js'] = 'sub_komponen/codejs';
        $data['page'] = 'sub_komponen/Sub_komponen_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Sub_komponen_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_subkomponen' => $row->id_subkomponen,
		'id_komponen' => $row->id_komponen,
		'kode_subkomponen' => $row->kode_subkomponen,
		'uraian_kegiatan' => $row->uraian_kegiatan,
		'volume' => $row->volume,
		'satuan' => $row->satuan,
		'jumlah' => $row->jumlah,
	    );
        $data['title'] = 'Sub Komponen';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'sub_komponen/Sub_komponen_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sub_komponen'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('sub_komponen/create_action'),
	    'id_subkomponen' => set_value('id_subkomponen'),
	    'id_komponen' => set_value('id_komponen'),
	    'kode_subkomponen' => set_value('kode_subkomponen'),
	    'uraian_kegiatan' => set_value('uraian_kegiatan'),
	    'volume' => set_value('volume'),
	    'satuan' => set_value('satuan'),
	    'jumlah' => set_value('jumlah'),
	);
        $data['title'] = 'Sub Komponen';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'sub_komponen/Sub_komponen_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_subkomponen' => $this->input->post('id_subkomponen',TRUE),
		'id_komponen' => $this->input->post('id_komponen',TRUE),
		'kode_subkomponen' => $this->input->post('kode_subkomponen',TRUE),
		'uraian_kegiatan' => $this->input->post('uraian_kegiatan',TRUE),
		'volume' => $this->input->post('volume',TRUE),
		'satuan' => $this->input->post('satuan',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
	    );
if(! $this->Sub_komponen_model->is_exist($this->input->post('id_subkomponen'))){
                $this->Sub_komponen_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('sub_komponen'));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, id_subkomponen is exist');
            }}
    }
    
    public function update($id) 
    {
        $row = $this->Sub_komponen_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sub_komponen/update_action'),
		'id_subkomponen' => set_value('id_subkomponen', $row->id_subkomponen),
		'id_komponen' => set_value('id_komponen', $row->id_komponen),
		'kode_subkomponen' => set_value('kode_subkomponen', $row->kode_subkomponen),
		'uraian_kegiatan' => set_value('uraian_kegiatan', $row->uraian_kegiatan),
		'volume' => set_value('volume', $row->volume),
		'satuan' => set_value('satuan', $row->satuan),
		'jumlah' => set_value('jumlah', $row->jumlah),
	    );
            $data['title'] = 'Sub Komponen';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'sub_komponen/Sub_komponen_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sub_komponen'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_subkomponen', TRUE));
        } else {
            $data = array(
		'id_subkomponen' => $this->input->post('id_subkomponen',TRUE),
		'id_komponen' => $this->input->post('id_komponen',TRUE),
		'kode_subkomponen' => $this->input->post('kode_subkomponen',TRUE),
		'uraian_kegiatan' => $this->input->post('uraian_kegiatan',TRUE),
		'volume' => $this->input->post('volume',TRUE),
		'satuan' => $this->input->post('satuan',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
	    );

            $this->Sub_komponen_model->update($this->input->post('id_subkomponen', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sub_komponen'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Sub_komponen_model->get_by_id($id);

        if ($row) {
            $this->Sub_komponen_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sub_komponen'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sub_komponen'));
        }
    }

    public function deletebulk(){
        $delete = $this->Sub_komponen_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('id_subkomponen', 'id subkomponen', 'trim|required');
	$this->form_validation->set_rules('id_komponen', 'id komponen', 'trim|required');
	$this->form_validation->set_rules('kode_subkomponen', 'kode subkomponen', 'trim|required');
	$this->form_validation->set_rules('uraian_kegiatan', 'uraian kegiatan', 'trim|required');
	$this->form_validation->set_rules('volume', 'volume', 'trim|required');
	$this->form_validation->set_rules('satuan', 'satuan', 'trim|required');
	$this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');

	$this->form_validation->set_rules('id_subkomponen', 'id_subkomponen', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Sub_komponen.php */
/* Location: ./application/controllers/Sub_komponen.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-08 23:34:45 */
/* http://harviacode.com */