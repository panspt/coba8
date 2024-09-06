<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
        $this->load->model('m_pengeluaran');
        $this->load->model('m_dashboard');
        $this->load->model('m_memberaktif');
        $this->load->library('form_validation');
    }

    public function index()
    {
        chek_belom_login();
        check_admin();

        $data = [
            'title' => 'Aime | Dashboard',
            'activeMenu' => 'dashboard',
            'openMenu' => 'dashboard',
            'log' => $this->m_user->user_login(),
            'tran' => $this->m_memberaktif->live_sewa(),
            'renn' => $this->m_dashboard->rental_terakhir()->result(),
            'seww' => $this->m_dashboard->sewa_terakhir()->result(),
            'penjl' => $this->m_dashboard->penjualan_terakhir()->result(),
        ];
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/navbar');
        $this->load->view('template/dashboard');
        $this->load->view('template/footer');
    }


    public function pengeluaran()
    {
        chek_belom_login();
        check_admin();
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');
        $this->form_validation->set_rules('total', 'TOTAL', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Aime | Dashboard',
                'activeMenu' => 'peng',
                'openMenu' => 'peng',
                'log' => $this->m_user->user_login(),
                'peng' => $this->m_pengeluaran->live_tgl()->result(),
                't' => $this->m_pengeluaran->live_ttl(),
            ];
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('template/navbar');
            $this->load->view('admin/pengeluaran');
            $this->load->view('template/footer');
        } else {
            date_default_timezone_set('Asia/Jakarta');
            $data = [
                'tgl_pengeluaran' => date('Y-m-d'),
                'judul_pengeluaran' => $this->input->post('judul'),
                'total' => $this->input->post('total'),
            ];
            $this->db->insert('tb_pengeluaran', $data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
            redirect('dashboard/pengeluaran');
        }
    }

    public function edit_pengeluaran()
    {
        $id = $this->input->post('id');
        $data = [
            // 'tgl_pengeluaran' => date('Y-m-d'),
            'judul_pengeluaran' => $this->input->post('judul'),
            'total' => $this->input->post('total'),
        ];
        $this->db->where('id_pengeluaran', $id);
        $this->db->update('tb_pengeluaran', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Edit data berhasil disimpan</div>');
        redirect('dashboard/pengeluaran');
    }

    public function hapus_pengeluaran()
    {
        $id = $this->input->post('id');
        $this->db->where('id_pengeluaran', $id);
        $data = $this->db->delete('tb_pengeluaran');
        echo json_encode($data);
    }

    public function password()
    {
        chek_belom_login();
        check_admin();
        // chek_belom_login();

        $this->form_validation->set_rules('pass_lama', 'Password Lama', 'required|trim', ['required' => 'Password lama harus diisi']);
        $this->form_validation->set_rules('pass1', 'Password', 'required|trim|min_length[6]|matches[pass2]', ['matches' => 'Password tidak sama!', 'min_length' => 'Password harus 6 digit/lebih!', 'required' => 'Password harus diisi']);
        $this->form_validation->set_rules('pass2', 'Password', 'required|trim|matches[pass1]', ['required' => 'Konfirmasi password harus diisi']);
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Aime | Edit Password',
                'activeMenu' => 'passw',
                'openMenu' => 'passw',
                'log' => $this->m_user->user_login(),
            ];
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('template/navbar');
            $this->load->view('admin/password');
            $this->load->view('template/footer');
        } else {
            $id = $this->input->post('id');
            $passlm = $this->input->post('passlm');
            $passlama = $this->input->post('pass_lama');
            $passbaru = $this->input->post('pass1');
            if (!password_verify($passlama, $passlm)) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Password lama salah</div>');
                redirect('dashboard/password');
            } else {
                if ($passlama == $passbaru) {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Password tidak boleh sama dengan yang lama</div>');
                    redirect('dashboard/password');
                } else {
                    $pass_hash = password_hash($passbaru, PASSWORD_DEFAULT);

                    $this->db->set('password', $pass_hash);
                    $this->db->where('id_user', $id);
                    $this->db->update('tb_user');
                    $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Edit Password Berhasil</div>');
                    redirect('dashboard/password');
                }
            }
        }
    }


    public function laporan()
    {
        chek_belom_login();
        check_admin();

        $data = [
            'title' => 'Aime | Dashboard',
            'activeMenu' => 'lap',
            'openMenu' => 'lap',
            'log' => $this->m_user->user_login(),
        ];
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/navbar');
        $this->load->view('admin/laporan/laporan');
        $this->load->view('template/footer');
    }

    public function cek_laporan()
    {
        $pilih = $this->input->post('pilih');
        $jns_lap = $this->input->post('jns');
        $tgl1 = $this->input->post('tgl1');
        $tgl2 = $this->input->post('tgl2');

        if (isset($_POST['pilih'])) {
            if ($pilih == 1) {
                if ($jns_lap == 'A') {
                    $data = [
                        'result' => $this->m_dashboard->laporan_rental($tgl1, $tgl2),
                        'total' => $this->m_dashboard->jml_ttl_rental($tgl1, $tgl2)->row(),
                        'tgl1' => $tgl1,
                        'tgl2' => $tgl2,
                    ];
                    $this->load->view('admin/laporan/v_lap_rental', $data);
                } else {
                    $data = [
                        'result' => $this->m_dashboard->laporan_rental_pertgl($tgl1, $tgl2),
                        'total' => $this->m_dashboard->jml_ttl_rental($tgl1, $tgl2)->row(),
                        'tgl1' => $tgl1,
                        'tgl2' => $tgl2,
                    ];
                    $this->load->view('admin/laporan/v_lap_rental_pertgl', $data);
                }
            } else  if ($pilih == 2) {
                if ($jns_lap == 'A') {
                    $data = [
                        'result' => $this->m_dashboard->laporan_sewa_lunas($tgl1, $tgl2),
                        'tgl1' => $tgl1,
                        'tgl2' => $tgl2,
                    ];
                    $this->load->view('admin/laporan/v_lap_sewa', $data);
                } else if ($jns_lap == 'B') {
                    $data = [
                        'result' => $this->m_dashboard->laporan_sewa_belumlunas($tgl1, $tgl2),
                        'tgl1' => $tgl1,
                        'tgl2' => $tgl2,
                    ];
                    $this->load->view('admin/laporan/v_lap_sewa', $data);
                } else if ($jns_lap == 'C') {
                    $data = [
                        'result' => $this->m_dashboard->laporan_sewa($tgl1, $tgl2),
                        'tgl1' => $tgl1,
                        'tgl2' => $tgl2,
                    ];
                    $this->load->view('admin/laporan/v_lap_sewa', $data);
                } else {
                    echo '<h1 class="text-dark">Data tidak di temukan, Silahkan Chek lagi</h1>';
                }
            } else  if ($pilih == 3) {
                if ($jns_lap == 'A') {
                    $data = [
                        'result' => $this->m_dashboard->laporan_penjualan($tgl1, $tgl2),
                        'tgl1' => $tgl1,
                        'tgl2' => $tgl2,
                    ];
                    $this->load->view('admin/laporan/v_lap_penjualan', $data);
                } else if ($jns_lap == 'B') {
                    $data = [
                        'result' => $this->m_dashboard->laporan_penjualan($tgl1, $tgl2),
                        'tgl1' => $tgl1,
                        'tgl2' => $tgl2,
                    ];
                    $this->load->view('admin/laporan/v_lap_item_penjualan', $data);
                } else {
                    echo '<h1 class="text-dark">Data tidak di temukan, Silahkan Chek lagi</h1>';
                }
            } else  if ($pilih == 4) {
                $data = [
                    'result' => $this->m_dashboard->laporan_pengeluaran($tgl1, $tgl2),
                    'tgl1' => $tgl1,
                    'tgl2' => $tgl2,
                ];
                $this->load->view('admin/laporan/v_lap_pengeluaran', $data);
            } else  if ($pilih == 5) {
            } else  if ($pilih == 6) {
                $data = [
                    'resultr' => $this->m_dashboard->laporan_keuangan_rental($tgl1, $tgl2),
                    'results' => $this->m_dashboard->laporan_keuangan_sewa($tgl1, $tgl2),
                    'resultp' => $this->m_dashboard->laporan_keuangan_penjualan($tgl1, $tgl2),
                    'resultg' => $this->m_dashboard->laporan_keuangan_pengeluaran($tgl1, $tgl2),
                    'tgl1' => $tgl1,
                    'tgl2' => $tgl2,
                ];
                $this->load->view('admin/laporan/v_lap_keuangan', $data);
            } else {
                echo '<h1 class="text-dark">Data tidak di temukan, Silahkan Chek lagi</h1>';
            }
        } else {
            echo '<h1 class="text-dark">Data tidak di temukan, Silahkan Chek lagi</h1>';
        }
    }

    public function dass()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tahun = $this->input->post('thnn');
        if (isset($_POST['thnn'])) {
            if ($tahun == date('Y')) {
                $bln = date('m');
            } else {
                $bln = '12';
            }
            $data = $this->m_dashboard->live_dashboard($tahun,  $bln);
            echo json_encode($data);
        }
        // if ($thn == date('Y')) {
        //     $bln = date('m');
        // } else {
        //     $bln = '12';
        // }
        // $live_dashboard = $this->m_dashboard->live_dashboard($thn, $bln);
        // echo json_encode($live_dashboard);
    }
}
