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
        margin-right: 20px;
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
            margin-right: 20px;
        }

        .tabl tr td {
            font-size: 10px;
        }
    }
</style>
<div class="page ">

    <img src="<?= base_url('assets/img/aime.png'); ?>" alt="" style="width: 90px;">
    <div class="head">
        LAPORAN KEUANGAN<br>
        DARI TANGGAL <?= date('d/m/Y', strtotime($tgl1)); ?> SAMPAI TANGGAL <?= date('d/m/Y', strtotime($tgl2)); ?>
    </div>
    <div class="row">
        <div class="col-md-2" style="margin-right: 10px;">
            <table class="tabl">
                <tr>
                    <th class="bg-dark" colspan="3">PENDAPATAN RENTAL</th>
                </tr>
                <tr>
                    <th>NO</th>
                    <th>TANGGAL</th>
                    <th>JUMLAH</th>
                </tr>
                <?php if ($resultr->num_rows() > 0) {; ?>
                    <?php $no = 1; ?>
                    <?php foreach ($resultr->result() as $r) {
                        $ttlr[] = $r->jml;
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td class="text-center"><?= date('d-m-Y', strtotime($r->tgl)); ?></td>
                            <td style="text-align: right;"><?= number_format($r->jml); ?></td>
                        </tr>
                    <?php }; ?>
                    <tr style=" background-color: bisque; font-weight: 800;">
                        <td style="text-align: right;" colspan="2">TOTAL</td>
                        <td style="text-align: right;"><?= number_format(array_sum($ttlr)); ?></td>
                    </tr>
                <?php } else {; ?>
                    <?php
                    $ttlr[] = 0;
                    ?>
                    <tr>
                        <td class="text-center" colspan="3">
                            <h6 style="color: black;">TRANSAKSI MASIH KOSONG</h6>
                        </td>
                    </tr>
                <?php }; ?>
            </table>
        </div>
        <div class="col-md-2" style="margin-right: 10px;">
            <table class="tabl">
                <tr>
                    <th class="bg-dark" colspan="3">PENDAPATAN SEWA</th>
                </tr>
                <tr>
                    <th>NO</th>
                    <th>TANGGAL</th>
                    <th>JUMLAH</th>
                </tr>
                <?php if ($results->num_rows() > 0) {; ?>
                    <?php $no = 1; ?>
                    <?php foreach ($results->result() as $s) {
                        $ttls[] = $s->jml;
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td class="text-center"><?= date('d-m-Y', strtotime($s->tgl)); ?></td>
                            <td style="text-align: right;"><?= number_format($s->jml); ?></td>
                        </tr>
                    <?php }; ?>
                    <tr style=" background-color: bisque; font-weight: 800;">
                        <td style="text-align: right;" colspan="2">TOTAL</td>
                        <td style="text-align: right;"><?= number_format(array_sum($ttls)); ?></td>
                    </tr>
                <?php } else {; ?>
                    <?php
                    $ttls[] = 0;
                    ?>
                    <tr>
                        <td class="text-center" colspan="3">
                            <h6 style="color: black;">TRANSAKSI MASIH KOSONG</h6>
                        </td>
                    </tr>
                <?php }; ?>
            </table>
        </div>
        <div class="col-md-2" style="margin-right: 10px;">
            <table class="tabl">
                <tr>
                    <th class="bg-dark" colspan="3">PENDAPATAN PENJUALAN</th>
                </tr>
                <tr>
                    <th>NO</th>
                    <th>TANGGAL</th>
                    <th>JUMLAH</th>
                </tr>
                <?php if ($resultp->num_rows() > 0) {; ?>
                    <?php $no = 1; ?>
                    <?php foreach ($resultp->result() as $p) {
                        $ttlp[] = $p->jml;
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td class="text-center"><?= date('d-m-Y', strtotime($p->tgl)); ?></td>
                            <td style="text-align: right;"><?= number_format($p->jml); ?></td>
                        </tr>
                    <?php }; ?>
                    <tr style=" background-color: bisque; font-weight: 800;">
                        <td style="text-align: right;" colspan="2">TOTAL</td>
                        <td style="text-align: right;"><?= number_format(array_sum($ttlp)); ?></td>
                    </tr>
                <?php } else {; ?>
                    <?php
                    $ttlp[] = 0;
                    ?>
                    <tr>
                        <td class="text-center" colspan="3">
                            <h6 style="color: black;">TRANSAKSI MASIH KOSONG</h6>
                        </td>
                    </tr>
                <?php }; ?>
            </table>
        </div>
        <div class="col-md-2" style="margin-right: 10px;">
            <table class="tabl">
                <tr>
                    <th class="bg-dark" colspan="3">DATA PENGELUARAN</th>
                </tr>
                <tr>
                    <th>NO</th>
                    <th>TANGGAL</th>
                    <th>JUMLAH</th>
                </tr>
                <?php if ($resultg->num_rows() > 0) {; ?>
                    <?php $no = 1; ?>
                    <?php foreach ($resultg->result() as $g) {
                        $ttlg[] = $g->jml;
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td class="text-center"><?= date('d-m-Y', strtotime($g->tgl_pengeluaran)); ?></td>
                            <td style="text-align: right;"><?= number_format($g->jml); ?></td>
                        </tr>
                    <?php }; ?>
                    <tr style=" background-color: bisque; font-weight: 800;">
                        <td style="text-align: right;" colspan="2">TOTAL</td>
                        <td style="text-align: right;"><?= number_format(array_sum($ttlg)); ?></td>
                    </tr>
                <?php } else {; ?>
                    <?php
                    $ttlg[] = 0;
                    ?>
                    <tr>
                        <td class="text-center" colspan="3">
                            <h6 style="color: black;">TRANSAKSI MASIH KOSONG</h6>
                        </td>
                    </tr>
                <?php }; ?>
            </table>
        </div>
        <?php $jmlttl = (empty(array_sum($ttlr)) ? 0 : array_sum($ttlr)) + (empty(array_sum($ttls)) ? 0 : array_sum($ttls)) + (empty(array_sum($ttlp)) ? 0 : array_sum($ttlp)); ?>
        <div class="col-md-3">
            <table class="tabl">
                <tr>
                    <th class="bg-dark">TOTAL OMSET</th>
                </tr>
                <tr>
                    <td style="font-size: 16px; font-weight: bold;">Rp <span style="float: right;"><?= number_format($jmlttl); ?></span></td>
                </tr>
            </table>

            <table class="tabl">
                <tr>
                    <th class="bg-dark">TOTAL PENGELUARAN</th>
                </tr>
                <tr>
                    <td style="font-size: 16px; font-weight: bold;">Rp <span style="float: right;"><?= number_format((empty(array_sum($ttlg)) ? 0 : array_sum($ttlg))); ?></span></td>
                </tr>
            </table>

            <table class="tabl">
                <tr>
                    <th class="bg-dark">PENDAPATAN BERSIH</th>
                </tr>
                <tr>
                    <td style="font-size: 16px; font-weight: bold;">Rp <span style="float: right;"><?= number_format($jmlttl - array_sum($ttlg)); ?></span></td>
                </tr>
            </table>
        </div>
    </div>

</div>