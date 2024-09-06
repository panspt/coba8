<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
        $this->load->model('m_setting');
    }

    public function index()
    {
        chek_belom_login();

        $data = [
            'title' => 'Aime | Setting ',
            'activeMenu' => 'set',
            'openMenu' => 'set',
            'log' => $this->m_user->user_login(),
            'sett' => $this->m_setting->live_setting()->result(),
        ];
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/navbar');
        $this->load->view('admin/setting');
        $this->load->view('template/footer');
    }

    public function edit()
    {
        $id = $this->input->post('id');
        $nm = $this->input->post('nm_field');
        $v = $this->input->post('value');
        if ($v == "") {
            $isi = '--';
        } else {
            $isi = $this->input->post('value');
        }
        $data = [
            $nm =>   $isi,
        ];
        $this->db->where('id_setting', $id);
        $ss = $this->db->update('tb_setting', $data);
        echo json_encode($ss);
    }
}
