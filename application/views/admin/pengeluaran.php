<div class="container-fluid pt-4 px-4">
    <div class="row g-4">

        <div class="col-sm-8 col-xl-8">
            <div class="bg-secondary rounded  p-4">
                <h1 style="margin-top: -20px; float: right;">Total : Rp. <?= (empty($t->ttl)) ? 0 : number_format($t->ttl) ?></h1>
                <h6 class="mb-4">Data Pengeluaran Bulan <?= format_indo2(date('Y-m-d')) ?></h6>

                <?= $this->session->flashdata('msg'); ?>
                <div class="table-responsive">
                    <table class="table  tab">
                        <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th>KETERANGAN PENGELUARAN</th>
                                <th>TANGGAL</th>
                                <th>HARGA</th>
                                <th width="10%">#</th>
                            </tr>
                        </thead>
                        <tbody id="peng">
                            <?php $no = 1; ?>
                            <?php foreach ($peng as $p) {; ?>
                                <tr id="hid<?= $p->id_pengeluaran ?>">
                                    <td><?= $no++; ?></td>
                                    <td><?= $p->judul_pengeluaran; ?></td>
                                    <td><?= format_indo($p->tgl_pengeluaran); ?></td>
                                    <td class="text-end"><?= number_format($p->total); ?></td>
                                    <td class="text-center">
                                        <button data-bs-toggle="modal" data-bs-target="#id<?= $p->id_pengeluaran ?>" class="btn btn-success btn-sm"><i class="fa fa-edit" data-toggle="tooltip" title="Edit Data"></i></button>
                                        <button data-id="<?= $p->id_pengeluaran ?>" data-nm="<?= $p->judul_pengeluaran ?>" class="btn btn-danger btn-sm btn_hapus"><i class="fa fa-trash " data-toggle="tooltip" title="Hapus Data"></i></button>
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
                <form action="<?= base_url('dashboard/pengeluaran'); ?>" method="POST">
                    <div class="mb-3">
                        <label for="" class="form-label text-white">JUDUL PENGELUARAN</label>
                        <input type="text" name="judul" class="form-control text-white " placeholder="Judul...." required autofocus value="<?= set_value('judul'); ?>">
                        <small class="text-danger"><?= form_error('judul'); ?></small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label text-white">TOTAL</label>
                        <input type="text" id="total" class="form-control text-white text-end rupiah " placeholder="Rp. 0" required>
                        <small class="text-danger"><?= form_error('total'); ?></small>
                        <input type="hidden" name="total" id="totalas">
                    </div>

                    <button type="submit" class="btn btn-success float-end mb-4"><i class="fa fa-save"></i> Simpan</button>
                    <button type="reset" class="btn btn-danger mb-4"><i class="fa fa-spinner"></i> Reset</button>
                </form>
            </div>
        </div>

    </div>
</div>

<div id="edit">
    <?php foreach ($peng as $d) { ?>
        <div class="modal fade" id="id<?= $d->id_pengeluaran ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">Edit data pengeluaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('dashboard/edit_pengeluaran'); ?>" method="post">
                        <input type="hidden" name="id" id="id" value="<?= $d->id_pengeluaran ?>">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="" class="form-label ">JUDUL PENGELUARAN</label>
                                <input type="text" name="judul" class="form-control text-white " placeholder="Judul...." required autofocus value="<?= $d->judul_pengeluaran; ?>">
                                <small class="text-danger"><?= form_error('judul'); ?></small>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label ">TOTAL</label>
                                <input type="text" id="total" data-id="<?= $d->id_pengeluaran ?>" class="form-control text-white text-end rupiah" placeholder="Rp. 0" value="<?= $d->total ?>">
                                <small class=" text-danger"><?= form_error('total'); ?></small>
                                <input type="hidden" name="total" id="totalas<?= $d->id_pengeluaran ?>" value="<?= $d->total ?>">
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
</div>


<script src="<?= base_url('assets/'); ?>js/jquery.js"></script>
<script>
    $(document).ready(function() {

        $('#total').keyup(function() {
            var ttk = ".";
            var h = $('#total').val();
            var h = h.replaceAll(ttk, "");
            $('#totalas').val(h);
        })

        $('#edit').on('keyup', '#total', function() {
            var id = $(this).attr('data-id');
            // alert(id)
            var ttk = ".";
            var h = $(this).val();
            var h = h.replaceAll(ttk, "");
            $('#totalas' + id).val(h);
        })

        $('#peng').on('click', '.btn_hapus', function() {
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
                        url: "<?= base_url('dashboard/hapus_pengeluaran'); ?>",
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