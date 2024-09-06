<div class="container-fluid pt-4 px-4">
    <div class="row g-4">

        <div class="col-sm-8 col-xl-8">
            <div class="bg-secondary rounded  p-4">
                <h6 class="mb-2">DATA PETUGAS SHIFT</h6>
                <?= $this->session->flashdata('msg'); ?>
                <div class="table-responsive">
                    <table class="table  tab">
                        <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th>JUDUL SHIFT</th>
                                <th>JADWAL</th>
                                <th>LAPORAN</th>
                                <th>KETERANGAN </th>
                                <th width="10%">#</th>
                            </tr>
                        </thead>
                        <tbody id="us">
                            <?php $no = 1; ?>
                            <?php foreach ($shift as $s) {; ?>
                                <tr id="hid<?= $s->id_shift ?>">
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $s->judul_shift; ?></td>
                                    <td><?= date('H.i', strtotime($s->dari_jam)); ?> - <?= date('H.i', strtotime($s->sampai_jam)); ?></td>
                                    <td><?= (($s->jns_shift == 1) ? 'Di tanggal yang sama' : 'Di antara 2 tanggal'); ?></td>
                                    <td><?= $s->keterangan; ?></td>
                                    <td class="text-center">
                                        <button data-bs-toggle="modal" data-bs-target="#id<?= $s->id_shift ?>" class="btn btn-success btn-sm"><i class="fa fa-edit" data-toggle="tooltip" title="Edit Data"></i></button>
                                        <button id="btn_hapus" data-id="<?= $s->id_shift ?>" data-nm="<?= $s->judul_shift ?>" class="btn btn-danger btn-sm "><i class="fa fa-trash" data-toggle="tooltip" title="Hapus Data"></i></button>
                                    </td>
                                </tr>
                            <?php }; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php date_default_timezone_set('Asia/Jakarta'); ?>
        <div class="col-sm-4 col-xl-4">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-2">FORM INPUT</h6>
                <form action="<?= base_url('user/shift'); ?>" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label text-white">JUDUL SHIFT</label>
                        <input type="text" name="judul" class="form-control text-white " placeholder="Judul Shift..." required autofocus value="<?= set_value('judul'); ?>">
                        <small class="text-danger"><?= form_error('judul'); ?></small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-white">DARI JAM</label>
                        <input type="text" name="jam1" id="datetimepicker3" class="form-control text-white clockpicker" placeholder="00:00" required autofocus value="<?= set_value('jam1'); ?>">
                        <small class="text-danger"><?= form_error('jam1'); ?></small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-white">SAMPAI JAM</label>
                        <input type="text" name="jam2" class="form-control text-white clockpicker" placeholder="00:00" required autofocus value="<?= set_value('jam2'); ?>">
                        <small class="text-danger"><?= form_error('jam2'); ?></small>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label text-white">KETERANGAN </label>
                        <textarea name="keterangan" class="form-control text-white" placeholder="Keterangan......" required></textarea>
                    </div>
                    <input type="hidden" name="jenis_laporan" id="jenis_laporan" value="1">
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="jenis1">
                            <label class="form-check-label" for="flexCheckDefault">
                                Ceklis jika di antara tanggal yang berbeda!!!
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success float-end mb-4"><i class="fa fa-save"></i> Simpan</button>
                    <button type="reset" class="btn btn-danger mb-4"><i class="fa fa-spinner"></i> Reset</button>
                </form>
            </div>
        </div>

    </div>
</div>

<?php foreach ($shift as $d) { ?>
    <div class="modal fade" id="id<?= $d->id_shift ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit data shift</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('user/edit_shift'); ?>" method="post">
                    <input type="hidden" name="id" id="id" value="<?= $d->id_shift ?>">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label text-white">JUDUL SHIFT</label>
                            <input type="text" name="judul" class="form-control text-white " placeholder="Judul Shift..." required autofocus value="<?= $d->judul_shift; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label text-white">DARI JAM</label>
                            <input type="text" name="jam1" class="form-control text-white " placeholder="00:00" required autofocus value="<?= $d->dari_jam; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label text-white">SAMPAI JAM</label>
                            <input type="text" name="jam2" class="form-control text-white " placeholder="00:00" required autofocus value="<?= $d->sampai_jam; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label text-white">KETERANGAN </label>
                            <textarea name="keterangan" class="form-control text-white" placeholder="Keterangan......" required><?= $d->keterangan; ?></textarea>
                        </div>
                        <input type="hidden" name="jenis_laporan" id="jenis_laporan2<?= $d->id_shift ?>" value="<?= $d->jns_shift; ?>">
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="jenis2<?= $d->id_shift ?>" <?= (($d->jns_shift == 2) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Ceklis jika di antara tanggal yang berbeda!!!
                                </label>
                            </div>
                        </div>
                    </div>
                    <script>
                        $("#jenis2<?= $d->id_shift ?>").on('change', function() {
                            if ($("#jenis2<?= $d->id_shift ?>").is(':checked'))
                                $('#jenis_laporan2<?= $d->id_shift ?>').val(2)
                            else {
                                $('#jenis_laporan2<?= $d->id_shift ?>').val(1)
                            }
                        });
                    </script>
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
    $(document).ready(function() {

        $("#jenis1").on('change', function() {
            if ($("#jenis1").is(':checked'))
                $('#jenis_laporan').val(2)
            else {
                $('#jenis_laporan').val(1)
            }
        });

        $('#us').on('click', '#btn_hapus', function() {
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
                        url: "<?= base_url('user/hapus_shift'); ?>",
                        async: true,
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
    })
</script>