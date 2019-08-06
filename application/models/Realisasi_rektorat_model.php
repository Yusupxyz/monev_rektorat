<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Realisasi_rektorat_model extends CI_Model
{

    public $table = 'realisasi_rektorat';
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
    
    // get total rows
    function total_rows($q = NULL,$id_subkomponen) {
        $query=$this->db->query("SELECT count(*) as count FROM `realisasi_rektorat` JOIN `bulan` ON `bulan`.`id_bulan`=`realisasi_rektorat`.`id_bulan` 
                                WHERE `id_subkomponen` = '".$id_subkomponen."' AND (`id_realisasi` LIKE '%".$q."%' ESCAPE '!' OR 
                                `realisasi_rektorat`.`id_bulan` LIKE '%".$q."%' ESCAPE '!' OR `id_subkomponen` LIKE '%".$q."%' ESCAPE '!' 
                                OR `rencana_capaian` LIKE '%".$q."%' ESCAPE '!' OR `ukuran_keberhasilan` LIKE '%".$q."%' ESCAPE '!' 
                                OR `realisasi_capaian` LIKE '%".$q."%' ESCAPE '!' OR `realisasi_jumlah` LIKE '%".$q."%' ESCAPE '!' 
                                OR `uraian_hasil` LIKE '%".$q."%' ESCAPE '!' OR `kendala` LIKE '%".$q."%' ESCAPE '!' OR `keterangan` 
                                LIKE '%".$q."%' ESCAPE '!')");
        return $query->row();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = 'a',$id_subkomponen) {
            $query=$this->db->query("SELECT * FROM `realisasi_rektorat` JOIN `bulan` ON `bulan`.`id_bulan`=`realisasi_rektorat`.`id_bulan` 
                                    WHERE `id_subkomponen` = '".$id_subkomponen."' AND (`id_realisasi` LIKE '%".$q."%' ESCAPE '!' OR 
                                    `realisasi_rektorat`.`id_bulan` LIKE '%".$q."%' ESCAPE '!' OR `id_subkomponen` LIKE '%".$q."%' ESCAPE '!' 
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
//check pk data is exists 

        function is_exist($id){
         $query = $this->db->get_where($this->table, array('id_realisasi' => $id));
         $count = $query->num_rows();
         if($count > 0){
            return true;
         }else{
            return false;
         }
        }


}

/* End of file Realisasi_rektorat_model.php */
/* Location: ./application/models/Realisasi_rektorat_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-08-06 05:08:33 */
/* http://harviacode.com */