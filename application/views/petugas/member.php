<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-xl-12">
            <?= $this->session->flashdata('msg'); ?>
            <div class="bg-secondary rounded h-100 p-4 ">
                <a href="<?= site_url('petugas/sewa'); ?>"><button class="btn btn-lg btn-success float-end ms-2"><i class="fa fa-laptop me-2"></i> Data Sewa</button></a>
                <button class="btn btn-lg btn-dark float-end " data-bs-toggle="modal" data-bs-target="#member"><i class="fa fa-plus-circle me-2"></i> Tambah Member Baru</button>
                <h6 class="mb-4">DATA MEMBER</h6>
                <br>
                <table class="table  tab" id="tab">
                    <thead>
                        <tr>
                            <th width="3%">NO</th>
                            <th width="10%">KODE MEMBER</th>
                            <th width="15%">ATAS NAMA</th>
                            <th width="10%">NO. TELP-/HP</th>
                            <th>ALAMAT</th>
                            <th width="10%">TGL. DAFTAR</th>
                            <th width="20%">OPSI</th>
                        </tr>
                    </thead>
                    <tbody id="memberaktif">
                        <?php $no = 1; ?>
                        <?php foreach ($mem as $m) {; ?>
                            <tr id="hid<?= $m->id_member_aktif; ?>">
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="text-center"><?= $m->kode_maktif; ?></td>
                                <td><?= $m->nama_maktif; ?></td>
                                <td class="text-center"><?= $m->hp; ?></td>
                                <td><?= $m->alamat; ?></td>
                                <td class="text-center"><?= format_indo($m->tgl_daftar); ?></td>
                                <td class="text-center">
                                    <button data-bs-toggle="modal" data-bs-target="#id<?= $m->id_member_aktif ?>" class="btn btn-success btn-sm btn_edit"><i class="fa fa-edit"></i> Edit </button>
                                    <?php if ($log->level == 1) {; ?>
                                        <button data-kd="<?= $m->kode_maktif; ?>" data-id="<?= $m->id_member_aktif; ?>" data-nm="<?= $m->nama_maktif; ?>" class="btn btn-danger btn-sm btn_hapus"><i class="fa fa-trash"></i> Hapus </button>
                                    <?php }; ?>
                                    <a href="<?= base_url('petugas/cetak_kartu/' . $m->nik); ?>"><button class="btn btn-dark btn-sm btn_print"><i class="fa fa-print"></i> Cetak Kartu Member </button></a>
                                </td>
                            </tr>
                        <?php }; ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


<!-- Modal Tambah-->

<div class="modal fade" id="member" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-secondary" id="staticBackdropLabel">TAMBAH MEMBER BARU</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('petugas/member'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="" class="form-label">NO KTP</label>
                        <input type="text" name="nik" class="form-control text-white numbers" placeholder="0" required value="<?= set_value('nik'); ?>">
                        <small class="text-danger"><?= form_error('nik'); ?></small>
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
                        <input class="form-control bg-dark" type="file" id="formFile" name="gambar">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary"><i class="fa fa-save me-2"></i> Simpan</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    <button type="reset" class="btn btn-warning float-start">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal Edit -->
<?php foreach ($mem as $m) {; ?>
    <div class="modal fade" id="id<?= $m->id_member_aktif; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-secondary" id="staticBackdropLabel">EDIT MEMBER</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('petugas/edit_member'); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="" value="<?= $m->id_member_aktif; ?>">
                    <input type="hidden" name="niklama" id="" value="<?= $m->nik; ?>">
                    <input type="hidden" name="filelama" id="" value="<?= $m->gambar; ?>">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="" class="form-label">NO KTP</label>
                            <input type="text" name="nik" class="form-control text-white numbers" placeholder="0" required value="<?= $m->nik; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">ATAS NAMA</label>
                            <input type="text" name="nama" class="form-control text-white" placeholder="Atas Nama....." required value="<?= $m->nama_maktif; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">NO. TELP-/HP</label>
                            <input type="text" name="hp" class="form-control text-white numbers" placeholder="0" required value="<?= $m->hp; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">ALAMAT LENGKAP</label>
                            <textarea name="alamat" class="form-control text-white" placeholder="Alamat...." required><?= $m->alamat; ?></textarea>
                        </div>
                        <div class="p-4">
                            <img src="<?= base_url('uploads/' . $m->gambar); ?>" alt="" width="30%">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">FOTO KTP</label>
                            <input class="form-control bg-dark" type="file" id="formFile" name="gambar">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary"><i class="fa fa-save me-2"></i> Simpan</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                        <button type="reset" class="btn btn-warning float-start">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php }; ?>

<script>
    $(document).ready(function() {
        $('#memberaktif').on('click', '.btn_hapus', function() {
            var id = $(this).attr('data-id');
            var nm = $(this).attr('data-nm');
            var kode = $(this).attr('data-kd');

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
                        url: "<?= base_url('petugas/hapus_maktif'); ?>",
                        async: true,
                        dataType: "JSON",
                        data: {
                            id: id,
                            kode: kode,
                        },
                        success: function(data) {
                            if (data.hasil == 'gagal') {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Member tidak boleh dihapus!, data masih berelasi dengan data sewa harian.....",
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
        });
    })
</script>