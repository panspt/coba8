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
            LAPORAN PENGELUARAN<br>
            DARI TANGGAL <?= date('d/m/Y', strtotime($tgl1)); ?> SAMPAI TANGGAL <?= date('d/m/Y', strtotime($tgl2)); ?>
        </div>
        <table class="tabl">
            <tr>
                <th width="3%">NO</th>
                <th width="13%">TANGGAL</th>
                <th>KETERANGAN</th>
                <th width="13%">JUMLAH</th>
            </tr>
            <?php $no = 1; ?>
            <?php foreach ($result->result() as $p) {
                $ttl[] = $p->total;
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $p->tgl_pengeluaran; ?></td>
                    <td><?= $p->judul_pengeluaran; ?></td>
                    <td>Rp <span style="float:right;"><?= number_format($p->total); ?>,-</span></td>
                </tr>
            <?php }; ?>
            <tr>
                <td colspan="3" style="font-size: 18px; text-align: right;"><b>TOTAL</b></td>
                <td style="font-size: 18px;"><b>Rp <span style="float:right;"><?= number_format(array_sum($ttl)); ?>,-</span></b></td>
            </tr>
        </table>
    <?php } else {; ?>
        <h1 style="color: black;">DATA TIDAK DITEMUKAN, SILAHKAN CARI DATA LAIN</h1>
    <?php }; ?>
</div>