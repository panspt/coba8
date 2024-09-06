<div class="container-fluid pt-4 px-4">
    <div class="row g-4">

        <div class="col-sm-8 col-xl-8">
            <div class="bg-secondary rounded  p-4">
                <h6 class="mb-2">DATA PLAYSTATION</h6>
                <?= $this->session->flashdata('msg'); ?>
                <div class="table-responsive">
                    <table class="table  tab">
                        <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th>JENIS PLAYSTATION</th>
                                <th>JUMLAH MENIT</th>
                                <th>HARGA</th>
                                <th width="10%">#</th>
                            </tr>
                        </thead>
                        <tbody id="ps">
                            <?php $no = 1; ?>
                            <?php foreach ($jps as $p) {; ?>
                                <tr id="hid<?= $p->id_ps ?>">
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $p->jenis_ps; ?></td>
                                    <td> Per <?= $p->menit; ?> Menit</td>
                                    <td class="text-end"><?= number_format($p->harga); ?></td>
                                    <td class="text-center">
                                        <button data-bs-toggle="modal" data-bs-target="#id<?= $p->id_ps ?>" class="btn btn-success btn-sm"><i class="fa fa-edit" data-toggle="tooltip" title="Edit Data"></i></button>
                                        <button id="btn_hapus" data-id="<?= $p->id_ps ?>" data-nm="<?= $p->jenis_ps ?>" class="btn btn-danger btn-sm "><i class="fa fa-trash" data-toggle="tooltip" title="Hapus Data"></i></button>
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
                <hr>
                <form action="<?= base_url('playstation'); ?>" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label text-white">JENIS PLAYSTATION</label>
                        <input type="text" name="jenis" class="form-control text-white " placeholder="Jenis PS" required autofocus value="<?= set_value('jenis'); ?>">
                        <small class="text-danger"><?= form_error('jenis'); ?></small>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label text-white">JUMLAH MENIT</label>
                                <input type="text" name="menit" class="form-control text-white numbers" placeholder="0" required value="<?= set_value('menit'); ?>">
                                <small class="text-danger"><?= form_error('menit'); ?></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label text-white">HARGA</label>
                                <input type="text" name="" id="hrg" class="form-control text-white numbers text-end" placeholder="Rp. 0" required>
                                <input type="hidden" name="harga" id="harga">
                                <small class="text-danger"><?= form_error('harga'); ?></small>
                            </div>
                        </div>
                    </div>



                    <button type="submit" class="btn btn-success float-end mb-4"><i class="fa fa-save"></i> Simpan</button>
                    <button type="reset" class="btn btn-danger mb-4"><i class="fa fa-spinner"></i> Reset</button>
                </form>
            </div>
        </div>

    </div>
</div>

<?php foreach ($jps as $d) {; ?>
    <div class="modal fade" id="id<?= $d->id_ps ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit data PlayStation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('playstation/edit_ps'); ?>" method="post">
                    <input type="hidden" name="id" id="id" value="<?= $d->id_ps ?>">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label ">JENIS PLAYSTATION</label>
                            <input type="text" name="jenis" class="form-control text-white " placeholder="Jenis PS" required autofocus value="<?= $d->jenis_ps; ?>">
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label ">JUMLAH MENIT</label>
                                    <input type="text" name="menit" class="form-control text-white numbers" placeholder="0" required value="<?= $d->menit; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label ">HARGA</label>
                                    <input type="text" name="harga" class="form-control text-white numbers text-end" placeholder="Rp. 0" required value="<?= $d->harga; ?>">
                                </div>
                            </div>
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
    var hrg = document.getElementById('hrg');
    hrg.addEventListener('keyup', function(e) {
        hrg.value = formatRupiah(this.value);
        // hilangkan titik
        var ttk = ".";
        var h = $('#hrg').val();
        var h = h.replaceAll(ttk, "");
        $('#harga').val(h);
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
    $(document).ready(function() {
        $('#ps').on('click', '#btn_hapus', function() {
            var id = $(this).attr('data-id');
            var nm = $(this).attr('data-nm');
            Swal.fire({
                title: 'Apa kamu yakin?',
                text: "Data " + nm + " akan di hapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('playstation/hapus_ps'); ?>",
                        async: true,
                        dataType: "JSON",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            if (data.hasil == 'gagal') {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Jenis " + nm + "  tidak boleh dihapus, Hapus terlebih dahulu data CHANNEL yang berkaitan dengan jenis tersebut!",
                                });
                            } else if (data.hasil == 'success') {
                                $('#hid' + id).hide(1000);
                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil",
                                    text: "Data berhasil dihapus!",
                                });
                            }

                        }
                    });
                }
            })

            return false;

        })
    })
</script>