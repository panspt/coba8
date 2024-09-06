</div>
<!-- Content End -->


<!-- Back to Top -->
<!-- <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a> -->
</div>
<audio id="bgm" class="aok">
    <source src="<?= base_url('uploads'); ?>/ipon.mp3" type="audio/mp3" />
</audio>
<div class="d-none">
    <?php
    date_default_timezone_set('Asia/Jakarta');
    $query_chanel = $this->db->query("SELECT * FROM tb_channel  JOIN tb_ps ON tb_ps.id_ps=tb_channel.idps ")->result();
    foreach ($query_chanel as $ch) {
        $query_rental = $this->db->query("SELECT * FROM tb_rental  JOIN tb_paket ON tb_paket.kode_mem=tb_rental.kode_member WHERE idchannel='$ch->id_channel' AND  aktif='Y' ");
        $m = $query_rental->row();
        if (empty($m->id_rental)) {
        } else {


    ?>
            <div id="pakett<?= $ch->id_channel ?>"></div>
            <script type="text/javascript">
                $('#pakett<?= $ch->id_channel ?>').countdown('<?= $m->stop ?>', function(event) {
                    var kn = event.strftime('%H:%M:%S');
                    if (kn == "00:00:00") {
                        clearInterval("#pakett<?= $ch->id_channel ?>");
                        setInterval(function() {
                            $('.aok').get(0).play();
                        }, 1000);
                    } else {
                        $(this).html(event.strftime('%H:%M:%S'));

                    }
                });
            </script>
        <?php }; ?>
    <?php }; ?>
</div>
<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/'); ?>lib/chart/chart.min.js"></script>
<script src="<?= base_url('assets/'); ?>lib/easing/easing.min.js"></script>
<script src="<?= base_url('assets/'); ?>lib/waypoints/waypoints.min.js"></script>
<script src="<?= base_url('assets/'); ?>lib/owlcarousel/owl.carousel.min.js"></script>
<script src="<?= base_url('assets/'); ?>lib/tempusdominus/js/moment.min.js"></script>
<script src="<?= base_url('assets/'); ?>lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="<?= base_url('assets/'); ?>lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Template Javascript -->
<script src="<?= base_url('assets/'); ?>datatable/datatables.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/main.js"></script>
<script src="<?= base_url('assets/'); ?>sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url('assets/'); ?>toastr/toastr.min.js"></script>

<script>
    let table = new DataTable('#tab', {
        // config options...
    });


    $('.numbers').keyup(function() {
        this.value = this.value.replace(/[^0-9.]/g, '');
    });
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });


    $('.rupiah').keyup(function() {
        this.value = formatRupiah(this.value);
    });

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

</body>

</html>