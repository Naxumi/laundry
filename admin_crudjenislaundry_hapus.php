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
$id_jenis = (int)$_GET['jenis_id'];

if (delete_jenis($id_jenis) > 0) {
    echo "<script>
            alert('Data Jenis Laundry Berhasil Dihapus');
            document.location.href = 'admin_crudjenislaundry.php';
          </script>";
} else {
    echo "<script>
            alert('Data Jenis Laundry Gagal Dihapus');
            document.location.href = 'admin_crudjenislaundry.php';
          </script>";
}