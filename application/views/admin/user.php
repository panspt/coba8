<div class="container-fluid pt-4 px-4">
    <div class="row g-4">

        <div class="col-sm-8 col-xl-8">
            <div class="bg-secondary rounded  p-4">
                <h6 class="mb-2">DATA USER</h6>
                <?= $this->session->flashdata('msg'); ?>
                <div class="table-responsive">
                    <table class="table  tab">
                        <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th>NAMA LENGKAP</th>
                                <th>USERNAME</th>
                                <th>LEVEL</th>
                                <th width="10%">#</th>
                            </tr>
                        </thead>
                        <tbody id="us">
                            <?php $no = 1; ?>
                            <?php foreach ($us as $u) {; ?>
                                <tr id="hid<?= $u->id_user ?>">
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $u->nama_user; ?></td>
                                    <td><?= $u->username; ?></td>
                                    <td>
                                        <?= ($u->level == 1) ? 'Master Admin' : 'Admin'; ?>
                                    </td>
                                    <td class="text-center">
                                        <button data-bs-toggle="modal" data-bs-target="#id<?= $u->id_user ?>" class="btn btn-success btn-sm"><i class="fa fa-edit" data-toggle="tooltip" title="Edit Data"></i></button>
                                        <button id="btn_hapus" data-id="<?= $u->id_user ?>" data-nm="<?= $u->nama_user ?>" class="btn btn-danger btn-sm "><i class="fa fa-trash" data-toggle="tooltip" title="Hapus Data"></i></button>
                                    </td>
                                </tr>
                            <?php }; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-sm-4 col-xl-4">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-2">FORM INPUT</h6>
                <form action="<?= base_url('user'); ?>" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label text-white">NAMA LENGKAP</label>
                        <input type="text" name="nama_lengkap" class="form-control text-white " placeholder="Nama Lengkap..." required autofocus value="<?= set_value('nama_lengkap'); ?>">
                        <small class="text-danger"><?= form_error('nama_lengkap'); ?></small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-white">USERNAME</label>
                        <input type="text" name="username" class="form-control text-white " placeholder="Username...." required value="<?= set_value('username'); ?>">
                        <small class="text-danger"><?= form_error('username'); ?></small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-white">LEVEL</label>
                        <select name="level" class="form-select text-white" aria-label="Default select example ">
                            <option selected>Pilih Level</option>
                            <option value="2">Admin</option>
                            <option value="1">Master Admin</option>
                        </select>
                        <small class="text-danger"><?= form_error('level'); ?></small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-white">PASSWORD</label>
                        <input type="password" name="pass1" class="form-control text-white " placeholder="......" required>
                        <small class="text-danger"><?= form_error('pass1'); ?></small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-white">KONFIRMASI PASSWORD </label>
                        <input type="password" name="pass2" class="form-control text-white " placeholder="......" required>
                        <small class="text-danger"><?= form_error('pass2'); ?></small>
                    </div>
                    <button type="submit" class="btn btn-success float-end mb-4"><i class="fa fa-save"></i> Simpan</button>
                    <button type="reset" class="btn btn-danger mb-4"><i class="fa fa-spinner"></i> Reset</button>
                </form>
            </div>
        </div>

    </div>
</div>

<?php foreach ($us as $d) { ?>
    <div class="modal fade" id="id<?= $d->id_user ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit data user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('user/edit_user'); ?>" method="post">
                    <input type="hidden" name="id" id="id" value="<?= $d->id_user ?>">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control text-white" value="<?= $d->nama_user ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control text-white" value="<?= $d->username ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Level</label>
                            <select name="level" id="" class="form-select text-white">
                                <option>-- Pilih Level --</option>
                                <option value="1" <?php if ($d->level == 1) echo 'selected'; ?>>Master Admin</option>
                                <option value="2" <?php if ($d->level == 2) echo 'selected'; ?>>Admin</option>
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
                        url: "<?= base_url('user/hapus_user'); ?>",
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
                                    text: "User tidak boleh dihapus!",
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