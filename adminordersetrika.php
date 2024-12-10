<?php

session_start();

include 'config/app.php';

// membatasi halaman sebelum login
if (!isset($_SESSION["petugaslogin"])) {
    echo "<script>
            alert('login dulu dong');
            document.location.href = 'adminlogin.php';
          </script>";
    exit;
}

$title = 'Daftar Mahasiswa';
$mahasiswaActive = 'active';
$akunActive = '';

if (isset($_POST['action'])) {
    if (update_ordersetrika($_POST) > 0) {
        echo "<script>
                alert('Status Pesanan Berhasil Diubah');
              </script>";
    } else {
        echo "<script>
                alert('Status Pesanan Gagal Diubah');
              </script>";
    }
}

// menampilkan data konfirmasi
$data_konfirmasi = select("SELECT 
                            t.transaksi_id AS transaksi_id, 
                            c.username AS nama_client, 
                            c.alamat AS alamat_client, 
                            t.kuantitas AS kuantitas,
                            j.nama_layanan AS nama_layanan
                            FROM 
                                transaksi t
                            JOIN
                                jenislaundry j ON t.jenis_id = j.jenis_id
                            JOIN 
                                client c ON t.client_id = c.client_id
                            WHERE status = 'dicuci' 
                                AND t.jenis_id = 2");

$jumlah = select("SELECT COUNT(*) AS jumlah_konfirmasi
                    FROM transaksi t
                    JOIN client c ON t.client_id = c.client_id
                    WHERE status = 'dicuci' 
                        AND t.jenis_id = 2");

// check apakah tombol terima/tolak ditekan
?>

<!DOCTYPE html>
<html lang="en"
      dir="ltr">

    <head>
        <title>Riwayat Transaksi</title>
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
                <div class="">

                </div>
                <div class="page-section">
                    <div class="container page__container">
                        <h1 class="text-center">Setrika Pesanan</h1>
                        <?php foreach ($jumlah as $jml) : ?>
                            <h6>Terdapat <?= $jml['jumlah_konfirmasi']; ?> pesanan yang belum disetrika</h6>
                        <?php endforeach; ?>
                        <!-- TERIMA ORDER -->
                            <div class="row card-group-row mb-lg-8pt">
                                <?php foreach ($data_konfirmasi as $konfirmasi) : ?>
                                    <div class="col-lg-4 col-md-6 card-group-row__col">
                                        <div class="card card-group-row__card p-relative o-hidden">
                                            <div class="card-body d-flex flex-row align-items-center">
                                                <div class="flex">
                                                    <p class="card-title d-flex align-items-center">
                                                        Order ID
                                                        <p class=""><?= $konfirmasi['transaksi_id']; ?></p>
                                                    </p>
                                                    <p class="card-title d-flex align-items-center">
                                                        Jenis Laundry
                                                        <p class=""><?= $konfirmasi['nama_layanan']; ?></p>
                                                    </p>
                                                    <p class="card-title d-flex align-items-center">
                                                        Nama
                                                        <p class=""><?= $konfirmasi['nama_client']; ?></p>
                                                    </p>
                                                    <p class="card-title d-flex align-items-center">
                                                        Alamat
                                                        <p class=""><?= $konfirmasi['alamat_client']; ?></p>
                                                    </p>
                                                    <p class="card-title d-flex align-items-center">
                                                        Kuantitas
                                                        <p class=""><?= $konfirmasi['kuantitas']; ?></p>
                                                    </p>
                                                    <form action="" class="col-md-5  mx-auto p-0" method="POST">
                                                        <input type="hidden" name="transaksi_id" value="<?= $konfirmasi['transaksi_id']; ?>">
                                                        <div class="form-group d-flex justify-content-end">
                                                            <button type="submit" name="action" value="tolak" class="btn btn-danger mr-2">Tolak</button>
                                                            <button type="submit" name="action" value="terima" class="btn btn-success">Setrika</button>
                                                        </div>
                                                    </form>
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

        <!-- Script -->
        <?php include("layout/script.php") ?>
    </body>

</html>