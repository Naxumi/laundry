<?php 
include 'config/app.php'; 

session_start();

// membatasi halaman sebelum login
if (!isset($_SESSION["petugaslogin"])) {
    echo "<script>
            alert('login dulu dong');
            document.location.href = 'adminlogin.php';
          </script>";
    exit;
}

if (isset($_POST['tambah'])) {
    if (create_akun($_POST) > 0) {
        echo "<script>
                alert('Akun berhasil dibuat');
                document.location.href = 'admin_crudclient.php';
              </script>";
    } else {
        echo "<script>
                alert('Akun gagal dibuat');
                document.location.href = 'admin_crudclient.php';
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
                            <div class="col-md-5 p-0 mx-auto">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="nama">Nama Panjang</label>
                                        <input id="nama"
                                               type="text"
                                               class="form-control"
                                               placeholder="Masukkan Nama Panjang"
                                               name="nama"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="username">Username</label>
                                        <input id="username"
                                               type="text"
                                               class="form-control"
                                               placeholder="Masukkan Username"
                                               name="username"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="email">Email</label>
                                        <input id="email"
                                               type="email"
                                               class="form-control"
                                               placeholder="Masukkan Email"
                                               name="email"
                                               required>
                                    </div>
                                    <div class="form-group mb-24pt">
                                        <label class="form-label"
                                               for="password">Kata Sandi</label>
                                        <input id="password"
                                               type="password"
                                               class="form-control"
                                               placeholder="Masukkan Kata Sandi"
                                               name="password"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="alamat">Alamat</label>
                                        <textarea id="alamat"
                                               type="text"
                                               class="form-control"
                                               name="alamat"
                                               required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="nohp">Nomor HP</label>
                                        <input id="nohp"
                                               type="text"
                                               class="form-control"
                                               placeholder="Masukkan Nomor HP"
                                               name="nohp"
                                               required>
                                    </div>
                                    <button type="submit" name="tambah" class="btn btn-primary">Buat Akun</button>
                                </form>
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

        </div>

        <!-- // END Drawer Layout -->

        <!-- Script -->
        <?php include("layout/script.php") ?>

    </body>

</html>