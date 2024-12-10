<?php

session_start();

include 'config/app.php';

// membatasi halaman sebelum login
if (isset($_SESSION["login"])) {

  // kosongkan $_SESSION user login
  $_SESSION = [];

  session_unset();
  session_destroy();
  header("Location: login.php");
  if (!isset($_SESSION["petugaslogin"])) {
    echo "<script>
            alert('login dulu dong');
            document.location.href = 'adminlogin.php';
          </script>";
    exit;
  }
}

if (isset($_SESSION["petugaslogin"]))
{
  // kosongkan $_SESSION user login
  $_SESSION = [];

  session_unset();
  session_destroy();
  header("Location: adminlogin.php");

  if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('login dulu dong');
            document.location.href = 'login.php';
          </script>";
    exit;
  }
}

header("Location: index.php");

// if (isset($_SESSION["petugaslogin"]))
// {
//   // kosongkan $_SESSION user login
//   $_SESSION = [];

//   session_unset();
//   session_destroy();
//   header("Location: adminlogin.php");
// }