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
$id_client = (int)$_GET['client_id'];

if (delete_client($id_client) > 0) {
    echo "<script>
            alert('Data client Berhasil Dihapus');
            document.location.href = 'admin_crudclient.php';
          </script>";
} else {
    echo "<script>
            alert('Data client Gagal Dihapus');
            document.location.href = 'admin_crudclient.php';
          </script>";
}