<style>
    .page {
        color: black !important;
    }

    .page h1 {
        text-align: center;
    }

    .page .head {
        text-align: center;
        font-size: 25px;
        font-weight: 800;
        border-bottom: 3px solid black;
        color: black;
    }

    .page img {
        position: absolute;
        margin-left: 20px;
        margin-top: -10px;
    }

    .page table {
        width: 100%;
        color: black;
        margin-top: 20px;
    }

    table.tabl {
        font-size: 15px;
        border-collapse: collapse;
    }

    .tabl tr th {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
        background-color: #ED3237;
        color: white;
        font-weight: 800;
    }

    .tabl tr td {
        border: 1px solid black;
        padding: 5px;
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
            size: A4;
            /* height: 14.5cm; */
            padding: 20px;
            /* padding: 5mm 5mm 5mm 5mm; */
            /* text-transform: uppercase; */
            position: relative;
            /* text-align: center; */
            font-size: 12pt;
        }

        table.tabl {
            font-size: 12px;
            border-collapse: collapse;
        }
    }
</style>
<div class="page ">
    <?php if ($result->num_rows() > 0) {; ?>
        <img src="<?= base_url('assets/img/aime.png'); ?>" alt="" style="width: 90px;">
        <div class="head">
            LAPORAN PENJUALAN<br>
            DARI TANGGAL <?= date('d/m/Y', strtotime($tgl1)); ?> SAMPAI TANGGAL <?= date('d/m/Y', strtotime($tgl2)); ?>
        </div>
        <table class="tabl">
            <tr>
                <th width="3%">NO</th>
                <th>TANGGAL</th>
                <th>PETUGAS</th>
                <th>KODE </th>
                <th>JML. ITEM</th>
                <th width="12%">TOTAL</th>
                <th width="12%">DIBAYAR</th>
                <th width="12%">SISA</th>
            </tr>
            <?php $no = 1; ?>
            <?php foreach ($result->result() as $t) {
                $jml = $this->db->query("SELECT SUM(jml) as j FROM  tb_keranjang WHERE kodepenjualan='$t->kode_penjualan' ")->row();

                if ($t->dibayar >= $t->jml_total) {
                    $stdby = $t->jml_total;
                } else {
                    $stdby = $t->dibayar;
                }

                if ($t->sts_bayar == 'M') {
                    $dbyr = 0;
                    $sts = $t->jml_total;
                } else {
                    $dbyr = $stdby;
                    $sts = 0;
                }

                $ttl[] = $t->jml_total;
                $dby[] = $dbyr;
                $sisa[] = $t->jml_total - $dbyr;
            ?>
                <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td class="text-center"><?= date('d/m/Y', strtotime($t->tgl_penjualan)); ?></td>
                    <td style="text-transform: capitalize;"><?= $t->nama_user; ?></td>
                    <td class="text-center"><?= $t->kode_penjualan; ?></td>
                    <td class="text-center"><?= $jml->j; ?> Item</td>
                    <td>Rp <span style="float:right;"><?= number_format($t->jml_total); ?>,-</span></td>
                    <td>Rp <span style="float:right;"><?= number_format($dbyr); ?>,-</span></td>
                    <td>Rp <span style="float:right;"><?= number_format($t->jml_total - $dbyr); ?>,-</span></td>

                </tr>
            <?php }; ?>
            <tr>
                <td colspan="4" style="border: 0px;">
                    <!-- <p style="font-size: 10px;">*) Laporan ini tidak termasuk data yang masih berjalan atau proses rental masih berlangsung</p> -->
                </td>
                <td class="text-center"><b>TOTAL</b></td>
                <td style="font-size: 18px;"><b>Rp <span style="float:right;"><?= number_format(array_sum($ttl)); ?>,-</span></b></td>
                <td style="font-size: 18px;"><b>Rp <span style="float:right;"><?= number_format(array_sum($dby)); ?>,-</span></b></td>
                <td style="font-size: 18px;"><b>Rp <span style="float:right;"><?= number_format(array_sum($sisa)); ?>,-</span></b></td>
            </tr>
        </table>
    <?php } else {; ?>
        <h1 style="color: black;">DATA TIDAK DITEMUKAN, SILAHKAN CARI DATA LAIN</h1>
    <?php }; ?>
</div>