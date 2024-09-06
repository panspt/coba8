</div>
<!-- Content End -->


<!-- Back to Top -->

</div>

<!-- JavaScript Libraries -->
<script src="<?= base_url('assets/'); ?>js/jquery.js"></script>
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
<script src="<?= base_url('assets/'); ?>clockpicker/bootstrap-clockpicker.min.js"></script>
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

    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 7000);

    $('.clockpicker').clockpicker({
        // placement: 'right',
        align: 'right',
        donetext: 'Done'
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