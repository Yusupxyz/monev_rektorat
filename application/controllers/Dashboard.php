<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public $user='',$group_id='';
	public $tahun ="";
	public function __construct()
	{
		parent::__construct();
		$this->layout->auth();
		$this->load->model('Komponen_model');
		$this->load->model('Komponen_rektorat_model');
		$this->load->model('Sub_komponen_model');
		$this->load->model('Sub_komponen_rektorat_model');
		$this->load->model('Kegiatan_model');
		$this->load->model('Kegiatan_rektorat_model');
		$this->load->model('Realisasi_model');
		$this->load->model('Realisasi_rektorat_model');
		$this->load->model('Users_model');
		$this->load->model('Tahun_model');
		$this->user = $this->ion_auth->user()->row();
		$this->tahun = $this->Tahun_model->get_by_aktif()->tahun;
	}
	
	public function index()
	{
		$this->group_id=$this->Users_model->get_group_id($this->user->id)->group_id;
		if ($this->group_id=='3' || $this->group_id=='4'){
			$data['total_pagu']=$this->Kegiatan_model->sum_by_jenis_unit($this->user->id_unit)->jumlah;
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
				}
				$i++;
				foreach ($a as $key => $value) {
					$dataset[$i][]=$value->realisasi_capaian;
				}
				$i++;
			}
			$data['color']=array("#ffff99","#ffff99", "#9999ff", "#9999ff", "#abedcc", "#abedcc", "#c9cfcc", "#c9cfcc","#ff1a75","#ff1a75"
								,"#4d4dff","#4d4dff","#00b300","#00b300","#c6ff1a","#c6ff1a","#99994d","#99994d","#cc00cc","#cc00cc"
								,"#00e673","#00e673","#00e6e6","#00e6e6","#e6e600","#e6e600");
			$data['dataset']=$dataset;
			// print("<pre>".print_r($data['color'],true)."</pre>");

			$data['title'] = 'Realisasi Capaian Tahun '.$this->tahun;
		}else{
			$data['total_pagu']=$this->Kegiatan_rektorat_model->get_by_kode('042.01.01')->jumlah;
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
			$data['color']=array("#ffff99","#ffff99", "#9999ff", "#9999ff", "#abedcc", "#abedcc", "#c9cfcc", "#c9cfcc","#ff1a75","#ff1a75"
								,"#4d4dff","#4d4dff","#00b300","#00b300","#c6ff1a","#c6ff1a","#99994d","#99994d","#cc00cc","#cc00cc"
								,"#00e673","#00e673","#00e6e6","#00e6e6","#e6e600","#e6e600");
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
