<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_memberaktif extends CI_Model
{

    public function kode()
    {
        $this->db->select('RIGHT(tb_member_aktif.askode,3) as invoice', FALSE);
        $this->db->order_by('invoice', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_member_aktif');  //cek dulu apakah ada sudah ada invoice di tabel.    
        if ($query->num_rows() <> 0) {
            //cek invoice jika telah tersedia    
            $data = $query->row();
            $invoice = intval($data->invoice) + 1;
        } else {
            $invoice = 1;  //cek jika invoice belum terdapat pada table
        }
        // $tgl = date('dmY');
        $batas = str_pad($invoice, 3, "0", STR_PAD_LEFT);
        $kodetampil =  $batas;  //format kode
        return $kodetampil;
    }

    function live_member()
    {
        $this->db->select('*');
        $this->db->from('tb_member_aktif');
        $this->db->order_by('id_member_aktif', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    function cekdatanik($nik)
    {
        $this->db->select('*');
        $this->db->from('tb_member_aktif');
        $this->db->where('nik', $nik);
        $query = $this->db->get();
        return $query;
    }

    function cekkodemember($id)
    {
        $this->db->select('*');
        $this->db->from('tb_member_aktif');
        $this->db->where('kode_maktif', $id);
        $query = $this->db->get();
        return $query;
    }


    public function carimember($kata)
    {
        $this->db->select('*');
        $this->db->from('tb_member_aktif');
        $this->db->like('nama_maktif', $kata);
        $this->db->or_like('hp', $kata);
        $this->db->or_like('alamat', $kata);
        $this->db->order_by('id_member_aktif', 'ASC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query;
    }


    // data sewa
    public function kodesewa()
    {
        $this->db->select('RIGHT(tb_sewaps.kode_sewa,4) as invoice', FALSE);
        $this->db->order_by('invoice', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_sewaps');  //cek dulu apakah ada sudah ada invoice di tabel.    
        if ($query->num_rows() <> 0) {
            //cek invoice jika telah tersedia    
            $data = $query->row();
            $invoice = intval($data->invoice) + 1;
        } else {
            $invoice = 1;  //cek jika invoice belum terdapat pada table
        }
        // $tgl = date('dmY');
        $batas = str_pad($invoice, 4, "0", STR_PAD_LEFT);
        $kodetampil =  "S" . $batas;  //format kode

        return $kodetampil;
    }

    function cek_kode_sewaps($kode)
    {
        $this->db->select('*');
        $this->db->from('tb_sewaps');
        $this->db->join('tb_user', 'tb_user.id_user=tb_sewaps.iduser');
        $this->db->join('tb_member_aktif', 'tb_member_aktif.kode_maktif=tb_sewaps.idmember');
        $this->db->join('tb_ps', 'tb_ps.id_ps=tb_sewaps.idps');
        // $this->db->join('tb_laporan', 'tb_laporan.kode=tb_sewaps.kode_sewa');
        $this->db->where('kode_sewa', $kode);
        $query = $this->db->get();
        return $query;
    }

    function live_sewa()
    {
        $this->db->select('*');
        $this->db->from('tb_sewaps');
        $this->db->join('tb_user', 'tb_user.id_user=tb_sewaps.iduser');
        $this->db->join('tb_member_aktif', 'tb_member_aktif.kode_maktif=tb_sewaps.idmember');
        $this->db->join('tb_ps', 'tb_ps.id_ps=tb_sewaps.idps');
        $this->db->where("sts_sewa='A'");
        $this->db->order_by('id_sewaps ', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    // data tambah sewa
    public function kodetambahsewa()
    {
        $this->db->select('RIGHT(tb_sewatambah.kode_tambah,4) as invoice', FALSE);
        $this->db->order_by('invoice', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_sewatambah');  //cek dulu apakah ada sudah ada invoice di tabel.    
        if ($query->num_rows() <> 0) {
            //cek invoice jika telah tersedia    
            $data = $query->row();
            $invoice = intval($data->invoice) + 1;
        } else {
            $invoice = 1;  //cek jika invoice belum terdapat pada table
        }
        // $tgl = date('dmY');
        $batas = str_pad($invoice, 4, "0", STR_PAD_LEFT);
        $kodetampil =  "TS" . $batas;  //format kode

        return $kodetampil;
    }



    // public function ceksewaps($kode)
    // {
    //     $this->db->select('*');
    //     $this->db->from('tb_sewaps');
    //     $this->db->where('kodememberaktif', $kode);
    //     $query = $this->db->get();
    //     return $query;
    // }

    public function cekkodekembali($kode)
    {
        $this->db->select('*');
        $this->db->from('tb_sewakembali');
        $this->db->where('kodesewa', $kode);
        $query = $this->db->get();
        return $query;
    }

    public function cekkodetambah($kode)
    {
        $this->db->select('*');
        $this->db->from('tb_sewatambah');
        $this->db->where('kodesewa', $kode);
        $query = $this->db->get();
        return $query;
    }


    // data tambah sewa
    public function kodesewakembali()
    {
        $this->db->select('RIGHT(tb_sewakembali.kode_sk,4) as invoice', FALSE);
        $this->db->order_by('invoice', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_sewakembali');  //cek dulu apakah ada sudah ada invoice di tabel.    
        if ($query->num_rows() <> 0) {
            //cek invoice jika telah tersedia    
            $data = $query->row();
            $invoice = intval($data->invoice) + 1;
        } else {
            $invoice = 1;  //cek jika invoice belum terdapat pada table
        }
        // $tgl = date('dmY');
        $batas = str_pad($invoice, 4, "0", STR_PAD_LEFT);
        $kodetampil =  "SK" . $batas;  //format kode

        return $kodetampil;
    }

    public function live_pskembali()
    {
        // menampilkan data dari 15 hari sebelumnya sampai hari ini.
        $tgl = date("Y-m-d", strtotime("-15 day"));
        $this->db->select('*');
        $this->db->from('tb_sewakembali');
        $this->db->join('tb_sewaps', 'tb_sewaps.kode_sewa=tb_sewakembali.kodesewa');
        $this->db->join('tb_user', 'tb_user.id_user=tb_sewaps.iduser');
        $this->db->join('tb_member_aktif', 'tb_member_aktif.kode_maktif=tb_sewaps.idmember');
        $this->db->join('tb_ps', 'tb_ps.id_ps=tb_sewaps.idps');
        $this->db->where("tgl_sk >='$tgl'");
        $query = $this->db->get();
        return $query;
    }
}
