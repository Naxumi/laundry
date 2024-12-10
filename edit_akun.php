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

$title = 'Ubah client';
$akunActive = '';

// check apakah tombol ubah ditekan
if (isset($_POST['ubah'])) {
    if (update_akun($_POST) > 0) {
        echo "<script>
                alert('Data Akun Berhasil Diubah!');
                document.location.href = 'edit_akun.php';
              </script>";
    } else {
        echo "<script>
                alert('Data Akun Gagal Diubah');
                document.location.href = 'edit_akun.php';
              </script>";
    }
}

// query ambil data client
$client_id = $_SESSION['client_id'];
$client = select("SELECT * FROM client WHERE client_id = $client_id")[0];

?>

<!DOCTYPE html>
<html lang="en"
      dir="ltr">

    <head>
        <title>Edit Akun</title>
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

                <!-- Navbar -->

                <?php include("layout/header.php") ?>
                <!-- // END Navbar -->

                <!-- // END Header -->

                <div class="pt-32pt">
                    <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
                        <div class="flex d-flex flex-column flex-sm-row align-items-center">

                            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                                <h2 class="mb-0">Account</h2>

                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>

                                    <li class="breadcrumb-item">

                                        <a href="">Account</a>

                                    </li>

                                    <li class="breadcrumb-item active">

                                        Edit Account

                                    </li>

                                </ol>

                            </div>
                        </div>

                    </div>
                </div>

                <!-- BEFORE Page Content -->

                <!-- // END BEFORE Page Content -->

                <!-- Page Content -->

                <div class="container page__container page-section">
                    <div class="page-separator">
                        <div class="page-separator__text">Basic Information</div>
                    </div>
                    <div class="col-md-6 p-0">
                        <form action="" method="POST">
                            <input type="hidden" name="client_id" value="<?= $client['client_id']; ?>">
                            <div class="form-group">
                                <label class="form-label"
                                    for="alamat">Nama Panjang</label>
                                <input id="nama"
                                    type="text"
                                    class="form-control"
                                    name="nama"
                                    value="<?= $client['nama']; ?>"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="form-label"
                                    for="email">Email</label>
                                <input id="email"
                                    type="text"
                                    class="form-control"
                                    name="email"
                                    value="<?= $client['email']; ?>"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="form-label"
                                    for="alamat">Alamat</label>
                                <input id="alamat"
                                    type="text"
                                    class="form-control"
                                    name="alamat"
                                    value="<?= $client['alamat']; ?>"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="form-label"
                                    for="nohp">Nomor HP</label>
                                <input id="nohp"
                                    type="text"
                                    class="form-control"
                                    name="nohp"
                                    value="<?= $client['no_hp']; ?>"
                                    required>
                            </div>
                            <button type="submit" name="ubah" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
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

    </body>

</html>