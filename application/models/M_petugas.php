<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_petugas extends CI_Model
{

    public function invoice()
    {
        $this->db->select('RIGHT(tb_penjualan.kode_penjualan,4) as invoice', FALSE);
        $this->db->order_by('invoice', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_penjualan');  //cek dulu apakah ada sudah ada invoice di tabel.    
        if ($query->num_rows() <> 0) {
            //cek invoice jika telah tersedia    
            $data = $query->row();
            $invoice = intval($data->invoice) + 1;
        } else {
            $invoice = 1;  //cek jika invoice belum terdapat pada table
        }
        // $tgl = date('dmY');
        $batas = str_pad($invoice, 4, "0", STR_PAD_LEFT);
        $kodetampil =  "P" . $batas;  //format kode
        return $kodetampil;
    }

    // function kode_rental($length = 10)
    function kode_rental()
    {
        // $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        // $randomString = substr(str_shuffle($characters), 0, $length);

        $this->db->select('RIGHT(tb_member.kode,6) as invoice', FALSE);
        $this->db->order_by('invoice', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_member');  //cek dulu apakah ada sudah ada invoice di tabel.    
        if ($query->num_rows() <> 0) {
            //cek invoice jika telah tersedia    
            $data = $query->row();
            $invoice = intval($data->invoice) + 1;
        } else {
            $invoice = 1;  //cek jika invoice belum terdapat pada table
        }
        // $tgl = date('dmY');
        $batas = str_pad($invoice, 6, "0", STR_PAD_LEFT);
        $kodetampil =  "R" . $batas;  //format kode
        return $kodetampil;
    }

    public function cek_penjualan()
    {
        $this->db->select('*');
        $this->db->from('tb_penjualan');
        $this->db->where('sts_bayar', 'B');
        $this->db->limit(1, 'ASC');
        $query = $this->db->get();
        return $query;
    }

    // public function cek_penjualan2()
    // {
    //     $this->db->select('*');
    //     $this->db->from('tb_penjualan');
    //     $this->db->where('sts_bayar', 'E');
    //     $this->db->limit(1, 'ASC');
    //     $query = $this->db->get();
    //     return $query;
    // }

    function cek_kode_penjualan($kode)
    {
        $this->db->select('*');
        $this->db->from('tb_penjualan');
        $this->db->join('tb_user', 'tb_user.id_user=tb_penjualan.iduser');
        $this->db->where('kode_penjualan', $kode);
        $query = $this->db->get();
        return $query;
    }

    public function cek_edit_penjualan()
    {
        $this->db->select('*');
        $this->db->from('tb_penjualan');
        $this->db->where('sts_bayar', 'E');
        $this->db->limit(1, 'ASC');
        $query = $this->db->get();
        return $query;
    }

    public function live_penjualan()
    {
        // menampilkan data dari 2 hari sebelumnya sampai hari ini.
        $tgl = date("Y-m-d", strtotime("-2 day"));
        $this->db->select('*');
        $this->db->from('tb_penjualan');
        $this->db->where("tgl_laporan >='$tgl'");
        $this->db->where("sts_bayar !='E'");
        $this->db->order_by('id_penjualan', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    function cek_data_keranjang($kode_penjualan, $kode)
    {
        $this->db->select('*');
        $this->db->from('tb_keranjang');
        $this->db->where('kodepenjualan', $kode_penjualan);
        $this->db->where('kodebarang', $kode);
        $query = $this->db->get();
        return $query;
    }

    function cek_kode_keranjang($kode)
    {
        $this->db->select('*');
        $this->db->from('tb_keranjang');
        $this->db->where('kodepenjualan', $kode);
        $query = $this->db->get();
        return $query;
    }

    public function live_member()
    {
        $hasil = $this->db->query("SELECT * FROM tb_member 
        JOIN tb_rental ON tb_member.kode=tb_rental.kode_member 
        JOIN tb_channel ON tb_channel.id_channel=tb_rental.idchannel  
        where sts_bayar='B' order by id_member ASC limit 1 ");
        return $hasil->row();
    }

    public function live_member2()
    {
        $hasil = $this->db->query("SELECT * FROM tb_rental 
        JOIN tb_member ON tb_member.kode=tb_rental.kode_member 
        JOIN tb_channel ON tb_channel.id_channel=tb_rental.idchannel 
        where aktif='Y'  ");
        return $hasil;
    }

    public function live_member3()
    {
        // menampilkan data dari 1 hari sebelumnya sampai hari ini.
        $tgl = date("Y-m-d", strtotime("-1 day"));
        $hasil = $this->db->query("SELECT * FROM tb_member 
        JOIN tb_rental ON tb_member.kode=tb_rental.kode_member 
        JOIN tb_channel ON tb_channel.id_channel=tb_rental.idchannel  
        WHERE total !='0' AND tgl_laporan >='$tgl' order by id_member DESC ");
        return $hasil;
    }


    public function cek_member($kode)
    {
        $hasil = $this->db->query("SELECT * FROM tb_member 
        JOIN tb_rental ON tb_member.kode=tb_rental.kode_member 
        JOIN tb_channel ON tb_channel.id_channel=tb_rental.idchannel  
        JOIN tb_ps ON tb_ps.id_ps=tb_channel.idps  
        JOIN tb_user ON tb_user.id_user=tb_member.iduser  
        WHERE kode ='$kode' order by id_member DESC ");
        return $hasil;
    }


    public function cek_shift($id)
    {
        $this->db->select('*');
        $this->db->from('tb_shift');
        $this->db->where('id_shift', $id);
        $query = $this->db->get();
        return $query;
    }

    public function cek_laporan($kode)
    {
        $this->db->select('*');
        $this->db->from('tb_laporan');
        $this->db->where('kode', $kode);
        $query = $this->db->get();
        return $query;
    }

    function cek_laporan_penjualan($kode)
    {
        $this->db->select('*');
        $this->db->from('tb_penjualan');
        $this->db->where('kode_pembayaran', $kode);
        $query = $this->db->get();
        return $query;
    }


    // function laporan_jml_penjualan($tgl1, $tgl2)
    // {
    //     $this->db->select('*');
    //     $this->db->from('tb_penjualan');
    //     $this->db->where("tgl_penjualan >='$tgl1'");
    //     $this->db->where("tgl_penjualan <='$tgl2'");
    //     $query = $this->db->get();
    //     return $query;
    // }
}
