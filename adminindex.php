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
$id_petugas = $_SESSION['petugas_id'];

// menampilkan data summary
$total_summary = select("SELECT 
                            COUNT(DISTINCT t.client_id) AS total_clients,
                            COUNT(t.transaksi_id) AS total_transactions,
                            SUM(t.total_harga) AS total_revenue
                        FROM 
                        transaksi t;
                        ");

// menampilkan data transaksi
$data_transaksi = select("SELECT 
                                t.transaksi_id AS transaksi_id, 
                                c.username AS client_username, 
                                p.username AS petugas_username, 
                                j.nama_layanan AS nama_layanan, 
                                t.tanggal_pemesanan AS tanggal_pemesanan, 
                                t.tanggal_pengambilan AS tanggal_pengambilan, 
                                t.tanggal_pengantaran AS tanggal_pengantaran, 
                                t.status AS status,
                                t.kuantitas AS kuantitas, 
                                t.total_harga AS total_harga
                            FROM 
                                transaksi t
                            JOIN 
                                client c ON t.client_id = c.client_id
                            LEFT JOIN 
                             petugas p ON t.petugas_id = p.petugas_id
                            JOIN 
                                jenislaundry j ON t.jenis_id = j.jenis_id");

// menampilkan data preview pesanan
$data_preview = select("SELECT
                            (SELECT COUNT(*) 
                                FROM transaksi t
                                JOIN client c ON t.client_id = c.client_id
                                WHERE t.status = 'konfirmasi') AS jumlah_konfirmasi,

                            (SELECT COUNT(*) 
                                FROM transaksi t
                                JOIN client c ON t.client_id = c.client_id
                                WHERE t.status = 'diterima') AS jumlah_diterima,

                            (SELECT COUNT(*) 
                                FROM transaksi t
                                JOIN client c ON t.client_id = c.client_id
                                WHERE t.status = 'dicuci' 
                                AND t.jenis_id = 2) AS jumlah_dicuci,

                            (SELECT COUNT(*) 
                                FROM transaksi t
                                JOIN client c ON t.client_id = c.client_id
                                WHERE (t.jenis_id = 2 AND t.status = 'disetrika') 
                                    OR (t.jenis_id != 2 AND t.status = 'dicuci')) AS jumlah_disetrika_dicuci,

                            (SELECT COUNT(*) 
                                FROM transaksi t
                                JOIN client c ON t.client_id = c.client_id
                                WHERE t.status = 'dalam pengiriman') AS jumlah_dalam_pengiriman");
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
                        <!-- PROSES LAUNDRY -->
                        <?php foreach ($data_preview as $preview) : ?>
                            <div class="row card-group-row mb-lg-8pt">
                                <div class="col-lg-4 col-md-6 card-group-row__col">
                                    <div class="card card-group-row__card p-relative o-hidden">
                                        <a href="adminordermasuk.php">
                                            <div class="card-body d-flex flex-row align-items-center">
                                                <div class="flex">
                                                    <p class="card-title d-flex align-items-center">
                                                        <strong>Order Masuk</strong>
                                                        <!-- <span class="text-20 ml-8pt">20%</span> -->
                                                        <!-- <i class="material-icons text-accent ml-4pt icon-16pt">keyboard_arrow_up</i> -->
                                                    </p>
                                                    <span class="h2 m-0"><?= $preview['jumlah_konfirmasi'] ?></span>
                                                </div>
                                                <i class="material-icons icon-32pt text-20 ml-8pt">gps_fixed</i>
                                            </div>
                                            <!-- <div class="progress"
                                                style="height: 3px;">
                                                <div class="progress-bar bg-accent"
                                                    role="progressbar"
                                                    style="width: 25%;"
                                                    aria-valuenow="25"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div> -->
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 card-group-row__col">
                                    <div class="card card-group-row__card p-relative o-hidden">
                                        <a href="adminordercuci.php">
                                            <div class="card-body d-flex flex-row align-items-center">
                                                <div class="flex">
                                                    <p class="card-title d-flex align-items-center">
                                                        <strong>Cuci</strong>
                                                        <!-- <span class="text-20 ml-8pt">2018</span> -->
                                                    </p>
                                                    <span class="h2 m-0"><?= $preview['jumlah_diterima'] ?></span>
                                                </div>
                                                <i class="material-icons icon-32pt text-20 ml-8pt">monetization_on</i>
                                            </div>
                                            <!-- <div class="progress"
                                                style="height: 3px;">
                                                <div class="progress-bar"
                                                    role="progressbar"
                                                    style="width: 50%;"
                                                    aria-valuenow="50"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div> -->
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 card-group-row__col">
                                    <div class="card card-group-row__card p-relative o-hidden">
                                        <a href="adminordersetrika.php">
                                            <div class="card-body d-flex flex-row align-items-center">
                                                <div class="card-title flex">
                                                    <strong>Setrika</strong>
                                                    <div class="h2 m-0"><?= $preview['jumlah_dicuci'] ?></div>
                                                </div>
                                                <i class="material-icons icon-32pt text-20">contacts</i>
                                            </div>
                                            <!-- <div class="progress"
                                                style="height: 3px;">
                                                <div class="progress-bar bg-warning"
                                                    role="progressbar"
                                                    style="width: 25%;"
                                                    aria-valuenow="25"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div> -->
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 card-group-row__col">
                                    <div class="card card-group-row__card p-relative o-hidden">
                                        <a href="adminorderkirim.php">
                                            <div class="card-body d-flex flex-row align-items-center">
                                                <div class="card-title flex">
                                                    <strong>Kirim</strong>
                                                    <div class="h2 m-0"><?= $preview['jumlah_disetrika_dicuci'] ?></div>
                                                </div>
                                                <i class="material-icons icon-32pt text-20">contacts</i>
                                            </div>
                                            <!-- <div class="progress"
                                                style="height: 3px;">
                                                <div class="progress-bar bg-warning"
                                                    role="progressbar"
                                                    style="width: 25%;"
                                                    aria-valuenow="25"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div> -->
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 card-group-row__col">
                                    <div class="card card-group-row__card p-relative o-hidden">
                                        <a href="adminorderdalampengiriman.php">
                                            <div class="card-body d-flex flex-row align-items-center">
                                                <div class="card-title flex">
                                                    <strong>Dalam Pengiriman</strong>
                                                    <div class="h2 m-0"><?= $preview['jumlah_dalam_pengiriman'] ?></div>
                                                </div>
                                                <i class="material-icons icon-32pt text-20">contacts</i>
                                            </div>
                                            <!-- <div class="progress"
                                                style="height: 3px;">
                                                <div class="progress-bar bg-warning"
                                                    role="progressbar"
                                                    style="width: 25%;"
                                                    aria-valuenow="25"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div> -->
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="page-separator">
                            <div class="page-separator__text">Summary</div>
                        </div>
                        <!-- SUMMARY -->
                        <?php foreach ($total_summary as $summary) : ?>
                            <div class="row card-group-row mb-lg-8pt">
                                <div class="col-lg-4 col-md-6 card-group-row__col">
                                    <div class="card card-group-row__card p-relative o-hidden">
                                        <div class="card-body d-flex flex-row align-items-center">
                                            <div class="flex">
                                                <p class="card-title d-flex align-items-center">
                                                    <strong>Total Transaksi</strong>
                                                    <!-- <span class="text-20 ml-8pt">20%</span> -->
                                                    <!-- <i class="material-icons text-accent ml-4pt icon-16pt">keyboard_arrow_up</i> -->
                                                </p>
                                                <span class="h2 m-0"><?= $summary['total_transactions']; ?></span>
                                            </div>
                                            <i class="material-icons icon-32pt text-20 ml-8pt">gps_fixed</i>
                                        </div>
                                        <!-- <div class="progress"
                                            style="height: 3px;">
                                            <div class="progress-bar bg-accent"
                                                role="progressbar"
                                                style="width: 25%;"
                                                aria-valuenow="25"
                                                aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 card-group-row__col">
                                    <div class="card card-group-row__card p-relative o-hidden">
                                        <div class="card-body d-flex flex-row align-items-center">
                                            <div class="flex">
                                                <p class="card-title d-flex align-items-center">
                                                    <strong>Total Pendapatan</strong>
                                                    <!-- <span class="text-20 ml-8pt">2018</span> -->
                                                </p>
                                                <span class="h2 m-0"><?= $summary['total_revenue'] ?></span>
                                            </div>
                                            <i class="material-icons icon-32pt text-20 ml-8pt">monetization_on</i>
                                        </div>
                                        <!-- <div class="progress"
                                            style="height: 3px;">
                                            <div class="progress-bar"
                                                role="progressbar"
                                                style="width: 50%;"
                                                aria-valuenow="50"
                                                aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 card-group-row__col">
                                    <div class="card card-group-row__card">
                                        <div class="card-body d-flex flex-row align-items-center">
                                            <div class="card-title flex">
                                                <strong>Total Client</strong>
                                                <div class="h2 m-0"><?= $summary['total_clients'] ?></div>
                                            </div>
                                            <i class="material-icons icon-32pt text-20">contacts</i>
                                        </div>
                                        <!-- <div class="progress"
                                            style="height: 3px;">
                                            <div class="progress-bar bg-warning"
                                                role="progressbar"
                                                style="width: 25%;"
                                                aria-valuenow="25"
                                                aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <h2>Tabel Transaksi</h1>
                        <div class="table-responsive">
                            <table id="example" class="table mb-0 thead-border-top-0 table-nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Transaksi</th>
                                        <th>username Client</th>
                                        <th>Username Petugas</th>
                                        <th>Jenis Laundry</th>
                                        <th>Tanggal Pemesanan</th>
                                        <th>Tanggal Pengambilan</th>
                                        <th>Tanggal Pengantaran</th>
                                        <th>Status Pesanan</th>
                                        <th>Kuantitas</th>
                                        <th>Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data_transaksi as $transaksi) : ?>
                                    <?php
                                        $bgClass = '';
                                        if ($transaksi['status'] == 'selesai') {
                                            $bgClass = 'bg-success';
                                        } elseif ($transaksi['status'] == 'gagal') {
                                            $bgClass = 'bg-danger';
                                        }
                                    ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $transaksi['transaksi_id']; ?></td>
                                        <td><?= $transaksi['client_username']; ?></td>
                                        <td><?= $transaksi['petugas_username']; ?></td>
                                        <td><?= $transaksi['nama_layanan']; ?></td>
                                        <td><?= $transaksi['tanggal_pemesanan']; ?></td>
                                        <td><?= $transaksi['tanggal_pengambilan']; ?></td>
                                        <td><?= $transaksi['tanggal_pengantaran']; ?></td>
                                        <td class="<?php echo $bgClass; ?>"><?= $transaksi['status']; ?></td>
                                        <td><?= $transaksi['kuantitas']; ?></td>
                                        <td><?= $transaksi['total_harga']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>NO</th>
                                        <th>ID TRANSAKSI</th>
                                        <th>USERNAME CLIENT</th>
                                        <th>USERNAME PETUGAS</th>
                                        <th>JENIS LAUNDRY</th>
                                        <th>TANGGAL PEMESANAN</th>
                                        <th>TANGGAL PENGAMBILAN</th>
                                        <th>TANGGAL PENGANTARAN</th>
                                        <th>STATUS PESANAN</th>
                                        <th>KUANTITAS</th>
                                        <th>TOTAL HARGA</th>
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