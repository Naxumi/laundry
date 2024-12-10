<?php 
include 'config/app.php'; 

if (isset($_POST['signup'])) {
    if (create_akun($_POST) > 0) {
        echo "<script>
                alert('Selamat Akun Anda Telah Berhasil Dibuat!');
                document.location.href = 'login.php';
              </script>";
    } else {
        echo "<script>
                alert('Akun Anda Gagal Dibuat');
                document.location.href = 'signup.php';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en"
      dir="ltr">

    <head>
        <title>Sign Up</title>
        <?php include("layout/head.php") ?>
    </head>

    <body class="layout-app ">

        <!-- Preloader -->
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

                <div class="page-section container page__container">
                    <div class="col-lg-10 p-0 mx-auto">
                        <div class="row">
                            <div class="col-md-6 mb-24pt mb-md-0">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="nama">Nama Panjang Anda:</label>
                                        <input id="nama"
                                               type="text"
                                               class="form-control"
                                               placeholder="Masukkan Nama Panjang"
                                               name="nama"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="username">Username Anda:</label>
                                        <input id="username"
                                               type="text"
                                               class="form-control"
                                               placeholder="Masukkan Username"
                                               name="username"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="email">Email Anda:</label>
                                        <input id="email"
                                               type="email"
                                               class="form-control"
                                               placeholder="Masukkan Email"
                                               name="email"
                                               required>
                                    </div>
                                    <div class="form-group mb-24pt">
                                        <label class="form-label"
                                               for="password">Kata Sandi Anda:</label>
                                        <input id="password"
                                               type="password"
                                               class="form-control"
                                               placeholder="Masukkan Kata Sandi"
                                               name="password"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="alamat">Alamat Anda:</label>
                                        <textarea id="alamat"
                                               type="text"
                                               class="form-control"
                                               name="alamat"
                                               required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="nohp">Nomor HP Anda:</label>
                                        <input id="nohp"
                                               type="text"
                                               class="form-control"
                                               placeholder="Masukkan Nomor HP"
                                               name="nohp"
                                               required>
                                    </div>
                                    <button type="submit" name="signup" class="btn btn-primary">Create account</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-separator justify-content-center m-0">
                    <div class="page-separator__text">or sign-in with</div>
                </div>
                <div class="page-section text-center">
                    <div class="container page__container">
                        <a href="signup-payment.php"
                           class="btn btn-secondary btn-block-xs">Facebook</a>
                        <a href="signup-payment.php"
                           class="btn btn-secondary btn-block-xs">Twitter</a>
                        <a href="signup-payment.php"
                           class="btn btn-secondary btn-block-xs">Google+</a>
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

        </div>

        <!-- // END Drawer Layout -->

        <!-- Script -->
        <?php include("layout/script.php") ?>

    </body>

</html>