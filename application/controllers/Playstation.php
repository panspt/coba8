<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Playstation extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
        $this->load->model('m_playstation');
        $this->load->library('form_validation');
    }

    public function index()
    {
        chek_belom_login();
        check_admin();
        $this->form_validation->set_rules(
            'jenis',
            'Jenis PlayStation',
            'required|trim|is_unique[tb_ps.jenis_ps]',
            ['is_unique' => 'Jenis PlayStation sudah pernah diinputkan, silahkan pilih Jenis lain!']
        );
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Aime | Dashboard',
                'activeMenu' => 'ps',
                'openMenu' => 'psOpen',
                'log' => $this->m_user->user_login(),
                'jps' => $this->m_playstation->live_ps()->result(),
            ];
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('template/navbar');
            $this->load->view('admin/ps/playstation');
            $this->load->view('template/footer');
        } else {
            $data = [
                'jenis_ps' => $this->input->post('jenis'),
                'harga' => $this->input->post('harga'),
                'menit' => $this->input->post('menit'),
            ];
            $this->db->insert('tb_ps', $data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
            redirect('playstation');
        }
    }

    public function edit_ps()
    {
        $id = $this->input->post('id');
        $data = [
            'jenis_ps' => $this->input->post('jenis'),
            'harga' => $this->input->post('harga'),
            'menit' => $this->input->post('menit'),
        ];
        $this->db->where('id_ps', $id);
        $this->db->update('tb_ps', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Edit data berhasil disimpan</div>');
        redirect('playstation');
    }

    public function hapus_ps()
    {
        $id = $this->input->post('id');
        $cek = 0;
        if ($cek > 0) {
            $data = [
                'hasil' => 'gagal',
            ];
            echo json_encode($data);
        } else {
            $data = [
                'hasil' => 'success',
            ];
            $this->db->where('id_ps', $id);
            $this->db->delete('tb_ps');
            echo json_encode($data);
        }
    }


    // Channel
    public function channel()
    {
        chek_belom_login();
        check_admin();
        $this->form_validation->set_rules(
            'channel',
            'Nama Channel',
            'required|trim|is_unique[tb_channel.nama_channel]',
            ['is_unique' => 'Nama channel sudah pernah diinputkan, silahkan pilih Nama lain!']
        );
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Aime | Dashboard',
                'activeMenu' => 'ch',
                'openMenu' => 'psOpen',
                'log' => $this->m_user->user_login(),
                'jps' => $this->m_playstation->live_ps()->result(),
                'cnl' => $this->m_playstation->live_channel()->result(),
            ];
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('template/navbar');
            $this->load->view('admin/ps/channel');
            $this->load->view('template/footer');
        } else {
            $data = [
                'idps' => $this->input->post('idps'),
                'nama_channel' => $this->input->post('channel'),
            ];
            $this->db->insert('tb_channel', $data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
            redirect('playstation/channel');
        }
    }

    public function edit_channel()
    {

        $id = $this->input->post('id');
        $data = [
            'idps' => $this->input->post('idps'),
            'nama_channel' => $this->input->post('channel'),
        ];
        $this->db->where('id_channel', $id);
        $this->db->update('tb_channel', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Edit data berhasil disimpan</div>');
        redirect('playstation/channel');
    }

    public function hapus_channel()
    {
        $id = $this->input->post('id');
        $this->db->where('id_channel', $id);
        $data = $this->db->delete('tb_channel');
        echo json_encode($data);
    }


    // sewa harian
    public function sewa()
    {
        chek_belom_login();
        check_admin();
        $this->form_validation->set_rules('idps', 'PS', 'required|trim');
        $this->form_validation->set_rules('hari', 'Hari', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Aime | Dashboard',
                'activeMenu' => 'sw',
                'openMenu' => 'psOpen',
                'log' => $this->m_user->user_login(),
                'jps' => $this->m_playstation->live_ps()->result(),
                'swa' => $this->m_playstation->live_sewa()->result(),
            ];
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('template/navbar');
            $this->load->view('admin/ps/sewa');
            $this->load->view('template/footer');
        } else {
            $idps = $this->input->post('idps');
            $hari = $this->input->post('hari');
            $cek = $this->m_playstation->cek_data_sewa($idps, $hari)->row();
            if (!empty($cek)) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Gagl, Data sudah pernah diinputkan, Silahkan input data yg lain (data tidak boleh sama dengan yang sudah ada di database)</div>');
                redirect('playstation/sewa');
            } else {
                $data = [
                    'idps' => $this->input->post('idps'),
                    'jml_hari' => $this->input->post('hari'),
                    'keterangan' => $this->input->post('keterangan'),
                    'harga_sewa' => $this->input->post('harga'),
                ];
                $this->db->insert('tb_sewa', $data);
                $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
                redirect('playstation/sewa');
            }
        }
    }

    public function edit_sewa()
    {
        $idpslama = $this->input->post('idpslama');
        $harilama = $this->input->post('harilama');
        $data1 = $idpslama . $harilama;
        $idps = $this->input->post('idps');
        $hari = $this->input->post('hari');
        $data2 = $idps . $hari;
        if ($data1 == $data2) {
            $id = $this->input->post('id');
            $data = [
                'harga_sewa' => $this->input->post('harga'),
                'keterangan' => $this->input->post('keterangan'),
            ];
            $this->db->where('id_sewa', $id);
            $this->db->update('tb_sewa', $data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Edit data berhasil disimpan</div>');
            redirect('playstation/sewa');
        } else {
            $cek = $this->m_playstation->cek_data_sewa($idps, $hari)->row();
            if (!empty($cek)) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Gagl, Data sudah pernah diinputkan, Silahkan input data yg lain (data tidak boleh sama dengan yang sudah ada di database)</div>');
                redirect('playstation/sewa');
            } else {
                $id = $this->input->post('id');
                $data = [
                    'idps' => $this->input->post('idps'),
                    'jml_hari' => $this->input->post('hari'),
                    'keterangan' => $this->input->post('keterangan'),
                    'harga_sewa' => $this->input->post('harga'),
                ];
                $this->db->where('id_sewa', $id);
                $this->db->update('tb_sewa', $data);
                $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Edit data berhasil disimpan</div>');
                redirect('playstation/sewa');
            }
        }
    }

    public function hapus_sewa()
    {
        $id = $this->input->post('id');
        $this->db->where('id_sewa', $id);
        $data = $this->db->delete('tb_sewa');
        echo json_encode($data);
    }
}
