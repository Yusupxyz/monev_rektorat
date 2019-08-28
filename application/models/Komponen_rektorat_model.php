<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Komponen_rektorat_model extends CI_Model
{

    public $table = 'komponen_rektorat';
    public $id = 'id_komponen';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }
    // count komponen
    function count_komponen($b)
    {
        $result=$this->db->query ('
            SELECT count(*) as "count" from komponen_rektorat 
            LEFT join kegiatan_rektorat on kegiatan_rektorat.id_kegiatan = komponen_rektorat.id_kegiatan 
            WHERE kegiatan_rektorat.id_unit = '.$b.' ')->row();
        return $result;
    }

    // get jumlah anak by id
    function count_child($i,$b)
    {
        $result=$this->db->query (
            'SELECT count(*) as "jumlah_anak" FROM komponen_rektorat 
            LEFT join sub_komponen_rektorat on komponen_rektorat.id_komponen=sub_komponen_rektorat.id_komponen 
            WHERE sub_komponen_rektorat.id_komponen=(SELECT id_komponen from sub_komponen_rektorat limit '.$i.',1)')->row();
        return $result;
    }

    // get jumlah anak unit by id
    function count_child_unit($i)
    {
        $result=$this->db->query (
            'SELECT count(*) as "jumlah_anak" FROM komponen_rektorat 
            LEFT join sub_komponen on komponen_rektorat.id_komponen=sub_komponen.id_komponen 
            WHERE komponen_rektorat.kode_komponen=(SELECT kode_komponen from sub_komponen limit '.$i.',1)')->row();
        return $result;
    }
    

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    
    // get data by kode komponen
    function get_by_kode($kode)
    {
        $this->db->where('kode_komponen', $kode);
        return $this->db->get($this->table)->row();
    }

    // get data by id_kegiatan
    function get_by_id_kegiatan($i,$b,$tahun)
    {
        $result=$this->db->query (
            'SELECT komponen_rektorat.*, unit.* FROM komponen_rektorat LEFT JOIN kegiatan_rektorat ON komponen_rektorat.id_kegiatan=kegiatan_rektorat.id_kegiatan LEFT JOIN
            unit ON unit.id_unit=kegiatan_rektorat.id_unit WHERE komponen_rektorat.id_kegiatan = 
                     (select id_kegiatan from kegiatan_rektorat where id_unit='.$b.' AND id_tahun='.$tahun.' limit '.$i.',1)')->result();
        return $result;
    }

    // get id by group by id_kegiatan
    function get_id_komponen($id)
    {
        $this->db->select('komponen_rektorat.id_komponen, kode_komponen, komponen_rektorat.uraian_kegiatan');
        $this->db->join('kegiatan_rektorat','kegiatan_rektorat.id_kegiatan=komponen_rektorat.id_kegiatan','left');
        $this->db->where('kegiatan_rektorat.id_unit',$id);
        $this->db->group_by('id_komponen');
        return $this->db->get($this->table)->result();
    }

    // get id komponen by id subkomponen
    function get_idsuboutput($id)
    {
        $this->db->select('id_kegiatan');
        $this->db->where('id_komponen', $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_komponen', $q);
	$this->db->or_like('id_komponen', $q);
	$this->db->or_like('id_kegiatan', $q);
	$this->db->or_like('kode_komponen', $q);
	$this->db->or_like('uraian_kegiatan', $q);
	$this->db->or_like('volume', $q);
	$this->db->or_like('satuan', $q);
	$this->db->or_like('jumlah', $q);
	$this->db->or_like('rencana_capaian', $q);
	$this->db->or_like('capaian', $q);
	$this->db->or_like('jumlah_capaian', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_komponen', $q);
	$this->db->or_like('id_komponen', $q);
	$this->db->or_like('id_kegiatan', $q);
	$this->db->or_like('kode_komponen', $q);
	$this->db->or_like('uraian_kegiatan', $q);
	$this->db->or_like('volume', $q);
	$this->db->or_like('satuan', $q);
	$this->db->or_like('jumlah', $q);
	$this->db->or_like('rencana_capaian', $q);
	$this->db->or_like('capaian', $q);
	$this->db->or_like('jumlah_capaian', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    // delete bulkdata
    function deletebulk(){
        $data = $this->input->post('msg_', TRUE);
        $arr_id = explode(",", $data); 
        $this->db->where_in($this->id, $arr_id);
        return $this->db->delete($this->table);
    }
//check pk data is exists 

        function is_exist($id){
         $query = $this->db->get_where($this->table, array($this->id => $id));
         $count = $query->num_rows();
         if($count > 0){
            return true;
         }else{
            return false;
         }
        }
        
// sum data by id kegiatan
function sum_by_idsuboutput($id)
{
    $this->db->select('sum(capaian) as sum_realisasi, sum(rencana_capaian) as sum_rencana, sum(jumlah_capaian) as sum_jumlah');
    $this->db->where('id_kegiatan', $id);
    return $this->db->get($this->table)->row();
}

   // get data by id
   function count_id_suboutput($id)
   {
       $this->db->select('count(*) as jumlah');
       $this->db->where('id_kegiatan', $id);
       return $this->db->get($this->table)->row();
   }

    // get id by group by id_kegiatan
    function get_id_kegiatan($id)
    {
        $this->db->select('komponen_rektorat.id_kegiatan');
        $this->db->join('kegiatan_rektorat', 'kegiatan_rektorat.id_kegiatan=komponen_rektorat.id_kegiatan', 'left');
        $this->db->where('kegiatan_rektorat.id_unit', $id);
        $this->db->group_by('id_kegiatan');
        return $this->db->get($this->table)->result();
    }

    // sum sub output data by id
    function sum_sub_output($id)
    {
        $this->db->select('sum(jumlah) as sum');
        $this->db->where('id_kegiatan', $id);
        return $this->db->get($this->table)->row();
    }
}

/* End of file Komponen_rektorat_model.php */
/* Location: ./application/models/Komponen_rektorat_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-27 09:40:00 */
/* http://harviacode.com */