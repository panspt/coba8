<div class="container-fluid pt-4 px-4">
    <div class="row g-4">

        <div class="col-sm-6 col-xl-6">
            <div class="bg-secondary rounded  p-4">
                <h6 class="mb-4">Setting Data </h6>

                <table class="table tab">
                    <?php foreach ($sett as $t) {; ?>
                        <tr>
                            <td width="35%"><?= $t->judul; ?></td>
                            <td>
                                <span class='edit'> <?= $t->isi ?></span>
                                <?php if ($t->id_setting == 4 || $t->id_setting == 5 || $t->id_setting == 6) {; ?>
                                    <textarea id="<?= $t->id_setting; ?>" class='txtedit form-control'><?= $t->isi ?></textarea>
                                <?php } else {; ?>
                                    <input type='text' class='txtedit form-control' value='<?= $t->isi ?>' id='<?= $t->id_setting; ?>'>
                                <?php }; ?>
                            </td>
                        </tr>
                    <?php }; ?>
                </table>
            </div>
        </div>

    </div>
</div>
<script src="<?= base_url('assets/'); ?>js/jquery.js"></script>
<script>
    $(document).ready(function() {
        $('.txtedit').hide();

        $('.edit').click(function() {
            $('.txtedit').hide();
            $(this).next('.txtedit').show().focus();
            $(this).hide();
        });
        $(".txtedit").focusout(function() {
            var nm_field = 'isi';
            var id = this.id;
            var value = $(this).val();
            $(this).hide();
            $(this).prev('.edit').show();
            $(this).prev('.edit').text(value);

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('setting/edit') ?>',
                dataType: 'JSON',
                data: {
                    id: id,
                    nm_field: nm_field,
                    value: value,
                },
                success: function(data) {
                    toastr.success("Data berhasil di ubah");
                }
            })
        })
    })
</script>