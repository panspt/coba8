<style>
    .page {
        /* width: 21cm; */
        /* height: 14.3cm; */
        /* border: 1px solid; */
        padding: 20px;
        /* text-align: center; */
        font-size: 12pt;
    }

    h3 {
        color: black;
        line-height: 20px;
        vertical-align: top;
    }

    h6 {
        color: black;
        line-height: 15px;
        vertical-align: top;
        text-align: center;
    }

    @media screen {

        html {
            background-color: Gainsboro;
        }



    }



    @media print {

        @page {
            margin: 20px;
            font-size: 9pt;
        }

        html,
        body {
            background-color: transparent;
            margin: 0;
            width: 21cm;
            height: 14.5cm;
            padding: auto;
            /* padding: 5mm 5mm 5mm 5mm; */
            /* text-transform: uppercase; */
            position: relative;
            text-align: center;
            font-size: 12pt;
        }



        h3 {
            color: black;
            line-height: 20px;
            vertical-align: top;
        }

        h6 {
            color: black;
            line-height: 15px;
            vertical-align: top;
            text-align: center;
        }

        hr {
            line-height: 5px;
        }

        table {
            font-size: 10pt !important;
        }

        p.bw {
            font-size: 9pt !important;
        }

    }
</style>
<?php if (!empty($m->id_shift)) {; ?>
    <?php
    $s1 = $this->db->query("SELECT * FROM tb_setting WHERE id_setting='1' ")->row();
    $s2 = $this->db->query("SELECT * FROM tb_setting WHERE id_setting='2' ")->row();
    $s3 = $this->db->query("SELECT * FROM tb_setting WHERE id_setting='3' ")->row();
    $s4 = $this->db->query("SELECT * FROM tb_setting WHERE id_setting='4' ")->row();
    $s5 = $this->db->query("SELECT * FROM tb_setting WHERE id_setting='5' ")->row();
    $s6 = $this->db->query("SELECT * FROM tb_setting WHERE id_setting='6' ")->row();
    ?>
    <div class="page">
        <div class="lap-head">
            <table style="width: 100%; padding: 0px;  color: black;">
                <tr>
                    <td style="width: 20%; text-align: center;">
                        <img src="<?= base_url('assets/img/aime.png'); ?>" alt="" style="width: 90px;">
                    </td>
                    <td style="text-align: left;">
                        <h3><?= $s1->isi; ?></h3>
                        <p><?= $s2->isi; ?> <?= $s3->isi; ?></p>
                    </td>
                </tr>
            </table>
            <hr style="border: 1px solid black; opacity: 100;">
            <h6>INVOICE REKAP PERGANTIAN SHIFT</h6>
            <hr style="border: 1px solid black; opacity: 100;">
            <table style="width: 100%;   color: black; font-size: 12pt;">
                <?php
                date_default_timezone_set('Asia/Jakarta');

                if ($m->jns_shift == 1) {
                    $tgl1 = date('Y-m-d') . ' ' . $m->dari_jam;
                    $tgl2 = date('Y-m-d') . ' ' . $m->sampai_jam;
                } else {
                    $tgl1 = date("Y-m-d", strtotime("-1 day")) . ' ' . $m->dari_jam;
                    $tgl2 = date('Y-m-d') . ' ' . $m->sampai_jam;
                }

                // echo $tgl1;
                // jml penjualan
                $tran_penjualan = $this->db->query("SELECT * FROM tb_penjualan WHERE date_format(tgl_penjualan,'%Y-%m-%d %H:%i:%s') >= '$tgl1' 
                AND date_format(tgl_penjualan,'%Y-%m-%d %H:%i:%s') <='$tgl2' ")->num_rows();

                // jml rental
                $tran_rental = $this->db->query("SELECT * FROM tb_rental WHERE date_format(start,'%Y-%m-%d %H:%i:%s') >= '$tgl1'
                AND date_format(start,'%Y-%m-%d %H:%i:%s') <='$tgl2' ")->num_rows();

                // jml sewa
                $tran_sewa = $this->db->query("SELECT * FROM tb_sewaps WHERE date_format(dari_tanggal,'%Y-%m-%d %H:%i:%s') >= '$tgl1'
                AND date_format(dari_tanggal,'%Y-%m-%d %H:%i:%s') <='$tgl2' ")->num_rows();

                $jp = $this->db->query("SELECT tgl_jam, SUM(jumlah) as jml FROM tb_laporan WHERE date_format(tgl_jam,'%Y-%m-%d %H:%i:%s') >= '$tgl1' 
                AND date_format(tgl_jam,'%Y-%m-%d %H:%i:%s') <= '$tgl2'  ")->row();

                ?>
                <tr>
                    <td style="width: 20%;">Petugas</td>
                    <td style="width: 2%;">:</td>
                    <td style="width: 40%;"><?= $log->nama_user ?></td>
                    <td style="width: 20%;">Jumlah Transaksi</td>
                    <td style="width: 2%;">:</td>
                    <td><span class="float-end"><?= $tran_penjualan + $tran_rental + $tran_sewa; ?></span></td>
                </tr>
                <tr>
                    <td>Jam Buka</td>
                    <td>:</td>
                    <td><?= date('H.i', strtotime($m->dari_jam)); ?></td>
                    <td>Jumlah Total</td>
                    <td>:</td>
                    <td>Rp <span class="float-end"><?= number_format((empty($jp->jml) ? 0 : $jp->jml)); ?></span></td>
                </tr>
                <tr>
                    <td>Jam Tutup</td>
                    <td>:</td>
                    <td><?= date('H.i', strtotime($m->sampai_jam)); ?></td>
                    <td>Uang di kasir</td>
                    <td>:</td>
                    <td>Rp </td>
                </tr>
                <tr>
                    <td>Diserahkan Kepada</td>
                    <td>:</td>
                    <td>Owner</td>
                    <td>Selisih</td>
                    <td>:</td>
                    <td>Rp </td>
                </tr>
                <tr>
                    <td colspan="6">Catatan : </td>
                </tr>
            </table>
            <div style="width: 100%;  border: 1px solid black;"><br><br><br><br></div>
            <hr style="border: 1px solid black; opacity: 100;">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 40%; font-size: 10pt; vertical-align: top;">
                        <p class="bw">*) Transaksi ini tidak termasuk dalam total transaksi <br> pendapat shift, hanya untuk informasi saja.</p>
                    </td>
                    <td style="text-align: center; vertical-align: top;">
                        <br>
                        Yang menyerahkan, <br>

                        <br>
                        <br>
                        <br>

                        <b><u> <?= $log->nama_user ?></u></b>
                    </td>
                    <td style="text-align: center; vertical-align: top;">
                        Ketapang, <?= format_indo(date('Y-m-d')); ?><br>
                        Yang menerima,
                        <br>
                        <br>
                        <br>
                        <br>
                        <b><u>OWNER</u></b>
                    </td>
                </tr>
            </table>

        </div>
    </div>
<?php } else {
    echo 'Data tidakditemukan....';
}; ?>