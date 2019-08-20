<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sub_komponen_model extends CI_Model
{

    public $table = 'sub_komponen';
    public $id = 'id_subkomponen';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
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

    // get all data by id
    function get_all_by_id($id,$id_unit=null)
    {
        $this->db->select('a.jenis as jenis_kegiatan, a.kode as kode_awal, a.ket as ket_awal, b.kode as kode_kegiatan, b.ket as ket_kegiatan, 
                          c.volume as volume_kegiatan, c.satuan as satuan_kegiatan,
                          sub_komponen.kode_subkomponen as output_kode, sub_komponen.uraian_kegiatan as output_ket');
        $this->db->join('komponen', 'komponen.id_komponen=sub_komponen.id_komponen','left');
        $this->db->join('kegiatan', 'kegiatan.id_kegiatan=komponen.id_kegiatan','left');
        $this->db->join('m_dat a', 'a.kode=kegiatan.kode_m_dat','left');
        $this->db->join('m_dat b', 'a.induk=b.kode','left');
        $this->db->join('kegiatan c', 'c.kode_m_dat=b.kode','left');
        $this->db->where('c.id_unit', $id_unit);
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get id komponen by id subkomponen
    function get_idkomponen($id)
    {
        $this->db->select('sub_komponen.id_komponen ,komponen.kode_komponen as kode');
        $this->db->join('komponen', 'komponen.id_komponen=sub_komponen.id_komponen','left');
        $this->db->where('id_subkomponen', $id);
        return $this->db->get($this->table)->row();
    }

     // get id komponen by id subkomponen
     function get_data_by_kode($kode)
     {
         $this->db->select('sum(sub_komponen.jumlah) as jumlah, sum(sub_komponen.rencana_capaian) as rc, sum(sub_komponen.capaian) as c, sum(sub_komponen.jumlah_capaian) as jc');
         $this->db->join('komponen', 'komponen.id_komponen=sub_komponen.id_komponen','left');
         $this->db->where('kode_komponen', $kode);
         return $this->db->get($this->table)->row();
     }
     // get id komponen by id subkomponen
     function count_by_kode($kode)
     {
         $this->db->select('count(*) as jumlah');
         $this->db->join('komponen', 'komponen.id_komponen=sub_komponen.id_komponen','left');
         $this->db->where('kode_komponen', $kode);
         return $this->db->get($this->table)->row();
     }

    // get data by id_komponen
    function get_by_id_komponen($i,$b,$tahun)
    {
        $result=$this->db->query (
            'SELECT sub_komponen.*, unit.* FROM sub_komponen LEFT JOIN komponen ON komponen.id_komponen=sub_komponen.id_komponen
            LEFT JOIN kegiatan ON komponen.id_kegiatan=kegiatan.id_kegiatan LEFT JOIN
            unit ON unit.id_unit=kegiatan.id_unit WHERE sub_komponen.id_komponen = 
                (select id_komponen from komponen LEFT JOIN kegiatan on komponen.id_kegiatan = kegiatan.id_kegiatan where kegiatan.id_unit = '.$b.' AND kegiatan.id_tahun = '.$tahun.'
                  limit '.$i.',1)')->result();
        return $result;
    }

    // get data by id_komponen
    function get_by_id_komponen_resume($i,$tahun)
    {
        $result=$this->db->query (
            'SELECT sub_komponen.*, unit.* FROM sub_komponen LEFT JOIN komponen ON komponen.id_komponen=sub_komponen.id_komponen
            LEFT JOIN kegiatan ON komponen.id_kegiatan=kegiatan.id_kegiatan LEFT JOIN
            unit ON unit.id_unit=kegiatan.id_unit WHERE komponen.kode_komponen = 
                (select kode_komponen from komponen LEFT JOIN kegiatan on komponen.id_kegiatan = kegiatan.id_kegiatan where kegiatan.id_tahun = '.$tahun.'
                  limit '.$i.',1)')->result();
        return $result;
    }

    // sum data by id subkomponen
    function sum_by_idkomponen($id)
    {
        $this->db->select('sum(capaian) as sum_realisasi, sum(rencana_capaian) as sum_rencana, sum(jumlah_capaian) as sum_jumlah');
        $this->db->where('id_komponen', $id);
        return $this->db->get($this->table)->row();
    }

    // sum data by id subkomponen
    function sum_by_kodekomponen($kode)
    {
        $this->db->select('sum(sub_komponen.capaian) as sum_realisasi, sum(sub_komponen.rencana_capaian) as sum_rencana, sum(sub_komponen.jumlah_capaian) as sum_jumlah');
        $this->db->join('komponen','sub_komponen.id_komponen=komponen.id_komponen','left');
        $this->db->where('kode_komponen', $kode);
        return $this->db->get($this->table)->row();
    }

    // sum komponen data by id
    function sum_komponen($id)
    {
        $this->db->select('sum(jumlah) as sum');
        $this->db->where('id_komponen', $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_subkomponen', $q);
	$this->db->or_like('id_subkomponen', $q);
	$this->db->or_like('id_komponen', $q);
	$this->db->or_like('kode_subkomponen', $q);
	$this->db->or_like('uraian_kegiatan', $q);
	$this->db->or_like('volume', $q);
	$this->db->or_like('satuan', $q);
	$this->db->or_like('jumlah', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_subkomponen', $q);
	$this->db->or_like('id_subkomponen', $q);
	$this->db->or_like('id_komponen', $q);
	$this->db->or_like('kode_subkomponen', $q);
	$this->db->or_like('uraian_kegiatan', $q);
	$this->db->or_like('volume', $q);
	$this->db->or_like('satuan', $q);
	$this->db->or_like('jumlah', $q);
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

    // get data by id
    function count_id_komponen($id)
    {
        $this->db->select('count(*) as jumlah');
        $this->db->where('id_komponen', $id);
        return $this->db->get($this->table)->row();
    }

    // get data by id
    function count_kode_komponen($kode)
    {
        $this->db->select('count(*) as jumlah');
        $this->db->join('komponen', 'komponen.id_komponen=sub_komponen.id_komponen','left');
        $this->db->where('kode_komponen', $kode);
        return $this->db->get($this->table)->row();
    }
    
     // get data by id_komponen
     function get_by_id_kode($id,$kode)
     {
        $this->db->where('id_komponen', $id);
        $this->db->where('kode_subkomponen', $kode);
        return $this->db->get($this->table)->row();
     }
    
}

/* End of file Sub_komponen_model.php */
/* Location: ./application/models/Sub_komponen_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-08 23:34:45 */
/* http://harviacode.com */