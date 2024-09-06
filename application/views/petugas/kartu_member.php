<div class="container-fluid pt-4 px-4">
    <div class="row g-4 item-content-center">
        <div class="col-xl-6">
            <div class="bg-secondary rounded h-100 p-4 ">
                <button id="cetak" class="btn btn-dark float-end ms-4"><i class="fa fa-print "></i> PRINT</button>
                <a href="<?= base_url('petugas/member'); ?>"><button class="btn btn-info float-end"><i class="fa fa-reply"></i> KEMBALI</button></a>
                <h6 class="mb-4">DATA MEMBER</h6>
                <br>
                <div id="data-print">
                    <style>
                        .idcard {
                            position: relative;
                            border-radius: 0.5rem;
                            width: 87mm;
                            height: 57mm;
                            background-color: black;
                            text-transform: uppercase;
                        }

                        .head-card {
                            display: block;
                            width: 100%;
                            height: 10mm;
                            background-color: darkorange;
                            border-top-right-radius: 0.5rem;
                            border-top-left-radius: 0.5rem;
                        }

                        .foot-card {
                            position: absolute;
                            display: block;
                            width: 100%;
                            height: 7mm;
                            bottom: 0px;
                            background-color: darkorange;
                            border-radius: 0.5rem;

                        }

                        .body-card {
                            position: relative;
                            display: block;
                            width: 100%;

                        }

                        .head-card img {
                            position: relative;
                            width: 80px;
                            height: 80px;
                            background-color: white;
                            padding: 10px;
                            border-radius: 5rem;
                            margin-left: 20px;
                            margin-top: 10px;
                        }

                        .head-card h3 {
                            position: relative;
                            float: right;
                            top: 15%;
                            right: 15px;
                            text-transform: uppercase;
                            font-size: 20px;
                        }

                        .body-card h2 {
                            position: relative;
                            text-align: center;
                            /* margin-top: 60px; */
                        }

                        .body-card h6 {
                            position: relative;
                            text-align: center;
                            margin-top: 50px;
                        }

                        .foot-card p {
                            position: relative;
                            padding: 0;
                            margin: 0;
                            text-align: center;
                            font-size: 11px;
                            text-transform: uppercase;
                            font-weight: 700;
                            margin-top: 5px;
                            color: black;
                        }

                        @media screen {

                            html {
                                background-color: Gainsboro;
                            }

                        }

                        @media print {

                            @page {
                                margin: auto;
                                size: auto;
                            }

                            html,
                            body {
                                background-color: transparent;
                                margin: 0;
                                width: 100mm;
                                padding: auto;
                                padding: 5mm 4mm 4mm 4mm;
                                /* text-transform: uppercase; */
                                position: relative;
                                text-align: center;
                                text-transform: uppercase;
                            }

                            .head-card img {
                                position: static;
                                width: 70px;
                                height: 70px;
                                background-color: white;
                                /* padding: 5px; */
                                border-radius: 5rem;
                                margin-left: -10px;
                                margin-top: 10px;
                            }

                            .head-card h3 {
                                position: relative;
                                float: right;
                                top: 17%;
                                right: 15px;
                                text-transform: uppercase;
                                font-size: 20px;
                            }

                            .body-card h6 {
                                position: relative;
                                text-align: center;
                                margin-top: 50px;
                                text-transform: uppercase;
                            }

                            .body-card h2 {
                                position: relative;
                                text-align: center;
                                font-size: 35px;
                                font-weight: 800;
                                text-transform: uppercase;
                            }




                        }
                    </style>
                    <?php
                    $s1 = $this->db->query("SELECT * FROM tb_setting WHERE id_setting='1' ")->row();
                    $s2 = $this->db->query("SELECT * FROM tb_setting WHERE id_setting='2' ")->row();
                    $s3 = $this->db->query("SELECT * FROM tb_setting WHERE id_setting='3' ")->row();
                    $s4 = $this->db->query("SELECT * FROM tb_setting WHERE id_setting='4' ")->row();
                    $s5 = $this->db->query("SELECT * FROM tb_setting WHERE id_setting='5' ")->row();
                    $s6 = $this->db->query("SELECT * FROM tb_setting WHERE id_setting='6' ")->row();
                    ?>
                    <div class="page">
                        <div class="idcard">
                            <div class="head-card">
                                <img src="<?= base_url('assets/img/aime.png'); ?>" alt="">
                                <h3><?= $s1->isi; ?></h3>
                            </div>
                            <div class="body-card">
                                <h6><?= $m->nama_maktif; ?></h6>
                                <h2><?= $m->kode_maktif; ?></h2>
                            </div>
                            <div class="foot-card">
                                <p>Alamat : <?= $s2->isi; ?>, HP : <?= $s3->isi; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function($) {
        $(document).ready(function() {
            $('#cetak').click(function() {
                $('#data-print').printArea();
                document.location.href = "<?= base_url('petugas/cetak_kartu/' . $m->nik); ?>";
            });
        });
    })(jQuery);
</script>