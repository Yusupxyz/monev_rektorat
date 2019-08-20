<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kegiatan_rektorat_model extends CI_Model
{

    public $table = 'kegiatan_rektorat';
    public $id = 'id_kegiatan';
    public $order = 'DESC';
    public $table2 = 'sub_komponen';
    public $table3 = 'komponen';
    public $table4 = 'kegiatan';
    
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


    // get data by id join with m_dat
    function get_by_id_join($id)
    {
        $this->db->join('m_dat', 'kegiatan_rektorat.kode_m_dat=m_dat.kode');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get data by kode mdat
    function get_by_kode($kode)
    {
        $this->db->where('kode_m_dat', $kode);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL,$i,$tahun) {
        $this->db->like('id_kegiatan', $q);
        $this->db->from($this->table);
        $this->db->where('id_unit',$i);
        $this->db->where('id_tahun',$tahun);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL,$i,$tahun) {
        $this->db->like('id_kegiatan', $q);
        $this->db->join('m_dat', 'kegiatan_rektorat.kode_m_dat=m_dat.kode');
        $this->db->join('unit', 'kegiatan_rektorat.id_unit=unit.id_unit');
        $this->db->where('kegiatan_rektorat.id_unit',$i);
        $this->db->where('kegiatan_rektorat.id_tahun',$tahun);
        $this->db->limit($limit, $start);
        $this->db->order_by('kode_m_dat', 'ASC');
        return $this->db->get($this->table)->result();
    }

    // get jumlah anak by id
    function count_child($i,$b,$tahun)
    {
        $result=$this->db->query ('SELECT count(*) as jumlah_anak FROM kegiatan_rektorat JOIN m_dat
                     ON kegiatan_rektorat.kode_m_dat = m_dat.kode WHERE m_dat.induk = 
                     (select kode_m_dat from kegiatan_rektorat where id_tahun = '.$tahun.' limit '.$i.',1)')->row();
        return $result;
    }

    // count kegiatan
    function count_kegiatan($b,$tahun)
    {
        $result=$this->db->query ('SELECT count(*) as "count" from kegiatan_rektorat where id_tahun = '.$tahun)->row();
        return $result;
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

    // update data by kode m_dat
    function update_bykode($id, $data)
    {
        $this->db->where('kode_m_dat', $id);
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
    function sum_by_induk($id)
    {
        $this->db->select('sum(capaian) as sum_realisasi, sum(rencana_capaian) as sum_rencana, sum(jumlah_capaian) as sum_jumlah');
        $this->db->join('m_dat', 'kegiatan_rektorat.kode_m_dat=m_dat.kode');
        $this->db->where('induk', $id);
        return $this->db->get($this->table)->row();
    }

     // get sum by jenis dan idunit
     function sum($i, $id)
     {
         $this->db->select('sum(jumlah) as sum');
         $this->db->join('m_dat', 'kegiatan_rektorat.kode_m_dat=m_dat.kode', 'left');
         $this->db->where('id_unit', $id);
         $this->db->where('jenis', $i);
         return $this->db->get($this->table)->row();
     }

    // get id_kegiatan by jenis dan idunit
    function get_id_kegiatan($i, $id)
    {
        $this->db->select('id_kegiatan');
        $this->db->join('m_dat', 'kegiatan_rektorat.kode_m_dat=m_dat.kode', 'left');
        $this->db->where('id_unit', $id);
        $this->db->where('jenis', $i);
        return $this->db->get($this->table)->row();
    }

      // komponenn
      function get_by_id_komponen($id)
      {
          $this->db->where('id_komponen', $id);
          return $this->db->get($this->table3)->row();
      }
}

/* End of file Kegiatan_rektorat_model.php */
/* Location: ./application/models/Kegiatan_rektorat_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-27 08:58:48 */
/* http://harviacode.com */