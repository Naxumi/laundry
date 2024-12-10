<?php

session_start();

include 'config/app.php';

// membatasi halaman sebelum login
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('login dulu dong');
            document.location.href = 'login.php';
          </script>";
    exit;
}

$title = 'Daftar Mahasiswa';
$mahasiswaActive = 'active';
$akunActive = '';

// menampilkan data jenis laundry
$data_jenislaundry = select("SELECT * FROM jenislaundry ORDER BY jenis_id ASC");
?>

<!DOCTYPE html>
<html lang="en"
      dir="ltr">

    <head>
        <title>Jenis Laundry</title>
        <?php include("layout/head.php") ?>
    </head>

    <body class="layout-app ">

        <?php include("layout/preloader.php") ?>

        <!-- Drawer Layout -->

        <div class="mdk-drawer-layout js-mdk-drawer-layout"
             data-push
             data-responsive-width="992px">
            <div class="mdk-drawer-layout__content page-content">

                <!-- Header -->

                <?php include("layout/header.php") ?>
                <!-- // END Header -->

                <!-- BEFORE Page Content -->

                <!-- // END BEFORE Page Content -->

                <!-- Page Content -->

                <div class="page-section">
                    <div class="container page__container">

                        <div class="page-separator">
                            <div class="page-separator__text">Jenis Laundry</div>
                        </div>

                        <div class="row card-group-row">

                            <!-- REPEAT CONTENT NOTE HAFIZH -->
                            <?php foreach ($data_jenislaundry as $laundry) : ?>
                                <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col">

                                    <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card"
                                        data-toggle="popover"
                                        data-trigger="clik">
                                        <a href=""></a>
                                        <a href="detail_laundry.php?jenis_id=<?= $laundry['jenis_id']; ?>"
                                        class="card-img-top js-image"
                                        data-position=""
                                        data-height="140">
                                            <img src="assets/images/paths/angular_430x168.png"
                                                alt="course">
                                            <span class="overlay__content">
                                                <span class="overlay__action d-flex flex-column text-center">
                                                    <i class="material-icons icon-32pt">play_circle_outline</i>
                                                    <span class="card-title text-white">Preview</span>
                                                </span>
                                            </span>
                                        </a>

                                        <div class="card-body flex">
                                            <div class="d-flex">
                                                <div class="flex">
                                                    <a class="card-title"
                                                    href="student-course.html"><?= $laundry['nama_layanan']; ?></a>
                                                    <small class="text-50 font-weight-bold mb-4pt"><?= $laundry['deskripsi']; ?></small>
                                                </div>
                                                <a href="student-course.html"
                                                data-toggle="tooltip"
                                                data-title="Add Favorite"
                                                data-placement="top"
                                                data-boundary="window"
                                                class="ml-4pt material-icons text-20 card-course__icon-favorite"></a>
                                            </div>
                                            <div class="d-flex">
                                                <div class="rating flex">
                                                    <span class="font-weight-bolder">Rp<?= $laundry['harga']; ?>/kg</span>
                                                    <!-- <span class="rating__item"><span class="material-icons">star</span></span>
                                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                                    <span class="rating__item"><span class="material-icons">star_border</span></span> -->
                                                </div>
                                                <!-- <small class="text-50">6 hours</small> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="popoverContainer d-none">
                                        <div class="media">
                                            <div class="media-left mr-12pt">
                                                <img src="assets/images/paths/angular_40x40@2x.png"
                                                    width="40"
                                                    height="40"
                                                    alt="Angular"
                                                    class="rounded">
                                            </div>
                                            <div class="media-body">
                                                <div class="card-title mb-0"><?= $laundry['nama_layanan']; ?></div>
                                                <p class="lh-1 mb-0">
                                                    <span class="text-50 small">with</span>
                                                    <span class="text-50 small font-weight-bold">Elijah Murray</span>
                                                </p>
                                            </div>
                                        </div>

                                        <p class="my-16pt text-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>

                                        <div class="mb-16pt">
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons icon-16pt text-50 mr-8pt">check</span>
                                                <p class="flex text-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                            </div>
                                        </div>

                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="d-flex align-items-center mb-4pt">
                                                    <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                                                    <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                                                </div>
                                                <div class="d-flex align-items-center mb-4pt">
                                                    <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                                                    <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="material-icons icon-16pt text-50 mr-4pt">assessment</span>
                                                    <p class="flex text-50 lh-1 mb-0"><small>Beginner</small></p>
                                                </div>
                                            </div>
                                            <div class="col text-right">
                                                <a href="student-course.html"
                                                class="btn btn-primary">Watch trailer</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>

                <!-- // END Page Content -->

                <!-- Footer -->

                <?php include("layout/footer.php") ?>

                <!-- // END Footer -->

            </div>

            <!-- // END drawer-layout__content -->

            <!-- Drawer -->

            <?php include("layout/sidebar.php") ?>

            <!-- // END Drawer -->
        </div>

        <!-- // END Drawer Layout -->

        <!-- jQuery -->
        <script src="assets/vendor/jquery.min.js"></script>

        <!-- Bootstrap -->
        <script src="assets/vendor/popper.min.js"></script>
        <script src="assets/vendor/bootstrap.min.js"></script>

        <!-- Perfect Scrollbar -->
        <script src="assets/vendor/perfect-scrollbar.min.js"></script>

        <!-- DOM Factory -->
        <script src="assets/vendor/dom-factory.js"></script>

        <!-- MDK -->
        <script src="assets/vendor/material-design-kit.js"></script>

        <!-- App JS -->
        <script src="assets/js/app.js"></script>

        <!-- Preloader -->
        <script src="assets/js/preloader.js"></script>

    </body>

</html>