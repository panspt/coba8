<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line fa-3x" style="color: #cac6c5;"></i>
                <div class="ms-3">
                    <p class="mb-2">Jumlah Transaksi</p>
                    <h6 class="mb-0" id="jmltrans">0</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x" style="color: #cac6c5;"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Omset</p>
                    <h6 class="mb-0" id="ttlost">Rp 0</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-area fa-3x" style="color: #cac6c5;"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Pengeluaran</p>
                    <h6 class="mb-0" id="ttlpgl">Rp 0</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-pie fa-3x" style="color: #cac6c5;"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Pendapatan</p>
                    <h6 class="mb-0" id="ttlpdt">Rp 0</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->


<!-- Sales Chart Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-8">
            <div class="bg-secondary text-center rounded p-4" id="datagrafik">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0"> Pendapatan Perbulan</h6>
                    <a href="<?= base_url('dashboard/laporan'); ?>">Cek Laporan</a>
                </div>
                <canvas id="grafik_pend_perbulan"></canvas>
            </div>
        </div>
        <div class="col-sm-12 col-xl-4">
            <div class="bg-secondary text-center rounded p-4" id="datagrafik2">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-1">Jumlah Transaksi</h6>
                    <a href="<?= base_url('dashboard/laporan'); ?>">Cek Laporan</a>
                </div>
                <hr style="margin-top: -4px;">
                <br>
                <canvas id="grafik_transaksi"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- Sales Chart End -->


<!-- Recent Sales Start -->
<?php if (!empty($tran->num_rows())) {; ?>
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Sewa PS Aktif</h6>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white text-center">
                            <th scope="col" width="5%">No</th>
                            <th scope="col">Kode Transaksi</th>
                            <th scope="col">Member</th>
                            <th scope="col">Jenis Ps</th>
                            <th scope="col">Dari Tanggal</th>
                            <th scope="col">Sampai Tanggal</th>
                            <th scope="col">Batas Waktu</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="sewaps">
                        <?php $no = 1; ?>
                        <?php foreach ($tran->result() as $t) {
                            $awal  = date_create($t->sampai_tanggal);
                            $akhir = date_create(date('Y-m-d H:i:s')); // waktu sekarang
                            $diff  = date_diff($awal, $akhir);
                            $thn = $diff->y;
                            $bln = $diff->m;
                            $hr = $diff->d;

                            $jamm =  $diff->h;
                            $mnt =  $diff->i;
                            $dtk =  $diff->s;

                            if ($thn > 0) {
                                $thn1 = $thn . ' Tahun, ';
                            } else {
                                $thn1 = "";
                            }
                            if ($bln > 0) {
                                $bln1 = $bln . ' Bulan, ';
                            } else {
                                $bln1 = "";
                            }

                            if ($hr > 0) {
                                $hr1 = $hr . ' Hari, ';
                            } else {
                                $hr1 = "";
                            }

                            if ($jamm >= 10) {
                                $jamm1 = $jamm;
                            } else {
                                $jamm1 = "0" . $jamm;
                            }

                            if ($mnt >= 10) {
                                $mnt1 = $mnt;
                            } else {
                                $mnt1 = "0" . $mnt;
                            }

                            if ($dtk >= 10) {
                                $dtk1 = $dtk;
                            } else {
                                $dtk1 = "0" . $dtk;
                            }
                            $timestampg =  $thn1 . $bln1 . $hr1;

                            if ($t->dibayar >= $t->total) {
                                $sts = '<span class="text-success">Lunas</span>';
                            } else {
                                $sts = '<span class="text-danger">Belum Lunas</span>';
                            }
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $t->kode_sewa; ?></td>
                                <td><?= $t->nama_maktif; ?></td>
                                <td class="text-center"><?= $t->jenis_ps; ?></td>
                                <td><?= format_indo($t->dari_tanggal) ?></td>
                                <td><?= format_indo($t->sampai_tanggal) ?></td>
                                <td class="text-left">
                                    <h6 style="color: blueviolet; margin-bottom: -1px; font-size: 17px;">
                                        <span id="waktu<?= $t->id_sewaps ?>"><?= $timestampg; ?></span>
                                        <span id="sewa<?= $t->id_sewaps ?>"></span> <span id="jam<?= $t->id_sewaps ?>"> Jam</span>
                                    </h6>
                                </td>
                                <td><?= number_format($t->total); ?> - <?= $sts; ?></td>
                                <td><button data-kd="<?= $t->kode_sewa; ?>" class="btn btn-sm btn-primary detail">Detail</button></td>
                            </tr>
                            <script type="text/javascript">
                                $('#sewa<?= $t->id_sewaps ?>').countdown('<?= $t->sampai_tanggal ?>', function(event) {
                                    var kn = event.strftime('%H:%M:%S');
                                    if (kn == "00:00:00") {
                                        clearInterval("#paket<?= $t->id_sewaps ?>");
                                        $(this).html('WAKTU HABIS');
                                        $(this).attr('class', 'blink');
                                        $('#waktu<?= $t->id_sewaps ?>').hide();
                                        $('#jam<?= $t->id_sewaps ?>').hide();
                                    } else {
                                        $(this).html(event.strftime('%H:%M:%S'));
                                    }
                                });
                            </script>
                        <?php }; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php }; ?>
<!-- Recent Sales End -->


<!-- Widgets Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="h-100 bg-secondary rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="mb-0">Terakhir Rental PS </h6>
                </div>
                <?php $no = 1; ?>
                <?php foreach ($renn as $r) {; ?>
                    <div class="d-flex align-items-center <?= (($no++ == 5) ? 'pt-3' : 'border-bottom  py-3'); ?> ">
                        <img class="rounded-circle flex-shrink-0" src="<?= base_url('assets'); ?>/img/ps.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0" style="text-transform: capitalize;"><?= $r->nama; ?></h6>
                                <small><?= dateAgo($r->stop); ?></small>
                            </div>
                            <?php
                            $jam = date('H', strtotime($r->lama_rental));
                            $menit = date('i', strtotime($r->lama_rental));
                            $cek_jam = substr($jam, 0, 1);
                            $jamasl = substr($jam, 1);
                            if ($jam != 0 && $menit != 0) {
                                $ls = (($cek_jam == 0) ? $jamasl : $jam) . ' jam ' . $menit . ' menit';
                            } else if ($jam != 0 && $menit == 0) {
                                $ls = (($cek_jam == 0) ? $jamasl : $jam) . ' jam ';
                            } else if ($jam == 0 && $menit != 0) {
                                $ls = $menit . ' menit ';
                            }
                            ?>
                            <span>Rental <?= $r->jenis_ps; ?> selama <?= $ls; ?></span>
                        </div>
                    </div>

                <?php }; ?>



            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="h-100 bg-secondary rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Terakhir Penjualan </h6>
                </div>
                <?php $no = 1; ?>
                <?php foreach ($penjl as $p) {
                    $jml = $this->db->query("SELECT SUM(jml) as j FROM  tb_keranjang WHERE kodepenjualan='$p->kode_penjualan' ")->row();
                    $m = $this->db->query("SELECT * FROM  tb_member WHERE kode='$p->kode_pembayaran' ")->row();

                    if ($p->kode_pembayaran == 'cash') {
                        $sts = 'Dibayar Cash';
                    } else {
                        $sts = $m->nama;
                    }
                ?>
                    <div class="d-flex align-items-center <?= (($no++ == 5) ? 'pt-3' : 'border-bottom  py-3'); ?> ">
                        <img class="rounded-circle flex-shrink-0" src="<?= base_url('assets'); ?>/img/snack.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0" style="text-transform: capitalize;"><?= $sts; ?></h6>
                                <small><?= dateAgo($p->tgl_penjualan); ?></small>
                            </div>
                            <span>Jumlah <?= $jml->j; ?> item, total Rp <?= number_format($p->jml_total); ?> </span>
                        </div>
                    </div>

                <?php }; ?>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="h-100 bg-secondary rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Terakhir Sewa PS </h6>
                </div>
                <?php $no = 1; ?>
                <?php foreach ($seww as $s) {; ?>
                    <div class="d-flex align-items-center <?= (($no++ == 5) ? 'pt-3' : 'border-bottom  py-3'); ?> ">
                        <img class="rounded-circle flex-shrink-0" src="<?= base_url('assets'); ?>/img/ps.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0" style="text-transform: capitalize;"><?= $s->nama_maktif; ?></h6>
                                <small><?= dateAgo($s->tgl_sk); ?></small>
                            </div>
                            <span>Rental <?= $s->jenis_ps; ?> selama <?= $s->jml_hari; ?> hari</span>
                        </div>
                    </div>

                <?php }; ?>


            </div>
        </div>
    </div>
</div>
<!-- Widgets End -->


<!-- Footer Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded-top p-4">
        <div class="row">
            <div class="col-12 col-sm-6 text-center text-sm-start">
                &copy; <a href="#">Aime Game Station</a>, All Right Reserved.
            </div>
            <!-- <div class="col-12 col-sm-6 text-center text-sm-end">
                Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
            </div> -->
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- detail -->
<!-- Modal detail sewa-->
<div class="modal fade" id="detailsewa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content  " style="border: 3px solid red;">
            <div id="detailsw"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    $('#sewaps').on('click', '.detail', function() {
        var kode = $(this).attr('data-kd');
        $.ajax({
            type: 'POST',
            url: '<?= base_url('petugas/detailsewa'); ?>',
            cache: false,
            data: {
                kode: kode,
            },
            success: function(data) {
                $("#detailsw").html(data);
                $("#detailsewa").modal("show");
            }
        });
    })
</script>
<!-- <input type="text" name="" id="tes"> -->
<script src="<?= base_url('assets/'); ?>js/jquery.js"></script>
<script>
    (function($) {
        $(document).ready(function() {
            dashboard();
            $('#tahunlap').change(function() {
                var thn = $(this).val();
                dashboard(thn)

            })



            function dashboard(thn) {

                if (thn == null) {
                    var thnn = '<?= date('Y'); ?>'
                } else {
                    var thnn = thn;
                }
                // alert(thnn);
                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('dashboard/dass'); ?>",
                    dataType: "JSON",
                    cache: true,
                    data: {
                        thnn: thnn,
                    },
                    success: function(data) {
                        $('#jmltrans').html(data.jmltrans);
                        $('#ttlost').html(data.ttlost);
                        $('#ttlpgl').html(data.ttlpgl);
                        $('#ttlpdt').html(data.ttlpdt);
                        $('#tes').val(data.transaksi);

                        // myChart1.update();
                        $('#grafik_pend_perbulan').remove();
                        $('#datagrafik').append('<canvas id="grafik_pend_perbulan"><canvas>');
                        canvas = document.querySelector('#grafik_pend_perbulan');
                        grafik_pendaptan_perbulan(data.bln, data.omset, data.pengeluaran, data.pendapatan);

                        $('#grafik_transaksi').remove();
                        $('#datagrafik2').append('<canvas id="grafik_transaksi"><canvas>');
                        canvas = document.querySelector('#grafik_transaksi');
                        transaksi(data.transaksi);
                    }
                });

            }

            // grafik_transaksi();

            function grafik_pendaptan_perbulan(bln, omset, pengeluaran, pendapatan) {

                Chart.defaults.color = "#6C7293";
                Chart.defaults.borderColor = "#000000";

                var ctx1 = $("#grafik_pend_perbulan").get(0).getContext("2d");
                var myChart1 = new Chart(ctx1, {
                    type: "bar",
                    data: {
                        labels: bln,
                        datasets: [{
                                label: "OMSET",
                                data: omset,
                                backgroundColor: "yellow"
                            },
                            {
                                label: "PENGELUARAN",
                                data: pengeluaran,
                                backgroundColor: "red"
                            },
                            {
                                label: "PENDAPATAN",
                                data: pendapatan,
                                backgroundColor: "green"
                            }
                        ]
                    },
                    options: {
                        responsive: true
                    }

                });

            }


            function transaksi(transaksi) {
                var ctx2 = $("#grafik_transaksi").get(0).getContext("2d");
                var myChart2 = new Chart(ctx2, {
                    type: "doughnut",
                    data: {
                        labels: ["Rental ", "Sewa", "Penjualan"],
                        datasets: [{
                            backgroundColor: [
                                "#cac6c5",
                                "#797674",
                                "#2F2F2F",
                            ],
                            data: transaksi,
                        }, ],
                    },
                    options: {
                        responsive: true,
                    },
                });
            }




        });
    })(jQuery);
</script>