<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Realisasi_model extends CI_Model
{

    public $table = 'realisasi';
    public $id = 'id_realisasi';
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

    // get data by id
    function chart($id_unit,$kode)
    {
        $this->db->select('realisasi.realisasi_capaian as realisasi_capaian, realisasi.rencana_capaian as rencana_capaian');
        $this->db->join('sub_komponen', 'sub_komponen.id_subkomponen=realisasi.id_subkomponen','left');
        $this->db->join('komponen', 'komponen.id_komponen=sub_komponen.id_komponen','left');    
        $this->db->where('id_unit', $id_unit);
        $this->db->where('komponen.kode_komponen', $kode);
        return $this->db->get($this->table)->result();
    }

    // get all data realisasi
    function chart_all($kode)
    {
        $this->db->select('realisasi.realisasi_capaian as realisasi_capaian, realisasi.rencana_capaian as rencana_capaian');
        $this->db->join('sub_komponen', 'sub_komponen.id_subkomponen=realisasi.id_subkomponen','left');
        $this->db->join('komponen', 'komponen.id_komponen=sub_komponen.id_komponen','left');    
        $this->db->where('komponen.kode_komponen', $kode);
        return $this->db->get($this->table)->result();
    }

    // sum data by id subkomponen
    function sum_by_idsubkomponen($id)
    {
        $this->db->select('sum(realisasi_capaian) as sum_realisasi, sum(rencana_capaian) as sum_rencana, sum(realisasi_jumlah) as sum_jumlah');
        $this->db->where('id_subkomponen', $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL,$id_subkomponen) {
        $query=$this->db->query("SELECT count(*) as count FROM `realisasi` JOIN `bulan` ON `bulan`.`id_bulan`=`realisasi`.`id_bulan` 
                                WHERE `id_subkomponen` = '".$id_subkomponen."' AND (`id_realisasi` LIKE '%".$q."%' ESCAPE '!' OR 
                                `realisasi`.`id_bulan` LIKE '%".$q."%' ESCAPE '!' OR `id_subkomponen` LIKE '%".$q."%' ESCAPE '!' 
                                OR `rencana_capaian` LIKE '%".$q."%' ESCAPE '!' OR `ukuran_keberhasilan` LIKE '%".$q."%' ESCAPE '!' 
                                OR `realisasi_capaian` LIKE '%".$q."%' ESCAPE '!' OR `realisasi_jumlah` LIKE '%".$q."%' ESCAPE '!' 
                                OR `uraian_hasil` LIKE '%".$q."%' ESCAPE '!' OR `kendala` LIKE '%".$q."%' ESCAPE '!' OR `keterangan` 
                                LIKE '%".$q."%' ESCAPE '!')");
        return $query->row();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = 'a',$id_subkomponen) {
        $query=$this->db->query("SELECT * FROM `realisasi` JOIN `bulan` ON `bulan`.`id_bulan`=`realisasi`.`id_bulan` 
                                WHERE `id_subkomponen` = '".$id_subkomponen."' AND (`id_realisasi` LIKE '%".$q."%' ESCAPE '!' OR 
                                `realisasi`.`id_bulan` LIKE '%".$q."%' ESCAPE '!' OR `id_subkomponen` LIKE '%".$q."%' ESCAPE '!' 
                                OR `rencana_capaian` LIKE '%".$q."%' ESCAPE '!' OR `ukuran_keberhasilan` LIKE '%".$q."%' ESCAPE '!' 
                                OR `realisasi_capaian` LIKE '%".$q."%' ESCAPE '!' OR `realisasi_jumlah` LIKE '%".$q."%' ESCAPE '!' 
                                OR `uraian_hasil` LIKE '%".$q."%' ESCAPE '!' OR `kendala` LIKE '%".$q."%' ESCAPE '!' OR `keterangan` 
                                LIKE '%".$q."%' ESCAPE '!') ORDER BY `id_realisasi` ASC LIMIT ".$start.",".$limit);
        return $query->result();
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

    function is_exist($id){
        $query = $this->db->get_where($this->table, array('id_subkomponen' => $id));
        $count = $query->num_rows();
        if($count > 0){
           return true;
        }else{
           return false;
        }
    }
}

/* End of file Realisasi_model.php */
/* Location: ./application/models/Realisasi_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-14 10:58:25 */
/* http://harviacode.com */