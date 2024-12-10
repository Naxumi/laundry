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
    if (update_petugas($_POST) > 0) {
        echo "<script>
                alert('Data Petugas Berhasil Diubah');
                document.location.href = 'admin_crudpetugas.php';
              </script>";
    } else {
        echo "<script>
                alert('Data Petugas Gagal Diubah');
                document.location.href = 'admin_crudpetugas.php';
              </script>";
    }
}



// ambil id petugas dari url
$id_petugas = (int)$_GET['petugas_id'];

// query ambil data petugas
$petugas = select("SELECT * FROM petugas WHERE petugas_id = $id_petugas")[0];

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
                                    <input type="hidden" name="petugas_id" value="<?= $petugas['petugas_id']; ?>">
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="nama">Nama Panjang</label>
                                        <input id="nama"
                                               type="text"
                                               class="form-control"
                                               placeholder="Masukkan Nama Panjang"
                                               name="nama"
                                               value="<?= $petugas['nama']; ?>"
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
                                               value="<?= $petugas['username']; ?>"
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
                                               value="<?= $petugas['email']; ?>"
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
                                               value="<?= $petugas['password']; ?>"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="role">role</label>
                                        <select id="role" class="form-control" name="role" required>
                                            <option value="" disabled>Pilih role</option>
                                            <option value="admin" <?= $petugas['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                            <option value="operator" <?= $petugas['role'] == 'operator' ? 'selected' : ''; ?>>Operator</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"
                                               for="nohp">Nomor HP</label>
                                        <input id="nohp"
                                               type="text"
                                               class="form-control"
                                               placeholder="Masukkan Nomor HP"
                                               name="nohp"
                                               value="<?= $petugas['no_hp']; ?>"
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