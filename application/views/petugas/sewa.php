<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-xl-8">
            <div class="bg-secondary rounded  p-2 h-100" style="border: 1px solid white;">
                <a href="<?= site_url('petugas/member'); ?>"><button class="btn  btn-success float-end ms-2"><i class="fa fa-users me-2"></i> Tambah Member Baru?</button></a>
                <h6 class="mb-2">DATA SEWA HARIAN</h6>
                <br>
                <div class="table-responsive bg-white" style="height: 760px;">
                    <table class="table  tab" style="font-size: 14px;">
                        <thead>
                            <tr>
                                <th width="1%">NO</th>
                                <th>ID MEMBER</th>
                                <th>ATAS NAMA</th>
                                <th>JENIS PS</th>
                                <th>TANGGAL SEWA</th>
                                <th>BATAS WAKTU </th>
                                <th>STATUS SEWA</th>
                                <th> TOTAL</th>
                                <th width="10%">OPSI</th>
                            </tr>
                        </thead>
                        <tbody id="sewaaktif">
                            <?php $no = 1; ?>
                            <?php foreach ($tran as $t) {
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
                                <tr id="hidd<?= $t->kode_sewa; ?>">
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td class="text-center"><?= $t->idmember; ?></td>
                                    <td><?= $t->nama_maktif; ?></td>
                                    <td class="text-center"><?= $t->jenis_ps; ?></td>
                                    <td><?= format_indo($t->dari_tanggal) ?></td>
                                    <td><?= format_indo($t->sampai_tanggal) ?></td>
                                    <td class="text-left">
                                        <h6 style="color: red; margin-bottom: -1px; font-size: 17px;">
                                            <span id="waktu<?= $t->id_sewaps ?>"><?= $timestampg; ?></span>
                                            <span id="sewa<?= $t->id_sewaps ?>"></span> <span id="jam<?= $t->id_sewaps ?>"> Jam</span>
                                        </h6>
                                    </td>
                                    <td><?= number_format($t->total); ?> - <?= $sts; ?></td>
                                    <td class="text-center">
                                        <!-- Example single danger button -->
                                        <div class="btn-group w-100">
                                            <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                OPSI
                                            </button>
                                            <ul class="dropdown-menu">



                                                <li><a data-kd="<?= $t->kode_sewa; ?>" class="dropdown-item detail_data" href="#"><i class="fa fa-search me-2"></i> DETAIL DATA</a>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a data-id="<?= $t->kode_sewa; ?>" class="dropdown-item btn_print" href="#"><i class="fa fa-print me-2"></i> PRINT DATA</a>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a data-bs-toggle="modal" data-bs-target="#tambahsewa<?= $t->kode_sewa; ?>" class="dropdown-item" href="#"><i class="fa fa-clock me-2"></i>TAMBAH WAKTU SEWA</a>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a data-nm="<?= $t->nama_maktif; ?>" data-id="<?= $t->kode_sewa; ?>" class="dropdown-item btn_kembali" href="#"><i class="fa fa-bullseye me-2"></i>UPDATE PS DIKEMBALIKAN</a>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <?php if ($log->level == 1) {; ?>
                                                    <li><a data-id="<?= $t->id_sewaps; ?>" data-kd="<?= $t->kode_sewa; ?>" data-nm="<?= $t->nama_maktif; ?>" class="dropdown-item btn_hapus" href="#"><i class="fa fa-trash me-2"></i> HAPUS DATA</a>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                <?php }; ?>
                                            </ul>
                                        </div>
                                    </td>
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


        <div class="col-xl-4">
            <div class="bg-secondary rounded h-100 p-4" style="border: 1px solid white; min-height: 87vh;">
                <h6 class="modal-title bg-secondary w-100 pb-4" id="staticBackdropLabel">TOTAL <span class="float-end me-4" id="ttlrp" style="font-size: 35px;">Rp 0</span></h6>
                <hr>
                <div class="mb-3 ">

                    <label for="staticEmail" class=" col-form-label text-white">ID MEMBER</label>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#namamember" class="float-end btn btn-sm btn-primary"><i class="fa fa-search me-2"></i>Cari dengan nama </a>
                    <input type="text" name="memid" class="form-control text-white" id="kodememaktif" autofocus placeholder="ID Member...." style="border: 1px solid white;">
                    <!-- <small hidden id="info" class="text-danger">ID tidak ditemukan</small> -->
                    <small class="text-danger" id="hasill" hidden><i class="fa fa-spinner fa-spin"></i> <span class="blink">Loading....</span></small>

                </div>
                <div class="mb-3">
                    <label for="" class="form-label text-white">ATAS NAMA</label>
                    <input type="text" id="nm" class="form-control text-dark bg-white" placeholder="Atas Nama....." readonly>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label text-white">ALAMAT</label>
                    <textarea class="form-control text-dark bg-white" id="alamat" placeholder="Alamat...." readonly></textarea>
                </div>
                <hr>
                <div class="mb-3">
                    <div class="form-check form-check-inline text-info">
                        <input class="form-check-input " type="radio" name="inlineRadioOptions" id="harian" value="h" checked>
                        <label class="form-check-label" for="inlineRadio1">SEWA PS HARIAN</label>
                    </div>
                    <div class="form-check form-check-inline text-info ">
                        <input class="form-check-input " type="radio" name="inlineRadioOptions" id="bulanan" value="b">
                        <label class="form-check-label" for="inlineRadio2">SEWA PS MINGGUAN / BULANAN</label>
                    </div>
                </div>
                <script>
                    $('#harian').change(function() {
                        var cek = $(this).val();
                        $('#sewaharian').attr('hidden', false);
                        $('#sewabulanan').attr('hidden', true);
                        $('#idform').val('h');
                    });
                    $('#bulanan').change(function() {
                        var cek = $(this).val();
                        $('#sewabulanan').attr('hidden', false);
                        $('#sewaharian').attr('hidden', true);
                        $('#idform').val('b');
                    })
                </script>
                <input type="hidden" name="" id="idform" value="h">
                <!-- harian -->
                <div class="row" id="sewaharian">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="" class="form-label text-white">PILIH PS</label>
                            <select name="ps" id="ps" class="form-select text-white" aria-label="Default select example " style="border:1px solid white">
                                <option value="">Pilih PS</option>
                                <?php foreach ($swa as $s) {; ?>
                                    <option value="<?= $s->idps; ?>"><?= $s->jenis_ps; ?></option>
                                <?php }; ?>
                            </select>
                            <small hidden id="pil" class="text-danger">Pilih PS.....</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="" class="form-label text-white">JML HARI</label>
                            <div class="input-group w-100">
                                <button type="button" class="btn  btn-danger input-group-text" id="minus">-</button>
                                <input type="text" id="hari" class="form-control form-control-sm text-center  bg-white" readonly style="border:0px" value="1">
                                <button type="button" class="btn  btn-success input-group-text" id="plus">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="" class="form-label text-white">HARGA </label>
                            <input type="text" id="harga" class="form-control text-dark bg-white text-end" placeholder="Rp. 0" readonly>
                            <input type="hidden" name="" id="hrgas">
                            <!-- <input type="hidden" name="" id="menit"> -->
                            <input type="hidden" name="" id="hrgjml">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label for="" class="form-label text-white">KEMBALI</label>
                            <input type="text" id="kembali" class="form-control form-control-lg numbers bg-white text-end" placeholder="Rp 0" readonly>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="mb-3">
                            <label for="" class="form-label text-white">DIBAYAR</label>
                            <input type="text" id="dibayar" class="form-control form-control-lg  rupiah text-white text-end" placeholder="Rp 0" style="border:1px solid white">
                            <input type="hidden" name="byr" id="byr">
                        </div>
                    </div>
                </div>
                <!-- end harian -->

                <!-- bulanan -->
                <div class="row" id="sewabulanan" hidden>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="" class="form-label text-white">PILIH PS</label>
                            <select name="ps2" id="ps2" class="form-select text-white" aria-label="Default select example " style="border:1px solid white">
                                <option value="">Pilih PS</option>
                                <?php foreach ($swa as $s) {; ?>
                                    <option value="<?= $s->idps; ?>"><?= $s->jenis_ps; ?></option>
                                <?php }; ?>
                            </select>
                            <small hidden id="pil" class="text-danger">Pilih PS.....</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="" class="form-label text-white">DARI TANGGAL </label>
                            <input type="date" id="tgl1" class="form-control  text-dark bg-white" value="<?= date('Y-m-d'); ?>">
                            <input type="hidden" id="tgl1br">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="" class="form-label text-white">SAMPAI TANGGAL </label>
                            <input type="date" id="tgl2" class="form-control  text-dark bg-white" value="<?= date('Y-m-d'); ?>">
                            <input type="hidden" id="tgl2br">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="" class="form-label text-white">JML HARI </label>
                            <input type="text" id="harimanual" class="form-control form-control-lg text-dark " readonly>
                            <input type="hidden" id="hrmanual">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <div class="form-check form-switch mb-2">
                                <label class="form-check-label text-white" for="flexSwitchCheckDefault">HARGA BARU</label>
                                <input class="form-check-input" type="checkbox" role="switch" id="switch" style="border:1px solid white">
                            </div>
                            <input type="text" id="hargamanual" class="form-control form-control-lg text-dark text-end rupiah" placeholder="Rp. 0" readonly>
                            <input type="hidden" id="hrgmanual">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label for="" class="form-label text-white">DIBAYAR</label>
                            <input type="text" id="dibayarmanual" class="form-control form-control-lg text-white text-end rupiah" placeholder="Rp. 0">
                            <input type="hidden" id="byrmanual">
                        </div>
                    </div>



                </div>
                <!-- end bulanan -->



                <div class="row ">
                    <hr>
                    <div class="col-md-4">
                        <button id="reset" class="btn btn-danger btn-lg w-100 "><i class="fa fa-spinner me-2"></i> RESET</button>
                    </div>
                    <div class="col-md-4">
                        <button id="simpan" class="btn btn-success btn-lg w-100 "><i class="fa fa-save me-2"></i> SIMPAN</button>
                    </div>
                    <div class="col-md-4">
                        <button id="cetak" class="btn btn-dark btn-lg w-100"><i class="fa fa-print me-2"></i> CETAK</button>
                    </div>
                </div>
                <hr>
                <div class="row">

                    <div class="col-md-6">
                        <button data-bs-toggle="modal" data-bs-target="#data_sewa" class="btn btn-outline-primary btn-lg w-100 " style="height: 75px;"><i class="fa fa-database me-2"></i> DATA SEWA</button>
                    </div>
                    <div class="col-md-6">
                        <button data-bs-toggle="modal" data-bs-target="#listharga" class="btn btn-outline-primary btn-lg w-100" style="height: 75px;"><i class="fa fa-file me-2"></i> LIST HARGA SEWA</button>
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


<!-- Modal cari member-->
<div class="modal fade" id="namamember" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content  " style="border: 3px solid red;">
            <div class="modal-header ">
                <input type="text" name="" id="cari" class="form-control form-control-lg text-white" placeholder="Cari dengan nama.......">
            </div>
            <div class="modal-body ">
                <div class="table-responsive">
                    <table class="table tab">
                        <thead>
                            <tr>
                                <th width="13.%">ID MEMBER</th>
                                <th width="25%">NAMA LENGKAP</th>
                                <th width="13%">TELP-/HP</th>
                                <th>ALAMAT</th>
                                <th width="13%">PILIH</th>
                            </tr>
                        </thead>
                        <tbody id="caridata">

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


<!-- Modal tambah sewa-->
<div id="tamabahsewa">
    <?php foreach ($tran as $t) { ?>
        <div class="modal fade" id="tambahsewa<?= $t->kode_sewa; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content  " style="border: 3px solid red;">
                    <div class="modal-header">
                        <h5 class="modal-title text-secondary" id="staticBackdropLabel">TAMBAH SEWA PS <span class="float-end"> - KODE : <?= $t->kode_sewa; ?></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <table style="width: 100%; " class="text-dark">
                            <tr>
                                <td width="40%">ID MEMBER</td>
                                <td width="3%">:</td>
                                <td><?= $t->kode_maktif; ?></td>
                            </tr>

                            <tr>
                                <td>NAMA MEMBER</td>
                                <td width="3%">:</td>
                                <td><?= $t->nama_maktif; ?></td>
                            </tr>
                            <tr>
                                <td>SEWA PS</td>
                                <td width="3%">:</td>
                                <td><?= $t->jenis_ps; ?></td>
                            </tr>
                            <?php

                            ?>
                            <tr>
                                <td>LAMA SEWA </td>
                                <td width="3%">:</td>
                                <td><?= $t->jml_hari; ?> Hari</td>
                            </tr>
                            <tr>
                                <td>TOTAL</td>
                                <td width="3%">:</td>
                                <td>Rp. <?= number_format($t->total); ?></td>
                            </tr>
                            <?php $dibayar = (($t->dibayar >= $t->total) ? $t->total : $t->dibayar); ?>
                            <tr>
                                <td>DIBAYAR</td>
                                <td width="3%">:</td>
                                <td>Rp. <?= number_format($dibayar); ?></td>
                            </tr>
                            <?php
                            $siss = (($t->dibayar >= $t->total) ? $t->dibayar - $t->total : $t->total - $t->dibayar)
                            ?>
                            <tr>
                                <td>SISA</td>
                                <td width="3%">:</td>
                                <td>Rp. <?= number_format($siss); ?></td>
                                <input type="hidden" name="" id="sisa<?= $t->id_sewaps; ?>" value="<?= $siss; ?>">
                            </tr>

                        </table>
                        <hr>
                        <div class="row bg-secondary rounded">
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <h5>TOTAL + SISA:</h5>
                                    <h1 style="float: right; font-size: 40px; font-weight: 900; " id="ttlrp<?= $t->id_sewaps; ?>">Rp.0</h1>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="" class="form-label text-white">JML HARI</label>
                                    <div class="input-group w-100">
                                        <button type="button" data-ps="<?= $t->idps; ?>" data-id="<?= $t->id_sewaps; ?>" class="btn  btn-danger input-group-text" id="minus">-</button>
                                        <input type="text" id="hari<?= $t->id_sewaps; ?>" class="form-control form-control-sm text-center  bg-white" readonly style="border:0px" value="0">
                                        <button type="button" data-ps="<?= $t->idps; ?>" data-id="<?= $t->id_sewaps; ?>" class="btn  btn-success input-group-text" id="plus">+</button>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="" id="hrgjml<?= $t->id_sewaps; ?>">
                            <input type="hidden" name="" id="hrgas<?= $t->id_sewaps; ?>">
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label for="" class="form-label text-white">HARGA </label>
                                    <input type="text" id="hargat<?= $t->id_sewaps; ?>" class="form-control   bg-white text-end" placeholder="Rp 0" readonly>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="" class="form-label text-white">KEMBALI</label>
                                    <input type="text" id="kembali<?= $t->id_sewaps; ?>" class="form-control form-control-lg  bg-white text-end" placeholder="Rp 0" readonly>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label for="" class="form-label text-white">DIBAYAR</label>
                                    <input type="text" data-id="<?= $t->id_sewaps; ?>" id="pembayaran" class="form-control form-control-lg rupiah text-white text-end bayar<?= $t->id_sewaps; ?>" placeholder="Rp 0" style="border:1px solid white">
                                    <input type="hidden" name="" id="byras<?= $t->id_sewaps; ?>">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                        <button data-stg="<?= $t->sampai_tanggal; ?>" data-id="<?= $t->id_sewaps; ?>" data-kd="<?= $t->kode_sewa; ?>" class="btn btn-success btn-ld  tambah_save"><i class="fa fa-save me-2"></i> SAVE</button>
                        <button data-stg="<?= $t->sampai_tanggal; ?>" data-id="<?= $t->id_sewaps; ?>" data-kd="<?= $t->kode_sewa; ?>" class="btn btn-dark btn-ld  tambah_print"><i class="fa fa-print me-2"></i> PRINT</button>
                    </div>
                </div>
            </div>
        </div>
    <?php }; ?>
</div>

<!-- Modal pelunasan sewa-->
<div class="modal fade" id="pelunasan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content  " style="border: 3px solid red;">
            <div class="modal-header">
                <h5 class="modal-title text-secondary" id="staticBackdropLabel">PELUNASAN SEWA PS <span class="float-end"> - KODE : <span id="kodepelunasan">0</span></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <table style="width: 100%; " class="text-dark">
                    <tr>
                        <td width="40%">ID MEMBER</td>
                        <td width="3%">:</td>
                        <td id="memberid"></td>
                    </tr>
                    <tr>
                        <td>NAMA MEMBER</td>
                        <td width="3%">:</td>
                        <td id="namamemberpl"></td>
                    </tr>
                    <tr>
                        <td>JENIS PS</td>
                        <td width="3%">:</td>
                        <td id="jnsps"></td>
                    </tr>
                    <tr>
                        <td>LAMA SEWA </td>
                        <td width="3%">:</td>
                        <td><span id="lm"></span> Hari</td>
                    </tr>
                    <tr>
                        <td>TOTAL </td>
                        <td width="3%">:</td>
                        <td id="ttlpl"></td>
                    </tr>
                    <tr>
                        <td>TERBAYAR</td>
                        <td width="3%">:</td>
                        <td id="byrpl"></td>
                    </tr>

                </table>
                <hr>
                <div class="row bg-secondary rounded">
                    <div class="col-md-12">
                        <div class="mb-2">
                            <h5>SISA PEMBAYARAN:</h5>
                            <h1 style="float: right; font-size: 40px; font-weight: 900; " id="ttlrppl">Rp.0</h1>
                        </div>
                    </div>

                    <hr>
                    <input type="hidden" name="" id="kodebayarpelunasan">
                    <input type="hidden" name="" id="ttlpel">
                    <input type="hidden" name="" id="sisapel">
                    <!-- <input type="hidden" name="" id="kodebayarpelunasan"> -->

                    <div class="col-md-5">
                        <div class="mb-3">
                            <label for="" class="form-label text-white">KEMBALI</label>
                            <input type="text" id="kembalipel" class="form-control form-control-lg  bg-white text-end" placeholder="Rp 0" readonly>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="mb-3">
                            <label for="" class="form-label text-white">DIBAYAR</label>
                            <input type="text" id="dibayarpel" class="form-control form-control-lg rupiah text-white text-end " placeholder="Rp 0" style="border:1px solid white">
                            <input type="hidden" name="" id="dbypel">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success btn_simpanpelunasan" data-bs-dismiss="modal"><i class="fa fa-save me-2"></i> SIMPAN </button>
                <button type="button" class="btn btn-dark btn_cetakpelunasan" data-bs-dismiss="modal"><i class="fa fa-print me-2"></i> CETAK </button>
            </div>
        </div>
    </div>
</div>


<!-- Modal data sewa-->
<div class="modal fade" id="data_sewa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content  " style="border: 3px solid red;">
            <div class="modal-header">
                <h5 class="modal-title text-secondary" id="staticBackdropLabel">DATA SEWA PS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="table-responsive">
                    <table class="table tab" style="font-size: 13px; ">
                        <thead>
                            <tr>
                                <th width=" 2%">NO</th>
                                <th width="6%">KODE</th>
                                <th width="9%">ID MEMBER</th>
                                <th width="15%">NAMA LENGKAP</th>
                                <th width="8%">JENIS PS</th>
                                <th width="10%">LAMA SEWA</th>
                                <th>TGL. SEWA</th>
                                <th>DIKEMBALIKAN</th>
                                <th>TOTAL</th>
                                <th width="12%">OPSI</th>
                            </tr>
                        </thead>
                        <tbody id="kdsw">
                            <?php $no = 1; ?>
                            <?php foreach ($kdsw as $d) {
                                $ke = $this->db->query("SELECT * FROM tb_sewakembali WHERE kodesewa='$d->kode_sewa' ")->row();

                            ?>
                                <tr id="hid2<?= $d->kode_sewa; ?>">
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td class="text-center"><?= $d->kode_sewa; ?></td>
                                    <td><?= $d->idmember; ?></td>
                                    <td><?= $d->nama_maktif; ?></td>
                                    <td class="text-center"><?= $d->jenis_ps; ?></td>
                                    <td><?= $d->jml_hari; ?> Hari</td>
                                    <td class="text-center"><?= date('d-m-Y H.i', strtotime($d->dari_tanggal)); ?></td>
                                    <td class="text-center"><?= date('d-m-Y H.i', strtotime($ke->tgl_sk)); ?></td>
                                    <td class="text-end"><?= number_format($d->total); ?></td>
                                    <td class="text-center">
                                        <button data-kd="<?= $d->kode_sewa; ?>" class="btn btn-sm btn-success detail_data2" data-toggle="tooltip" title="Detail Data Transaksi Sewa"><i class="fa fa-file"></i></button>
                                        <button data-id="<?= $d->id_sewaps; ?>" data-kd="<?= $d->kode_sewa; ?>" data-nm="<?= $d->nama_maktif; ?>" class="btn btn-sm btn-danger btn_hapus" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-trash"></i></button>
                                        <button data-kd="<?= $d->kode_sewa; ?>" class="btn btn-sm btn-dark btn_print" data-toggle="tooltip" title="Cetak Data"><i class="fa fa-print"></i></button>
                                    </td><span class="text-danger"></span>
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

<!-- Modal data list harga sewa-->
<div class="modal fade" id="listharga" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content  " style="border: 3px solid red;">
            <div class="modal-header">
                <h5 class="modal-title text-secondary" id="staticBackdropLabel">LIET HARGA SEWA PS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="table-responsive">
                    <table class="table tab">
                        <thead>
                            <tr>
                                <th width="13.%">JENIS PS</th>
                                <th width="25%">JML HARI</th>
                                <th width="13%">HARGA</th>
                                <th>KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody id="list_harga">
                            <?php $no = 1; ?>
                            <?php foreach ($list as $s) {; ?>
                                <tr>
                                    <td class="text-center" style="background-color: aquamarine !important; font-size: 30px !important; font-weight: 900 !important;"><?= $s->jenis_ps; ?></td>
                                    <td class="text-center"><?= $s->jml_hari; ?> Hari</td>
                                    <td class="text-end"><?= number_format($s->harga_sewa); ?> </td>
                                    <td class="text-start"><?= $s->keterangan; ?></td>
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

<script>
    // detail sewa
    $('#sewaaktif').on('click', '.detail_data', function() {
        var kode = $(this).attr('data-kd');
        detail(kode);
        $("#data_sewa").modal("hide");
    });

    // proses pencarian detail sewa
    function detail(kode) {
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
        return true;
    }

    $('#kdsw').on('click', '.detail_data2', function() {
        var kode = $(this).attr('data-kd');
        detail(kode);
        $("#data_sewa").modal("hide");
    })

    // proses update status ps dikembalikan
    $('#sewaaktif').on('click', '.btn_kembali', function() {
        var kode = $(this).attr('data-id');
        var nm = $(this).attr('data-nm');
        Swal.fire({
            title: 'Pastikan dengan benar!',
            text: "Member atas nama ( " + nm + " ) dengan Kode Sewa " + kode + "  Telah mengembalikan PS!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Benar!"
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('petugas/ps_kembali'); ?>',
                    dataType: 'JSON',
                    data: {
                        kode: kode,
                    },
                    success: function(data) {
                        if (data.hasil == 'lunas') {
                            alert('Update status PS kembali berhasil disimpan.....');
                            document.location.href = "<?= base_url('petugas/sewa'); ?>";
                        } else if (data.hasil == 'belumlunas') {
                            $('#kodepelunasan').html(data.kode);
                            $('#kodebayarpelunasan').val(data.kode);

                            $('#memberid').html(data.memberid);
                            $('#namamemberpl').html(data.namamemberpl);
                            $('#jnsps').html(data.jnsps);
                            $('#lm').html(data.jmlhari);

                            $('#ttlpl').html(data.hargarp);
                            $('#byrpl').html(data.dibayarrp);
                            $('#ttlrppl').html(data.sisarp);

                            $('#ttlpel').val(data.harga);
                            $('#sisapel').val(data.sisa);


                            $('#pelunasan').modal('show');
                        }

                    }
                });

            }
        });
    });

    (function($) {
        $(document).ready(function() {

            // cari member
            $('#kodememaktif').keyup(function() {
                var id = $(this).val();
                $('#info').attr('hidden', true);

                if (id == '') {
                    // $('#info').attr('hidden', true);
                    $('#hasill').attr('hidden', true);
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url('petugas/cekmemberaktif'); ?>',
                        dataType: 'JSON',
                        data: {
                            id: id
                        },
                        success: function(data) {
                            if (data.hasil == 'ada') {
                                // $('#info').attr('hidden', true);
                                $('#hasill').attr('hidden', true);
                                $('#nm').val(data.an);
                                $('#alamat').val(data.alamat);

                            } else if (data.hasil == 'kosong') {
                                $('#hasill').attr('hidden', false);
                            }
                        }
                    });
                }
            });

            // function cekdata(data1, data2) {
            //     setInterval(function() {
            //         $('#hasill').attr('hidden', data1);
            //         $('#info').attr('hidden', data2);
            //     }, 3000);
            // }

            // cari member dengan nama
            $('#cari').keyup(function() {
                var kata = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('petugas/cari'); ?>',
                    data: {
                        kata: kata,
                    },
                    success: function(data) {
                        $('#caridata').html(data);
                    }
                });
            });

            // pilih data member
            $('#caridata').on('click', '.btn_pilih', function() {
                var id = $(this).attr('data-kd');
                var nm = $(this).attr('data-nm');
                var alm = $(this).attr('data-alm');

                $('#kodememaktif').val(id);
                $('#nm').val(nm);
                $('#alamat').val(alm);
            });

            // pilih PS
            $('#ps').change(function() {
                var id = $(this).val();
                if (id == '') {
                    toastr.error("Pilih PS dengan benar!, Data tidak di temukan");
                    $('#pil').attr('hidden', false);
                } else {
                    $('#pil').attr('hidden', true);

                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url('petugas/cekps'); ?>',
                        dataType: 'JSON',
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            $('#ttlrp').html(data.harga);
                            $('#harga').val(data.harga);
                            $('#hrgas').val(data.hrgas);
                            $('#hrgjml').val(data.hrgas);

                            $('#hari').val(1)
                        }
                    });
                }

            });

            // plus
            $("#plus").click(function() {
                var hr = $('#hari').val();
                var hari = parseInt(hr) + 1;
                var ps = $('#ps').val();
                hitung_harga(hari, ps);
            });

            // minus
            $("#minus").click(function() {
                var hr = $('#hari').val();
                var ps = $('#ps').val();
                var hari = parseInt(hr) - 1;
                if (hr == 1) {} else {
                    hitung_harga(hari, ps);
                }
            });

            // hitung total harga sewa
            function hitung_harga(hari, ps) {
                var sisa = 0;
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('petugas/cekhari'); ?>',
                    dataType: 'json',
                    data: {
                        hari: hari,
                        ps: ps,
                        sisa: sisa,
                    },
                    success: function(data) {
                        $('#ttlrp').html(data.harga);
                        $('#harga').val(data.harga);
                        $('#hrgas').val(data.hrgas);
                        $('#hrgjml').val(data.hrgas);
                        $('#hari').val(hari);
                    }
                });
            }

            // hitung pembayaran 
            $('#dibayar').keyup(function() {
                // buang titik
                var ttk = ".";
                var h = $(this).val();
                var dby = h.replaceAll(ttk, "");
                $('#byr').val(dby);

                var jml = $('#hrgjml').val();
                var jmlkem = parseInt(jml) - parseInt(dby);

                var reversee = jmlkem.toString().split('').reverse().join(''),
                    jmlkem_ttl = reversee.match(/\d{1,3}/g);
                jmlkem_ttl = jmlkem_ttl.join('.').split('').reverse().join('');
                if (parseInt(jml) > parseInt(dby)) {
                    $('#kembali').val('Rp - ' + jmlkem_ttl);
                } else {
                    $('#kembali').val('Rp ' + jmlkem_ttl);
                }

            });

            // simnpan data sewa
            $('#simpan').click(function() {
                var cekform = $('#idform').val();
                if (cekform == 'h') {
                    var idps = $('#ps').val();
                    var hrg = $('#hrgjml').val();
                    var dby = $('#byr').val();
                    var hari = $('#hari').val();
                    var kode = $('#kodememaktif').val();
                    var save = 'simpan';
                    simpan(idps, hrg, hari, kode, dby, save);
                } else if (cekform == 'b') {
                    var idps = $('#ps2').val();
                    var hrg = $('#hrgmanual').val();
                    var dby = $('#byrmanual').val();
                    var hari = $('#hrmanual').val();
                    var kode = $('#kodememaktif').val();
                    var save = 'simpan';
                    simpan(idps, hrg, hari, kode, dby, save);
                }
            });

            // simpan + cetak data sewa
            $('#cetak').click(function() {
                var cekform = $('#idform').val();
                if (cekform == 'h') {
                    var idps = $('#ps').val();
                    var hrg = $('#hrgjml').val();
                    var dby = $('#byr').val();
                    var hari = $('#hari').val();
                    var kode = $('#kodememaktif').val();
                    var save = 'cetak';
                    simpan(idps, hrg, hari, kode, dby, save);
                } else if (cekform == 'b') {
                    var idps = $('#ps2').val();
                    var hrg = $('#hrgmanual').val();
                    var dby = $('#byrmanual').val();
                    var hari = $('#hrmanual').val();
                    var kode = $('#kodememaktif').val();
                    var save = 'cetak';
                    simpan(idps, hrg, hari, kode, dby, save);
                }
            });

            // sewa ps bulanan

            // pilih tgl ps2
            $('#ps2').change(function() {
                hitung_hari()
            });

            // input harga manual
            $('#switch').click(function() {
                if ($(this).is(':checked')) {
                    $('#hargamanual').attr('readonly', false);
                    $('#hargamanual').addClass('text-white');
                    $('#hargamanual').removeClass('text-dark');
                    $('#hargamanual').val('');
                } else {
                    $('#hargamanual').attr('readonly', true);
                    $('#hargamanual').addClass('text-dark');
                    $('#hargamanual').removeClass('text-white');
                    hitung_hari()
                }
            });

            // pilih tgl 1
            $('#tgl1').change(function() {
                hitung_hari()
            });

            // pilih tgl 2
            $('#tgl2').change(function() {
                hitung_hari()
            });

            // hitung hari untuk bulanan
            function hitung_hari() {
                var tgl1 = $('#tgl1').val();
                var tgl2 = $('#tgl2').val();
                var ps = $('#ps2').val();

                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('petugas/cek_harga_manual'); ?>',
                    dataType: 'JSON',
                    data: {
                        ps: ps,
                        tgl1: tgl1,
                        tgl2: tgl2,
                    },
                    success: function(data) {
                        $('#ttlrp').html(data.harga);
                        $('#hargamanual').val(data.harga);
                        $('#harimanual').val(data.hari);
                        $('#hrgmanual').val(data.hrgas);
                        $('#hrmanual').val(data.harias);
                    }
                });
            }

            // hitung pembayaran
            $('#dibayarmanual').keyup(function() {
                var ttk = ".";
                var h = $(this).val();
                var dby = h.replaceAll(ttk, "");
                $('#byrmanual').val(dby);
            })

            $('#hargamanual').keyup(function() {
                var ttk = ".";
                var h = $(this).val();
                var dby = h.replaceAll(ttk, "");
                $('#hrgmanual').val(dby);
            })

            // proses simapn
            function simpan(idps, hrg, hari, kode, dby, save) {
                if (kode == '') {
                    toastr.error("Data ID member masih kosong");
                } else if (idps == '') {
                    toastr.error("Data PS belum dipilih");
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url('petugas/simpansewaps'); ?>',
                        dataType: 'JSON',
                        data: {
                            idps: idps,
                            hrg: hrg,
                            hari: hari,
                            kode: kode,
                            dby: dby,
                        },
                        success: function(data) {
                            if (save == 'simpan') {

                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil...",
                                    text: "Transaksi Sewa PS berhasil disimpan.",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.location.href = "<?= base_url('petugas/sewa'); ?>";
                                    }
                                });

                            } else if (save == 'cetak') {
                                print(data);
                            }
                        }
                    });
                }
            }

            // proses cetak
            function print(kode) {
                // $('#load').hide();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('petugas/print_sewaps') ?>",
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
                                document.location.href = "<?= base_url('petugas/sewa'); ?>";
                            }
                        });
                    }
                });
            }

            // reset
            $('#reset').click(function() {
                // alert();
                $('#ttlrp').html('');
                $('#harga').val('');
                $('#hrgas').val('');
                $('#hrgjml').val('');
                $('#menit').val('');

                $('#hari').val(1);
                $('#kodememaktif').val('')
                $('#kodememaktif').focus()
                $('#nm').val('');
                $('#alamat').val('');

                $('#harga').val('');
                $('#ttlrp').html('');

                $('#ps').val('');
                $('#hrgjml').val('');
                $('#dibayar').val('')
                $('#byr').val('');
                $('#kembali').val('');
                $('#info').attr('hidden', true);
                $('#hasill').attr('hidden', true);
            });




            // data sewa aktif
            // print ulang data sewa
            $('#sewaaktif').on('click', '.btn_print', function() {
                // alert();
                var kode = $(this).attr('data-id');
                print(kode);
            });

            // hapus data sewa
            $('#sewaaktif').on('click', '.btn_hapus', function() {
                var id = $(this).attr('data-id');
                var kode = $(this).attr('data-kd');
                var nm = $(this).attr('data-nm');
                hapus_sewa(id, kode, nm);
            });

            // proses hapus data sewa
            function hapus_sewa(id, kode, nm) {
                Swal.fire({
                    title: 'Pastikan dengan benar!',
                    text: "Member atas nama ( " + nm + " ) dengan Kode Sewa " + kode + "  akan dihapus.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: 'POST',
                            url: '<?= base_url('petugas/hapus_sewaps'); ?>',
                            dataType: 'JSON',
                            data: {
                                id: id,
                                kode: kode,
                            },
                            success: function(data) {
                                $('#hid' + kode).hide(1000);
                                $('#hid2' + kode).hide(1000);
                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil",
                                    text: "Data berhasil dihapus!",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.location.href = "<?= base_url('petugas/sewa'); ?>";
                                    }
                                });
                            }
                        });

                    }
                });
            }

            // proses pembayaran pelunasan
            $('#dibayarpel').keyup(function() {

                var ttk = ".";
                var h = $(this).val();
                var dby = h.replaceAll(ttk, "");
                $('#dbypel').val(dby);

                var ttl = $('#sisapel').val();
                var jmlkem = parseInt(ttl) - parseInt(dby);

                var reversee = jmlkem.toString().split('').reverse().join(''),
                    jmlkem_ttl = reversee.match(/\d{1,3}/g);
                jmlkem_ttl = jmlkem_ttl.join('.').split('').reverse().join('');
                if (parseInt(ttl) > parseInt(dby)) {
                    $('#kembalipel').val('Rp - ' + jmlkem_ttl);
                } else {
                    $('#kembalipel').val('Rp ' + jmlkem_ttl);
                }

            })

            // simpan data pelunasan
            $('.btn_simpanpelunasan').click(function() {
                var kode = $('#kodebayarpelunasan').val();
                var dby = $('#dbypel').val();
                var ttl = $('#ttlpel').val();
                var sisa = $('#sisapel').val();
                var sts = 'simpan';
                // alert(kode)
                sumpan_pelunasan(kode, dby, ttl, sisa, sts);
            });

            // cetak data pelunasan
            $('.btn_cetakpelunasan').click(function() {
                var kode = $('#kodebayarpelunasan').val();
                var dby = $('#dbypel').val();
                var ttl = $('#ttlpel').val();
                var sisa = $('#sisapel').val();
                var sts = 'cetak';
                sumpan_pelunasan(kode, dby, ttl, sisa, sts);
            });

            // proses simpan data pelunasan
            function sumpan_pelunasan(kode, dby, ttl, sisa, sts) {
                if (dby == '') {
                    toastr.error("Input jumlah pembayaran");
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url('petugas/updatepelunasan'); ?>',
                        dataType: 'JSON',
                        data: {
                            kode: kode,
                            dby: dby,
                            ttl: ttl,
                            sisa: sisa,
                        },
                        success: function(data) {
                            if (sts == 'simpan') {
                                $('#hidd' + kode).hide(1000);
                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil",
                                    text: "Data pembayaran berhasil disimpan!",
                                });
                            } else if (sts == 'cetak') {
                                print_pelunasan(kode);
                            }
                        }
                    });
                }
            }

            // cetak data pelunasan
            function print_pelunasan(kode) {

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('petugas/print_pelunasan') ?>",
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
                                document.location.href = "<?= base_url('petugas/sewa'); ?>";
                            }
                        });
                    }
                });
            }


            // tambah sewa
            // tambah sewa plus
            $('#tamabahsewa').on('click', '#plus', function() {
                var id = $(this).attr('data-id');
                var ps = $(this).attr('data-ps');
                var hr = $('#hari' + id).val();
                var sisa = $('#sisa' + id).val();
                var hari = parseInt(hr) + 1;
                hitung_tambah_sewa(hari, ps, id, sisa);
            });

            // tambah sewa minus
            $('#tamabahsewa').on('click', '#minus', function() {
                var id = $(this).attr('data-id');
                var ps = $(this).attr('data-ps');
                var hr = $('#hari' + id).val();
                var sisa = $('#sisa' + id).val();
                var hari = parseInt(hr) - 1;
                if (hr == 1) {} else {
                    hitung_tambah_sewa(hari, ps, id, sisa);
                }
            });

            // proses hitung tambah sewa 
            function hitung_tambah_sewa(hari, ps, id, sisa) {
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('petugas/cekhari'); ?>',
                    dataType: 'json',
                    data: {
                        hari: hari,
                        ps: ps,
                        sisa: sisa,
                    },
                    success: function(data) {
                        $('#ttlrp' + id).html(data.ttlrp);
                        $('#hrgjml' + id).val(data.ttl);
                        $('#hrgas' + id).val(data.hrgas);
                        $('#hari' + id).val(hari);
                        $('#hargat' + id).val(data.harga);

                    }
                });
            }

            // cek pembayaran tambah sewa
            $('#tamabahsewa').on('keyup', '#pembayaran', function() {
                var id = $(this).attr('data-id');
                // buang titik
                var ttk = ".";
                var h = $(this).val();
                var dby = h.replaceAll(ttk, "");
                $('#byras' + id).val(dby);

                var hrg = $('#hrgjml' + id).val();
                var jmlkem = parseInt(dby) - parseInt(hrg);

                var reversee = jmlkem.toString().split('').reverse().join(''),
                    jmlkem_ttl = reversee.match(/\d{1,3}/g);
                jmlkem_ttl = jmlkem_ttl.join('.').split('').reverse().join('');
                if (parseInt(hrg) > parseInt(dby)) {
                    $('#kembali' + id).val('Rp - ' + jmlkem_ttl);
                } else {
                    $('#kembali' + id).val('Rp ' + jmlkem_ttl);
                }
            });

            // proses simpan tambah sewa
            $('#tamabahsewa').on('click', '.tambah_save', function() {
                var id = $(this).attr('data-id');
                var kd = $(this).attr('data-kd');
                var tgl = $(this).attr('data-stg');
                var byr = $('#byras' + id).val();
                var hrg = $('#hrgas' + id).val();
                var hr = $('#hari' + id).val();
                var sisa = $('#sisa' + id).val();
                var sts = 'simapan';
                simpan_tambah_sewa(id, kd, byr, hrg, hr, tgl, sts, sisa);
            });

            // proses cetak tambah sewa
            $('#tamabahsewa').on('click', '.tambah_print', function() {
                var id = $(this).attr('data-id');
                var kd = $(this).attr('data-kd');
                var tgl = $(this).attr('data-stg');
                var byr = $('#byras' + id).val();
                var hrg = $('#hrgas' + id).val();
                var hr = $('#hari' + id).val();
                var sisa = $('#sisa' + id).val();
                var sts = 'cetak';
                simpan_tambah_sewa(id, kd, byr, hrg, hr, tgl, sts, sisa);
            });

            // proses input tambah sewa
            function simpan_tambah_sewa(id, kd, byr, hrg, hr, tgl, sts, sisa) {
                // alert(id);
                if (hrg == '') {
                    toastr.error("Tentukan jumlah hari dulu!!!");
                } else if (byr == '') {
                    toastr.error("Tentukan jumlah pembayaran!!!");
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url('petugas/simpan_tambah_sewa'); ?>',
                        dataType: 'json',
                        data: {
                            id: id,
                            kd: kd,
                            hr: hr,
                            hrg: hrg,
                            byr: byr,
                            tgl: tgl,
                            sisa: sisa,
                        },
                        success: function(data) {
                            if (sts == 'simapan') {
                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil...",
                                    text: "Tambah Waktu Sewa berhasil disimpan.",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.location.href = "<?= base_url('petugas/sewa'); ?>";
                                    }
                                });
                            } else if (sts == 'cetak') {
                                print(data);
                            }
                        }
                    });
                }
            }


            $('#kdsw').on('click', '.btn_hapus', function() {
                var kode = $(this).attr('data-kd');
                var id = $(this).attr('data-id');
                var nm = $(this).attr('data-nm');
                hapus_sewa(id, kode, nm)
            })

            $('#kdsw').on('click', '.btn_print', function() {
                var kode = $(this).attr('data-kd');
                print_pelunasan(kode)
            })


        })
    })(jQuery);
</script>