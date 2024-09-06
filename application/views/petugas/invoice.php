<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-xl-8">
            <div class="bg-white rounded h-100 p-4 ">
                <div id="load">
                    <div id="data-print" class="tampilkan_data">


                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <?= $this->session->flashdata('msg'); ?>
            <div class="bg-secondary rounded h-100 p-4 ">
                <div class="mb-3">
                    <label for="" class="form-label text-white">PILIH SHIFT PETUGAS</label>
                    <select name="idshift" id="idshift" class="form-select text-white" aria-label="Default select example ">
                        <option value="">Pilih Shift Petugas</option>
                        <?php foreach ($sft as $p) {; ?>
                            <option value="<?= $p->id_shift ?>"><?= $p->judul_shift; ?> --- <?= $p->keterangan; ?></option>
                        <?php }; ?>
                    </select>
                    <small class="text-danger"><?= form_error('idps'); ?></small>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-success btn-lg w-100 btn_cari"><i class="fa fa-search me-2"></i>Cek Data</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary btn-lg w-100 btn_print"><i class="fa fa-print me-2"></i> CETAK</button>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>






<script>
    (function($) {
        $(document).ready(function() {
            $('.btn_cari').click(function() {
                var id = $('#idshift').val();
                // alert(id)
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('petugas/cari_data_shift'); ?>',
                    // dataType: 'GET',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        // alert();
                        $('.tampilkan_data').html(data);
                    }
                });
            })

            $('.btn_print').click(function() {
                $('#data-print').printArea();
            })
        })
    })(jQuery);
</script>