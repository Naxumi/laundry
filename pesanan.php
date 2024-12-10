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
$id_client = $_SESSION['client_id'];

// menampilkan data jenis laundry
$data_transaksi = select("SELECT 
                                t.transaksi_id AS transaksi_id,
                                j.nama_layanan AS Jenis, 
                                t.tanggal_pemesanan AS 'Tanggal Pemesanan', 
                                t.tanggal_pengantaran AS 'Tanggal Pengantaran', 
                                t.status AS Status, 
                                t.total_harga AS 'Total Harga' 
                            FROM 
                                transaksi t
                            JOIN 
                                jenislaundry j ON t.jenis_id = j.jenis_id
                            WHERE 
                                t.client_id = $id_client AND 
                                t.status NOT IN ('selesai', 'gagal')");

if (isset($_POST['action'])) {
    if (update_pesananclient($_POST) > 0) {
        echo "<script>
                alert('Status Pesanan Berhasil Diubah');
              </script>";
    } else {
        echo "<script>
                alert('Status Pesanan Gagal Diubah');
              </script>";
    }
}

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

                <div class="page-section">
                    <div class="container page__container">
                        <h2>Riwayat Transaksi</h1>
                        <div class="table-responsive">
                            <table id="example" class="table mb-0 thead-border-top-0 table-nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Aksi</th>
                                        <th>No</th>
                                        <th>Jenis Laundry</th>
                                        <th>Tanggal Pemesanan</th>
                                        <th>Tanggal Pengantaran</th>
                                        <th>Status</th>
                                        <th>Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data_transaksi as $transaksi) : ?>
                                    <tr>
                                        <?php if ($transaksi['Status'] == "dalam pengiriman") : ?>
                                            <form action="" class="col-md-5  mx-auto p-0" method="POST">
                                                <input type="hidden" name="transaksi_id" value="<?= $transaksi['transaksi_id']; ?>">
                                                <div class="form-group d-flex justify-content-end">
                                                        <td>
                                                            <button type="submit" name="action" value="terima" class="btn btn-success">Terima</button>
                                                        </td>
                                                </div>
                                            </form>
                                            <?php else: ?>
                                                <td></td>
                                        <?php endif ; ?>
                                        <td><?= $no++; ?></td>
                                        <td><?= $transaksi['Jenis']; ?></td>
                                        <td><?= $transaksi['Tanggal Pemesanan']; ?></td>
                                        <td><?= $transaksi['Tanggal Pengantaran']; ?></td>
                                        <td><?= $transaksi['Status']; ?></td>
                                        <td><?= $transaksi['Total Harga']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Aksi</th>
                                        <th>No</th>
                                        <th>Jenis Laundry</th>
                                        <th>Tanggal Pemesanan</th>
                                        <th>Tanggal Pengantaran</th>
                                        <th>Status</th>
                                        <th>Total Harga</th>
                                    </tr>
                                </tfoot>
                            </table>
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