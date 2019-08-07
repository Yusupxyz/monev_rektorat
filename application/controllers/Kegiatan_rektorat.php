<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kegiatan_rektorat extends CI_Controller
{
    public $tahun ="";
    public $group_id="";

    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Kegiatan_rektorat_model');
        $this->load->library('form_validation');
        $this->load->model('Komponen_rektorat_model');
        $this->load->model('Komponen_model');
        $this->load->model('Sub_komponen_rektorat_model');
        $this->load->model('Sub_komponen_model');
        $this->load->model('Tahun_model');
        $this->load->model('Users_model');
        $this->tahun = $this->Tahun_model->get_by_aktif()->id_tahun;
    }

    public function index()
    {
        $count_child=array();
        $count_child_komponen=array();
        $komponen=array();
        $subkomponen=array();
        $user = $this->ion_auth->user()->row();
        $b=$user->id_unit;
        $this->group_id=$this->Users_model->get_group_id($user->id)->group_id;
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'kegiatan_rektorat?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kegiatan_rektorat?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'kegiatan_rektorat';
            $config['first_url'] = base_url() . 'kegiatan_rektorat';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kegiatan_rektorat_model->total_rows($q,$b,$this->tahun);
        $kegiatan_rektorat = $this->Kegiatan_rektorat_model->get_limit_data($config['per_page'], $start, $q,$b,$this->tahun);
        $title = $this->db->query("select * from unit where id_unit = $b")->result();
        
        for ($i=0;$i<$this->Kegiatan_rektorat_model->count_kegiatan($b,$this->tahun)->count;$i++){
            $count_child[] =$this->Kegiatan_rektorat_model->count_child($i,$b,$this->tahun);
            $komponen[] = $this->Komponen_rektorat_model->get_by_id_kegiatan($i,$b,$this->tahun);
        }
        $kode_komponen=$this->Komponen_rektorat_model->get_all();
        for ($i=0;$i<$this->Komponen_rektorat_model->count_komponen($b)->count;$i++){
            $count_child_komponen[] =$this->Komponen_rektorat_model->count_child($i,$b);
            $subkomponen[] = $this->Sub_komponen_rektorat_model->get_by_id_komponen($i,$b,$this->tahun);
            $count_child_komponen_unit[] =$this->Komponen_rektorat_model->count_child_unit($i,$b);
            $subkomponenunit[] = $this->Sub_komponen_model->get_by_id_komponen_rektorat($i,$b,$this->tahun);
        }

        // echo "<pre>"; print_r($subkomponen);echo"</pre>";
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kegiatan_rektorat_data' => $kegiatan_rektorat,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'count_child' => $count_child,
            'count_child_komponen' => $count_child_komponen,
            'count_child_komponen_unit' => $count_child_komponen_unit,
            'komponen' => $komponen,
            'subkomponen' => $subkomponen,
            'subkomponenunit' => $subkomponenunit,
            'group_id' => $this->group_id,
            'id_unit' => $b
        );
        $data['title'] = 'RKA Kegiatan Rektorat';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Kegiatan Rektorat' => '',
        ];
        $data['code_js'] = 'kegiatan_rektorat/codejs';
        $data['page'] = 'kegiatan_rektorat/Kegiatan_rektorat_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Kegiatan_rektorat_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kegiatan' => $row->id_kegiatan,
		'kode_m_dat' => $row->kode_m_dat,
		'volume' => $row->volume,
		'satuan' => $row->satuan,
		'jumlah' => $row->jumlah,
		'rencana_capaian' => $row->rencana_capaian,
		'capaian' => $row->capaian,
		'jumlah_capaian' => $row->jumlah_capaian,
		'id_unit' => $row->id_unit,
		'id_tahun' => $row->id_tahun,
	    );
        $data['title'] = 'Kegiatan Rektorat';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'kegiatan_rektorat/Kegiatan_rektorat_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kegiatan_rektorat'));
        }
    }

    public function create($page=null,$id=null) 
    {
        $data = array(
            'button' => 'Tambah',
             'action' => site_url('kegiatan_rektorat/create_action'),
	    'id_kegiatan' => set_value('id_kegiatan'),
	    'kode_m_dat' => set_value('kode_m_dat'),
	    'volume' => set_value('volume'),
	    'satuan' => set_value('satuan'),
	    'jumlah' => set_value('jumlah'),
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
            $data['page'] = 'kegiatan_rektorat/Kegiatan_rektorat_form_program';
        }elseif ($page=='sub_program'){
            $data['m_data'] = $this->m_dat_model->get_m_dat_induk('3');
            $data['page'] = 'kegiatan_rektorat/Kegiatan_rektorat_form_sub';
        }elseif ($page=='sub_output'){
            $data['m_data'] = $this->m_dat_model->get_m_dat_induk('4');
            $data['page'] = 'kegiatan_rektorat/Kegiatan_rektorat_form_sub_output';
        }elseif ($page=='komponen'){
            $data['action'] =site_url('kegiatan_rektorat/create_action_komponen/'.$id);
            $data['page'] = 'kegiatan_rektorat/Kegiatan_rektorat_form_komponen';
        }elseif ($page=='subkomponen'){
            $data['action'] =site_url('kegiatan_rektorat/create_action_subkomponen/'.$id);
            $data['page'] = 'kegiatan_rektorat/Kegiatan_rektorat_form_subkomponen';
        }else{
            $data['m_data'] = $this->m_dat_model->get_m_dat_induk('1');
            $data['page'] = 'kegiatan_rektorat/Kegiatan_rektorat_form';
        }
    
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
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
        'id_tahun' => $this->tahun
	    );

        //print_r($id_unit);
        if(! $this->Kegiatan_rektorat_model->is_exist($this->input->post('id_kegiatan'))){
                $this->Kegiatan_rektorat_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kegiatan_rektorat'));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, id_kegiatan is exist');
            }
        }
    }

    public function create_action_komponen($id=null) 
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

        if(!$this->Komponen_rektorat_model->is_exist($this->input->post('id_subkomponen'))){
                $this->Komponen_rektorat_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('kegiatan_rektorat/'.$id_unit));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, id_kegiatan is exist');
            }
        }
    }

    public function create_action_subkomponen($id=null) 
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
        if(! $this->Sub_komponen_rektorat_model->is_exist($this->input->post('id_subkomponen'))){
            $this->Sub_komponen_rektorat_model->insert($data);
          
            // //update komponen
            // $id_komponen=$this->Komponen_rektorat_model->get_id_komponen($id_unit);
            // foreach ($id_komponen as $key => $value) {
            //     if (!isset($this->Sub_komponen_rektorat_model->sum_komponen($value->id_komponen)->sum)){
            //         $sum_komponen = array(
            //             'jumlah' => '0'
            //         );
            //     }else{
            //         $sum_komponen = array(
            //             'jumlah' => $this->Sub_komponen_rektorat_model->sum_komponen($value->id_komponen)->sum
            //         );
            //     }
            //     $this->Komponen_rektorat_model->update($value->id_komponen,$sum_komponen);
            // }
            
            // //update sub output
            // $id_kegiatan=$this->Komponen_rektorat_model->get_id_kegiatan($id_unit);
            // foreach ($id_kegiatan as $key => $value) {
            //     $sum_sub_output = array(
            //         'jumlah' => $this->Komponen_rektorat_model->sum_sub_output($value->id_kegiatan)->sum
            //     );
            //     $this->Kegiatan_rektorat_model->update($value->id_kegiatan,$sum_sub_output);
            // }

            // //update kegiatan
            // for ($i=4;$i>1;$i--){
            //     $sum = array(
            //         'jumlah' => $this->Kegiatan_rektorat_model->sum($i,$id_unit)->sum
            //     );
            //     $id_kegiatan= $this->Kegiatan_rektorat_model->get_id_kegiatan($i-1,$id_unit)->id_kegiatan;
            //     $this->Kegiatan_rektorat_model->update($id_kegiatan,$sum);
            // }

            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kegiatan_rektorat'));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, id_kegiatan is exist');
            }}
    }
    
    public function update($id=null,$page=null) 
    {
        $row = $this->Kegiatan_rektorat_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kegiatan/update_action'),
		'id_kegiatan' => set_value('id_kegiatan', $row->id_kegiatan),
		'kode_m_dat' => set_value('kode_m_dat', $row->kode_m_dat),
		'volume' => set_value('volume', $row->volume),
		'satuan' => set_value('satuan', $row->satuan),
		'jumlah' => set_value('jumlah', $row->jumlah),
	    );
            $data['title'] = 'Kegiatan Rektorat';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $this->load->model('m_dat_model');
        if ($page=='program'){
            $data['m_data'] = $this->m_dat_model->get_m_dat_induk('2');
            $data['selected'] = $this->Kegiatan_rektorat_model->get_by_id($id)->kode_m_dat;
            $data['page'] = 'kegiatan_rektorat/Kegiatan_rektorat_form_program';
        }elseif ($page=='sub_program'){
            $data['m_data'] = $this->m_dat_model->get_m_dat_induk('3');
            $data['selected'] = $this->Kegiatan_rektorat_model->get_by_id($id)->kode_m_dat;
            $data['page'] = 'kegiatan_rektorat/Kegiatan_rektorat_form_sub';
        }elseif ($page=='sub_output'){
            $data['m_data'] = $this->m_dat_model->get_m_dat_induk('4');
            $data['selected'] = $this->Kegiatan_rektorat_model->get_by_id($id)->kode_m_dat;
            $data['page'] = 'kegiatan_rektorat/Kegiatan_rektorat_form_sub_output';
        }elseif ($page=='komponen'){
            $data['action'] =site_url('kegiatan/create_action_komponen/'.$id_unit.'/'.$id);
            $data['page'] = 'kegiatan_rektorat/Kegiatan_rektorat_form_komponen';
        }elseif ($page=='subkomponen'){
            $data['action'] =site_url('kegiatan/create_action_subkomponen/'.$id_unit.'/'.$id);
            $data['page'] = 'kegiatan_rektorat/Kegiatan_rektorat_form_subkomponen';
        }else{
            $data['m_data'] = $this->m_dat_model->get_m_dat_induk('1');
            $data['selected'] = $this->Kegiatan_rektorat_model->get_by_id($id)->kode_m_dat;
            $data['page'] = 'kegiatan_rektorat/Kegiatan_rektorat_form';
        }
        $data['page'] = 'kegiatan_rektorat/Kegiatan_rektorat_form';
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
            $this->create();
        } else {    
            $data = array(
		'kode_m_dat' => $this->input->post('kode_m_dat',TRUE),
		'volume' => $this->input->post('volume',TRUE),
		'satuan' => $this->input->post('satuan',TRUE),
		'jumlah' => '-',
        'id_tahun' => $this->tahun
	    );

            $this->Kegiatan_rektorat_model->update($this->input->post('id_kegiatan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kegiatan_rektorat'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kegiatan_rektorat_model->get_by_id($id);

        if ($row) {
            $this->Kegiatan_rektorat_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kegiatan_rektorat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kegiatan_rektorat'));
        }
    }

    public function deletebulk(){
        $delete = $this->Kegiatan_rektorat_model->deletebulk();
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

    public function export(){
        // Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php';
        
        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('YH')
                     ->setLastModifiedBy('YH')
                     ->setTitle("Data Kegiatan")
                     ->setSubject("Unit")
                     ->setDescription("Laporan Semua Data RKA Rektorat")
                     ->setKeywords("RKA Rektorat");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
          'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ),
          'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
          )    
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
          'alignment' => array(
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ),
          'borders' => array(
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
          )
        );

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row2 = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
              'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
              'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row3 = array(
            'borders' => array(
              'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
              'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row4 = array(
            'borders' => array(
              'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
       
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "kode"); // Set kolom A3 dengan tulisan "Kode"
        $excel->setActiveSheetIndex(0)->setCellValue('B1', "uraian"); // Set kolom B3 dengan tulisan "Uraian"
        $excel->setActiveSheetIndex(0)->setCellValue('C1', "jumlah"); // Set kolom C3 dengan tulisan "Jumlah"
        $excel->setActiveSheetIndex(0)->setCellValue('D1', "rencana capaian"); // Set kolom D3 dengan tulisan "Rencana Capaian"
        $excel->setActiveSheetIndex(0)->setCellValue('E1', "realisasi capaian fisik"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('F1', "realisasi jumlah capaian"); // Set kolom F3 dengan tulisan "ALAMAT"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E1')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F1')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $b=0;
        $kegiatan_rektorat = $this->Kegiatan_rektorat_model->get_limit_data('1000', '0', null,$b,$this->tahun);
        for ($i=0;$i<$this->Kegiatan_rektorat_model->count_kegiatan($b,$this->tahun)->count;$i++){
            $count_child[] =$this->Kegiatan_rektorat_model->count_child($i,$b,$this->tahun);
            $komponen[] = $this->Komponen_rektorat_model->get_by_id_kegiatan($i,$b,$this->tahun);
        }
        $kode_komponen=$this->Komponen_rektorat_model->get_all();
        for ($i=0;$i<$this->Komponen_rektorat_model->count_komponen($b)->count;$i++){
            $count_child_komponen[] =$this->Komponen_rektorat_model->count_child($i,$b);
            $subkomponen[] = $this->Sub_komponen_rektorat_model->get_by_id_komponen($i,$b,$this->tahun);
            $count_child_komponen_unit[] =$this->Komponen_rektorat_model->count_child_unit($i,$b);
            $subkomponenunit[] = $this->Sub_komponen_model->get_by_id_komponen_rektorat($i,$b,$this->tahun);
        }
        // var_dump($count_child_komponen);
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        $i=0; // array cek komponen
        $j=0; // array cek subkomponen
        //data kegiatan rektorat
        foreach($kegiatan_rektorat as $data){ // Lakukan looping pada variabel kegiatan rektorat 
        $rencana_capaian=$data->rencana_capaian/100;
        $capaian=$data->rencana_capaian/100;
          $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data->kode_m_dat);
          $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->ket);
          $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->jumlah);
          $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $rencana_capaian);
          $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $capaian);
          $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->jumlah_capaian);
          
          // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
          $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row3);
          $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row2);
          $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row2);
          $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row3);
          
          $numrow++; // Tambah 1 setiap kali looping
          // data komponen rektorat
          if ($count_child[$i]->jumlah_anak=='0'){
            if (isset($komponen[$i][0])){
                foreach($komponen[$i] as $data => $value){ // Lakukan looping pada variabel komponen rektorat
                    $rencana_capaian=$value->rencana_capaian/100;
                    $capaian=$value->rencana_capaian/100;
                    $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $value->kode_komponen);
                    $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $value->uraian_kegiatan);
                    $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $value->jumlah);
                    $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, rencana_capaian);
                    $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $capaian);
                    $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $value->jumlah_capaian);
                    
                    // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
                    $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
                    $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
                    $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row3);
                    $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row2);
                    $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row2);
                    $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row3);
                    
                    $numrow++; // Tambah 1 setiap kali looping 

                    // data sub komponen rektorat
                    if ($count_child_komponen[$j]->jumlah_anak!='0'){
                        if (isset($subkomponen[$j][0])){
                            foreach($subkomponen[$j] as $data => $value_sub){ // Lakukan looping pada variabel sub komponen rektorat
                                $rencana_capaian=$value_sub->rencana_capaian/100;
                                $capaian=$value_sub->rencana_capaian/100;
                                $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $value_sub->kode_subkomponen);
                                $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $value_sub->uraian_kegiatan);
                                $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $value_sub->jumlah);
                                $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $rencana_capaian);
                                $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $capaian);
                                $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $value_sub->jumlah_capaian);
                                
                                // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
                                $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
                                $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
                                $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row3);
                                $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row2);
                                $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row2);
                                $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row3);
                                
                                $numrow++; // Tambah 1 setiap kali looping 

                            }
                        }
                    }
                    
                    // data sub komponen unit
                    if ($count_child_komponen_unit[$j]->jumlah_anak!='0'){
                        if (isset($subkomponenunit[$j][0])){
                            foreach($subkomponenunit[$j] as $data => $value_sub_unit){ // Lakukan looping pada variabel sub komponen unit
                                $rencana_capaian=$value_sub_unit->rencana_capaian/100;
                                $capaian=$value_sub_unit->rencana_capaian/100;
                                $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $value_sub_unit->kode_subkomponen);
                                $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $value_sub_unit->uraian_kegiatan);
                                $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $value_sub_unit->jumlah);
                                $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $rencana_capaian);
                                $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $capaian);
                                $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $value_sub_unit->jumlah_capaian);
                                
                                // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
                                $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
                                $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
                                $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row3);
                                $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row2);
                                $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row2);
                                $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row3);
                                
                                $numrow++; // Tambah 1 setiap kali looping 

                            }
                        }
                    }
                   $j++; // tambah array cek sub komponen
                }
            }
        }
        $i++; // tambah array cek komponen
        }
        $numrow--;
        // Set style row data terakhir
        $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row4);
        $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row4);
        $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row4);
        $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row4);
        $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row4);
        $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row4);

        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(15); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(110); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(25); // Set width kolom F

        // Set currency format
        $excel->getActiveSheet()->getStyle('C2:C'.$numrow)->getNumberFormat()->setFormatCode( '###0,00_-'); 
        $excel->getActiveSheet()->getStyle('F2:F'.$numrow)->getNumberFormat()->setFormatCode( '###0,00_-'); 

        // Set percentage format
        $excel->getActiveSheet()->getStyle('D2:D'.$numrow)->getNumberFormat()->applyFromArray( 
            array( 
                'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE
            )
        ); 
        $excel->getActiveSheet()->getStyle('E2:E'.$numrow)->getNumberFormat()->applyFromArray( 
            array( 
                'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE
            )
        ); 
        
        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("rkakal all");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="List Monitoring.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
      }

}

/* End of file Kegiatan_rektorat.php */
/* Location: ./application/controllers/Kegiatan_rektorat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-27 08:58:48 */
/* http://harviacode.com */