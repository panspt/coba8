<!-- Sale & Revenue Start -->

<div class="container-fluid pt-4 px-4">

    <div class="row g-4">
        <div class="col-xl-8">
            <?= $this->session->flashdata('notiff'); ?>

            <div class="row g-4" id="start">
                <?php foreach ($ps as $p) {; ?>
                    <?php
                    date_default_timezone_set('Asia/Jakarta');
                    $query_rental = $this->db->query("SELECT * FROM tb_rental  JOIN tb_member ON tb_member.kode=tb_rental.kode_member WHERE idchannel='$p->id_channel' AND aktif='Y' ");
                    $m = $query_rental->row();
                    if (empty($m)) {
                    ?>
                        <div class="col-xl-3 col-sm-4 col-xs-4 mb-2">
                            <div class="bg-secondary rounded text-center  p-4 cnl2">
                                <h6 style="margin-top: -15px; margin-bottom: 20px; color: white;"><?= $p->nama_channel; ?> : <span> <?= $p->jenis_ps; ?> </span></h6>
                                <h1 style="margin-top: -10px;">READY</h1>
                                <p style="margin-top: -8px; font-weight: bold; color: red;">00.00.00 </p>
                                <p style="margin-top: -20px; color: red; font-size: 9pt;">MEMBER</p>
                                <button class="btn btn-success btn-md start" data-nm="<?= $p->nama_channel; ?>" data-id="<?= $p->id_channel; ?>" data-hr="<?= $p->harga; ?>" data-bs-toggle="modal" data-bs-target="#myModal">START <i class="fa fa-play-circle "></i></button>
                            </div>
                        </div>
                    <?php } else { ?>
                        <?php
                        $paket_ps = $this->db->query("SELECT * FROM tb_paket WHERE kode_mem='$m->kode' ")->row();
                        if (!empty($paket_ps)) {
                        ?>
                            <div class="col-xl-3 col-sm-4 col-xs-4 mb-2">
                                <div class="bg-secondary rounded text-center  p-4 cnl" id="bor<?= $p->id_channel ?>">
                                    <h6 style="margin-top: -12px; margin-bottom: 20px; color: white;"><?= $p->nama_channel; ?> : <span> <?= $p->jenis_ps; ?> </span></h6>
                                    <h4 id="ong<?= $p->id_channel ?>" style="margin-top: -10px; color: Cyan;">ON GOING</h4>
                                    <h2 style="margin-top: -10px; color: yellow;" id="paket<?= $p->id_channel ?>">00:00:00</h2>

                                    <p style="margin-top: -5px; color: red; font-size: 9pt; text-transform: uppercase; "><?= $m->nama ?> <br>
                                        <span style="color: Cyan;"><?= $paket_ps->paket ?></span>
                                    </p>
                                    <a id="stpp<?= $p->id_channel ?>" class="btn btn-primary btn-md btn_stop" data-hpk="<?= $paket_ps->id_paket ?>" data-pk="KO" data-nm="<?= $p->nama_channel ?>" data-idch="<?= $p->id_channel ?>" data-idrt="<?= $m->id_rental ?>" data-idmm="<?= $m->id_member ?>" data-toggle="tooltip" title="STOP"> <i class="fa fa-stop-circle "></i></a>
                                    <button id="add<?= $p->id_channel ?>" data-pk="<?= $paket_ps->id_paket ?>" data-id="<?= $m->id_rental ?>" data-nmm="<?= $m->nama ?>" data-stp="<?= $m->stop ?>" data-nm="<?= $p->nama_channel ?>" class="btn btn-info btn-md Add" data-bs-toggle="modal" data-bs-target="#exampleModalAdd"> <i class="fa fa-clock " data-toggle="tooltip" title="Tambah Waktu Sewa"></i></button>
                                    <a hidden id="stp<?= $p->id_channel ?>" data-hpk="KO" class="btn btn-primary btn-md btn_stop" data-pk="<?= $paket_ps->id_paket ?>" data-nm="<?= $p->nama_channel ?>" data-idch="<?= $p->id_channel ?>" data-idrt="<?= $m->id_rental ?>" data-idmm="<?= $m->id_member ?>"> <i class="fa fa-stop-circle "></i></a>
                                    <?php if ($log->level == 1) {; ?>
                                        <a class="btn hapus_start btn-warning" data-pk="<?= $paket_ps->id_paket ?>" data-nm="<?= $p->nama_channel ?>" data-idch="<?= $p->id_channel ?>" data-idrt="<?= $m->id_rental ?>" data-idmm="<?= $m->id_member ?>" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash text-primary"></i></a>
                                    <?php }; ?>

                                    <script type="text/javascript">
                                        $('#paket<?= $p->id_channel ?>').countdown('<?= $m->stop ?>', function(event) {

                                            // let isPlaying = false;
                                            var add = document.getElementById("add<?= $p->id_channel ?>");
                                            var stp = document.getElementById("stp<?= $p->id_channel ?>");
                                            var stpp = document.getElementById("stpp<?= $p->id_channel ?>");
                                            var ong = document.getElementById("ong<?= $p->id_channel ?>");
                                            // var bgm = $("#bgm").html();
                                            var kn = event.strftime('%H:%M:%S');
                                            if (kn == "00:00:00") {
                                                clearInterval("#paket<?= $p->id_channel ?>");
                                                $(this).html('WAKTU HABIS');
                                                $(this).attr('class', 'blink');
                                                $(this).attr('style', 'color:white');
                                                $(this).attr('style', 'text-shadow:1 px 2 px 1 px #9ad2fe,-1px -2px 1px # 1895 f7; ');
                                                stp.hidden = false;
                                                add.hidden = false;
                                                stpp.hidden = true;
                                                
                                                $('#ong<?= $p->id_channel ?>').html('#~~#~~#');
                                                $('#bor<?= $p->id_channel ?>').attr('style', 'border-color:white');
                                                // setInterval(function() {
                                                //     $('.aok').get(0).play();
                                                // }, 1000);
                                            } else {
                                                $(this).html(event.strftime('%H:%M:%S'));
                                                stp.hidden = true;
                                                add.hidden = false;
                                                stpp.hidden = false;
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                        <?php
                        } else {
                            $awal  = date_create($m->start);
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
                            $timestampg =  $thn1 . $bln1 . $hr1 .  $jamm1 .  ":" . $mnt1 . ":" . $dtk1;
                        ?>
                            <div class="col-xl-3 col-sm-4 col-xs-4 mb-2">
                                <div class="bg-secondary rounded text-center  p-4 cnl">
                                    <h6 style="margin-top: -12px; margin-bottom: 20px; color: white;"><?= $p->nama_channel; ?> : <span> <?= $p->jenis_ps; ?> </span></h6>
                                    <h4 style="margin-top: -10px; color: Cyan;">ON GOING</h4>
                                    <h2 style="margin-top: -10px; color: yellow;" id="jamServer<?= $p->id_channel ?>"><?= $timestampg; ?></h2>
                                    <script>
                                        var serverClock = jQuery("#jamServer" + '<?= $p->id_channel ?>');
                                        if (serverClock.length > 0) {
                                            showServerTime(serverClock, serverClock.text());
                                        }

                                        function showServerTime(obj, time) {
                                            var parts = time.split(":"),
                                                newTime = new Date('<?= $m->start ?>');

                                            newTime.setHours(parseInt(parts[0], 10));
                                            newTime.setMinutes(parseInt(parts[1], 10));
                                            newTime.setSeconds(parseInt(parts[2], 10));

                                            var timeDifference = new Date().getTime() - newTime.getTime();

                                            var methods = {
                                                displayTime: function() {
                                                    var now = new Date(new Date().getTime() - timeDifference);
                                                    obj.text([
                                                        methods.leadZeros(now.getHours(), 2),
                                                        methods.leadZeros(now.getMinutes(), 2),
                                                        methods.leadZeros(now.getSeconds(), 2)
                                                    ].join(":"));
                                                    setTimeout(methods.displayTime, 500);
                                                },

                                                leadZeros: function(time, width) {
                                                    while (String(time).length < width) {
                                                        time = "0" + time;
                                                    }
                                                    return time;
                                                }
                                            }
                                            methods.displayTime();
                                        }
                                    </script>
                                    <p style="margin-top: -5px; color: red; font-size: 9pt; text-transform: uppercase;"><?= $m->nama; ?> <br><span style="color: Cyan;">Auto Time</span></p>

                                    <a class="btn btn-primary btn-md btn_stop" data-hpk="KO" data-pk="KO" data-nm="<?= $p->nama_channel ?>" data-idch="<?= $p->id_channel ?>" data-idrt="<?= $m->id_rental ?>" data-idmm="<?= $m->id_member ?>">STOP <i class="fa fa-stop-circle "></i></a>
                                    <?php if ($log->level == 1) {; ?>
                                        <a class="btn hapus_start btn-warning" data-pk="KO" data-nm="<?= $p->nama_channel ?>" data-idch="<?= $p->id_channel ?>" data-idrt="<?= $m->id_rental ?>" data-idmm="<?= $m->id_member ?>" style="margin-left: 10px;" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash text-primary"></i></a>
                                    <?php }; ?>
                                </div>
                            </div>
                        <?php }; ?>
                    <?php }; ?>
                <?php }; ?>
            </div>

        </div>
        <div class=" col-md-4 col-sm-4 col-xl-4  " style="z-index: 1;">
            <div class="bg-secondary rounded  sticky-top p-4" style="min-height: 87vh; border: 1px solid grey;">
                <table class="table table-bordered" style="border-color: grey;">
                    <tr>
                        <th width="35%" class="text-white">RENTAL </th>
                        <th class="text-white" id="jenis_ps" style="text-transform: uppercase"></th>
                    </tr>
                    <tr>
                        <th class="text-white">ATAS NAMA</th>
                        <th class="text-white" id="ats_nm" style="text-transform: capitalize"></th>
                    </tr>
                    <tr>
                        <th class="text-white">LAMA SEWA</th>
                        <th class="text-white" id="lama"></th>
                    </tr>
                    <tr>
                        <th class="text-white">TOTAL</th>
                        <th class="text-white" id="tl_rp"></th>
                    </tr>
                    <tr>
                        <th class="text-white">SNACK/MINUMAN</th>
                        <th class="text-white" id="tl_pj"></th>
                    </tr>
                </table>
                <div style="width: 100%; height: 60px; border: 1px solid grey; padding-left: 5px; color: white; font-size: 9pt;">
                    JUMLAH TOTAL
                    <span style="float: right; font-size: 30pt; font-weight: bold; padding-right: 5px;" id="tl_rp2">Rp.0</span>
                </div>

                <br>
                <label for="">DIBAYAR</label>
                <input type="hidden" name="" id="total" value="0">
                <input type="hidden" name="" id="totalrental" value="0">
                <input class="form-control form-control-lg mb-3 text-white text-end numbers" autofocus type="text" placeholder="Rp.0 " id="dibayar" style="border: 1px solid red; height: 70px; font-size: 25pt;">
                <input type="hidden" name="" id="byr">
                <div class="row">
                    <div class="col-md-8">
                        <label for="">KEMBALI</label>
                        <input class="form-control form-control-lg mb-3 text-dark " id="kembali" type="text" placeholder="Rp.0 " readonly>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-lg btn-success btn-block w-100 btn-pro btn_simpan"><i class="fa fa-save me-1"></i> SIMPAN</button>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="<?= site_url('petugas'); ?>"><button class="btn btn-lg btn-danger btn-block w-100 btn-pro"><i class="fa fa-spinner me-1"></i> RELOAD</button></a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <button data-bs-toggle="modal" data-bs-target="#rental" class="btn btn-lg btn-info btn-block w-100 btn-pro"><i class="fa fa-database me-1"></i> DATA RENTAL</button>
                    </div>
                    <div class="col-md-4 mb-3">
                        <button class="btn btn-lg btn-success btn-block w-100 btn-pro btn_cetak"><i class="fa fa-print me-1"></i> CETAK</button> 
                    </div>

                    <hr>
                    <div class="col-md-6 mb-3">
                        <a href="<?= site_url('petugas/sewa'); ?>"><button class="btn btn-lg btn-outline-primary btn-block w-100 btn-pro  " style="color: white; border-color: white"><i class="fa fa-laptop me-1"></i> SEWA PS</button></a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="<?= site_url('petugas/penjualan'); ?>"><button class="btn btn-lg btn-outline-primary btn-block w-100 btn-pro" style="color: white; border-color: white"><i class="fa fa-shopping-cart me-1"></i> PENJUALAN</button></a>
                    </div>
                    <br>
                    <div class="col-md-6 ">
                        <a href="<?= site_url('petugas/member'); ?>"><button class="btn btn-lg btn-outline-primary btn-block w-100 btn-pro" style="color: white; border-color: white"><i class="fa fa-users me-1"></i> DATA MEMBER</button></a>
                    </div>
                    <div class="col-md-6 ">
                        <a href="<?= site_url('petugas/invoice'); ?>"><button class="btn btn-lg btn-outline-primary btn-block w-100 btn-pro" style="color: white; border-color: white"><i class="fa fa-print me-1"></i> CETAK INVOICE</button></a>
                    </div>
                </div>

            </div>
        </div>


        <div id="load">
            <div id="data-print" class="tampilkan_data">


            </div>
        </div>

    </div>
</div>
<!-- Sale & Revenue End -->
<input type="hidden" name="" id="lamarental" value="0">
<input type="hidden" name="" id="id_r" value="0">
<input type="hidden" name="" id="id_m" value="0">
<input type="hidden" name="" id="kode" value="0">


<!-- <script src="<?= base_url('assets/'); ?>js/jquery.js"></script> -->

<!-- modal start -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('petugas/start'); ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_ch" value="0">
                    <input type="hidden" name="user" value="<?= $log->id_user ?>">
                    <input type="hidden" name="harga" id="harga" value="0">
                    <label for="exampleInputEmail1" class="form-label">Atas Nama</label>
                    <input type="text" name="nm" id="datamember" class="form-control text-white start_show" required placeholder="Member" autofocus>
                    <br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="paket" style="border-color: red;">
                        <label class="form-check-label" for="paket">
                            Ceklis untuk pilih paket sewa
                        </label>
                    </div>
                    <input type="hidden" name="waktu" id="rubah" value="kosong">

                    <select name="waktu" class="form-select form-select-sm text-white" id="pilih_paket" disabled>
                        <option selected value="">Pilih Paket Sewa</option>
                        <option value="I">coba</option>
                        <option value="H">30 Menit</option>
                        <option value="A">1 Jam</option>
                        <option value="B">1,5 Jam</option>
                        <option value="C">2 Jam</option>
                        <option value="D">2,5 Jam</option>
                        <option value="E">3 Jam</option>
                        <option value="F">3,5 Jam</option>
                        <option value="G">4 Jam</option>
                    </select>
                    <script>
                        $('#pilih_paket').hide()
                        $('#paket').on('click', function() {
                            if ($(this).prop('checked')) {
                                $('#pilih_paket').show()
                                $('#rubah').prop("disabled", true);
                                $('#pilih_paket').prop("disabled", false);
                                // $('#hp').focus()
                            } else {
                                $('#pilih_paket').val(' ')
                                $('#pilih_paket').hide()
                                $('#rubah').prop("disabled", false);
                                $('#pilih_paket').prop("disabled", true);
                            }
                        })
                    </script>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-block">START <i class="fa fa-play-circle "></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal Tambah waktu -->
<div class="modal fade" id="exampleModalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLabelAdd"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= base_url('petugas/add'); ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_rt">
                    <input type="hidden" name="id_pk" id="id_pk_lama">
                    <input type="hidden" name="waktu_lama" id="waktu_lama">
                    <label for="exampleInputEmail1" class="form-label">Atas Nama : <span id="nama_member"></span></label>
                    <br>
                    <select name="waktu" class="form-select form-select-sm text-white">
                        <option selected value="">Tambahkan Waktu Sewa</option>
                        <option value="I">Coba</option>
                        <option value="H">30 Menit</option>
                        <option value="A">1 Jam</option>
                        <option value="B">1,5 Jam</option>
                        <option value="C">2 Jam</option>
                        <option value="D">2,5 Jam</option>
                        <option value="E">3 Jam</option>
                        <option value="F">3,5 Jam</option>
                        <option value="G">4 Jam</option>
                    </select>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-block">Tambahkan <i class="fa fa-clock "></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal data rental -->
<div class="modal fade" id="rental" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-secondary" id="staticBackdropLabel">DATA RENTAL PS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="table-responsive" style="height: 600px;">
                    <table class="table table-bordered tab" style="font-size: 14px;">
                        <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th>ATAS NAMA</th>
                                <th width="10%">LAMA SEWA</th>
                                <th width="10%">HARGA</th>
                                <th width="12%">SNACK/MINUMAN</th>
                                <th width="10%">JUMLAH</th>
                                <th width="10%">DIBAYAR</th>
                                <th width="13%">STS PEMBAYARAN</th>
                                <th width="12%">OPSI</th>
                            </tr>
                        </thead>
                        <tbody id="datarental">
                            <?php $no = 1; ?>
                            <?php foreach ($ren as $r) {; ?>
                                <?php
                                $penjualan = $this->db->query("SELECT SUM(jml_total) as total FROM tb_penjualan WHERE kode_pembayaran='$r->kode'");
                                $pen = $penjualan->row();
                                $ttlpen = (empty($pen->total)) ? 0 : $pen->total;
                                $jum = $ttlpen + $r->total;

                                $paket = $this->db->query("SELECT * FROM tb_paket WHERE kode_mem='$r->kode'");
                                $pk = $paket->row();
                                $idpk = (empty($pk->id_paket)) ? 0 : $pk->id_paket;

                                if ($r->dibayar >= $jum) {
                                    $hasil = number_format($r->dibayar - $jum);
                                } else {
                                    $hasil = '<span class="text-danger">' . number_format($jum - $r->dibayar)  . '</span>';
                                }
                                ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $r->nama; ?></td>
                                    <td class="text-center"><?= $r->lama_rental; ?></td>
                                    <td>Rp <span class="float-end"><?= number_format($r->total) ?></span></td>
                                    <td>Rp <span class="float-end"><?= number_format($ttlpen); ?></span></td>
                                    <td>Rp <span class="float-end"><?= number_format($jum); ?></span></td>
                                    <td>Rp <span class="float-end"><?= number_format($r->dibayar); ?></span></td>
                                    <?php if ($r->dibayar >= $jum) { ?>
                                        <td> Kembali Rp <span class="float-end"><?= $hasil; ?></span></td>
                                    <?php } else {; ?>
                                        <td class="text-danger">Kurang Rp <span class="float-end"><?= $hasil; ?></span></td>
                                    <?php }; ?>
                                    <td class="text-center">
                                        <button data-nm="<?= $r->nama; ?>" data-kd="<?= $r->kode; ?>" data-bs-dismiss="modal" class=" btn btn-success btn-sm btn_edit"><i class="fa fa-edit"></i></button>
                                        <button data-kd="<?= $r->kode; ?>" class="btn btn-dark btn-sm btn_print"><i class="fa fa-print"></i></button>
                                        <?php if ($log->level == 1) {; ?>
                                            <button data-idpk="<?= $idpk; ?>" data-idm="<?= $r->id_member; ?>" data-idr="<?= $r->id_rental; ?>" data-nm="<?= $r->nama; ?>" data-kd="<?= $r->kode; ?>" class="btn btn-danger btn-sm btn_hapus"><i class="fa fa-trash"></i></button>
                                        <?php }; ?>
                                    </td>
                                </tr>
                            <?php }; ?>

                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- ubah password -->
<div class="modal fade" id="ubahpass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Ubah Password Anda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <input type="hidden" name="idus" id="idus" value="<?= $log->id_user ?>">
                <input type="hidden" name="passlm" id="passlm" value="<?= $log->password ?>">
                <div class="mb-3">
                    <label for="" class="form-label text-dark">USERNAME</label>
                    <input type="text" name="username" class="form-control text-dark " value="<?= $log->username ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label text-dark">PASSWORD LAMA</label>
                    <input type="password" name="pass_lama" id="pass_lama" class="form-control text-white " placeholder="Password Lama" required>
                    <small class="text-danger"><?= form_error('pass_lama'); ?></small>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label text-dark">PASSWORD BARU</label>
                    <input type="password" name="pass1" id="pass1" class="form-control text-white " placeholder="Password Baru" required>
                    <small class="text-danger"><?= form_error('pass1'); ?></small>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label text-dark">KONFIRMASI PASSWORD BARU</label>
                    <input type="password" name="pass2" id="pass2" class="form-control text-white " placeholder="Konfirmasi Password Baru" required>
                    <small class="text-danger"><?= form_error('pass2'); ?></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btn_ubah_pass" class="btn btn-secondary"><i class="fa fa-save me-2"></i> Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>



<script>
    $("#myModal").on("shown.bs.modal", function() {
        setTimeout(function() {
            $('#datamember').focus();
        }, 100);
    });

    var dibayar = document.getElementById('dibayar');
    dibayar.addEventListener('keyup', function(e) {
        dibayar.value = formatRupiah(this.value);
        // hilangkan titik
        var ttk = ".";
        var h = $('#dibayar').val();
        var h = h.replaceAll(ttk, "");
        $('#byr').val(h);
        // $('.aok').get(0).play();
    });

    /* Fungsi */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + '.' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    $('#btn_ubah_pass').click(function() {
        var id = $('#idus').val();
        var passlm = $('#passlm').val();
        var pass_lama = $('#pass_lama').val();
        var pass1 = $('#pass1').val();
        var pass2 = $('#pass2').val();
        if (pass_lama == "") {
            toastr.error("Password Lama harus diisi!");
            $('#pass_lama').focus();
        } else if (pass1 == "") {
            toastr.error("Password Baru harus diisi!");
            $('#pass1').focus();
        } else if (pass2 == "") {
            toastr.error("Konfirmasi Password Baru harus diisi!");
            $('#pass2').focus();
        } else {
            $.ajax({
                type: 'POST',
                url: '<?= base_url('petugas/ubah_password'); ?>',
                dataType: 'JSON',
                data: {
                    id: id,
                    passlm: passlm,
                    pass_lama: pass_lama,
                    pass1: pass1,
                    pass2: pass2,
                },
                success: function(data) {
                    if (data.hasil == 'gagal') {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: data.isi,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.location.href = "<?= base_url('petugas'); ?>";
                            }
                        });
                    } else if (data.hasil == 'berhasil') {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil...",
                            text: data.isi,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.location.href = "<?= base_url('petugas'); ?>";
                            }
                        });
                    }
                }
            });
        }
    })
</script>

<script>
    (function($) {
        $(document).ready(function(e) {
            rental();


            function rental() {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo base_url('petugas/hitung_rental') ?>',
                    async: true,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status == "success") {
                            $("#jenis_ps").html(data.jenis_ps);
                            $("#ats_nm").html(data.nama);
                            $("#lama").html(data.lama);
                            $("#tl_rp").html(data.tl_rp);
                            $("#tl_pj").html(data.tl_pj);
                            $("#tl_rp2").html(data.sub_tl_pj);
                            $("#id_m").val(data.id_member);
                            $("#id_r").val(data.id_rental);
                            $("#total").val(data.total);
                            $("#lamarental").val(data.lama);
                            $("#totalrental").val(data.totalrental);
                            $("#kode").val(data.kode);
                        } else {
                            $("#ats_nm").html('');
                        }
                    }
                });
            }

            $('#start').on('click', '.start', function() {

                var id = $(this).attr('data-id');
                var harga = $(this).attr('data-hr');
                var nm = $(this).attr('data-nm');

                $('#exampleModalLabel').html(nm);
                $('#id_ch').val(id);
                $('#harga').val(harga);
            });

            $('#start').on('click', '.Add', function() {
                var id = $(this).attr('data-id');
                var id_pk = $(this).attr('data-pk');
                var nm = $(this).attr('data-nm');
                var nmm = $(this).attr('data-nmm');
                var stop = $(this).attr('data-stp');
                $('#id_rt').val(id);
                $('#exampleModalLabelAdd').html(nm);
                $('#nama_member').html(nmm);
                $('#waktu_lama').val(stop);
                $('#id_pk_lama').val(id_pk);
            })

            $('#start').on('click', '.hapus_start', function() {
                var id_ch = $(this).attr('data-idch');
                var id_mm = $(this).attr('data-idmm');
                var id_rt = $(this).attr('data-idrt');
                var id_pk = $(this).attr('data-pk');
                var nm = $(this).attr('data-nm');

                Swal.fire({
                    title: 'Apa kamu yakin?',
                    text: "Data " + nm + " akan di hapus!!!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url('petugas/hapus_start'); ?>",
                            async: true,
                            dataType: "JSON",
                            data: {
                                id_ch: id_ch,
                                id_mm: id_mm,
                                id_rt: id_rt,
                                id_pk: id_pk,
                            },
                            success: function(data) {
                                document.location.href = "<?= base_url('petugas'); ?>";
                                // $('#bayar').modal('show')
                            }
                        });
                    }
                })

                return false;
            });

            $('#start').on('click', '.btn_stop', function() {
                var id_ch = $(this).attr('data-idch');
                var id_mm = $(this).attr('data-idmm');
                var id_rt = $(this).attr('data-idrt');
                var id_pk = $(this).attr('data-pk');
                var id_hpk = $(this).attr('data-hpk');
                var nm = $(this).attr('data-nm');

                Swal.fire({
                    title: nm,
                    text: "Pastikan data yang anda pilih sudah benar!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Stop!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url('petugas/stop'); ?>",
                            async: true,
                            dataType: "JSON",
                            data: {
                                id_ch: id_ch,
                                id_mm: id_mm,
                                id_rt: id_rt,
                                id_pk: id_pk,
                                id_hpk: id_hpk,
                            },
                            success: function(data) {
                                document.location.href = "<?= base_url('petugas'); ?>";
                                // $('#bayar').modal('show')
                            }
                        });
                    }
                })

                return false;
            })


            $('#dibayar').keyup(function() {
                var ttl = $("#total").val();
                var byr = $("#byr").val();
                var kembali = parseInt(byr) - parseInt(ttl);

                var reversee = kembali.toString().split('').reverse().join(''),
                    kembali_total = reversee.match(/\d{1,3}/g);
                kembali_total = kembali_total.join('.').split('').reverse().join('');
                if (parseInt(ttl) > parseInt(byr)) {
                    $('#kembali').val('Rp - ' + kembali_total);
                } else {
                    $('#kembali').val("Rp " + kembali_total);
                }
            });

            $('.btn_simpan').click(function() {
                var total = $('#totalrental').val();
                var byr = $('#byr').val();
                var lamarental = $('#lamarental').val();
                var id_r = $('#id_r').val();
                var id_m = $('#id_m').val();
                var kode = $('#kode').val();
                var sts = "save";
                save(total, byr, lamarental, id_r, id_m, sts, kode);
            });

            $('.btn_cetak').click(function() {
                var total = $('#totalrental').val();
                var byr = $('#byr').val();
                var lamarental = $('#lamarental').val();
                var id_r = $('#id_r').val();
                var id_m = $('#id_m').val();
                var kode = $('#kode').val();
                var sts = "print";
                save(total, byr, lamarental, id_r, id_m, sts, kode);
            })

            $('#datarental').on('click', '.btn_print', function() {
                var kode = $(this).attr('data-kd');
                print(kode);
            });

            function save(total, byr, lamarental, id_r, id_m, sts, kode) {
                if (total == 0) {
                    toastr.error("Data rental masih kosong");
                } else if (byr == 0) {
                    toastr.error("Ketik jumlah pembayaran");
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url('petugas/simpan_pembayaran_rental'); ?>',
                        dataType: 'JSON',
                        data: {
                            total: total,
                            byr: byr,
                            lamarental: lamarental,
                            id_r: id_r,
                            id_m: id_m,
                            kode: kode,
                        },
                        success: function(data) {
                            if (sts == 'save') {
                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil...",
                                    text: "Pembayaran rental berhasil disimpan.",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.location.href = "<?= base_url('petugas'); ?>";
                                    }
                                });
                            } else {
                                print(kode);
                            }
                        }
                    });
                }
                return false;
            }

            function print(kode) {
                // $('#load').hide();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('petugas/print') ?>",
                    data: {
                        kode: kode
                    },
                    cache: false,
                    success: function(data) {
                        $('.tampilkan_data').html(data);

                        let timerInterval;
                        Swal.fire({
                            title: 'Proses pencarian data...',
                            html: 'Mohon tunggu <b></b> milliseconds.',
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                                const timer = Swal.getPopup().querySelector("b");
                                timerInterval = setInterval(() => {
                                    timer.textContent = `${Swal.getTimerLeft()}`;
                                }, 100);
                            },
                            willClose: () => {
                                clearInterval(timerInterval);
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                $('#load').hide();
                                $('#data-print').printArea();
                                document.location.href = "<?= base_url('petugas'); ?>";
                            }
                        });
                    }
                });
                return false;
            }



            $('#datarental').on('click', '.btn_edit', function() {
                var kode = $(this).attr('data-kd');
                var nm = $(this).attr('data-nm');
                Swal.fire({
                    title: "Edit Data Rental!",
                    text: "Atas nama >> " + nm + " << Pastikan data yang anda pilih sudah benar!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Edit!"
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: 'POST',
                            url: '<?= base_url('petugas/edit_rental'); ?>',
                            dataType: 'JSON',
                            data: {
                                kode: kode,
                            },
                            success: function(data) {
                                rental();
                                Swal.fire({
                                    title: "Berhasil!",
                                    text: "Data telah ditampilakan kembali.",
                                    icon: "success"
                                })(function() {
                                    document.location.href = "<?= base_url('petugas'); ?>";
                                });
                            }
                        });

                    }
                });
            });

            $('#datarental').on('click', '.btn_hapus', function() {
                var kode = $(this).attr('data-kd');
                var nm = $(this).attr('data-nm');
                var idm = $(this).attr('data-idm');
                var idr = $(this).attr('data-idr');
                var idpk = $(this).attr('data-idpk');
                Swal.fire({
                    title: 'Apa kamu yakin?',
                    text: "Atas nama >> " + nm + " << Pastikan data yang anda pilih sudah benar!",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: 'POST',
                            url: '<?= base_url('petugas/hapus_rental'); ?>',
                            dataType: 'JSON',
                            data: {
                                idm: idm,
                                idr: idr,
                                idpk: idpk,
                                kode: kode,
                            },
                            success: function(data) {
                                Swal.fire({
                                    title: "Berhasil!",
                                    text: "Data telah ditampilakan kembali.",
                                    icon: "success"
                                })
                                document.location.href = "<?= base_url('petugas'); ?>";
                            }
                        });
                    }
                    return false;
                });
            })

        });
    })(jQuery);
</script>