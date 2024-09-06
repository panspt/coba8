<style>
    @import url('https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap');

    /* body {
        margin: 0;
        width: 48mm;
        text-align: center;
    } */

    /* *,
    *::after,
    *::before {
        box-sizing: border-box;
    } */
    .head-struk {
        font-family: "Barlow Condensed", sans-serif;
        text-align: center;
        align-items: center;
        justify-content: center;
        /* font-size: 16pt; */
    }

    img {
        /* display: block; */
        height: auto;
        width: 20mm;
    }

    .pemilik {
        display: block;
        font-size: 16pt;
        font-weight: 700;
        margin-bottom: -3px;
        font-family: "Barlow Condensed", sans-serif;
    }

    .alamat {
        /* margin-top: -30px; */
        font-size: 12pt;
        font-weight: 400;
        margin-bottom: -5px;
        margin-top: -5px;
        font-family: "Barlow Condensed", sans-serif;
    }

    .info {
        font-size: 12pt;
        font-weight: 400;
        text-align: center;
        margin-top: 20px;
        line-height: 18px;
        font-family: "Barlow Condensed", sans-serif;
    }

    table.tabb {
        width: 100%;
        font-size: 12pt;
        font-family: "Barlow Condensed", sans-serif;
        line-height: 13pt;
    }

    .tabb tr td {
        /* border: 1px solid; */
        font-family: "Barlow Condensed", sans-serif;
        font-size: 12pt;
        line-height: 13pt;
    }

    .garis {
        margin-bottom: -5px;
        margin-top: -5px;

    }

    .page {
        padding-bottom: 5mm;
    }

    /*
 * Screen
 */
    @media screen {

        html {
            background-color: Gainsboro;
        }

        /* body {
            background-color: white;
            box-shadow: 2px 2px 0px 1px #000, 0px 0px 0px 1px #000;
            margin: 3em;
            width: 57mm;
            padding: 5mm 4.5mm 1pt 4.5mm;
            position: relative;
        } */

        /* body::before {
            content: "";
            position: absolute;
            z-index: 1;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            border-top: 5mm solid white;
            border-right: 4.5mm solid white;
            border-left: 4.5mm solid white;
            pointer-events: none;
        } */

    }

    /*
 * Print
 */
    @media print {

        @page {
            margin: 0;
        }

        html,
        body {
            background-color: transparent;
            margin: 0;
            width: 60mm;
            padding: auto;
            /* padding: 5mm 5mm 5mm 5mm; */
            text-transform: uppercase;
            position: relative;
            text-align: center;
            font-size: 12pt;
        }

        /* body {
            padding: 1pt 0pt;
        } */

        /* .page::before {
            content: "--";
            font-size: 6pt;
            line-height: 1pt;
            display: block;
            text-align: left;
            position: absolute;
            top: 0;
            left: 0;
        }

        body::after {
            display: block;
            content: "--";
            font-size: 6pt;
            line-height: 1pt;
            text-align: left;
        } */

    }
</style>
<div class="page">
    <?php date_default_timezone_set('Asia/Jakarta'); ?>
    <div class="head-struk">
        <img src="<?= base_url('assets/img/aime.png'); ?>" alt="">
        <?php
        $s1 = $this->db->query("SELECT * FROM tb_setting WHERE id_setting='1' ")->row();
        $s2 = $this->db->query("SELECT * FROM tb_setting WHERE id_setting='2' ")->row();
        $s3 = $this->db->query("SELECT * FROM tb_setting WHERE id_setting='3' ")->row();
        $s4 = $this->db->query("SELECT * FROM tb_setting WHERE id_setting='4' ")->row();
        $s5 = $this->db->query("SELECT * FROM tb_setting WHERE id_setting='5' ")->row();
        $s6 = $this->db->query("SELECT * FROM tb_setting WHERE id_setting='6' ")->row();
        ?>
        <div class="pemilik"><?= $s1->isi; ?></div>
        <div class="alamat"><?= $s2->isi; ?></div>
        <span class="info"><?= $s3->isi; ?></span>
    </div>
    <div class="info"><?= $s4->isi; ?> </div>
    <div class="">------------------------------------------</div>
    <?php
    $tambah = $this->db->query("SELECT * FROM tb_sewakembali JOIN tb_user ON tb_user.id_user=tb_sewakembali.iduser WHERE kodesewa='$m->kode_sewa' ");
    $a = $tambah->row();
    $cek = $tambah->num_rows();

    ?>
    <table class="tabb">
        <tr>
            <td colspan="4" style="text-align: center;">STRUK PS DIKEMBALIKAN</td>
        </tr>
        <tr>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td width="24%">kode </td>
            <td width="2%">:</td>
            <td width="40%"><?= $a->kode_sk; ?></td>
            <td style="float: right;"><?= date('d.m.y', strtotime($a->tgl_sk)); ?></td>
        </tr>
        <tr>
            <td>petugas</td>
            <td>:</td>
            <td><?= $a->nama_user; ?></td>
            <td style="float: right;"><?= date('H.i', strtotime($a->tgl_sk)); ?></td>
        </tr>
    </table>
    <div class="garis">------------------------------------------</div>
    <table class="tabb">
        <tr>
            <td width="40%">ID</td>
            <td width="1%">:</td>
            <td><?= $m->kode_maktif; ?></td>
        </tr>
        <tr>
            <td>nama</td>
            <td>:</td>
            <td><?= $m->nama_maktif; ?> </td>
        </tr>
        <tr>
            <td>sewa ps</td>
            <td>:</td>
            <td><?= $m->jenis_ps; ?> </td>
        </tr>

        <tr>
            <td>SELAMA</td>
            <td>:</td>
            <td><?= $m->jml_hari; ?> Hari </td>
        </tr>
        <tr>
            <td colspan="3"></td>
        </tr>
        <tr style="vertical-align: top;">
            <td>batas waktu sewa</td>
            <td>:</td>
            <td>
                TGL.<span style="float: right;"><?= date('d.m.y', strtotime($m->sampai_tanggal)); ?></span> <br>
                JAM <span style="float: right;"><?= date('H.i', strtotime($m->sampai_tanggal)); ?></span>
            </td>
        </tr>
    </table>
    <div class="garis">------------------------------------------</div>
    <table class="tabb">
        <tr>
            <td width="40%"> TOTAL</td>
            <td style="text-transform: capitalize; width: 1%;">:</td>
            <td style=" text-transform: capitalize;">Rp. <span style="float: right;"> <?= number_format($m->total, 0, ',', '.'); ?></span> </td>
        </tr>
        <tr>
            <td>TERBAYAR</td>
            <td style="text-transform: capitalize;">:</td>
            <td style=" text-transform: capitalize;">Rp. <span style="float: right;"> <?= number_format($m->dibayar - $a->sisa_pembayaran, 0, ',', '.'); ?></span> </td>
        </tr>
        <tr>
            <td>SISA</td>
            <td style="text-transform: capitalize;">:</td>
            <td style=" text-transform: capitalize;">Rp. <span style="float: right;"> <?= number_format($a->sisa_pembayaran, 0, ',', '.'); ?></span> </td>
        </tr>
    </table>
    <div class="garis">------------------------------------------</div>
    <table class="tabb">
        <tr>
            <td colspan="3" style="text-align: center;">DATA PELUNASAN</td>
        </tr>
        <tr>
            <td width="40%"> TOTAL SISA</td>
            <td style="text-transform: capitalize; width: 1%;">:</td>
            <td style=" text-transform: capitalize;">Rp. <span style="float: right;"> <?= number_format($a->sisa_pembayaran, 0, ',', '.'); ?></span> </td>
        </tr>
        <tr>
            <td>DIBAYAR</td>
            <td style="text-transform: capitalize;">:</td>
            <td style=" text-transform: capitalize;">Rp. <span style="float: right;"> <?= number_format($a->dibayar, 0, ',', '.'); ?></span> </td>
        </tr>
        <tr>
            <td>kembali</td>
            <td style="text-transform: capitalize;">:</td>
            <td style=" text-transform: capitalize;">Rp. <span style="float: right;"> <?= number_format($a->dibayar - $a->sisa_pembayaran, 0, ',', '.'); ?></span> </td>
        </tr>
        <tr>
            <td colspan="3"><br><br></td>
        </tr>
        <tr>
            <td colspan="3" style="font-size: 12pt; text-align: center;"><?= $s6->isi; ?></td>
        </tr>
    </table>
</div>