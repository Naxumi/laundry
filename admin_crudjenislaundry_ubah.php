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

// check apakah tombol ubah ditekan
if (isset($_POST['ubah'])) {
    if (update_jenis($_POST) > 0) {
        echo "<script>
                alert('Data Jenis Laundry Berhasil Diubah');
                document.location.href = 'admin_crudjenislaundry.php';
              </script>";
    } else {
        echo "<script>
                alert('Data jenis Gagal Diubah');
                document.location.href = 'admin_crudjenislaundry.php';
              </script>";
    }
}



// ambil id jenis dari url
$id_jenis = (int)$_GET['jenis_id'];

// query ambil data jenis
$jenis = select("SELECT * FROM jenislaundry WHERE jenis_id = $id_jenis")[0];

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
                                    <input type="hidden" name="jenis_id" value="<?= $jenis['jenis_id']; ?>">
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="nama">Nama Layanan</label>
                                        <input id="nama"
                                               type="text"
                                               class="form-control"
                                               placeholder="Masukkan Nama Layanan Laundry"
                                               name="nama_layanan"
                                               value="<?= $jenis['nama_layanan']; ?>"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="deskripsi">Deskripsi</label>
                                        <input id="deskripsi"
                                               type="text"
                                               class="form-control"
                                               placeholder="Masukkan deskripsi"
                                               name="deskripsi"
                                               value="<?= $jenis['deskripsi']; ?>"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="harga">Harga</label>
                                        <input id="harga"
                                               type="harga"
                                               class="form-control"
                                               placeholder="Masukkan harga"
                                               name="harga"
                                               value="<?= $jenis['harga']; ?>"
                                               required>
                                    </div>
                                    <button type="submit" name="ubah" class="btn btn-primary">Simpan</button>
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