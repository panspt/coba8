<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-xl-4">
            <div class="bg-secondary rounded h-100 p-4" style="border: 1px solid azure;">
                <h1 class="float-end" style="position: relative; font-size: 30px; font-weight: 800 !important; color: white; margin-bottom: -10px; text-transform: uppercase;" id="kodepen">AUTO</h1>
                <p class="text-danger">KODE TRANSAKSI :</p>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="bg-secondary rounded h-100 p-4 " style="border: 1px solid azure;">
                <div class="">
                    <input type="text" id="kode" class="form-control form-control-lg text-white" placeholder="Kode Barang....." autofocus value="">
                    <small class="text-danger" id="hasil" hidden><i class="fa fa-spinner fa-spin"></i> <span class="blink">Loading....</span></small>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="bg-secondary rounded h-100 p-4 " style="border: 1px solid azure;">
                <h1 class="float-end" style="position: relative; font-size: 40px; font-weight: 800 !important; color: white;" id="ttl">Rp. 0</h1>
                <p class=" text-danger">TOTAL</p>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="bg-secondary rounded h-100 p-4 " style="border: 1px solid azure;">
                <div class="table-responsive" style="height: 335px; background-color: gainsboro; ">
                    <table class="table  tab table-head-fixed">
                        <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th>KODE BARANG</th>
                                <th>NAMA BARANG</th>
                                <th width="13%">QTY</th>
                                <th>HARGA</th>
                                <th>JUMLAH</th>
                                <?php if ($log->level == 1) {; ?>
                                    <th width="5%">#</th>
                                <?php }; ?>
                            </tr>
                        </thead>
                        <tbody id="cart">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="bg-secondary rounded h-100 p-4 " style="border: 1px solid azure;">
                <div class="mb-3">
                    <label for="" class="form-label text-white">PILIH PEMBAYARAN</label>
                    <select id="bayar" class="form-select text-white form-select-lg" aria-label="Default select example ">
                        <option value="">--Pilih Pembayaran--</option>
                        <option value="cash">Bayar Cash</option>
                        <?php foreach ($mem as $m) {; ?>
                            <option value="<?= $m->kode; ?>"><?= $m->nama; ?> - (<?= $m->nama_channel; ?>)</option>
                        <?php }; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label text-white">DIBAYAR</label>
                    <input type="text" id="dibayar" class="form-control form-control-lg  text-end numbers" placeholder="Rp.0">
                    <input type="hidden" name="" id="byr" value="0">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label text-white">KEMBALI</label>
                    <input type="text" id="kembali" class="form-control form-control-lg text-dark text-end" placeholder="Rp.0" disabled>
                    <input type="hidden" name="" id="ttl2" value="0">
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <button class="btn btn-danger btn-lg w-100 btn_refresh"><i class="fa fa-spinner me-2"></i> Refresh</button>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-success btn-lg w-100 btn_simpan"><i class="fa fa-save me-2"></i> Simpan</button>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-dark btn-lg w-100 btn_cetak"><i class="fa fa-print me-2"></i> Cetak</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12">
            <div class="bg-secondary rounded h-100 p-4 ">
                <br>
                <div class="table-responsive">
                    <table id="tab" class="table  tab">
                        <thead>
                            <tr>
                                <th width="3%">NO</th>
                                <th>KODE TRANSAKSI</th>
                                <th>TANGGAL</th>
                                <th>JENIS PEMBAYARAN</th>
                                <th width="8%">JML ITEM</th>
                                <th>TOTAL</th>
                                <th>DIBAYAR</th>
                                <th>KEMBALI</th>
                                <th width="10%">OPSI</th>
                            </tr>
                        </thead>
                        <tbody id="penjualan">
                            <?php $no = 1; ?>
                            <?php foreach ($pen as $p) {; ?>
                                <?php
                                $jmlker = $this->db->query("SELECT SUM(jml) as jum FROM tb_keranjang WHERE kodepenjualan='$p->kode_penjualan' GROUP BY kodepenjualan")->row();
                                $jml = (empty($jmlker->jum)) ? 0 : $jmlker->jum;
                                $mem = $this->db->query("SELECT * FROM tb_member WHERE kode='$p->kode_pembayaran' ")->row();
                                $member = (empty($mem->nama)) ? 'PEMBAYARAN CASH' : 'MEMBER ' . $mem->nama;
                                ?>
                                <tr id="hid<?= $p->id_penjualan; ?>">
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $p->kode_penjualan ?></td>
                                    <td><?= date('d-m-Y', strtotime($p->tgl_penjualan)); ?></td>
                                    <td><?= $member ?> </td>
                                    <td class="text-center"><?= $jml ?> Item</td>
                                    <td><?= number_format($p->jml_total) ?></td>
                                    <?php if ($p->sts_bayar == 'M') {; ?>
                                        <td><span class="text-primary">Proses menunggu...</span></td>
                                    <?php } else {; ?>
                                        <td class="text-end"><?= number_format($p->dibayar) ?></td>
                                    <?php }; ?>
                                    <td><?= number_format($p->dibayar - $p->jml_total) ?></td>
                                    <td class="text-center">
                                        <?php if ($log->level == 1) {; ?>
                                            <button data-kd="<?= $p->kode_penjualan; ?>" data-id="<?= $p->id_penjualan; ?>" class="btn btn-success btn_edit"><i class="fa fa-edit"></i></button>
                                        <?php }; ?>
                                        <button data-kd="<?= $p->kode_penjualan; ?>" class="btn btn-dark btn_print <?= (!empty($log->level == 1) ? '' : 'w-100'); ?>"><i class="fa fa-print <?= (!empty($log->level == 1) ? '' : 'me-2'); ?>"></i> <?= (!empty($log->level == 1) ? '' : 'PRINT'); ?></button>
                                        <?php if ($log->level == 1) {; ?>
                                            <button data-kd="<?= $p->kode_penjualan; ?>" data-id="<?= $p->id_penjualan; ?>" class="btn btn-danger btn_hapus"><i class="fa fa-trash"></i></button>
                                        <?php }; ?>
                                    </td>
                                </tr>
                            <?php }; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div id="load">
            <div id="data-print" class="tampilkan_data">


            </div>
        </div>

    </div>
</div>

<?php if (empty($cekcek)) {; ?>
    <input type="hidden" name="" id="cek" value="baru">
<?php } else {; ?>
    <input type="hidden" name="" id="cek" value="lama">
<?php }; ?>
<input type="hidden" name="" id="item" value="0">
<input type="hidden" name="" id="kodepen2" value="0">
<!-- Modal -->

<div class="modal fade" id="member" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-secondary" id="staticBackdropLabel">TAMBAH MEMBER BARU</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="" class="form-label">NO KTP</label>
                        <input type="text" name="ktp" class="form-control text-white numbers" placeholder="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">ATAS NAMA</label>
                        <input type="text" name="nama" class="form-control text-white" placeholder="Atas Nama....." required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">NO. TELP-/HP</label>
                        <input type="text" name="hp" class="form-control text-white numbers" placeholder="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">ALAMAT LENGKAP</label>
                        <textarea name="alamat" class="form-control text-white" placeholder="Alamat...." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">FOTO KTP</label>
                        <input class="form-control bg-dark" type="file" id="formFile">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"><i class="fa fa-save me-2"></i> Simpan</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    <button type="reset" class="btn btn-warning float-start">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    var dibayar = document.getElementById('dibayar');
    dibayar.addEventListener('keyup', function(e) {
        dibayar.value = formatRupiah(this.value);
        // hilangkan titik
        var ttk = ".";
        var h = $('#dibayar').val();
        var h = h.replaceAll(ttk, "");
        $('#byr').val(h);
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
</script>

<script>
    (function($) {
        $(document).ready(function() {
            cekstatus();

            function cekstatus() {
                var cek = $('#cek').val();
                if (cek == 'baru') {
                    live_cart();
                    penjualan();
                } else if (cek == 'lama') {
                    live_cart2();
                    penjualan2();
                }
            }

            function live_cart() {
                $.ajax({
                    type: 'post',
                    url: '<?= base_url('petugas/live_penjualan'); ?>',
                    success: function(data) {
                        $('#cart').html(data);
                    },
                });
            }

            function penjualan() {
                $.ajax({
                    type: 'post',
                    url: '<?= base_url('petugas/datapenjualan'); ?>',
                    dataType: 'JSON',
                    success: function(data) {
                        $('#kodepen').html(data.kode);
                        $('#kodepen2').val(data.kode);
                        $('#ttl').html(data.ttl);
                        $('#ttl2').val(data.ttl2);
                    },
                });
            }

            $('#kode').on({

                keypress: function() {
                    typed_into = true;
                },
                change: function() {
                    if (typed_into) {
                        var kd = $(this).val();
                        var cek = $('#cek').val();
                        $.ajax({
                            type: 'POST',
                            url: '<?= base_url('petugas/cek_kode_barang'); ?>',
                            dataType: 'JSON',
                            data: {
                                kd: kd,
                                cek: cek,
                            },
                            success: function(data) {
                                if (data.hasil == 'gagal') {
                                    // $('#hasil').attr('hidden', false);
                                } else if (data.hasil == 'success') {

                                    toastr.success("Barang berhasil di tambahkan...");
                                    $('#hasil').attr('hidden', true);
                                    $('#kode').val('')
                                    cekstatus();
                                }
                            }
                        });
                        typed_into = false; //reset type listener
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: "Kode barang tidak ditemukan/ Stok habis",
                            icon: "error"
                        });
                        // $('#kode').val("")
                        $('#kode').focus()
                    }
                }
            });



            $("#cart").on('click', '#plus', function() {
                var id = $(this).attr('data-id');
                var qty = $(this).attr('data-qty');
                var cek = $('#cek').val();

                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('petugas/tambah'); ?>',
                    dataType: 'JSON',
                    data: {
                        id: id,
                        qty: qty,
                        cek: cek,
                    },
                    success: function(data) {
                        cekstatus();
                    }

                });
            });

            $("#cart").on('click', '#minus', function() {
                var id = $(this).attr('data-id');
                var qty = $(this).attr('data-qty');
                var cek = $('#cek').val();

                if (qty == 1) {
                    toastr.error("Qty tidak boleh kosong");
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url('petugas/kurang'); ?>',
                        dataType: 'JSON',
                        data: {
                            id: id,
                            qty: qty,
                            cek: cek,
                        },
                        success: function(data) {
                            cekstatus();
                        }
                    });
                }
            });

            $('#cart').on('click', '.hapus_item', function() {
                var id = $(this).attr('data-id');
                var nm = $(this).attr('data-nm');
                var cek = $('#cek').val();
                var item = $('#item').val();

                Swal.fire({
                    title: 'Apa kamu yakin?',
                    text: "Data " + nm + " akan di hapus!!!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: '<?= base_url('petugas/hapus_item'); ?>',
                            // cache: false,
                            dataType: 'JSON',
                            data: {
                                id: id,
                                cek: cek,
                                item: item,
                            },
                            success: function(data) {
                                toastr.success("Barang berhasil dihapus...");
                                cekstatus();
                            }
                        });

                    }
                });




            });


            $('#bayar').on('change', function() {
                var bayar = $(this).val();
                var ttl = $('#ttl').html();
                var ttl2 = $('#ttl2').val();
                if (bayar == 'cash') {
                    $('#dibayar').attr('disabled', false);
                    $('#dibayar').val('');
                    $('#dibayar').addClass('text-white');
                    $('#kembali').val('')
                    $('#byr').val('');
                } else {
                    $('#dibayar').removeClass('text-white');
                    $('#dibayar').val(ttl);
                    $('#dibayar').attr('disabled', true);
                    $('#kembali').val('')
                    $('#byr').val(ttl2);
                }
            });

            $('.btn_refresh').click(function() {
                $('#bayar').val('');
                $('#dibayar').attr('disabled', false);
                $('#dibayar').val('');
                $('#dibayar').addClass('text-white');
                $('#kembali').val('')
                $('#byr').val('');
            });

            $('#dibayar').keyup(function() {
                var bayar = $('#byr').val();
                var ttl = $('#ttl2').val();

                var kembali = parseInt(bayar) - parseInt(ttl);

                var reversee = kembali.toString().split('').reverse().join(''),
                    kembali_total = reversee.match(/\d{1,3}/g);
                kembali_total = kembali_total.join('.').split('').reverse().join('');
                if (parseInt(ttl) > parseInt(bayar)) {
                    $('#kembali').val('- ' + kembali_total);
                } else {
                    $('#kembali').val(kembali_total);
                }
            });

            $('.btn_simpan').click(function() {
                var bayar = $('#bayar').val();
                var dibayar = $('#byr').val();
                var ttl = $('#ttl2').val();
                var cek = $('#cek').val();
                var save = 'simpan';

                simpandata(bayar, dibayar, ttl, cek, save);
            });

            $('.btn_cetak').click(function() {
                var bayar = $('#bayar').val();
                var dibayar = $('#byr').val();
                var ttl = $('#ttl2').val();
                var cek = $('#cek').val();
                var save = 'cetak';

                simpandata(bayar, dibayar, ttl, cek, save);
            });

            $('#penjualan').on('click', '.btn_print', function() {
                var kode = $(this).attr('data-kd');
                print(kode);
            });

            function simpandata(bayar, dibayar, ttl, cek, save) {
                var kode = $('#kodepen2').val();
                if (ttl == 0) {
                    toastr.error("Data penjualan masih kosong");
                } else if (bayar == '') {
                    toastr.error("Pilih pembayaran...");
                } else if (dibayar == 0) {
                    toastr.error("Ketik jumlah pembayaran");
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url('petugas/simpan_penjualan'); ?>',
                        dataType: 'JSON',
                        data: {
                            bayar: bayar,
                            dibayar: dibayar,
                            ttl: ttl,
                            cek: cek,
                            kode: kode,
                        },
                        success: function(data) {
                            if (save == 'simpan') {
                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil...",
                                    text: "Transaksi berhasil disimpan.",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.location.href = "<?= base_url('petugas/penjualan'); ?>";
                                    }
                                });

                            } else if (save == 'cetak') {
                                print(kode);
                            }
                        }
                    });
                }
            }

            $('#penjualan').on('click', '.btn_edit', function() {
                var id = $(this).attr('data-id');
                var kd = $(this).attr('data-kd');
                // alert(kd);

                Swal.fire({
                    title: "Edit Data Penjualan!",
                    text: "Kode Penjualan >> " + kd + " << Pastikan data yang anda pilih sudah benar!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Edit!"
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: 'POST',
                            url: '<?= base_url('petugas/edit_penjualan'); ?>',
                            dataType: 'JSON',
                            data: {
                                id: id,
                            },
                            success: function(data) {
                                $('#cek').val('lama')
                                cekstatus();
                                Swal.fire({
                                        title: "Berhasil!",
                                        text: "Data telah ditampilakan kembali.",
                                        icon: "success"
                                    },

                                    function() {
                                        document.location.href = "<?= base_url('petugas/penjualan'); ?>";
                                    });
                            }
                        });

                    }
                });
            });



            function live_cart2() {
                $.ajax({
                    type: 'post',
                    url: '<?= base_url('petugas/live_edit_penjualan'); ?>',
                    success: function(data) {
                        $('#cart').html(data);
                    },
                });
            }


            function penjualan2() {
                $.ajax({
                    type: 'post',
                    url: '<?= base_url('petugas/datapenjualanedit'); ?>',
                    dataType: 'JSON',
                    success: function(data) {
                        $('#kodepen').html(data.kode);
                        $('#kodepen2').val(data.kode);
                        $('#ttl').html(data.ttl);
                        $('#ttl2').val(data.ttl2);
                        $('#cek').val(data.cart);
                        $('#item').val(data.item);
                    },
                });
            }

            $('#penjualan').on('click', '.btn_hapus', function() {
                var id = $(this).attr('data-id');
                var kd = $(this).attr('data-kd');
                Swal.fire({
                    title: 'Apa kamu yakin?',
                    text: "Hapus Kode Penjualan >> " + kd + " << Pastikan data yang anda pilih sudah benar!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: 'POST',
                            url: '<?= base_url('petugas/hapus_penjualan'); ?>',
                            dataType: 'JSON',
                            data: {
                                id: id,
                                kd: kd,
                            },
                            success: function(data) {
                                $('#hid' + id).hide(1000);
                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil",
                                    text: "Data berhasil dihapus!",
                                });
                            }
                        });

                    }
                });
            });

            function print(kode) {
                // $('#load').hide();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('petugas/print_penjualan') ?>",
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
                                document.location.href = "<?= base_url('petugas/penjualan'); ?>";
                            }
                        });
                    }
                });
                return false;
            }

        })
    })(jQuery);
</script>