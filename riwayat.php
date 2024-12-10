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
$data_transaksi = select("SELECT j.nama_layanan AS Jenis, 
                        t.tanggal_pemesanan AS Tanggal_Pemesanan, 
                        t.tanggal_pengantaran AS Tanggal_Pengantaran, 
                        t.status AS Status,
                        t.kuantitas AS Kuantitas,
                        t.total_harga AS Total_Harga 
                    FROM transaksi t 
                    JOIN jenislaundry j ON t.jenis_id = j.jenis_id
                    WHERE t.client_id = $id_client 
                        AND (t.status = 'selesai' OR t.status = 'gagal')");
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
                                        <th>No</th>
                                        <th>Jenis Laundry</th>
                                        <th>Tanggal Pemesanan</th>
                                        <th>Tanggal Pengantaran</th>
                                        <th>Status</th>
                                        <th>Kuantitas</th>
                                        <th>Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data_transaksi as $transaksi) : ?>
                                    <?php
                                        $bgClass = '';
                                        if ($transaksi['Status'] == 'selesai') {
                                            $bgClass = 'bg-success';
                                        } elseif ($transaksi['Status'] == 'gagal') {
                                            $bgClass = 'bg-danger';
                                        }
                                    ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $transaksi['Jenis']; ?></td>
                                        <td><?= $transaksi['Tanggal_Pemesanan']; ?></td>
                                        <td><?= $transaksi['Tanggal_Pengantaran']; ?></td>
                                        <td class="<?php echo $bgClass; ?>"><?= $transaksi['Status']; ?></td>
                                        <td><?= $transaksi['Kuantitas']; ?></td>
                                        <td><?= $transaksi['Total_Harga']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Laundry</th>
                                        <th>Tanggal Pemesanan</th>
                                        <th>Tanggal Pengantaran</th>
                                        <th>Status</th>
                                        <th>Kuantitas</th>
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