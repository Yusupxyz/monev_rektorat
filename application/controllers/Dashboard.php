<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public $user='',$group_id='';
	public $tahun ="";
	public function __construct()
	{
		parent::__construct();
		$this->layout->auth();
		$this->load->helper('form');
		$this->load->model('Komponen_model');
		$this->load->model('Komponen_rektorat_model');
		$this->load->model('Sub_komponen_model');
		$this->load->model('Sub_komponen_rektorat_model');
		$this->load->model('Kegiatan_model');
		$this->load->model('Kegiatan_rektorat_model');
		$this->load->model('Realisasi_model');
		$this->load->model('Realisasi_rektorat_model');
		$this->load->model('Users_model');
		$this->load->model('Unit_model');
		$this->load->model('Tahun_model');
		$this->load->model('Set_unit_chart_model');
		$this->user = $this->ion_auth->user()->row();
		$this->tahun = $this->Tahun_model->get_by_aktif()->tahun;
		$this->id_tahun = $this->Tahun_model->get_by_aktif()->id_tahun;
	}
	
	public function index()
	{
		$this->group_id=$this->Users_model->get_group_id($this->user->id)->group_id;
		$data['total_pagu']=0;
		$data['total_serapan_dana']=0;
		$data['total_realisasi_capaian']=0;
		$data['total_rencana_capaian']=0;
		if ($this->group_id=='3' || $this->group_id=='4'){
			if (isset($this->Kegiatan_model->sum_by_jenis_unit($this->user->id_unit)->jumlah)){
				$data['total_pagu']=$this->Kegiatan_model->sum_by_jenis_unit($this->user->id_unit)->jumlah;
				$data['total_serapan_dana'] = $this->Kegiatan_model->sum_by_jenis_unit($this->user->id_unit)->jumlah_capaian;
				$data['total_realisasi_capaian']=$this->Kegiatan_model->sum_by_jenis_unit($this->user->id_unit)->capaian;
				$data['total_rencana_capaian']=$this->Kegiatan_model->sum_by_jenis_unit($this->user->id_unit)->rencana_capaian;
			}
			$data['label']=$this->Komponen_model->get_id_komponen($this->user->id_unit);
			$i=0;
			foreach ($data['label'] as $key => $value) {
				$data['labels'][]='Rencana "'.$value->uraian_kegiatan.' ('.$value->kode_komponen.')"';
				$data['labels'][]='Realisasi "'.$value->uraian_kegiatan.' ('.$value->kode_komponen.')"';
				$a=$this->Realisasi_model->chart($this->user->id_unit,$value->kode_komponen);
				foreach ($a as $key => $value) {
					$dataset[$i][]=$value->rencana_capaian;
					// $dataset[$i][]=$value->rencana_capaian;
				}
				$i++;
				foreach ($a as $key => $value) {
					$dataset[$i][]=$value->realisasi_capaian;
				}
				$i++;
				// print("<pre>".print_r($value->kode_komponen)."</pre>");
			}
			$data['color']=array("#e6194b","#e6194b", "#3cb44b", "#3cb44b", "#ffe119", "#ffe119", "#4363d8", "#4363d8","#f58231","#f58231"
								,"#911eb4","#911eb4","#46f0f0","#46f0f0","#f032e6","#f032e6","#bcf60c","#bcf60c","#fabebe","#fabebe"
								,"#008080","#008080","#e6beff","#e6beff","#9a6324","#9a6324");
			$data['dataset']=$dataset;
			// print("<pre>".print_r($data['dataset'],true)."</pre>");

			$data['title'] = 'Realisasi Capaian Tahun '.$this->tahun;
		}elseif ($this->group_id=='5'){
			$kegiatan = $this->Kegiatan_model->get_data($this->user->id_unit, $this->id_tahun);

			for ($i = 0; $i < $this->Kegiatan_model->count_kegiatan($this->user->id_unit, $this->id_tahun)->count; $i++) {
				$count_child[] = $this->Kegiatan_model->count_child($i, $this->user->id_unit, $this->id_tahun);
				$komponen[] = $this->Komponen_model->get_by_id_kegiatan($i, $this->user->id_unit, $this->id_tahun);
			}

			if (isset($kegiatan)){
				foreach ($kegiatan as $key ) { 
					$data_jumlah_kegiatan[]=$this->Kegiatan_model->sum_jumlah($key->kode_m_dat);
				}
			}
	
			if (isset($komponen)){
				for ($i=0; $i < count($komponen) ; $i++) { 
					if (isset($komponen[$i][0])){ 
						foreach ($komponen[$i] as $key => $value) { 
							$data_jumlah[$i][]=$this->Sub_komponen_model->get_data_by_kode($value->kode_komponen);
							$count_jumlah[$i][]=$this->Sub_komponen_model->count_by_kode($value->kode_komponen);
						}
					}else{
						$data_jumlah[$i]='';
						$count_jumlah[$i]='';
					}
				}
		
				$v=0;
				for ($i=0; $i < count($data_jumlah) ; $i++) {
					$jumlah_rc=0;
					$jumlah_c=0; 
					if (isset($data_jumlah[$i][0])){ 
						$jumlah_rc=$jumlah_rc+round($data_jumlah[$i][$v]->rc/$count_jumlah[$i][$v]->jumlah);
						$jumlah_c=$jumlah_c+round($data_jumlah[$i][$v]->c/$count_jumlah[$i][$v]->jumlah);
					}
					$data_suboutput[$i]['jc']=$jumlah_rc;
					$data_suboutput[$i]['c']=$jumlah_c;
				}
				
				for ($i=0; $i < count($data_suboutput) ; $i++) {
					$jumlah_rc=0;
					$jumlah_c=0; 
					$data_subprogram[$i]['jc']=$jumlah_rc+$data_suboutput[$i]['jc'];
					$data_subprogram[$i]['c']=$jumlah_c+$data_suboutput[$i]['c'];
				}
		
				for ($i=0; $i < count($data_subprogram) ; $i++) {
					$jumlah_rc=0;
					$jumlah_c=0; 
					$data_program[$i]['jc']=$jumlah_rc+$data_subprogram[$i]['jc'];
					$data_program[$i]['c']=$jumlah_c+$data_subprogram[$i]['c'];
				}
			}
			
			if(isset($data_jumlah_kegiatan)){
				$data['total_pagu']=$data_jumlah_kegiatan[0]->jumlah;
				$data['total_serapan_dana'] = $data_jumlah_kegiatan[0]->jc;
			}
			if(isset($data_program)){
				$data['total_realisasi_capaian']=$data_program[3]['jc'];
				$data['total_rencana_capaian']=$data_program[3]['c'];
			}

			$id_unit_unit=$this->Set_unit_chart_model->get_by_id()->id_unit;
			$data['options']=$this->Unit_model->get_all2();
			$data['attribute']='id="unit" class="form-control select2"';
			$data['selected']=$id_unit_unit;
			$data['label']=$this->Komponen_model->get_id_komponen('0');
			$i=0;

			foreach ($data['label'] as $key => $value) {
				$data['labels'][]='Rencana "'.$value->uraian_kegiatan.' ('.$value->kode_komponen.')"';
				$data['labels'][]='Realisasi "'.$value->uraian_kegiatan.' ('.$value->kode_komponen.')"';
				$a=$this->Realisasi_model->chart('0',$value->kode_komponen);
				foreach ($a as $key => $value) {
					$dataset[$i][]=$value->rencana_capaian;
				}
				$i++;
				foreach ($a as $key => $value) {
					$dataset[$i][]=$value->realisasi_capaian;
				}
				$i++;
				// print("<pre>".print_r($a)."</pre>");
			}

			$data['label2']=$this->Komponen_model->get_id_komponen($id_unit_unit);
			$i=0;
			foreach ($data['label2'] as $key => $value) {
				$data['labels2'][]='Rencana "'.$value->uraian_kegiatan.' ('.$value->kode_komponen.')"';
				$data['labels2'][]='Realisasi "'.$value->uraian_kegiatan.' ('.$value->kode_komponen.')"';
				$a=$this->Realisasi_model->chart($id_unit_unit,$value->kode_komponen);
				foreach ($a as $key => $value) {
					$dataset2[$i][]=$value->rencana_capaian;
				}
				$i++;
				foreach ($a as $key => $value) {
					$dataset2[$i][]=$value->realisasi_capaian;
				}
				$i++;
			}
			$data['color']=array("#e6194b","#e6194b", "#3cb44b", "#3cb44b", "#ffe119", "#ffe119", "#4363d8", "#4363d8","#f58231","#f58231"
								,"#911eb4","#911eb4","#46f0f0","#46f0f0","#f032e6","#f032e6","#bcf60c","#bcf60c","#fabebe","#fabebe"
								,"#008080","#008080","#e6beff","#e6beff","#9a6324","#9a6324");
			$data['dataset']=$dataset;

			if (isset($dataset2))
			$data['dataset2']=$dataset2;

			print("<pre>".print_r($data['data_program'],true)."</pre>");

			$data['title'] = 'Realisasi Capaian Rektorat '.$this->tahun;
			$data['title2'] = 'Realisasi Capaian Unit '.$this->tahun;
		}else{
			if (isset($this->Kegiatan_model->sum_by_jenis_unit($this->user->id_unit)->jumlah)){
				$data['total_pagu']=$this->Kegiatan_model->sum_by_jenis_unit($this->user->id_unit)->jumlah;
				$data['total_serapan_dana'] = $this->Kegiatan_model->sum_by_jenis_unit($this->user->id_unit)->jumlah_capaian;
				$data['total_realisasi_capaian']=$this->Kegiatan_model->sum_by_jenis_unit($this->user->id_unit)->capaian;
				$data['total_rencana_capaian']=$this->Kegiatan_model->sum_by_jenis_unit($this->user->id_unit)->rencana_capaian;
			}
			$data['label']=$this->Komponen_model->get_id_komponen($this->user->id_unit);
			$i=0;
			
			foreach ($data['label'] as $key => $value) {
				$data['labels'][]='Rencana "'.$value->uraian_kegiatan.' ('.$value->kode_komponen.')"';
				$data['labels'][]='Realisasi "'.$value->uraian_kegiatan.' ('.$value->kode_komponen.')"';
				$a=$this->Realisasi_model->chart($this->user->id_unit,$value->kode_komponen);
				foreach ($a as $key => $value) {
					$dataset[$i][]=$value->rencana_capaian;
				}
				$i++;
				foreach ($a as $key => $value) {
					$dataset[$i][]=$value->realisasi_capaian;
				}
				$i++;
				// print("<pre>".print_r($a)."</pre>");
			}

			$data['color']=array("#e6194b","#e6194b", "#3cb44b", "#3cb44b", "#ffe119", "#ffe119", "#4363d8", "#4363d8","#f58231","#f58231"
								,"#911eb4","#911eb4","#46f0f0","#46f0f0","#f032e6","#f032e6","#bcf60c","#bcf60c","#fabebe","#fabebe"
								,"#008080","#008080","#e6beff","#e6beff","#9a6324","#9a6324");
			if (isset($dataset))
			$data['dataset']=$dataset;
			// print("<pre>".print_r($data['label'],true)."</pre>");
			// print("<pre>".print_r($data['dataset'],true)."</pre>");

			$data['title'] = 'Realisasi Capaian Program Dukungan Manajemen dan Pelaksanaan Tugas Teknis Lainnya Kementerian Riset, Teknologi dan Pendidikan Tinggi '.$this->tahun;
		}
		$data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];
        $data['code_js'] = 'Dashboard/codejs';
        $data['page'] = 'Dashboard/Index';
		$this->load->view('template/backend', $data);
	}
	

}
