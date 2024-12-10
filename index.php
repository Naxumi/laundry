<?php 
include 'config/app.php'; 
session_start();

    
// menampilkan data jenis laundry
$data_jenislaundry = select("SELECT * FROM jenislaundry ORDER BY jenis_id ASC");
?>

<!DOCTYPE html>
<html lang="en"
      dir="ltr">

    <head>
        <title>Luma</title>
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

                <div class="mdk-box mdk-box--bg-primary bg-dark js-mdk-box mb-0"
                     data-effects="parallax-background blend-background">
                    <div class="mdk-box__bg">
                        <div class="mdk-box__bg-front"
                             style="background-image: url(assets/images/photodune-4161018-group-of-students-m.jpg);"></div>
                    </div>
                    <div class="mdk-box__content justify-content-center">
                        <div class="hero container page__container text-center py-112pt">
                            <h1 class="text-white text-shadow">Noble Laundry</h1>
                            <p class="lead measure-hero-lead mx-auto text-white text-shadow mb-48pt">Layanan Laundry Terpercaya dan Berkualitas</p>

                            <a href="laundry.php"
                               class="btn btn-lg btn-white btn--raised mb-16pt">Pesan Sekarang
                            </a>
                            
                        </div>
                    </div>
                </div>

                <div class="border-bottom-2 py-16pt navbar-light bg-white border-bottom-2">
                    <div class="container page__container">
                        <div class="row align-items-center">
                            <div class="d-flex col-md align-items-center border-bottom border-md-0 mb-16pt mb-md-0 pb-16pt pb-md-0">
                                <div class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                    <i class="material-icons text-white">account_box</i>
                                </div>
                                <div class="flex">
                                    <div class="card-title mb-4pt">8,000+ pelanggan puas</div>
                                    <p class="card-subtitle text-70">Memberikan layanan laundry berkualitas tinggi untuk semua kebutuhan Anda.</p>
                                </div>
                            </div>
                            <div class="d-flex col-md align-items-center border-bottom border-md-0 mb-16pt mb-md-0 pb-16pt pb-md-0">
                                <div class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                    <i class="material-icons text-white">verified_user</i>
                                </div>
                                <div class="flex">
                                    <div class="card-title mb-4pt">Dikelola oleh Ahli</div>
                                    <p class="card-subtitle text-70">Laundry Anda akan dirawat oleh para profesional berpengalaman.</p>
                                </div>
                            </div>
                            <div class="d-flex col-md align-items-center">
                                <div class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                                    <i class="material-icons text-white">update</i>
                                </div>
                                <div class="flex">
                                    <div class="card-title mb-4pt">Akses Tanpa Batas</div>
                                    <p class="card-subtitle text-70">Nikmati layanan laundry tanpa batas dengan berbagai pilihan paket.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-section border-bottom-2">
                    <div class="container page__container">
                        <div class="page-separator">
                            <div class="page-separator__text">Jenis Laundry</div>
                        </div>

                        <div class="row card-group-row">
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

                <div class="page-section">
                    <div class="container page__container">
                        <div class="page-headline text-center">
                            <h2>Feedback</h2>
                            <p class="lead measure-lead mx-auto text-70">Apa yang mereka rasakan setelah menggunakan jasa Noble Laundry.</p>
                        </div>

                        <div class="position-relative carousel-card p-0 mx-auto">
                            <div class="row d-block js-mdk-carousel"
                                 id="carousel-feedback">
                                <a class="carousel-control-next js-mdk-carousel-control mt-n24pt"
                                   href="#carousel-feedback"
                                   role="button"
                                   data-slide="next">
                                    <span class="carousel-control-icon material-icons"
                                          aria-hidden="true">keyboard_arrow_right</span>
                                    <span class="sr-only">Next</span>
                                </a>
                                <div class="mdk-carousel__content">

                                    <div class="col-12 col-md-6">

                                        <div class="card card-feedback card-body">
                                            <blockquote class="blockquote mb-0">
                                                <p class="text-70 small mb-0">Layanan laundry yang benar-benar merawat pakaian Anda. Pakaian saya selalu kembali bersih tanpa noda dan rapi. Layanan penjemputan dan pengantaran sangatlah nyaman. Sangat direkomendasikan!</p>
                                            </blockquote>
                                        </div>
                                        <div class="media ml-12pt">
                                            <div class="media-left mr-12pt">
                                                <a href="student-profile.html"
                                                   class="avatar avatar-sm">
                                                    <!-- <img src="assets/images/people/110/guy-.jpg" width="40" alt="avatar" class="rounded-circle"> -->
                                                    <span class="avatar-title rounded-circle">UK</span>
                                                </a>
                                            </div>
                                            <div class="media-body media-middle">
                                                <a href="student-profile.html"
                                                   class="card-title">Sucipto</a>
                                                <div class="rating mt-4pt">
                                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                                    <span class="rating__item"><span class="material-icons">star_border</span></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-12 col-md-6">

                                        <div class="card card-feedback card-body">
                                            <blockquote class="blockquote mb-0">
                                                <p class="text-70 small mb-0">Saya sangat terkesan dengan kualitas layanan laundry ini. Pakaian saya selalu bersih sempurna dan harum. Waktu pengerjaannya cepat, dan layanan pelanggan sangat baik. Terima kasih telah membuat hidup saya lebih mudah!</p>
                                            </blockquote>
                                        </div>
                                        <div class="media ml-12pt">
                                            <div class="media-left mr-12pt">
                                                <a href="student-profile.html"
                                                   class="avatar avatar-sm">
                                                    <!-- <img src="assets/images/people/110/guy-.jpg" width="40" alt="avatar" class="rounded-circle"> -->
                                                    <span class="avatar-title rounded-circle">UK</span>
                                                </a>
                                            </div>
                                            <div class="media-body media-middle">
                                                <a href="student-profile.html"
                                                   class="card-title">Ibang</a>
                                                <div class="rating mt-4pt">
                                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                                    <span class="rating__item"><span class="material-icons">star_border</span></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-12 col-md-6">

                                        <div class="card card-feedback card-body">
                                            <blockquote class="blockquote mb-0">
                                                <p class="text-70 small mb-0">Layanan laundry ini sangat membantu. Stafnya profesional dan layanannya dapat diandalkan. Pakaian saya dirawat dengan sangat baik, dan kenyamanan penjemputan serta pengantaran ke rumah tak tertandingi. Saya sangat puas dengan layanan mereka.</p>
                                            </blockquote>
                                        </div>
                                        <div class="media ml-12pt">
                                            <div class="media-left mr-12pt">
                                                <a href="student-profile.html"
                                                   class="avatar avatar-sm">
                                                    <!-- <img src="assets/images/people/110/guy-.jpg" width="40" alt="avatar" class="rounded-circle"> -->
                                                    <span class="avatar-title rounded-circle">UK</span>
                                                </a>
                                            </div>
                                            <div class="media-body media-middle">
                                                <a href="student-profile.html"
                                                   class="card-title">Limbo</a>
                                                <div class="rating mt-4pt">
                                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                                    <span class="rating__item"><span class="material-icons">star</span></span>
                                                    <span class="rating__item"><span class="material-icons">star_border</span></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
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

        <!-- Script -->

        <?php include("layout/script.php") ?>

        <!-- End Script -->

    </body>

</html>