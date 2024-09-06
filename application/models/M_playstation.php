<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_playstation extends CI_Model
{
    function live_ps()
    {
        $this->db->select('*');
        $this->db->from('tb_ps');
        $this->db->order_by('id_ps', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    function live_channel()
    {
        $this->db->select('*');
        $this->db->from('tb_channel');
        $this->db->join('tb_ps', 'tb_ps.id_ps=tb_channel.idps');
        $this->db->order_by('id_channel', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    function live_channel2()
    {
        $this->db->select('*');
        $this->db->from('tb_channel');
        $this->db->join('tb_ps', 'tb_ps.id_ps=tb_channel.idps');
        $this->db->order_by('id_channel', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    function live_sewa()
    {
        $this->db->select('*');
        $this->db->from('tb_sewa');
        $this->db->join('tb_ps', 'tb_ps.id_ps=tb_sewa.idps');
        $this->db->order_by('id_ps', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    function live_sewa_group()
    {
        $this->db->select('*');
        $this->db->from('tb_sewa');
        $this->db->join('tb_ps', 'tb_ps.id_ps=tb_sewa.idps');
        $this->db->group_by('idps');
        // $this->db->order_by('id_ps', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    function cekps($id)
    {
        $this->db->select('*');
        $this->db->from('tb_sewa');
        $this->db->where('idps', $id);
        $this->db->where('jml_hari=1');
        $query = $this->db->get();
        return $query;
    }

    function cekjmlhari($hr, $ps)
    {
        $this->db->select('*');
        $this->db->from('tb_sewa');
        $this->db->join('tb_ps', 'tb_ps.id_ps=tb_sewa.idps');
        $this->db->where('idps', $ps);
        $this->db->where('jml_hari', $hr);
        $query = $this->db->get();
        return $query;
    }

    function cek_data_sewa($idps, $hari)
    {
        $this->db->select('*');
        $this->db->from('tb_sewa');
        $this->db->where('idps', $idps);
        $this->db->where('jml_hari', $hari);
        $query = $this->db->get();
        return $query;
    }
}
