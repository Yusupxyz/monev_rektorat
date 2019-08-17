<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kegiatan_model extends CI_Model
{

    public $table = 'kegiatan';
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

    function get_by_id_subkomponen($id)
    {
        $this->db->where('id_subkomponen', $id);
        return $this->db->get($this->table2)->row();
    }

    function get_by_id_kegiatan($id)
    {
        $this->db->where('id_kegiatan', $id);
        return $this->db->get($this->table4)->row();
    }
    function delete_kegiatan($id)
    {
        $this->db->where('id_kegiatan', $id);
        $this->db->delete($this->table4);
    }
    function delete_subkomponen($id)
    {
        $this->db->where('id_subkomponen', $id);
        $this->db->delete($this->table2);
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
        $this->db->join('m_dat', 'kegiatan.kode_m_dat=m_dat.kode');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get id_kegiatan by jenis dan idunit
    function get_id_kegiatan($i, $id)
    {
        $this->db->select('id_kegiatan');
        $this->db->join('m_dat', 'kegiatan.kode_m_dat=m_dat.kode', 'left');
        $this->db->where('id_unit', $id);
        $this->db->where('jenis', $i);
        return $this->db->get($this->table)->row();
    }


    // sum data by id kegiatan
    function sum_by_induk($id)
    {
        $this->db->select('sum(capaian) as sum_realisasi, sum(rencana_capaian) as sum_rencana, sum(jumlah_capaian) as sum_jumlah');
        $this->db->join('m_dat', 'kegiatan.kode_m_dat=m_dat.kode');
        $this->db->where('induk', $id);
        return $this->db->get($this->table)->row();
    }

    // get sum by jenis dan idunit
    function sum($i, $id)
    {
        $this->db->select('sum(jumlah) as sum');
        $this->db->join('m_dat', 'kegiatan.kode_m_dat=m_dat.kode', 'left');
        $this->db->where('id_unit', $id);
        $this->db->where('jenis', $i);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL, $i, $tahun)
    {
        $this->db->like('id_kegiatan', $q);
        $this->db->from($this->table);
        $this->db->where('id_unit', $i);
        $this->db->where('id_tahun', $tahun);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $i, $tahun)
    {
        $this->db->like('id_kegiatan', $q);

        $this->db->join('m_dat', 'kegiatan.kode_m_dat=m_dat.kode');
        // $this->db->where()
        $this->db->where('kegiatan.id_unit', $i);
        $this->db->where('kegiatan.id_tahun', $tahun);
        $this->db->limit($limit, $start);
        $this->db->order_by('kode_m_dat', 'ASC');
        return $this->db->get($this->table)->result();
    }

    // sum_by_jenis_unit
    function sum_by_jenis_unit($id_unit)
    {
        $this->db->select('*');
        $this->db->join('m_dat', 'kegiatan.kode_m_dat=m_dat.kode', 'left');
        $this->db->where('jenis', '1');
        $this->db->where('id_unit', $id_unit);
        return $this->db->get($this->table)->row();
    }

    // get jumlah anak by id
    function count_child($i, $b, $tahun)
    {
        $result = $this->db->query('SELECT count(*) as jumlah_anak FROM kegiatan JOIN m_dat
                     ON kegiatan.kode_m_dat = m_dat.kode WHERE m_dat.induk = 
                     (select kode_m_dat from kegiatan where id_tahun = ' . $tahun . ' AND id_unit=' . $b . ' limit ' . $i . ',1)')->row();
        return $result;
    }

    // count kegiatan
    function count_kegiatan($b, $tahun)
    {
        $result = $this->db->query('SELECT count(*) as "count" from kegiatan where id_tahun = ' . $tahun . ' AND id_unit =' . $b . ' ')->row();
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
    // update data_komponen
    function update_komponen($id, $data)
    {
        $this->db->where('id_komponen', $id);
        $this->db->update($this->table3, $data);
    }

    // update data_komponen
    function update_subkomponen($id, $data)
    {
        $this->db->where('id_subkomponen', $id);
        $this->db->update($this->table2, $data);
    }
    // update data by kode m_dat
    function update_bykode($id, $data, $id_unit)
    {
        $this->db->where('kode_m_dat', $id);
        $this->db->where('id_unit', $id_unit);
        $this->db->update($this->table, $data);
    }
    // komponenn
    function get_by_id_komponen($id)
    {
        $this->db->where('id_komponen', $id);
        return $this->db->get($this->table3)->row();
    }

    // delete komponen
    function delete_komponen($id)
    {
        $this->db->where('id_komponen', $id);
        $this->db->delete($this->table3);
    }


    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    // delete bulkdata
    function deletebulk()
    {
        $data = $this->input->post('msg_', TRUE);
        $arr_id = explode(",", $data);
        $this->db->where_in($this->id, $arr_id);
        return $this->db->delete($this->table);
    }
    //check pk data is exists 

    function is_exist($id)
    {
        $query = $this->db->get_where($this->table, array($this->id => $id));
        $count = $query->num_rows();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }
}

/* End of file Kegiatan_model.php */
/* Location: ./application/models/Kegiatan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-08 18:29:18 */
/* http://harviacode.com */
