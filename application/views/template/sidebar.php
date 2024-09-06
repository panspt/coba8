<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="<?= site_url('dashboard'); ?>" class="navbar-brand mx-4 mb-3">
            <h3 style="color: #cac6c5;"><img class="rounded-circle" src="<?= base_url('assets'); ?>/img/aime.png" style="width: 30px; height: 30px; margin-right: 12px; "></i>Aime Game</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="<?= base_url('assets/'); ?>img/aime.png" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0"><?= $log->nama_user ?></h6>
                <span><?= ($log->level == 1) ? 'Master Admin' : 'Admin' ?></span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="<?= site_url('petugas'); ?>" target="_blank" class="nav-item nav-link "><i class="fa fa-laptop me-2"></i>App </a>
            <a href="<?= site_url('dashboard'); ?>" class="nav-item nav-link <?= ($activeMenu == 'dashboard') ? 'active' : ''; ?>"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="<?= site_url('dashboard/password'); ?>" class="nav-item nav-link <?= ($activeMenu == 'passw') ? 'active' : ''; ?>"><i class="fa fa-key me-2"></i>Edit Password</a>
            <a href="<?= site_url('dashboard/pengeluaran'); ?>" class="nav-item nav-link <?= ($activeMenu == 'peng') ? 'active' : ''; ?>"><i class="fa fa-th me-2"></i>Pengeluaran </a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?= ($openMenu == 'psOpen') ? 'active' : ''; ?>" data-bs-toggle="dropdown"><i class="fa fa-th me-2"></i> PlayStation</a>
                <div class="dropdown-menu bg-transparent border-0 ">
                    <a href="<?= site_url('playstation'); ?>" class="dropdown-item <?= ($activeMenu == 'ps') ? 'active' : ''; ?>"><i class="fa fa-bullseye me-2"></i> Data PlayStation</a>
                    <a href="<?= site_url('playstation/channel'); ?>" class="dropdown-item <?= ($activeMenu == 'ch') ? 'active' : ''; ?>"><i class="fa fa-bullseye me-2"></i> Channel</a>
                    <a href="<?= site_url('playstation/sewa'); ?>" class="dropdown-item <?= ($activeMenu == 'sw') ? 'active' : ''; ?>"><i class="fa fa-bullseye me-2"></i>Harga Sewa Harian</a>
                </div>
            </div>
            <a href="<?= site_url('barang'); ?>" class="nav-item nav-link <?= ($activeMenu == 'barang') ? 'active' : ''; ?>"><i class="fa fa-th me-2"></i>Data Barang</a>
            <a href="<?= site_url('user/shift'); ?>" class="nav-item nav-link <?= ($activeMenu == 'shif') ? 'active' : ''; ?>"><i class="fa fa-clock me-2"></i>Shift Petugas</a>
            <a href="<?= site_url('setting'); ?>" class="nav-item nav-link <?= ($activeMenu == 'set') ? 'active' : ''; ?>"><i class="fa fa-cogs me-2"></i>Setting</a>
            <a href="<?= site_url('user'); ?>" class="nav-item nav-link <?= ($activeMenu == 'user') ? 'active' : ''; ?>"><i class="fa fa-user me-2"></i>User</a>
            <a href="<?= site_url('dashboard/laporan'); ?>" class="nav-item nav-link <?= ($activeMenu == 'lap') ? 'active' : ''; ?>"><i class="fa fa-database me-2"></i>Laporan</a>
        </div>
    </nav>
</div>
<!-- Sidebar End -->