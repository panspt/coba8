<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pengeluaran extends CI_Model
{
    public function live_tgl()
    {
        date_default_timezone_set('Asia/Jakarta');
        $y = date('Y');
        $m = date('m');
        $hasil = $this->db->query("SELECT * FROM tb_pengeluaran WHERE MONTH(tgl_pengeluaran) ='$m' AND YEAR(tgl_pengeluaran) ='$y' ");
        return $hasil;
    }

    public function live_ttl()
    {
        date_default_timezone_set('Asia/Jakarta');
        $b = date('m');
        $t = date('Y');
        $hasil = $this->db->query("SELECT SUM(total) as ttl, tgl_pengeluaran FROM tb_pengeluaran WHERE MONTH(tgl_pengeluaran) ='$b' AND YEAR(tgl_pengeluaran) ='$t' ");
        $cek = $hasil->num_rows();
        if ($cek > 0) {
            $ada = $hasil->row();
        } else {
            $ada = array(
                'ttl' => 0,
            );
        }
        return $ada;
    }
}
