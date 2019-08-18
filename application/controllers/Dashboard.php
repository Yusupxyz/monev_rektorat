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
	}
	
	public function index()
	{
		$this->group_id=$this->Users_model->get_group_id($this->user->id)->group_id;
		if ($this->group_id=='3' || $this->group_id=='4'){
			$data['total_pagu']=$this->Kegiatan_model->sum_by_jenis_unit($this->user->id_unit)->jumlah;
			$data['total_serapan_dana'] = $this->Kegiatan_model->sum_by_jenis_unit($this->user->id_unit)->jumlah_capaian;
			$data['total_realisasi_capaian']=$this->Kegiatan_model->sum_by_jenis_unit($this->user->id_unit)->capaian;
			$data['total_rencana_capaian']=$this->Kegiatan_model->sum_by_jenis_unit($this->user->id_unit)->rencana_capaian;
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
			$id_unit_unit=$this->Set_unit_chart_model->get_by_id()->id_unit;
			$data['options']=$this->Unit_model->get_all2();
			$data['attribute']='id="unit" class="form-control select2"';
			$data['selected']=$id_unit_unit;
			$data['total_pagu']=$this->Kegiatan_rektorat_model->get_by_kode('042.01.01')->jumlah;
			$data['total_serapan_dana'] = $this->Kegiatan_rektorat_model->get_by_kode('042.01.01')->jumlah_capaian;
			$data['total_realisasi_capaian']=$this->Kegiatan_rektorat_model->get_by_kode('042.01.01')->capaian;
			$data['total_rencana_capaian']=$this->Kegiatan_rektorat_model->get_by_kode('042.01.01')->rencana_capaian;
			$data['label']=$this->Komponen_rektorat_model->get_id_komponen($this->user->id_unit);
			$i=0;
			foreach ($data['label'] as $key => $value) {
				$data['labels'][]='Rencana "'.$value->uraian_kegiatan.' ('.$value->kode_komponen.')"';
				$data['labels'][]='Realisasi "'.$value->uraian_kegiatan.' ('.$value->kode_komponen.')"';
				$a=$this->Realisasi_rektorat_model->chart($this->user->id_unit,$value->kode_komponen);
				$b=$this->Realisasi_model->chart_all($value->kode_komponen);
				$j=0;
				foreach ($a as $key => $value) {
					if (isset($b[$j]->rencana_capaian))
						$unit=$b[$j]->rencana_capaian;
					else $unit=0;	
					$dataset[$i][]=$value->rencana_capaian+$unit;
				}
				$i++;
				foreach ($a as $key => $value) {
					if (isset($b[$j]->realisasi_capaian))
						$unit=$b[$j++]->realisasi_capaian;
					else $unit=0;
					$dataset[$i][]=$value->realisasi_capaian;
				}
				$i++;
			}
			$data['label2']=$this->Komponen_model->get_id_komponen($id_unit_unit);
			$i=0;
			foreach ($data['label2'] as $key => $value) {
				$data['labels2'][]='Rencana "'.$value->uraian_kegiatan.' ('.$value->kode_komponen.')"';
				$data['labels2'][]='Realisasi "'.$value->uraian_kegiatan.' ('.$value->kode_komponen.')"';
				$a=$this->Realisasi_model->chart($id_unit_unit,$value->kode_komponen);
				foreach ($a as $key => $value) {
					$dataset2[$i][]=$value->rencana_capaian;
					// $dataset[$i][]=$value->rencana_capaian;
				}
				$i++;
				foreach ($a as $key => $value) {
					$dataset2[$i][]=$value->realisasi_capaian;
				}
				$i++;
				// print("<pre>".print_r($data['labels2'])."</pre>");
			}
			$data['color']=array("#e6194b","#e6194b", "#3cb44b", "#3cb44b", "#ffe119", "#ffe119", "#4363d8", "#4363d8","#f58231","#f58231"
								,"#911eb4","#911eb4","#46f0f0","#46f0f0","#f032e6","#f032e6","#bcf60c","#bcf60c","#fabebe","#fabebe"
								,"#008080","#008080","#e6beff","#e6beff","#9a6324","#9a6324");
			$data['dataset']=$dataset;

			if (isset($dataset2))
			$data['dataset2']=$dataset2;

			// print("<pre>".print_r($data['label2'],true)."</pre>");

			$data['title'] = 'Realisasi Capaian Rektorat '.$this->tahun;
			$data['title2'] = 'Realisasi Capaian Unit '.$this->tahun;
		}else{
			$data['total_pagu']=$this->Kegiatan_rektorat_model->get_by_kode('042.01.01')->jumlah;
			$data['total_serapan_dana'] = $this->Kegiatan_rektorat_model->get_by_kode('042.01.01')->jumlah_capaian;
			$data['total_realisasi_capaian']=$this->Kegiatan_rektorat_model->get_by_kode('042.01.01')->capaian;
			$data['total_rencana_capaian']=$this->Kegiatan_rektorat_model->get_by_kode('042.01.01')->rencana_capaian;
			$data['label']=$this->Komponen_rektorat_model->get_id_komponen($this->user->id_unit);
			$i=0;
			foreach ($data['label'] as $key => $value) {
				$data['labels'][]='Rencana "'.$value->uraian_kegiatan.' ('.$value->kode_komponen.')"';
				$data['labels'][]='Realisasi "'.$value->uraian_kegiatan.' ('.$value->kode_komponen.')"';
				$a=$this->Realisasi_rektorat_model->chart($this->user->id_unit,$value->kode_komponen);
				$b=$this->Realisasi_model->chart_all($value->kode_komponen);
				$j=0;
				foreach ($a as $key => $value) {
					if (isset($b[$j]->rencana_capaian))
						$unit=$b[$j]->rencana_capaian;
					else $unit=0;	
					$dataset[$i][]=$value->rencana_capaian+$unit;
				}
				$i++;
				foreach ($a as $key => $value) {
					if (isset($b[$j]->realisasi_capaian))
						$unit=$b[$j++]->realisasi_capaian;
					else $unit=0;
					$dataset[$i][]=$value->realisasi_capaian;
				}
				$i++;
			}
			$data['color']=array("#e6194b","#e6194b", "#3cb44b", "#3cb44b", "#ffe119", "#ffe119", "#4363d8", "#4363d8","#f58231","#f58231"
								,"#911eb4","#911eb4","#46f0f0","#46f0f0","#f032e6","#f032e6","#bcf60c","#bcf60c","#fabebe","#fabebe"
								,"#008080","#008080","#e6beff","#e6beff","#9a6324","#9a6324");
			$data['dataset']=$dataset;
			// print("<pre>".print_r($data['dataset'],true)."</pre>");

			$data['title'] = 'Realisasi Capaian Program Dukungan Manajemen dan Pelaksanaan Tugas Teknis Lainnya Kementerian Riset, Teknologi dan Pendidikan Tinggi '.$this->tahun;
		}
		$data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];
        //$this->layout->set_privilege(1);
        $data['code_js'] = 'Dashboard/codejs';
        $data['page'] = 'Dashboard/Index';
		$this->load->view('template/backend', $data);
	}

	private function generate_hex_color($n) {
		$n = intval($n);
		if (!$n)
			return '00';
	
		$n = max(0, min($n, 255)); // make sure the $n is not bigger than 255 and not less than 0
		$index1 = (int) ($n - ($n % 16)) / 16;
		$index2 = (int) $n % 16;
	
		return substr("0123456789ABCDEF", $index1, 1) 
			. substr("0123456789ABCDEF", $index2, 1);
	}
	

}
