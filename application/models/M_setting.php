<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_setting extends CI_Model
{
    function live_setting()
    {
        $this->db->select('*');
        $this->db->from('tb_setting');
        $this->db->order_by('id_setting', 'ASC');
        $query = $this->db->get();
        return $query;
    }
}
