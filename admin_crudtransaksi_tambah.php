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
    if (create_transaksiadmin($_POST) > 0) {
        echo "<script>
                alert('Akun berhasil dibuat');
                document.location.href = 'admin_crudtransaksi.php';
              </script>";
    } else {
        echo "<script>
                alert('Akun gagal dibuat');
                document.location.href = 'admin_crudtransaksi.php';
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
                                               for="client">ID client</label>
                                        <input id="client"
                                               type="number"
                                               class="form-control"
                                               placeholder="Masukkan ID client"
                                               name="client"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="petugas">ID Petugas</label>
                                        <input id="petugas"
                                               type="number"
                                               class="form-control"
                                               placeholder="Masukkan ID petugas"
                                               name="petugas">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="jenis">ID jenis</label>
                                        <input id="jenis"
                                               type="number"
                                               class="form-control"
                                               placeholder="Masukkan ID jenis"
                                               name="jenis"
                                               required>
                                    </div>
                                    <div class="form-group mb-24pt">
                                        <label class="form-label"
                                               for="pemesanan">Tanggal Pemesanan</label>
                                        <input id="pemesanan"
                                               type="datetime-local"
                                               class="form-control"
                                               placeholder="Masukkan Tanggal Pemesanan"
                                               name="tanggal_pemesanan"
                                               required
                                               step="1">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="pengambilan">Tanggal Pengambilan</label>
                                        <input id="pengambilan"
                                               type="datetime-local"
                                               class="form-control"
                                               name="tanggal_pengambilan">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="pengantaran">Tanggal Pengantaran</label>
                                        <input id="pengantaran"
                                               type="datetime-local"
                                               class="form-control"
                                               placeholder="Masukkan Tanggal Pengantaran"
                                               name="tanggal_pengantaran">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="status">Status</label>
                                        <select id="status" name="status" required>
                                            <option value="konfirmasi">Konfirmasi</option>
                                            <option value="diterima">Diterima</option>
                                            <option value="dicuci">Dicuci</option>
                                            <option value="disetrika">Disetrika</option>
                                            <option value="dalam pengiriman">Dalam Pengiriman</option>
                                            <option value="selesai">Selesai</option>
                                            <option value="gagal">Gagal</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="kuantitas">Kuantitas</label>
                                        <input id="kuantitas"
                                               type="number"
                                               class="form-control"
                                               placeholder="Masukkan kuantitas"
                                               name="kuantitas"
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