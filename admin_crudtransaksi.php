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

// menampilkan data transaksi
$data_transaksi = select("SELECT * FROM  transaksi ORDER BY transaksi_id ASC");

// jumlah pesanan

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
                        <h2>Data transaksi</h1>
                        <p>Lihat informasi semua transaksi</p>
                        <a href="admin_crudtransaksi_tambah.php">
                            <button type="button" class="btn btn-sm btn-dark mb-3">
                                <span class="btn-inner--text">Tambah</span>
                            </button>
                        </a>
                        <div class="table-responsive">
                            <table id="example" class="table mb-0 thead-border-top-0 table-nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Aksi</th>
                                        <th>No</th>
                                        <th>ID Transaksi</th>
                                        <th>ID Client</th>
                                        <th>ID Petugas</th>
                                        <th>ID Jenis</th>
                                        <th>Tanggal Pemesanan</th>
                                        <th>Tanggal Pengambilan</th>
                                        <th>Tanggal Pengantaran</th>
                                        <th>Status</th>
                                        <th>Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data_transaksi as $transaksi) : ?>
                                    <tr>
                                        <td>
                                            <a href="admin_crudtransaksi_ubah.php?transaksi_id=<?= $transaksi['transaksi_id']; ?>" class="text-secondary font-weight-bold text-xs px-2" data-bs-toggle="tooltip" data-bs-title="Edit">
                                                <svg width="14" height="14" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11.2201 2.02495C10.8292 1.63482 10.196 1.63545 9.80585 2.02636C9.41572 2.41727 9.41635 3.05044 9.80726 3.44057L11.2201 2.02495ZM12.5572 6.18502C12.9481 6.57516 13.5813 6.57453 13.9714 6.18362C14.3615 5.79271 14.3609 5.15954 13.97 4.7694L12.5572 6.18502ZM11.6803 1.56839L12.3867 2.2762L12.3867 2.27619L11.6803 1.56839ZM14.4302 4.31284L15.1367 5.02065L15.1367 5.02064L14.4302 4.31284ZM3.72198 15V16C3.98686 16 4.24091 15.8949 4.42839 15.7078L3.72198 15ZM0.999756 15H-0.000244141C-0.000244141 15.5523 0.447471 16 0.999756 16L0.999756 15ZM0.999756 12.2279L0.293346 11.5201C0.105383 11.7077 -0.000244141 11.9624 -0.000244141 12.2279H0.999756ZM9.80726 3.44057L12.5572 6.18502L13.97 4.7694L11.2201 2.02495L9.80726 3.44057ZM12.3867 2.27619C12.7557 1.90794 13.3549 1.90794 13.7238 2.27619L15.1367 0.860593C13.9869 -0.286864 12.1236 -0.286864 10.9739 0.860593L12.3867 2.27619ZM13.7238 2.27619C14.0917 2.64337 14.0917 3.23787 13.7238 3.60504L15.1367 5.02064C16.2875 3.8721 16.2875 2.00913 15.1367 0.860593L13.7238 2.27619ZM13.7238 3.60504L3.01557 14.2922L4.42839 15.7078L15.1367 5.02065L13.7238 3.60504ZM3.72198 14H0.999756V16H3.72198V14ZM1.99976 15V12.2279H-0.000244141V15H1.99976ZM1.70617 12.9357L12.3867 2.2762L10.9739 0.86059L0.293346 11.5201L1.70617 12.9357Z" fill="#64748B" />
                                                </svg>
                                            </a>
                                            <a href="admin_crudtransaksi_hapus.php?transaksi_id=<?= $transaksi['transaksi_id']; ?>" class="text-secondary font-weight-bold text-xs" data-bs-toggle="tooltip" data-bs-title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line>
                                                </svg>
                                            </a>
                                        </td>
                                        <td><?= $no++; ?></td>
                                        <td><?= $transaksi['transaksi_id']; ?></td>
                                        <td><?= $transaksi['client_id']; ?></td>
                                        <td><?= $transaksi['petugas_id']; ?></td>
                                        <td><?= $transaksi['jenis_id']; ?></td>
                                        <td><?= $transaksi['tanggal_pemesanan']; ?></td>
                                        <td><?= $transaksi['tanggal_pengambilan']; ?></td>
                                        <td><?= $transaksi['tanggal_pengantaran']; ?></td>
                                        <td><?= $transaksi['status']; ?></td>
                                        <td><?= $transaksi['total_harga']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>AKSI</th>
                                        <th>NO</th>
                                        <th>ID TRANSAKSI</th>
                                        <th>ID CLIENT</th>
                                        <th>ID PETUGAS</th>
                                        <th>ID JENIS</th>
                                        <th>TANGGAL PEMESANAN</th>
                                        <th>TANGGAL PENGAMBILAN</th>
                                        <th>TANGGAL PENGANTARAN</th>
                                        <th>STATUS</th>
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