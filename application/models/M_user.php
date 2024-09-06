<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
    function live_user()
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->order_by('id_user', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function get($id = null)
    {
        $this->db->from('tb_user');
        if ($id != null) {
            $this->db->where('id_user', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    function edit_user($data, $id)
    {
        $this->db->where('id_user', $id);
        $this->db->update('tb_user', $data);
        return TRUE;
    }

    public function view_edit($id)
    {
        $query = $this->db->get_where('tb_user', array('id_user' => $id));
        return $query->result();
    }

    public function user_login()
    {
        $hasil = $this->db->get_where('tb_user', ['id_user' => $this->session->userdata('id_user')])->row();
        return $hasil;
    }

    public function delete($where)
    {
        $this->db->where($where);
        $this->db->delete('tb_user');
        return TRUE;
    }


    function live_shift()
    {
        $this->db->select('*');
        $this->db->from('tb_shift');
        $this->db->order_by('id_shift', 'DESC');
        $query = $this->db->get();
        return $query;
    }
}
