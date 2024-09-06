<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard extends CI_Model
{
    // laporan rental per kode
    public function laporan_rental($tgl1, $tgl2)
    {
        $this->db->select('*');
        $this->db->from('tb_member');
        $this->db->join('tb_user', 'tb_user.id_user=tb_member.iduser');
        $this->db->join('tb_rental', 'tb_rental.kode_member=tb_member.kode');
        $this->db->join('tb_channel', 'tb_channel.id_channel=tb_rental.idchannel');
        $this->db->join('tb_ps', 'tb_ps.id_ps=tb_channel.idps');
        $this->db->where(" date_format(tgl_pembayaran,'%Y-%m-%d') >='$tgl1'");
        $this->db->where(" date_format(tgl_pembayaran,'%Y-%m-%d') <='$tgl2'");
        // $this->db->where("tb_rental.aktif='Y'");
        $query = $this->db->get();
        return $query;
    }

    public function jml_ttl_rental($tgl1, $tgl2)
    {
        $this->db->select('SUM(total) as ttl, SUM(IF(dibayar >= total, total, dibayar)) as dby');
        $this->db->from('tb_member');
        $this->db->where("tgl_laporan >='$tgl1'");
        $this->db->where("tgl_laporan <='$tgl2'");
        $query = $this->db->get();
        return $query;
    }

    // laporan rental per tanggal
    public function laporan_rental_pertgl($tgl1, $tgl2)
    {
        $this->db->select('tgl_pembayaran,COUNT(id_member) as jml, SUM(total) as ttl ,SUM(IF(dibayar >= total,total,dibayar)) as dby');
        $this->db->from('tb_member');
        $this->db->where(" date_format(tgl_pembayaran,'%Y-%m-%d') >='$tgl1'");
        $this->db->where(" date_format(tgl_pembayaran,'%Y-%m-%d') <='$tgl2'");
        $this->db->group_by("date_format(tgl_pembayaran,'%Y-%m-%d')");
        $query = $this->db->get();
        return $query;
    }

    public function laporan_sewa($tgl1, $tgl2)
    {
        $this->db->select('*');
        $this->db->from('tb_sewaps');
        $this->db->join('tb_member_aktif', 'tb_member_aktif.kode_maktif=tb_sewaps.idmember');
        $this->db->join('tb_user', 'tb_user.id_user=tb_sewaps.iduser');
        $this->db->join('tb_ps', 'tb_ps.id_ps=tb_sewaps.idps');
        $this->db->where(" date_format(dari_tanggal,'%Y-%m-%d') >='$tgl1'");
        $this->db->where(" date_format(dari_tanggal,'%Y-%m-%d') <='$tgl2'");
        // $this->db->order_by('id_sewaps', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function laporan_sewa_lunas($tgl1, $tgl2)
    {
        $this->db->select('*');
        $this->db->from('tb_sewaps');
        $this->db->join('tb_member_aktif', 'tb_member_aktif.kode_maktif=tb_sewaps.idmember');
        $this->db->join('tb_user', 'tb_user.id_user=tb_sewaps.iduser');
        $this->db->join('tb_ps', 'tb_ps.id_ps=tb_sewaps.idps');
        $this->db->where(" date_format(dari_tanggal,'%Y-%m-%d') >='$tgl1'");
        $this->db->where(" date_format(dari_tanggal,'%Y-%m-%d') <='$tgl2'");
        $this->db->where("total = dibayar");
        // $this->db->order_by('id_sewaps', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function laporan_sewa_belumlunas($tgl1, $tgl2)
    {
        $this->db->select('*');
        $this->db->from('tb_sewaps');
        $this->db->join('tb_member_aktif', 'tb_member_aktif.kode_maktif=tb_sewaps.idmember');
        $this->db->join('tb_user', 'tb_user.id_user=tb_sewaps.iduser');
        $this->db->join('tb_ps', 'tb_ps.id_ps=tb_sewaps.idps');
        $this->db->where(" date_format(dari_tanggal,'%Y-%m-%d') >='$tgl1'");
        $this->db->where(" date_format(dari_tanggal,'%Y-%m-%d') <='$tgl2'");
        $this->db->where("total > dibayar");
        // $this->db->order_by('id_sewaps', 'DESC');
        $query = $this->db->get();
        return $query;
    }


    public function laporan_penjualan($tgl1, $tgl2)
    {
        $this->db->select('*');
        $this->db->from('tb_penjualan');
        $this->db->join('tb_user', 'tb_user.id_user=tb_penjualan.iduser');
        $this->db->where(" date_format(tgl_penjualan,'%Y-%m-%d') >='$tgl1'");
        $this->db->where(" date_format(tgl_penjualan,'%Y-%m-%d') <='$tgl2'");
        $query = $this->db->get();
        return $query;
    }

    public function laporan_pengeluaran($tgl1, $tgl2)
    {
        $this->db->select('*');
        $this->db->from('tb_pengeluaran');
        $this->db->where(" tgl_pengeluaran >='$tgl1'");
        $this->db->where(" tgl_pengeluaran <='$tgl2'");
        $query = $this->db->get();
        return $query;
    }

    public function laporan_keuangan_rental($tgl1, $tgl2)
    {
        $this->db->select('SUM(jumlah) as jml,tb_laporan.kode,tgl,tb_member.kode');
        $this->db->from('tb_laporan');
        $this->db->join('tb_member', 'tb_member.kode=tb_laporan.kode');
        $this->db->where(" tgl >='$tgl1'");
        $this->db->where(" tgl <='$tgl2'");
        $this->db->group_by("tgl");
        $query = $this->db->get();
        return $query;
    }

    public function laporan_keuangan_sewa($tgl1, $tgl2)
    {
        $this->db->select('SUM(jumlah) as jml, tgl, kode, kode_sewa');
        $this->db->from('tb_laporan');
        $this->db->join('tb_sewaps', 'tb_sewaps.kode_sewa=tb_laporan.kode');
        $this->db->where(" tgl >='$tgl1'");
        $this->db->where(" tgl <='$tgl2'");
        $this->db->group_by("tgl");
        $query = $this->db->get();
        return $query;
    }

    public function laporan_keuangan_penjualan($tgl1, $tgl2)
    {
        $this->db->select('SUM(jumlah) as jml, tgl, kode, kode_penjualan');
        $this->db->from('tb_laporan');
        $this->db->join('tb_penjualan', 'tb_penjualan.kode_penjualan=tb_laporan.kode');
        $this->db->where(" tgl >='$tgl1'");
        $this->db->where(" tgl <='$tgl2'");
        $this->db->group_by("tgl");
        $query = $this->db->get();
        return $query;
    }

    public function laporan_keuangan_pengeluaran($tgl1, $tgl2)
    {
        $this->db->select('SUM(total) as jml, tgl_pengeluaran');
        $this->db->from('tb_pengeluaran');
        $this->db->where(" tgl_pengeluaran >='$tgl1'");
        $this->db->where(" tgl_pengeluaran <='$tgl2'");
        $this->db->group_by("tgl_pengeluaran");
        $query = $this->db->get();
        return $query;
    }

    // data dashboard
    public function live_dashboard($tahun, $bulan)
    {
        date_default_timezone_set('Asia/Jakarta');
        // cek jumlah transaksi
        $queryr = $this->db->query("SELECT COUNT(id_member) as jml FROM tb_member WHERE YEAR(tgl_laporan)='$tahun'  GROUP BY YEAR(tgl_laporan) ")->row();
        $dtr = (empty($queryr->jml) ? 0 : $queryr->jml);
        $querys = $this->db->query("SELECT COUNT(id_sewaps) as jml FROM tb_sewaps WHERE YEAR(dari_tanggal)='$tahun'  GROUP BY YEAR(dari_tanggal) ")->row();
        $dts = (empty($querys->jml) ? 0 : $querys->jml);
        $queryp = $this->db->query("SELECT COUNT(id_penjualan) as jml FROM tb_penjualan WHERE YEAR(tgl_laporan)='$tahun'  GROUP BY YEAR(tgl_laporan) ")->row();
        $dtp = (empty($queryp->jml) ? 0 : $queryp->jml);


        // cek omset
        $queryo = $this->db->query("SELECT SUM(jumlah) as jml FROM tb_laporan WHERE YEAR(tgl)='$tahun'  GROUP BY YEAR(tgl) ")->row();
        $dto = (empty($queryo->jml) ? 0 : $queryo->jml);

        // pengeluaran
        $queryg = $this->db->query("SELECT SUM(total) as jml FROM tb_pengeluaran WHERE YEAR(tgl_pengeluaran)='$tahun'  GROUP BY YEAR(tgl_pengeluaran) ")->row();
        $dtg = (empty($queryg->jml) ? 0 : $queryg->jml);

        $cek_bulan = array();
        $omset_per_bln = array();
        $penge_per_bln = array();
        $i = 1;
        while ($i <=  $bulan) {
            $cek_bulan[] = format_bulan($tahun . '-' . $i);

            // omset perbulan
            $omset = $this->db->query("SELECT SUM(jumlah) as jml FROM tb_laporan WHERE YEAR(tgl)='$tahun'  AND MONTH(tgl)='$i'  GROUP BY MONTH(tgl) ")->row();
            $omset_per_bln[] = (empty($omset->jml) ? 0 : $omset->jml);

            // pengeluaran perbulan
            $pengeluaran = $this->db->query("SELECT SUM(total) as jml FROM tb_pengeluaran WHERE YEAR(tgl_pengeluaran)='$tahun'  AND MONTH(tgl_pengeluaran)='$i'  GROUP BY MONTH(tgl_pengeluaran) ")->row();
            $penge_per_bln[] = (empty($pengeluaran->jml) ? 0 : $pengeluaran->jml);


            $i++;
        }

        $pend = format_array($bulan, $omset_per_bln, $penge_per_bln);


        $data = [
            'jmltrans' => number_format($dtr + $dts + $dtp),
            'ttlost' => "Rp " . number_format($dto),
            'ttlpgl' => "Rp " . number_format($dtg),
            'ttlpdt' => "Rp " . number_format($dto - $dtg),

            'bln' =>  $cek_bulan,
            'omset' =>  $omset_per_bln,
            'pengeluaran' =>  $penge_per_bln,
            'pendapatan' =>  $pend,


            'transaksi' =>  [$dtr, $dts,  $dtp],
        ];
        return $data;
    }


    public function rental_terakhir()
    {
        $this->db->select('*');
        $this->db->from('tb_member');
        $this->db->join('tb_user', 'tb_user.id_user=tb_member.iduser');
        $this->db->join('tb_rental', 'tb_rental.kode_member=tb_member.kode');
        $this->db->join('tb_channel', 'tb_channel.id_channel=tb_rental.idchannel');
        $this->db->join('tb_ps', 'tb_ps.id_ps=tb_channel.idps');
        $this->db->where("tb_rental.aktif='N'");
        $this->db->order_by("tgl_pembayaran", 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query;
    }


    public function sewa_terakhir()
    {
        $this->db->select('*');
        $this->db->from('tb_sewaps');
        $this->db->join('tb_sewakembali', 'tb_sewakembali.kodesewa=tb_sewaps.kode_sewa');
        $this->db->join('tb_member_aktif', 'tb_member_aktif.kode_maktif=tb_sewaps.idmember');
        $this->db->join('tb_user', 'tb_user.id_user=tb_sewaps.iduser');
        $this->db->join('tb_ps', 'tb_ps.id_ps=tb_sewaps.idps');
        $this->db->where("sts_sewa='K'");
        $this->db->order_by("tb_sewakembali.tgl_sk", 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query;
    }

    public function penjualan_terakhir()
    {
        $this->db->select('*');
        $this->db->from('tb_penjualan');
        $this->db->join('tb_user', 'tb_user.id_user=tb_penjualan.iduser');
        $this->db->where("sts_bayar='L'");
        $this->db->order_by("id_penjualan", 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query;
    }
}
