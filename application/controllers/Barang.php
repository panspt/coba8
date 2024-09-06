<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
        $this->load->model('m_barang');
        $this->load->library('form_validation');
    }

    public function index()
    {
        chek_belom_login();
        check_admin();
        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required|trim|is_unique[tb_barang.kode_barang]',  ['is_unique' => 'Kode barang sudah pernah diinputkan, silahkan pilih kode lain!']);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Aime | Data Barang',
                'activeMenu' => 'barang',
                'openMenu' => 'barang',
                'log' => $this->m_user->user_login(),
                'brg' => $this->m_barang->live_barang()->result(),
            ];
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('template/navbar');
            $this->load->view('admin/barang');
            $this->load->view('template/footer');
        } else {
            $data = [
                'kode_barang' => $this->input->post('kode_barang'),
                'nama_barang' => $this->input->post('nama_barang'),
                'harga_barang' => $this->input->post('hrg_barang'),
                'keterangan' => $this->input->post('keterangan'),
            ];
            $this->db->insert('tb_barang', $data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
            redirect('barang');
        }
    }

    public function cek_kode()
    {
        $kode = $this->input->post('kd');
        $cek = $this->m_barang->cek_kode_barang($kode)->num_rows();
        if ($cek > 0) {
            $data = [
                'hasil' => 'ada'
            ];
            echo json_encode($data);
        } else {
            $data = [
                'hasil' => 'kosong'
            ];
            echo json_encode($data);
        }
    }


    public function edit_barang()
    {
        $id = $this->input->post('id');
        $data = [
            'nama_barang' => $this->input->post('nama_barang'),
            'harga_barang' => $this->input->post('harga'),
            'keterangan' => $this->input->post('keterangan'),
        ];
        $this->db->where('id_barang', $id);
        $this->db->update('tb_barang', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Edit data berhasil disimpan</div>');
        redirect('barang');
    }


    public function hapus_barang()
    {
        $id = $this->input->post('id');
        $this->db->where('id_barang', $id);
        $data = $this->db->delete('tb_barang');
        echo json_encode($data);
    }
}
