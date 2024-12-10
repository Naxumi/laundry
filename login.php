<?php

session_start();

include 'config/app.php';

// check apakah tmbol login ditekan
if (isset($_POST['login'])) {
    // ambil input username dan password
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // check username
    $result = mysqli_query($db, "SELECT * FROM client WHERE username = '$username'");

    // jika ada usernya
    if (mysqli_num_rows($result) == 1) {
        // check passwordnya
        $hasil = mysqli_fetch_assoc($result);

        if (password_verify($password, $hasil['password'])) {
            // set session
                $_SESSION['login']         = true;
                $_SESSION['client_id']     = $hasil['client_id'];
                $_SESSION['nama']          = $hasil['nama'];
                $_SESSION['username']      = $hasil['username'];
                $_SESSION['email']         = $hasil['email'];
                $_SESSION['password']      = $hasil['password'];
                $_SESSION['alamat']        = $hasil['alamat'];
                $_SESSION['no_hp']         = $hasil['no_hp'];
                $_SESSION['created_at']    = $hasil['created_at'];

            // jika login benar arahkan ke file index.php
            header("Location: index.php");
            exit;
        }
    }
    // jika tidak ada usernya/login salah
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en"
      dir="ltr">

    <head>
        <title>Login</title>
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

                <div class="pt-32pt pt-sm-64pt pb-32pt">
                    <div class="container page__container">
                        <h1 class="text-center">Login User</h1>
                        <form action=""
                              class="col-md-5 p-0 mx-auto" method="POST">
                            <div class="form-group">

                                <?php if (isset($error)) : ?>
                                    <div class="alert alert-danger text-center">
                                        <b>Username/Password SALAH</b>
                                    </div>
                                <?php endif; ?>

                                <label class="form-label"
                                       for="username">Username:</label>
                                <input id="username"
                                       type="text"
                                       class="form-control"
                                       placeholder="Masukkan Username"
                                       name="username"
                                       required>
                            </div>
                            <div class="form-group">
                                <label class="form-label"
                                       for="password">Password:</label>
                                <input id="password"
                                       type="password"
                                       class="form-control"
                                       placeholder="Masukkan Password"
                                       name="password"
                                       required>
                                <p class="text-right"><a href="signup.php"
                                       class="small">Belum Punya Akun?</a></p>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="login" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- <div class="page-separator justify-content-center m-0">
                    <div class="page-separator__text">or sign-in with</div>
                </div>
                <div class="bg-body pt-32pt pb-32pt pb-md-64pt text-center">
                    <div class="container page__container">
                        <a href="index.php"
                           class="btn btn-secondary btn-block-xs">Facebook</a>
                        <a href="index.php"
                           class="btn btn-secondary btn-block-xs">Twitter</a>
                        <a href="index.php"
                           class="btn btn-secondary btn-block-xs">Google+</a>
                    </div>
                </div> -->

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

    </body>

</html>