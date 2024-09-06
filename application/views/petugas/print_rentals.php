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
        line-height: 10pt;
    }

    .tabb tr td {
        /* border: 1px solid; */
        font-family: "Barlow Condensed", sans-serif;
        font-size: 12pt;
        line-height: 10pt;
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
    <table class="tabb">
        <tr>
            <td width="24%">kode </td>
            <td width="2%">:</td>
            <td width="40%"><?= $m->kode; ?></td>
            <td style="float: right;"><?= date('d.m.y', strtotime($m->tgl_pembayaran)); ?></td>
        </tr>
        <tr>
            <td>petugas</td>
            <td>:</td>
            <td><?= $m->nama_user; ?></td>
            <td style="float: right;"><?= date('H.i', strtotime($m->tgl_pembayaran)); ?></td>
        </tr>
    </table>
    <div class="garis">------------------------------------------</div>
    <table class="tabb">
        <tr>
            <td width="24%">A.N</td>
            <td width="4%">:</td>
            <td width="22%" colspan="2"><?= $m->nama; ?></td>

        </tr>
        <tr>
            <td>rental</td>
            <td>:</td>
            <td><?= $m->nama_channel; ?></td>
            <td style="float: right;"><?= $m->jenis_ps; ?></td>
        </tr>
        <tr>
            <td>SELAMA</td>
            <td>:</td>
            <td><?= $m->lama_rental; ?></td>
            <td style="float: right; text-transform: capitalize;"> <?= number_format($m->total, 0, ',', '.'); ?></td>
        </tr>

    </table>
    <?php
    $paket = $this->db->query("SELECT * FROM tb_penjualan 
    JOIN tb_keranjang ON tb_keranjang.kodepenjualan=tb_penjualan.kode_penjualan
    JOIN tb_barang ON tb_barang.kode_barang=tb_keranjang.kodebarang
     WHERE kode_pembayaran='$m->kode'");
    $pk = $paket->num_rows();
    $ada = $paket->result();
    if (!empty($pk)) {
    ?>
        <div class="garis">------------------------------------------</div>
        <table class="tabb">
            <?php foreach ($ada as $b) {; ?>
                <tr>
                    <td><?= $b->nama_barang; ?></td>
                    <td style="text-transform: lowercase;">x <?= $b->jml; ?></td>
                    <td>:</td>
                    <td style="float: right; text-transform: capitalize;"> <?= number_format($b->harga, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>JML</td>
                    <td>:</td>
                    <td style="float: right; text-transform: capitalize;"> <?= number_format($b->jml * $b->harga, 0, ',', '.'); ?></td>
                </tr>

            <?php }; ?>
        </table>
    <?php } else {
    }; ?>
    <div class="garis">------------------------------------------</div>

    <?php
    $penjualan = $this->db->query("SELECT SUM(jml_total) as total FROM tb_penjualan WHERE kode_pembayaran='$m->kode'");
    $pen = $penjualan->row();
    $ttlpen = (empty($pen->total)) ? 0 : $pen->total;
    $jum = $ttlpen + $m->total;
    ?>
    <table class="tabb">
        <tr>
            <td>TOTAL</td>
            <td style="text-transform: capitalize;">: Rp</td>
            <td style="float: right; text-transform: capitalize;"> <?= number_format($jum, 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td>DIBAYAR</td>
            <td style="text-transform: capitalize;">: Rp</td>
            <td style="float: right; text-transform: capitalize;"> <?= number_format($m->dibayar, 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td> <?= (($m->dibayar >= $jum) ? 'KEMBALI' : 'SISA'); ?></td>
            <td style="text-transform: capitalize;">: Rp</td>
            <td style="float: right; text-transform: capitalize;"> <?= number_format($m->dibayar - $jum, 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td colspan="3"><br></td>
        </tr>

        <tr>
            <td colspan="3" style="font-size: 12pt; text-align: center;"><?= $s6->isi; ?></td>
        </tr>
    </table>
</div>