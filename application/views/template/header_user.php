<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $title; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="<?= base_url('assets/'); ?>img/aime.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url('assets/'); ?>lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <!-- Customized Bootstrap Stylesheet -->

    <link href="<?= base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>datatable/datatables.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.0.min.js"></script>
    <script src="<?= base_url('assets/printarea/') ?>jquery-1.8.3.min.js"></script>
    <script src="<?= base_url('assets/printarea/') ?>jquery.PrintArea.js"></script>

    <script type="text/javascript" src="<?= base_url('assets/'); ?>jquery.countdown-2.2.0/jquery.countdown.min.js"></script>
    <link href="<?= base_url('assets/'); ?>sweetalert2/sweetalert2.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>toastr/toastr.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="<?= base_url('assets/'); ?>css/style.css" rel="stylesheet">


    <style>
        .cnl {
            border: 3px solid darkorange;
            text-align: center;
            color: red;
            margin-bottom: 10px;
        }

        .cnl2 {
            border: 1px solid white;
            text-align: center;
            color: red;
            margin-bottom: 10px;
        }

        .btn-pro {
            width: 100%;
            height: 70px;
            font-weight: bold;
            /* font-size: 15pt; */
        }

        .tab {
            width: 100%;
            color: white;
            border-color: red !important;
        }

        .tab tr th {
            border: 1px solid red;
            border-bottom: red;
            text-align: center !important;
            background-color: black !important;
            padding: 10px;
        }

        .tab tr td {
            border: 1px solid black;
            /* text-align: center; */
            font-size: 14px black !important;
            font-weight: 500 !important;
            background-color: gainsboro !important;
            color: black;
            padding-left: 8px !important;
            padding-right: 8px !important;
            padding: 3px !important;
            vertical-align: middle;
        }

        #dt-length-0 {
            background-color: white;
            border-color: red;
        }

        #dt-search-0 {
            background-color: white;
            border-color: red;
        }

        .blink {
            animation: blinker 3s linear infinite;
        }

        @keyframes blinker {
            50% {
                opacity: 0;
            }
        }
    </style>

</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->





        <!-- Content Start -->
        <div class="content open">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0" style="border-bottom: 5px solid grey;">
                <a href="<?= site_url(''); ?>" class="navbar-brand d-flex  me-4">
                    <!-- <h2 class="text-primary mb-0"><i class="fa fa-gamepad"></i> Aime G.S.</h2> -->
                </a>

                <a href="<?= site_url('petugas'); ?>" class="nav-link flex-shrink-0 text-white me-2" style="border: 1px solid; border-radius: 5px;" data-toggle="tooltip" title="Menu Channel">
                    <i class="fa fa-tv"></i>
                </a>



                <a href="#" class="nav-link flex-shrink-0 text-white">
                    <i class="fa fa-user me-2"></i>
                    <span class="d-none d-lg-inline-flex" style="font-weight: bold;">Petugas : <?= $log->nama_user ?></span>
                </a>



                <a href="#" class="nav-link flex-shrink-0 text-white">
                    <i class="fa fa-calendar me-2"></i>
                    <span class="d-none d-lg-inline-flex" style="font-weight: bold;"> <?= format_indo(date('Y-m-d')) ?></span>
                </a>



                <h2 style="margin-left: 130px; margin-bottom: 0px; color: white; width: 50%;">
                    <marquee behavior="" direction="">
                        <?php
                        $hitung = $this->db->query("SELECT * FROM tb_ps")->num_rows();
                        $no = 1;
                        $dtps = $this->db->query("SELECT * FROM tb_ps")->result();
                        foreach ($dtps as $s) {
                            echo "HARGA " . $s->jenis_ps . " PER " . $s->menit . " MENIT : Rp " . number_format($s->harga, 0, ',', '.');
                            if ($no++ == $hitung) {
                            } else {
                                echo " - - ";
                            }
                        }

                        ?>

                    </marquee>
                </h2>
                <div class="navbar-nav align-items-center ms-auto">
                    <?php
                    // $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                    if ($title == "Aime | Channel PS") {; ?>
                        <a href="#" class="nav-link  text-danger " data-bs-toggle="modal" data-bs-target="#ubahpass">
                            <i class="fa fa-key" data-toggle="tooltip" title="Ubah Password"></i>
                        </a>
                    <?php }; ?>
                    <div class="nav-item dropdown">
                        <a href="<?= site_url('auth/logout'); ?>" class="nav-link text-danger" data-toggle="tooltip" title="Log Out">
                            <i class="fa fa-sign-out-alt me-1"></i>
                        </a>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
            <?php
            date_default_timezone_set('Asia/Jakarta');
            ?>