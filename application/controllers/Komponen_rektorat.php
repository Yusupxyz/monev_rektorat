<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Komponen_rektorat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Komponen_rektorat_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'komponen_rektorat?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'komponen_rektorat?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'komponen_rektorat';
            $config['first_url'] = base_url() . 'komponen_rektorat';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Komponen_rektorat_model->total_rows($q);
        $komponen_rektorat = $this->Komponen_rektorat_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'komponen_rektorat_data' => $komponen_rektorat,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Komponen Rektorat';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Komponen Rektorat' => '',
        ];
        $data['code_js'] = 'komponen_rektorat/codejs';
        $data['page'] = 'komponen_rektorat/Komponen_rektorat_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Komponen_rektorat_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_komponen' => $row->id_komponen,
		'id_kegiatan' => $row->id_kegiatan,
		'kode_komponen' => $row->kode_komponen,
		'uraian_kegiatan' => $row->uraian_kegiatan,
		'volume' => $row->volume,
		'satuan' => $row->satuan,
		'jumlah' => $row->jumlah,
		'rencana_capaian' => $row->rencana_capaian,
		'capaian' => $row->capaian,
		'jumlah_capaian' => $row->jumlah_capaian,
	    );
        $data['title'] = 'Komponen Rektorat';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'komponen_rektorat/Komponen_rektorat_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('komponen_rektorat'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('komponen_rektorat/create_action'),
	    'id_komponen' => set_value('id_komponen'),
	    'id_kegiatan' => set_value('id_kegiatan'),
	    'kode_komponen' => set_value('kode_komponen'),
	    'uraian_kegiatan' => set_value('uraian_kegiatan'),
	    'volume' => set_value('volume'),
	    'satuan' => set_value('satuan'),
	    'jumlah' => set_value('jumlah'),
	    'rencana_capaian' => set_value('rencana_capaian'),
	    'capaian' => set_value('capaian'),
	    'jumlah_capaian' => set_value('jumlah_capaian'),
	);
        $data['title'] = 'Komponen Rektorat';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'komponen_rektorat/Komponen_rektorat_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_komponen' => $this->input->post('id_komponen',TRUE),
		'id_kegiatan' => $this->input->post('id_kegiatan',TRUE),
		'kode_komponen' => $this->input->post('kode_komponen',TRUE),
		'uraian_kegiatan' => $this->input->post('uraian_kegiatan',TRUE),
		'volume' => $this->input->post('volume',TRUE),
		'satuan' => $this->input->post('satuan',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
		'rencana_capaian' => $this->input->post('rencana_capaian',TRUE),
		'capaian' => $this->input->post('capaian',TRUE),
		'jumlah_capaian' => $this->input->post('jumlah_capaian',TRUE),
	    );
if(! $this->Komponen_rektorat_model->is_exist($this->input->post('id_komponen'))){
                $this->Komponen_rektorat_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('komponen_rektorat'));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, id_komponen is exist');
            }}
    }
    
    public function update($id) 
    {
        $row = $this->Komponen_rektorat_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('komponen_rektorat/update_action'),
		'id_komponen' => set_value('id_komponen', $row->id_komponen),
		'id_kegiatan' => set_value('id_kegiatan', $row->id_kegiatan),
		'kode_komponen' => set_value('kode_komponen', $row->kode_komponen),
		'uraian_kegiatan' => set_value('uraian_kegiatan', $row->uraian_kegiatan),
		'volume' => set_value('volume', $row->volume),
		'satuan' => set_value('satuan', $row->satuan),
		'jumlah' => set_value('jumlah', $row->jumlah),
		'rencana_capaian' => set_value('rencana_capaian', $row->rencana_capaian),
		'capaian' => set_value('capaian', $row->capaian),
		'jumlah_capaian' => set_value('jumlah_capaian', $row->jumlah_capaian),
	    );
            $data['title'] = 'Komponen Rektorat';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'komponen_rektorat/Komponen_rektorat_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('komponen_rektorat'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_komponen', TRUE));
        } else {
            $data = array(
		'id_komponen' => $this->input->post('id_komponen',TRUE),
		'id_kegiatan' => $this->input->post('id_kegiatan',TRUE),
		'kode_komponen' => $this->input->post('kode_komponen',TRUE),
		'uraian_kegiatan' => $this->input->post('uraian_kegiatan',TRUE),
		'volume' => $this->input->post('volume',TRUE),
		'satuan' => $this->input->post('satuan',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
		'rencana_capaian' => $this->input->post('rencana_capaian',TRUE),
		'capaian' => $this->input->post('capaian',TRUE),
		'jumlah_capaian' => $this->input->post('jumlah_capaian',TRUE),
	    );

            $this->Komponen_rektorat_model->update($this->input->post('id_komponen', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('komponen_rektorat'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Komponen_rektorat_model->get_by_id($id);

        if ($row) {
            $this->Komponen_rektorat_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('komponen_rektorat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('komponen_rektorat'));
        }
    }

    public function deletebulk(){
        $delete = $this->Komponen_rektorat_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('id_komponen', 'id komponen', 'trim|required');
	$this->form_validation->set_rules('id_kegiatan', 'id kegiatan', 'trim|required');
	$this->form_validation->set_rules('kode_komponen', 'kode komponen', 'trim|required');
	$this->form_validation->set_rules('uraian_kegiatan', 'uraian kegiatan', 'trim|required');
	$this->form_validation->set_rules('volume', 'volume', 'trim|required');
	$this->form_validation->set_rules('satuan', 'satuan', 'trim|required');
	$this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');
	$this->form_validation->set_rules('rencana_capaian', 'rencana capaian', 'trim|required');
	$this->form_validation->set_rules('capaian', 'capaian', 'trim|required');
	$this->form_validation->set_rules('jumlah_capaian', 'jumlah capaian', 'trim|required');

	$this->form_validation->set_rules('id_komponen', 'id_komponen', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Komponen_rektorat.php */
/* Location: ./application/controllers/Komponen_rektorat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-27 09:40:00 */
/* http://harviacode.com */