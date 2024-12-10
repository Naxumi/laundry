<?php

session_start();

// membatasi halaman sebelum login
if (!isset($_SESSION["petugaslogin"])) {
    echo "<script>
              alert('login dulu dong');
              document.location.href = 'adminlogin.php';
            </script>";
    exit;
  }

include 'config/app.php';

// menerima id mahasiswa yang dipilih pengguna
$id_transaksi = (int)$_GET['transaksi_id'];

if (delete_transaksi($id_transaksi) > 0) {
    echo "<script>
            alert('Data Transaksi Berhasil Dihapus');
            document.location.href = 'admin_crudtransaksi.php';
          </script>";
} else {
    echo "<script>
            alert('Data Transaksi Gagal Dihapus');
            document.location.href = 'admin_crudtransaksi.php';
          </script>";
}