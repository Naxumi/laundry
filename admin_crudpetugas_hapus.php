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
$id_petugas = (int)$_GET['petugas_id'];

if (delete_petugas($id_petugas) > 0) {
    echo "<script>
            alert('Data Petugas Berhasil Dihapus');
            document.location.href = 'admin_crudpetugas.php';
          </script>";
} else {
    echo "<script>
            alert('Data Petugas Gagal Dihapus');
            document.location.href = 'admin_crudpetugas.php';
          </script>";
}