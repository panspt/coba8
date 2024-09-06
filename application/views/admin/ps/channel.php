<div class="container-fluid pt-4 px-4">
    <div class="row g-4">

        <div class="col-sm-8 col-xl-8">
            <div class="bg-secondary rounded  p-4">
                <h6 class="mb-2">DATA CHANNEL</h6>
                <?= $this->session->flashdata('msg'); ?>
                <div class="table-responsive">
                    <table class="table  tab">
                        <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th>NAMA CHANNEL</th>
                                <th>JENIS PLAYSTATION</th>
                                <th>HARGA PERMENIT</th>
                                <th width="10%">#</th>
                            </tr>
                        </thead>
                        <tbody id="chan">
                            <?php $no = 1; ?>
                            <?php foreach ($cnl as $p) {; ?>
                                <tr id="hid<?= $p->id_channel ?>">
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $p->nama_channel; ?></td>
                                    <td><?= $p->jenis_ps; ?></td>
                                    <td>Harga Per <?= $p->menit; ?> Menit : <?= number_format($p->harga); ?></td>
                                    <td class="text-center">
                                        <button data-bs-toggle="modal" data-bs-target="#id<?= $p->id_channel ?>" class="btn btn-success btn-sm"><i class="fa fa-edit" data-toggle="tooltip" title="Edit Data"></i></button>
                                        <button id="btn_hapus" data-id="<?= $p->id_channel ?>" data-nm="<?= $p->nama_channel ?>" class="btn btn-danger btn-sm "><i class="fa fa-trash" data-toggle="tooltip" title="Hapus Data"></i></button>
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
                <form action="<?= base_url('playstation/channel'); ?>" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label text-white">NAMA CHANNEL</label>
                        <input type="text" name="channel" class="form-control text-white " placeholder="Nama Channel...." required autofocus value="<?= set_value('channel'); ?>">
                        <small class="text-danger"><?= form_error('channel'); ?></small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-white">PILIH PLAYSTATION</label>
                        <select name="idps" class="form-select text-white" aria-label="Default select example ">
                            <option selected>Pilih PS</option>
                            <?php foreach ($jps as $p) {; ?>
                                <option value="<?= $p->id_ps ?>"><?= $p->jenis_ps; ?></option>
                            <?php }; ?>
                        </select>
                        <small class="text-danger"><?= form_error('idps'); ?></small>
                    </div>
                    <button type="submit" class="btn btn-success float-end mb-4"><i class="fa fa-save"></i> Simpan</button>
                    <button type="reset" class="btn btn-danger mb-4"><i class="fa fa-spinner"></i> Reset</button>
                </form>
            </div>
        </div>

    </div>
</div>

<?php foreach ($cnl as $d) {; ?>
    <div class="modal fade" id="id<?= $d->id_channel ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit data PlayStation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('playstation/edit_channel'); ?>" method="post">
                    <input type="hidden" name="id" id="id" value="<?= $d->id_channel ?>">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label text-white">NAMA CHANNEL</label>
                            <input type="text" name="channel" class="form-control text-white " placeholder="Nama Channel...." required autofocus value="<?= $d->nama_channel; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label text-white">PILIH PLAYSTATION</label>
                            <select name="idps" class="form-select text-white" aria-label="Default select example ">
                                <option selected>Pilih PS</option>
                                <?php foreach ($jps as $p) {; ?>
                                    <option value="<?= $p->id_ps ?>" <?= ($d->idps == $p->id_ps) ? 'selected' : ''; ?>><?= $p->jenis_ps; ?></option>
                                <?php }; ?>
                            </select>
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
    $(document).ready(function() {
        $('#chan').on('click', '#btn_hapus', function() {
            var id = $(this).attr('data-id');
            var nm = $(this).attr('data-nm');
            Swal.fire({
                title: 'Apa kamu yakin?',
                text: "Data channel " + nm + " akan di hapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('playstation/hapus_channel'); ?>",
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