<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
        <a href="<?= site_url('dashboard'); ?>" class="navbar-brand d-flex d-lg-none me-4">
            <h2 class="text-primary mb-0"><i class="fa fa-gamepad"></i></h2>
        </a>
        <a href="#" class="sidebar-toggler flex-shrink-0">
            <i class="fa fa-bars"></i>
        </a>

        <a href="#" class="nav-link flex-shrink-0 text-white">
            <i class="fa fa-user me-2"></i>
            <span class="d-none d-lg-inline-flex" style="font-weight: bold;">Halo, <?= $log->nama_user ?></span>
        </a>
        <a href="#" class="nav-link flex-shrink-0 text-white">
            <i class="fa fa-calendar mr10"></i>
            <span class="d-none d-lg-inline-flex" style="font-weight: bold;"> <?= format_indo(date('Y-m-d')) ?></span>
        </a>
        <a href="#" class="nav-link flex-shrink-0 text-white">
            <i class="fa fa-clock mr10"></i>
            <span class="d-none d-lg-inline-flex">
                <span id="jam" style="font-weight: bold;"></span>
            </span>
        </a>

        <script type="text/javascript">
            window.onload = function() {
                jam();
            }

            function jam() {
                var e = document.getElementById('jam'),
                    d = new Date(),
                    h, m, s;
                h = d.getHours();
                m = set(d.getMinutes());
                s = set(d.getSeconds());

                e.innerHTML = h + ':' + m + ':' + s;

                setTimeout('jam()', 1000);
            }

            function set(e) {
                e = e < 10 ? '0' + e : e;
                return e;
            }
        </script>
        <div class="navbar-nav align-items-center ms-auto">
            <form class="d-none d-md-flex ms-4">
                <select name="tahunlap" id="tahunlap" class="form-select ">
                    <?php
                    date_default_timezone_set('Asia/Jakarta');
                    $date = date('Y');
                    $lap = $this->db->query("SELECT * FROM tb_laporan GROUP BY year(tgl)='$date' ORDER BY id_laporan DESC ");
                    if (!empty($lap->num_rows())) {
                        foreach ($lap->result() as $l) {
                    ?>
                            <option value="<?= date('Y', strtotime($l->tgl)); ?>"><?= date('Y', strtotime($l->tgl)); ?></option>
                        <?php }; ?>
                    <?php } else {; ?>
                        <option value="<?= date('Y'); ?>"><?= date('Y'); ?></option>
                    <?php }; ?>
                    <!-- <option value="2023">2023</option> -->
                </select>
            </form>
            <div class="nav-item dropdown">
                <a href="<?= site_url('auth/logout'); ?>" class="nav-link">
                    <i class="fa fa-sign-out-alt me-1"></i> Log Out
                </a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->