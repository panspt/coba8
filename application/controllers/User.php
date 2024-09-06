<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
        $this->load->library('form_validation');
    }
    public function index()
    {
        chek_belom_login();
        check_admin();

        $this->form_validation->set_rules('nama_lengkap', 'Nama', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tb_user.username]', ['is_unique' => 'Username sudah pernah di inputkan, silahkan input Username lain!']);
        $this->form_validation->set_rules('level', 'Level', 'required|trim');
        $this->form_validation->set_rules('pass1', 'Password', 'required|trim|min_length[6]|matches[pass2]', ['matches' => 'Password tidak sama!', 'min_length' => 'Password harus 6 digit/lebih!', 'required' => 'Password harus diisi']);
        $this->form_validation->set_rules('pass2', 'Password', 'required|trim|matches[pass1]', ['required' => 'Konfirmasi password harus diisi']);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Aime | Data User',
                'activeMenu' => 'user',
                'openMenu' => 'user',
                'us' => $this->m_user->live_user()->result(),
                'log' => $this->m_user->user_login(),
            ];
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('template/navbar');
            $this->load->view('admin/user');
            $this->load->view('template/footer');
        } else {
            $data = [
                'nama_user' => htmlspecialchars($this->input->post('nama_lengkap', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => password_hash($this->input->post('pass1'), PASSWORD_DEFAULT),
                'level' => htmlspecialchars($this->input->post('level', true))
            ];
            $this->db->insert('tb_user', $data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
            redirect('user');
        }
    }

    public function edit_user()
    {
        $id = $this->input->post('id');
        $data = [
            'nama_user' => $this->input->post('nama_lengkap'),
            'username' => $this->input->post('username'),
            'level' => $this->input->post('level'),
        ];
        $this->db->where('id_user', $id);
        $this->db->update('tb_user', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Edit data berhasil disimpan</div>');
        redirect('user');
    }

    public function hapus_user()
    {
        $a = $this->input->post('id');
        if ($a == 1) {
            $data = [
                'hasil' => 'gagal',
            ];
            echo json_encode($data);
        } else {
            $data = [
                'hasil' => 'success',
            ];
            $this->db->where('id_user', $a);
            $this->db->delete('tb_user');
            echo json_encode($data);
        }
    }


    public function shift()
    {
        $this->form_validation->set_rules('judul', 'JUDUL', 'required|trim');
        $this->form_validation->set_rules('jam1', 'JAM', 'required|trim');
        $this->form_validation->set_rules('jam2', 'JAM', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'KTR', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Aime | Data Petugas Shift',
                'activeMenu' => 'shif',
                'openMenu' => 'shif',
                'us' => $this->m_user->live_user()->result(),
                'log' => $this->m_user->user_login(),
                'shift' => $this->m_user->live_shift()->result(),
            ];
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('template/navbar');
            $this->load->view('admin/shift');
            $this->load->view('template/footer');
        } else {
            $data = [
                'judul_shift' => $this->input->post('judul'),
                'dari_jam' => $this->input->post('jam1'),
                'sampai_jam' => $this->input->post('jam2'),
                'keterangan' => $this->input->post('keterangan'),
                'jns_shift' => $this->input->post('jenis_laporan'),
            ];
            $this->db->insert('tb_shift', $data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
            redirect('user/shift');
        }
    }

    public function edit_shift()
    {
        $id = $this->input->post('id');
        $data = [
            'judul_shift' => $this->input->post('judul'),
            'dari_jam' => $this->input->post('jam1'),
            'sampai_jam' => $this->input->post('jam2'),
            'keterangan' => $this->input->post('keterangan'),
            'jns_shift' => $this->input->post('jenis_laporan'),
        ];
        $this->db->where('id_shift', $id);
        $this->db->update('tb_shift', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Edit data berhasil disimpan</div>');
        redirect('user/shift');
    }


    public function hapus_shift()
    {
        $a = $this->input->post('id');
        $this->db->where('id_shift', $a);
        $this->db->delete('tb_shift');
        echo json_encode($a);
    }
}
