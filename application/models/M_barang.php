<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_barang extends CI_Model
{
    function live_barang()
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->order_by('id_barang', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    function cek_kode_barang($kode)
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->where('kode_barang', $kode);
        $query = $this->db->get();
        return $query;
    }
}
