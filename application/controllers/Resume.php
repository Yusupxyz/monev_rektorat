<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Resume extends CI_Controller
{
    public $tahun = "";
    public $group_id = "";

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
        $this->load->model('Realisasi_model');
        $this->load->library('form_validation');
        $this->tahun = $this->Tahun_model->get_by_aktif()->id_tahun;
    }

    public function index($b = null, $view = null)
    {
        //route untuk setiap kegiatan unit
        if ($b == null && $view == null) {
            $user = $this->ion_auth->user()->row();
            $b = $user->id_unit;
            $this->group_id = $this->Users_model->get_group_id($user->id)->group_id;
        } elseif ($view == 'view') {
            $user = $this->ion_auth->user()->row();
            $this->group_id = $this->Users_model->get_group_id($user->id)->group_id;
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
        $config['total_rows'] = $this->Kegiatan_model->total_rows($q, $b, $this->tahun);
        $kegiatan = $this->Kegiatan_model->get_limit_data($config['per_page'], $start, $q, $b, $this->tahun);
        $title = $this->db->query("select * from unit where id_unit = $b")->result();


        // print_r($this->tahun);
        for ($i = 0; $i < $this->Kegiatan_model->count_kegiatan($b, $this->tahun)->count; $i++) {
            $count_child[] = $this->Kegiatan_model->count_child($i, $b, $this->tahun);
            $komponen[] = $this->Komponen_model->get_by_id_kegiatan($i, $b, $this->tahun);
        }

        for ($i = 0; $i < $this->Komponen_model->count_komponen($b)->count; $i++) {
            $count_child_komponen[] = $this->Komponen_model->count_child_resume($i, $b);
            $subkomponen[] = $this->Sub_komponen_model->get_by_id_komponen_resume($i,  $this->tahun,$b);
            $count_child_komponen_unit[] =$this->Komponen_model->count_child_unit($i);
            $subkomponenunit[] = $this->Sub_komponen_model->get_by_id_komponen_rektorat($i,$b,$this->tahun);
        }

        if (isset($kegiatan)){
            foreach ($kegiatan as $key ) { 
                $data_jumlah_kegiatan[]=$this->Kegiatan_model->sum_jumlah($key->kode_m_dat);
            }
        }
        if (isset($komponen)){
            for ($j=0; $j < count($komponen) ; $j++) { 
                    if (isset($komponen[$j][0])){ 
                        foreach ($komponen[$j] as $key => $value) { 
                            if ($this->Komponen_model->count_kode_komponen($value->kode_komponen)->count==0){
                                $data_jumlah[$j][]=$this->Komponen_model->get_data_by_kode($value->id_komponen);
                            }else{
                                $data_jumlah[$j][]=$this->Sub_komponen_model->get_data_by_kode($value->kode_komponen);
                            }
                            $count_jumlah[$j][]=$this->Sub_komponen_model->count_by_kode($value->kode_komponen);
                            $jenis[$j][]=$data_jumlah_kegiatan[$j]->jenis;
                        }
                    }else{
                        $data_jumlah[$j]='';
                        $count_jumlah[$j]='';
                        $jenis[$j][]='';
                    }
                }
            
            for ($i=0; $i < count($data_jumlah) ; $i++) { 
                $jumlah_rc=0;
                $jumlah_c=0;
                if ($data_jumlah[$i]!=null){
                    for ($j=0; $j < count($data_jumlah[$i]) ; $j++) { 
                        $jumlah_rc=$jumlah_rc+$data_jumlah[$i][$j]->rc;
                        $jumlah_c=$jumlah_c+$data_jumlah[$i][$j]->c;
                    }
                     $jumlah_rc=round($jumlah_rc/count($data_jumlah[$i]));
                     $jumlah_c=round($jumlah_c/count($data_jumlah[$i]));
                }
                $data_suboutput[$i]['jc']=$jumlah_rc;
                $data_suboutput[$i]['c']=$jumlah_c;
            }
            
            $i=0;
            foreach ($kegiatan as $key ) {
                $jumlah_rc=0;
                $jumlah_c=0;
                if ($key->jenis==3){
                    $temp=$key->kode_m_dat;
                    $j=0;
                    foreach ($kegiatan as $key2) {
                        if ($key2->jenis==4 && $key2->induk==$temp){
                            $jumlah_rc=$jumlah_rc+$data_suboutput[$j]['jc'];
                            $jumlah_c=$jumlah_c+$data_suboutput[$j]['c'];
                        }
                        $j++;
                    }
                    $data_subprogram[$i]['jc']=$jumlah_rc;
                    $data_subprogram[$i++]['c']=$jumlah_c;
                }else{
                    $data_subprogram[$i]['jc']=$jumlah_rc;
                    $data_subprogram[$i++]['c']=$jumlah_c;
                }
            }

            $i=0;
            foreach ($kegiatan as $key ) {
                $jumlah_rc=0;
                $jumlah_c=0;
                if ($key->jenis==2){
                    $temp=$key->kode_m_dat;
                    $j=0;
                    foreach ($kegiatan as $key2) {
                        if ($key2->jenis==3 && $key2->induk==$temp){
                            $jumlah_rc=$jumlah_rc+$data_subprogram[$j]['jc'];
                            $jumlah_c=$jumlah_c+$data_subprogram[$j]['c'];
                        }
                        $j++;
                    }
                    $data_program[$i]['jc']=$jumlah_rc;
                    $data_program[$i++]['c']=$jumlah_c;
                }else{
                    $data_program[$i]['jc']=$jumlah_rc;
                    $data_program[$i++]['c']=$jumlah_c;
                }
            }

            $i=0;
            foreach ($kegiatan as $key ) {
                $jumlah_rc=0;
                $jumlah_c=0;
                if ($key->jenis==2){
                    $temp=$key->kode_m_dat;
                    $j=0;
                    foreach ($kegiatan as $key2) {
                        if ($key2->jenis==3){
                            $jumlah_rc=$jumlah_rc+$data_subprogram[$j]['jc'];
                            $jumlah_c=$jumlah_c+$data_subprogram[$j]['c'];
                        }
                        $j++;
                    }
                    $data_program_backup[$i]['jc']=$jumlah_rc;
                    $data_program_backup[$i++]['c']=$jumlah_c;
                }else{
                    $data_program_backup[$i]['jc']=$jumlah_rc;
                    $data_program_backup[$i++]['c']=$jumlah_c;
                }
            }

            // $i=0;
            // foreach ($kegiatan as $key ) {
            //     $jumlah_rc=0;
            //     $jumlah_c=0;
            //     if ($key->jenis==1){
            //         $temp=$key->kode_m_dat;
            //         $j=0;
            //         foreach ($kegiatan as $key2) {
            //             if ($key2->jenis==2 && $key2->induk==$temp){
            //                 $jumlah_rc=$jumlah_rc+$data_program[$j]['jc'];
            //                 $jumlah_c=$jumlah_c+$data_program[$j]['c'];
            //             }
            //             $j++;
            //         }
            //         $data_program_induk[$i]['jc']=$jumlah_rc;
            //         $data_program_induk[$i++]['c']=$jumlah_c;
            //     }else{
            //         $data_program_induk[$i]['jc']=$jumlah_rc;
            //         $data_program_induk[$i++]['c']=$jumlah_c;
            //     }
            // }
        }
        
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kegiatan_data' => $kegiatan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'group_id' => $this->group_id,
            'id_unit' => $b
        );

        if (isset($count_child))
            $data['count_child'] = $count_child;
        if (isset($count_child_komponen))
            $data['count_child_komponen'] = $count_child_komponen;
        if (isset($count_child_komponen_unit))
            $data['count_child_komponen_unit'] = $count_child_komponen_unit;
        if (isset($komponen))
            $data['komponen'] = $komponen;
        if (isset($subkomponen))
            $data['subkomponen'] = $subkomponen;
        if (isset($subkomponenunit))
            $data['subkomponenunit'] = $subkomponenunit;
        if (isset($data_jumlah))
            $data['data_komponen'] = $data_jumlah;
        if (isset($data_jumlah_kegiatan))
            $data['data_jumlah_kegiatan'] = $data_jumlah_kegiatan;
        if (isset($data_suboutput))
            $data['data_suboutput'] = $data_suboutput;
        if (isset($data_program_backup))
            $data['data_program_induk'] = $data_program_backup;
        if (isset($data_program))
            $data['data_program'] = $data_program;
        if (isset($data_subprogram))
            $data['data_subprogram'] = $data_subprogram;
        if (isset($count_jumlah))
            $data['count_jumlah'] = $count_jumlah;

        // echo "<pre>"; print_r($data_program_backup);echo"</pre>";
        // echo "<pre>"; print_r($kegiatan);echo"</pre>";

        $data['title'] = 'Resume';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Kegiatan' => '',
        ];
        $data['code_js'] = 'kegiatan/codejs';
        $data['page'] = 'resume/resume_list';

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

    public function create($id_unit, $page = null, $id = null)
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('kegiatan/create_action/' . $id_unit),
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
        if ($page == 'program') {
            $data['m_data'] = $this->m_dat_model->get_m_dat_induk('2');
            $data['page'] = 'kegiatan/Kegiatan_form_program';
        } elseif ($page == 'sub_program') {
            $data['m_data'] = $this->m_dat_model->get_m_dat_induk('3');
            $data['page'] = 'kegiatan/Kegiatan_form_sub';
        } elseif ($page == 'sub_output') {
            $data['m_data'] = $this->m_dat_model->get_m_dat_induk('4');
            $data['page'] = 'kegiatan/Kegiatan_form_sub_output';
        } elseif ($page == 'komponen') {
            $data['action'] = site_url('kegiatan/create_action_komponen/' . $id_unit . '/' . $id);
            $data['page'] = 'kegiatan/Kegiatan_form_komponen';
        } elseif ($page == 'subkomponen') {
            $data['action'] = site_url('kegiatan/create_action_subkomponen/' . $id_unit . '/' . $id);
            $data['page'] = 'kegiatan/Kegiatan_form_subkomponen';
        } else {
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
                'kode_m_dat' => $this->input->post('kode_m_dat', TRUE),
                'volume' => $this->input->post('volume', TRUE),
                'satuan' => $this->input->post('satuan', TRUE),
                'jumlah' => '-',
                'id_unit' => $id_unit,
                'id_tahun' => $this->tahun

            );

            //print_r($id_unit);
            if (!$this->Kegiatan_model->is_exist($this->input->post('id_kegiatan'))) {
                $this->Kegiatan_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('kegiatan/' . $id_unit));
            } else {
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, id_kegiatan is exist');
            }
        }
    }

    public function create_action_komponen($id_unit, $id = null)
    {
        $this->_rules();
        $user = $this->ion_auth->user()->row();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'kode_komponen' => $this->input->post('kode_komponen', TRUE),
                'id_kegiatan' => $id,
                'uraian_kegiatan' => $this->input->post('uraian_kegiatan', TRUE),
                'volume' => $this->input->post('volume', TRUE),
                'satuan' => $this->input->post('satuan', TRUE),
                'jumlah' => '-'
            );

            if (!$this->Komponen_model->is_exist($this->input->post('id_subkomponen'))) {
                $this->Komponen_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('kegiatan/' . $id_unit));
            } else {
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, id_kegiatan is exist');
            }
        }
    }

    public function create_action_subkomponen($id_unit, $id = null)
    {
        $this->_rules();
        $user = $this->ion_auth->user()->row();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'kode_subkomponen' => $this->input->post('kode_subkomponen', TRUE),
                'id_komponen' => $id,
                'uraian_kegiatan' => $this->input->post('uraian_kegiatan', TRUE),
                'volume' => $this->input->post('volume', TRUE),
                'satuan' => $this->input->post('satuan', TRUE),
                'jumlah' => $this->input->post('jumlah', TRUE)
            );
            if (!$this->Sub_komponen_model->is_exist($this->input->post('id_subkomponen'))) {
                $this->Sub_komponen_model->insert($data);

                //update komponen
                $id_komponen = $this->Komponen_model->get_id_komponen($id_unit);
                foreach ($id_komponen as $key => $value) {
                    if (!isset($this->Sub_komponen_model->sum_komponen($value->id_komponen)->sum)) {
                        $sum_komponen = array(
                            'jumlah' => '0'
                        );
                    } else {
                        $sum_komponen = array(
                            'jumlah' => $this->Sub_komponen_model->sum_komponen($value->id_komponen)->sum
                        );
                    }
                    $this->Komponen_model->update($value->id_komponen, $sum_komponen);
                }

                //update sub output
                $id_kegiatan = $this->Komponen_model->get_id_kegiatan($id_unit);
                foreach ($id_kegiatan as $key => $value) {
                    $sum_sub_output = array(
                        'jumlah' => $this->Komponen_model->sum_sub_output($value->id_kegiatan)->sum
                    );
                    $this->Kegiatan_model->update($value->id_kegiatan, $sum_sub_output);
                }

                //update kegiatan
                for ($i = 4; $i > 1; $i--) {
                    $sum = array(
                        'jumlah' => $this->Kegiatan_model->sum($i, $id_unit)->sum
                    );
                    $id_kegiatan = $this->Kegiatan_model->get_id_kegiatan($i - 1, $id_unit)->id_kegiatan;
                    $this->Kegiatan_model->update($id_kegiatan, $sum);
                }

                //insert realiasi dari subkomponen
                if(!$this->Realisasi_model->is_exist($this->input->post('id_subkomponen'))){
                    for($i=1;$i<13;$i++){
                        $data = array(
                            'id_subkomponen' => $this->input->post('id_subkomponen'),
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

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('kegiatan/' . $id_unit));
            } else {
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, id_kegiatan is exist');
            }
        }
    }
    public function delete_subkomponen($id, $id_unit)
    {
        $row = $this->Kegiatan_model->get_by_id_subkomponen($id);

        if ($row) {
            $this->Kegiatan_model->delete_subkomponen($id);
            $this->session->set_flashdata('message', 'Delete Record Success');

            //update komponen
            $id_komponen = $this->Komponen_model->get_id_komponen($id_unit);
            foreach ($id_komponen as $key => $value) {
                if (!isset($this->Sub_komponen_model->sum_komponen($value->id_komponen)->sum)) {
                    $sum_komponen = array(
                        'jumlah' => '0'
                    );
                } else {
                    $sum_komponen = array(
                        'jumlah' => $this->Sub_komponen_model->sum_komponen($value->id_komponen)->sum
                    );
                }
                $this->Komponen_model->update($value->id_komponen, $sum_komponen);
            }
            //update sub output
            $id_kegiatan = $this->Komponen_model->get_id_kegiatan($id_unit);
            foreach ($id_kegiatan as $key => $value) {
                $sum_sub_output = array(
                    'jumlah' => $this->Komponen_model->sum_sub_output($value->id_kegiatan)->sum
                );
                $this->Kegiatan_model->update($value->id_kegiatan, $sum_sub_output);
            }

            //update kegiatan
            for ($i = 4; $i > 1; $i--) {
                $sum = array(
                    'jumlah' => $this->Kegiatan_model->sum($i, $id_unit)->sum
                );
                $id_kegiatan = $this->Kegiatan_model->get_id_kegiatan($i - 1, $id_unit)->id_kegiatan;
                $this->Kegiatan_model->update($id_kegiatan, $sum);
            }
            redirect(site_url('kegiatan/' . $id_unit));
            // redirect(site_url('sub_komponen'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            // redirect(site_url('sub_komponen'));
        }
    }
    public function delete_komponen($id, $id_unit)
    {
        $row = $this->Kegiatan_model->get_by_id_komponen($id);

        if ($row) {
            $this->Kegiatan_model->delete_komponen($id);
            $this->session->set_flashdata('message', 'Delete Record Success');

            $id_komponen = $this->Komponen_model->get_id_komponen($id_unit);
            foreach ($id_komponen as $key => $value) {
                if (!isset($this->Sub_komponen_model->sum_komponen($value->id_komponen)->sum)) {
                    $sum_komponen = array(
                        'jumlah' => '0'
                    );
                } else {
                    $sum_komponen = array(
                        'jumlah' => $this->Sub_komponen_model->sum_komponen($value->id_komponen)->sum
                    );
                }
                $this->Komponen_model->update($value->id_komponen, $sum_komponen);
            }
            //update sub output
            $id_kegiatan = $this->Komponen_model->get_id_kegiatan($id_unit);
            foreach ($id_kegiatan as $key => $value) {
                $sum_sub_output = array(
                    'jumlah' => $this->Komponen_model->sum_sub_output($value->id_kegiatan)->sum
                );
                $this->Kegiatan_model->update($value->id_kegiatan, $sum_sub_output);
            }

            //update kegiatan
            for ($i = 4; $i > 1; $i--) {
                $sum = array(
                    'jumlah' => $this->Kegiatan_model->sum($i, $id_unit)->sum
                );
                $id_kegiatan = $this->Kegiatan_model->get_id_kegiatan($i - 1, $id_unit)->id_kegiatan;
                $this->Kegiatan_model->update($id_kegiatan, $sum);
            }
            redirect(site_url('kegiatan/' . $id_unit));
            // redirect(site_url('komponen'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            // redirect(site_url('komponen'));
        }
    }

    //delete kegiatan
    public function delete_kegiatan($id, $id_unit)
    {
        $row = $this->Kegiatan_model->get_by_id_kegiatan($id);

        if ($row) {
            $this->Kegiatan_model->delete_kegiatan($id);
            $this->session->set_flashdata('message', 'Delete Record Success');

            $id_komponen = $this->Komponen_model->get_id_komponen($id_unit);
            foreach ($id_komponen as $key => $value) {
                if (!isset($this->Sub_komponen_model->sum_komponen($value->id_komponen)->sum)) {
                    $sum_komponen = array(
                        'jumlah' => '0'
                    );
                } else {
                    $sum_komponen = array(
                        'jumlah' => $this->Sub_komponen_model->sum_komponen($value->id_komponen)->sum
                    );
                }
                $this->Komponen_model->update($value->id_komponen, $sum_komponen);
            }
            //update sub output
            $id_kegiatan = $this->Komponen_model->get_id_kegiatan($id_unit);
            foreach ($id_kegiatan as $key => $value) {
                $sum_sub_output = array(
                    'jumlah' => $this->Komponen_model->sum_sub_output($value->id_kegiatan)->sum
                );
                $this->Kegiatan_model->update($value->id_kegiatan, $sum_sub_output);
            }

            //update kegiatan
            for ($i = 4; $i > 1; $i--) {
                $sum = array(
                    'jumlah' => $this->Kegiatan_model->sum($i, $id_unit)->sum
                );
                $id_kegiatan = $this->Kegiatan_model->get_id_kegiatan($i - 1, $id_unit)->id_kegiatan;
                $this->Kegiatan_model->update($id_kegiatan, $sum);
            }
            redirect(site_url('kegiatan/' . $id_unit));
            // redirect(site_url('komponen'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            // redirect(site_url('komponen'));
        }
    }

    public function update_komponen($id_unit, $id_komponen)
    {
        $row = $this->Kegiatan_model->get_by_id_komponen($id_komponen);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kegiatan/update_action_komponen'),
                'id_komponen' => set_value('id_komponen', $row->id_komponen),
                'kode_komponen' => set_value('kode_komponen', $row->kode_komponen),
                'uraian_kegiatan' => set_value('uraian_kegiatan', $row->uraian_kegiatan),
                'volume' => set_value('volume', $row->volume),
                'satuan' => set_value('satuan', $row->satuan),
                'id_unit' => set_value('id_unit', $id_unit),

            );
            $data['title'] = 'komponen';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'kegiatan/Kegiatan_form_edit_komponen';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            //redirect(site_url('kegiatan/' . $this->uri->segment(4)));
            redirect(site_url('kegiatan/' . $id_unit));
        }
    }

    public function update_action_komponen()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_komponen', TRUE));
        } else {
            $data = array(
                'id_komponen' => $this->input->post('id_komponen', TRUE),
                'kode_komponen' => $this->input->post('kode_komponen', TRUE),
                'uraian_kegiatan' => $this->input->post('uraian_kegiatan', TRUE),
                'volume' => $this->input->post('volume', TRUE),
                'satuan' => $this->input->post('satuan', TRUE),


            );
            // echo "<pre>";
            // var_dump($data);
            // echo "</pre>";
            $this->Kegiatan_model->update_komponen($this->input->post('id_komponen', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');

            redirect(site_url('kegiatan/' . $this->input->post('id_unit', TRUE)));
        }
    }
    //update_subkomponen
    public function update_subkomponen($id_unit, $id_subkomponen)
    {
        $row = $this->Kegiatan_model->get_by_id_subkomponen($id_subkomponen);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kegiatan/update_action_subkomponen'),
                'id_subkomponen' => set_value('id_subkomponen', $row->id_subkomponen),
                'kode_subkomponen' => set_value('kode_subkomponen', $row->kode_subkomponen),
                'uraian_kegiatan' => set_value('uraian_kegiatan', $row->uraian_kegiatan),
                'volume' => set_value('volume', $row->volume),
                'satuan' => set_value('satuan', $row->satuan),
                'jumlah' => set_value('jumlah', $row->jumlah),
                'id_unit' => set_value('id_unit', $id_unit),

            );
            $data['title'] = 'Sub komponen';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'kegiatan/Kegiatan_form_edit_subkomponen';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            //redirect(site_url('kegiatan/' . $this->uri->segment(4)));
            redirect(site_url('kegiatan/' . $id_unit));
        }
    }

    public function update_action_subkomponen()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_subkomponen', TRUE));
        } else {
            $data = array(
                'id_subkomponen' => $this->input->post('id_subkomponen', TRUE),
                'kode_subkomponen' => $this->input->post('kode_subkomponen', TRUE),
                'uraian_kegiatan' => $this->input->post('uraian_kegiatan', TRUE),
                'volume' => $this->input->post('volume', TRUE),
                'satuan' => $this->input->post('satuan', TRUE),
                'jumlah' => $this->input->post('jumlah', TRUE),


            );
            // echo "<pre>";
            // var_dump($data);
            // echo "</pre>";
            $this->Kegiatan_model->update_subkomponen($this->input->post('id_subkomponen', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            //update komponen
            $id_komponen = $this->Komponen_model->get_id_komponen($this->input->post('id_unit'));
            foreach ($id_komponen as $key => $value) {
                if (!isset($this->Sub_komponen_model->sum_komponen($value->id_komponen)->sum)) {
                    $sum_komponen = array(
                        'jumlah' => '0'
                    );
                } else {
                    $sum_komponen = array(
                        'jumlah' => $this->Sub_komponen_model->sum_komponen($value->id_komponen)->sum
                    );
                }
                $this->Komponen_model->update($value->id_komponen, $sum_komponen);
            }

            //update sub output
            $id_kegiatan = $this->Komponen_model->get_id_kegiatan($this->input->post('id_unit'));
            foreach ($id_kegiatan as $key => $value) {
                $sum_sub_output = array(
                    'jumlah' => $this->Komponen_model->sum_sub_output($value->id_kegiatan)->sum
                );
                $this->Kegiatan_model->update($value->id_kegiatan, $sum_sub_output);
            }

            //update kegiatan
            for ($i = 4; $i > 1; $i--) {
                $sum = array(
                    'jumlah' => $this->Kegiatan_model->sum($i, $this->input->post('id_unit'))->sum
                );
                $id_kegiatan = $this->Kegiatan_model->get_id_kegiatan($i - 1, $this->input->post('id_unit'))->id_kegiatan;
                $this->Kegiatan_model->update($id_kegiatan, $sum);
            }
            redirect(site_url('kegiatan/' . $this->input->post('id_unit', TRUE)));
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

    public function deletebulk()
    {
        $delete = $this->Kegiatan_model->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
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

    public function export($id_unit)
    {
        // Load plugin PHPExcel nya
        include APPPATH . 'third_party/PHPExcel-1.8/Classes/PHPExcel.php';

        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('YH')
            ->setLastModifiedBy('YH')
            ->setTitle("RKAKL")
            ->setSubject("Unit")
            ->setDescription("Laporan Semua Data RKAKL")
            ->setKeywords("RKAKL Unit");
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
        $b = $id_unit;
        $kegiatan = $this->Kegiatan_model->get_limit_data('1000', '0', null, $b, $this->tahun);
        for ($i = 0; $i < $this->Kegiatan_model->count_kegiatan($b, $this->tahun)->count; $i++) {
            $count_child[] = $this->Kegiatan_model->count_child($i, $b, $this->tahun);
            $komponen[] = $this->Komponen_model->get_by_id_kegiatan($i, $b, $this->tahun);
        }

        for ($i = 0; $i < $this->Komponen_model->count_komponen($b)->count; $i++) {
            $count_child_komponen[] = $this->Komponen_model->count_child($i, $b);
            $subkomponen[] = $this->Sub_komponen_model->get_by_id_komponen($i, $b, $this->tahun);
        }
        // var_dump($count_child_komponen);
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        $i = 0; // array cek komponen
        $j = 0; // array cek subkomponen
        //data kegiatan rektorat
        foreach ($kegiatan as $data) { // Lakukan looping pada variabel kegiatan rektorat
            $rencana_capaian = $data->rencana_capaian / 100;
            $capaian = $data->rencana_capaian / 100;
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $data->kode_m_dat);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->ket);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->jumlah);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $rencana_capaian);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $capaian);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data->jumlah_capaian);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row3);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row2);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row2);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row3);

            $numrow++; // Tambah 1 setiap kali looping
            // data komponen rektorat
            if ($count_child[$i]->jumlah_anak == '0') {
                if (isset($komponen[$i][0])) {
                    foreach ($komponen[$i] as $data => $value) { // Lakukan looping pada variabel komponen rektorat
                        $rencana_capaian = $value->rencana_capaian / 100;
                        $capaian = $value->rencana_capaian / 100;
                        $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $value->kode_komponen);
                        $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $value->uraian_kegiatan);
                        $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $value->jumlah);
                        $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $rencana_capaian);
                        $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $capaian);
                        $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $value->jumlah_capaian);

                        // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
                        $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row3);
                        $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row2);
                        $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row2);
                        $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row3);

                        $numrow++; // Tambah 1 setiap kali looping 

                        // data sub komponen rektorat
                        if ($count_child_komponen[$j]->jumlah_anak != '0') {
                            if (isset($subkomponen[$j][0])) {
                                foreach ($subkomponen[$j] as $data => $value_sub) { // Lakukan looping pada variabel sub komponen rektorat  
                                    $rencana_capaian = $value_sub->rencana_capaian / 100;
                                    $capaian = $value_sub->rencana_capaian / 100;
                                    $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $value_sub->kode_subkomponen);
                                    $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $value_sub->uraian_kegiatan);
                                    $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $value_sub->jumlah);
                                    $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $rencana_capaian);
                                    $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $capaian);
                                    $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $value_sub->jumlah_capaian);

                                    // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
                                    $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
                                    $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
                                    $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row3);
                                    $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row2);
                                    $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row2);
                                    $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row3);

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
        $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row4);
        $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row4);
        $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row4);
        $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row4);
        $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row4);
        $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row4);

        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(15); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(110); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(25); // Set width kolom F

        // Set currency format
        $excel->getActiveSheet()->getStyle('C2:C' . $numrow)->getNumberFormat()->setFormatCode('###0,00_-');
        $excel->getActiveSheet()->getStyle('F2:F' . $numrow)->getNumberFormat()->setFormatCode('###0,00_-');

        // Set percentage format
        $excel->getActiveSheet()->getStyle('D2:D' . $numrow)->getNumberFormat()->applyFromArray(
            array(
                'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE
            )
        );
        $excel->getActiveSheet()->getStyle('E2:E' . $numrow)->getNumberFormat()->applyFromArray(
            array(
                'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE
            )
        );

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("rkakal unit");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="List Monitoring Unit.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }
}

/* End of file Kegiatan.php */
/* Location: ./application/controllers/Kegiatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-08 18:29:18 */
/* http://harviacode.com */
