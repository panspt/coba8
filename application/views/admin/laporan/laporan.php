<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <?php date_default_timezone_set('Asia/Jakarta'); ?>
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded  p-4">
                <h6 class="mb-4">DATA LAPORAN </h6>
                <div class="row ">
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="" class="form-label text-white">PILIH LAPORAN</label>
                            <select name="pilih" id="pilih" class="form-select text-white">
                                <option value="">Pilih Laporan....</option>
                                <option value="1">Rental PS</option>
                                <option value="2">Sewa PS</option>
                                <option value="3"> Penjualan</option>
                                <option value="4"> Pengeluaran</option>
                                <!-- <option value="5"> Petugas Shift</option> -->
                                <option value="6"> Keuangan</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 jns_lap">
                        <div class="mb-3">
                            <label for="" class="form-label text-white">PILIH JENIS LAPORAN</label>
                            <select id="jns_lap" class="form-select text-white">
                                <option value="">Pilih Jenis Laporan....</option>

                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="" class="form-label text-white">DARI TANGGAL</label>
                            <input type="date" name="tgl1" id="tgl1" class="form-control  bg-white" value="<?= date('Y-m-d'); ?>">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="" class="form-label text-white">SAMPAI TANGGAL</label>
                            <input type="date" name="tgl2" id="tgl2" class="form-control bg-white" value="<?= date('Y-m-d'); ?>">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="mb-3">
                            <button class="btn btn-info " id="search" style="margin-top: 30px;"><i class="fa fa-search"></i> CARI!</button>
                            <button class="btn btn-primary " id="cetak" style="margin-top: 30px;"><i class="fa fa-print"></i> CETAK!</button>
                        </div>
                    </div>
                </div>

            </div>

            <div class=" rounded  p-4" style="background-color: #EFEFF0;">
                <div id="data-laporan">
                    <div class="loading"></div>
                    <div class="tampilkan_data"></div>
                </div>
            </div>
        </div>


    </div>
</div>

<script>
    $(document).ready(function() {
        $('.jns_lap').hide();
        $('#pilih').change(function() {
            var hasil = $(this).val();
            var rental = '<option value="">Pilih Jenis Laporan....</option> <option value="A">Per Member </option> <option value="B">Per Tanggal</option>';
            var sewa = '<option value="">Pilih Jenis Laporan....</option> <option value="A">Lunas Terbayar</option> <option value="B">Belum  Lunas</option> <option value="C">Tampilkan Semua</option>';
            var penjualan = '<option value="">Pilih Jenis Laporan....</option> <option value="A">Per Kode Penjualan</option> <option value="B">Per Kode Barang</option>';
            if (hasil == 6) {
                $('.jns_lap').hide(1000);
                $('#a').html('');
            } else if (hasil == 1) {
                $('.jns_lap').show(1000);
                $('#jns_lap').html(rental);
            } else if (hasil == 2) {
                $('.jns_lap').show(1000);
                $('#jns_lap').html(sewa);
            } else if (hasil == 3) {
                $('.jns_lap').show(1000);
                $('#jns_lap').html(penjualan);
            } else if (hasil == 4) {
                $('.jns_lap').hide(1000);
            } else {
                $('.jns_lap').hide(1000);
                $('#a').html('');
            }
        })

        $("#search").click(function() {
            var pilih = $('#pilih').val();
            var tgl1 = $('#tgl1').val();
            var tgl2 = $('#tgl2').val();
            var jns = $('#jns_lap').val();

            if (pilih == '') {
                toastr.error("Pilih data laporan");
            } else if (tgl1 == '') {
                toastr.error("Dari tanggal, belom dipilih");
            } else if (tgl2 == '') {
                toastr.error("Sampai tanggal, belom dipilih");
            } else {
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('dashboard/cek_laporan'); ?>',
                    data: {
                        pilih: pilih,
                        jns: jns,
                        tgl1: tgl1,
                        tgl2: tgl2,
                    },
                    cache: false,
                    beforeSend: function() {
                        $(this).html("SEARCHING...").attr("disabled", "disabled");
                        $('.loading').html('Loading...');
                    },
                    success: function(data) {
                        $("#search").html("CARI").removeAttr("disabled");
                        $('.loading').html('');
                        $('.tampilkan_data').html(data);
                    }
                });
                return false;
            }
        });

    })
</script>
<script>
    (function($) {
        // fungsi dijalankan setelah seluruh dokumen ditampilkan
        $(document).ready(function(e) {

            // aksi ketika tombol cetak ditekan
            $("#cetak").bind("click", function(event) {
                // cetak data pada area <div id="#data-mahasiswa"></div>
                $("#hide").hide();
                $('#data-laporan').printArea();
            });
        });
    })(jQuery);
</script>