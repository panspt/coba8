<div class="container-fluid pt-4 px-4">
    <div class="row g-4">

        <div class="col-sm-6 col-xl-6">
            <div class="bg-secondary rounded  p-4">
                <h6 class="mb-4">Ubah Password Anda </h6>
                <?= $this->session->flashdata('msg'); ?>
                <form action="<?= base_url('dashboard/password'); ?>" method="POST">
                    <input type="hidden" name="id" id="" value="<?= $log->id_user ?>">
                    <input type="hidden" name="passlm" id="" value="<?= $log->password ?>">
                    <div class="mb-3">
                        <label for="" class="form-label text-white">USERNAME</label>
                        <input type="text" name="username" class="form-control text-dark " value="<?= $log->username ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-white">PASSWORD LAMA</label>
                        <input type="password" name="pass_lama" class="form-control text-white " placeholder="Password Lama" required>
                        <small class="text-danger"><?= form_error('pass_lama'); ?></small>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label text-white">PASSWORD BARU</label>
                        <input type="password" name="pass1" class="form-control text-white " placeholder="Password Baru" required>
                        <small class="text-danger"><?= form_error('pass1'); ?></small>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label text-white">KONFIRMASI PASSWORD BARU</label>
                        <input type="password" name="pass2" class="form-control text-white " placeholder="Konfirmasi Password Baru" required>
                        <small class="text-danger"><?= form_error('pass2'); ?></small>
                    </div>

                    <button type="submit" class="btn btn-success float-end mb-4"><i class="fa fa-save"></i> Simpan</button>
                    <button type="reset" class="btn btn-danger mb-4"><i class="fa fa-spinner"></i> Reset</button>
                </form>
            </div>
        </div>


    </div>
</div>