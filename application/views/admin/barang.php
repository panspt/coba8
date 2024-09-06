<div class="container-fluid pt-4 px-4">
    <div class="row g-4">

        <div class="col-sm-8 col-xl-8">
            <div class="bg-secondary rounded  p-4">
                <h6 class="mb-2">DATA BARANG</h6>
                <?= $this->session->flashdata('msg'); ?>
                <div class="table-responsive">
                    <table class="table  tab" id="tab">
                        <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th>KODE BARANG</th>
                                <th>NAMA BARANG</th>
                                <th>HARGA JUAL</th>
                                <th>KETERANGAN</th>
                                <th width="10%">#</th>
                            </tr>
                        </thead>
                        <tbody id="brg">
                            <?php $no = 1; ?>
                            <?php foreach ($brg as $b) {; ?>
                                <tr id="hid<?= $b->id_barang ?>">
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $b->kode_barang; ?></td>
                                    <td><?= $b->nama_barang; ?></td>
                                    <td class="text-end"><?= number_format($b->harga_barang); ?></td>
                                    <td><?= $b->keterangan; ?></td>
                                    <td class="text-center">
                                        <button data-bs-toggle="modal" data-bs-target="#id<?= $b->id_barang ?>" class="btn btn-success btn-sm"><i class="fa fa-edit" data-toggle="tooltip" title="Edit Data"></i></button>
                                        <button data-id="<?= $b->id_barang ?>" data-nm="<?= $b->nama_barang ?>" class="btn btn-danger btn-sm btn_hapus"><i class="fa fa-trash " data-toggle="tooltip" title="Hapus Data"></i></button>
                                    </td>
                                </tr>
                            <?php }; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-sm-4 col-xl-4">
            <div class="bg-secondary rounded  p-4">
                <h6 class="mb-2">FORM INPUT</h6>
                <form action="<?= base_url('barang'); ?>" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label text-white">KODE BARANG</label>
                        <input type="text" name="kode_barang" id="kode" class="form-control text-white " placeholder="Kode...." required autofocus>
                        <small class="text-danger" id="hasil"></small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-white">NAMA BARANG</label>
                        <input type="text" name="nama_barang" class="form-control text-white " placeholder="Nama....." required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-white">HARGA JUAL</label>
                        <input type="text" name="" id="hrg_jual" class="form-control text-white numbers text-end" placeholder="Rp. 0" required>
                        <input type="hidden" name="hrg_barang" id="hrg_barang">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-white">KETERANGAN BARANG</label>
                        <textarea name="keterangan" class="form-control text-white" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success float-end mb-4" id="simpan"><i class="fa fa-save"></i> Simpan</button>
                    <button type="reset" class="btn btn-danger mb-4"><i class="fa fa-spinner"></i> Reset</button>
                </form>
            </div>
        </div>

    </div>
</div>
<?php foreach ($brg as $d) { ?>
    <div class="modal fade" id="id<?= $d->id_barang ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit data barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('barang/edit_barang'); ?>" method="post">
                    <input type="hidden" name="id" id="id" value="<?= $d->id_barang ?>">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label text-white">KODE BARANG</label>
                            <input type="text" name="" class="form-control " placeholder="Kode...." value="<?= $d->kode_barang ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label text-white">NAMA BARANG</label>
                            <input type="text" name="nama_barang" class="form-control text-white " value="<?= $d->nama_barang ?>" placeholder="Nama....." required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label text-white">HARGA JUAL</label>
                            <input type="text" name="harga" class="form-control text-white numbers text-end" value="<?= $d->harga_barang ?>" placeholder="Rp. 0" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label text-white">KETERANGAN BARANG</label>
                            <textarea name="keterangan" class="form-control text-white" required><?= $d->keterangan ?></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-secondary"><i class="fa fa-save me-2"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<script src="<?= base_url('assets/'); ?>js/jquery.js"></script>
<script>
    $('#kode').keyup(function() {
        var kd = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?= base_url('barang/cek_kode'); ?>',
            dataType: 'JSON',
            data: {
                kd: kd,
            },
            success: function(data) {
                if (data.hasil == 'ada') {
                    $('#simpan').attr('disabled', true);
                    $('#hasil').html('Kode barang sudah pernah diinputkan, silahkan pilih kode lain!');
                } else if (data.hasil == 'kosong') {
                    $('#hasil').html(' ');
                    $('#simpan').attr('disabled', false);
                }

            }
        });
    })

    var hrgjual = document.getElementById('hrg_jual');
    hrgjual.addEventListener('keyup', function(e) {
        hrgjual.value = formatRupiah(this.value);
        // hilangkan titik
        var ttk = ".";
        var h = $('#hrg_jual').val();
        var h = h.replaceAll(ttk, "");
        $('#hrg_barang').val(h);
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

    $('#brg').on('click', '.btn_hapus', function() {
        var id = $(this).attr('data-id');
        var nm = $(this).attr('data-nm');
        Swal.fire({
            title: 'Apa kamu yakin?',
            text: "Data " + nm + " akan di hapus!!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('barang/hapus_barang'); ?>",
                    // async: true,
                    dataType: "JSON",
                    data: {
                        id: id
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
        })

        return false;

    })
</script>