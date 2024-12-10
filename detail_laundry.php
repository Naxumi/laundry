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

$title = 'Detail Mahasiswa';
$akunActive = '';

// mengambil id mahasiswa dari url
$jenis_id = (int)$_GET['jenis_id'];

// menampilkan data mahasiswa
$laundry = select("SELECT * FROM jenislaundry WHERE jenis_id = $jenis_id")[0];


// check apakah tombol tambah ditekan
if (isset($_POST['pesan'])) {
    if (create_transaksi($_POST) > 0) {
        echo "<script>
                alert('Pesanan Anda Berhasil!');
                document.location.href = 'laundry.php';
              </script>";
    } else {
        echo "<script>
                alert('Pesanan Anda Gagal!');
                document.location.href = 'laundry.php';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en"
      dir="ltr">

    <head>
        <title>Login</title>
        <?php include("layout/head.php") ?>
    </head>

    <body class="layout-app ">

        <!-- Preloader -->
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

                <div class="pt-32pt pt-sm-64pt pb-32pt">
                    <div class="container page__container">
                        <h2><?= $laundry['nama_layanan']; ?></h2>
                        <h4 class="font-weight-normal"><?= $laundry['deskripsi']; ?></h4>
                        <span>
                            <svg width="20px" viewBox="-5 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>dollar [#303840]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-63.000000, -2917.000000)" fill="#303840"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M13.0000978,2768 C10.3390978,2768 9.00009781,2766.371 9.00009781,2764.5 C9.00009781,2762.691 10.2710978,2761 13.0000978,2761 L13.0000978,2768 Z M19.0000978,2773.5 L19.0000978,2773.5 C19.0000978,2775.309 17.7290978,2777 15.0000978,2777 L15.0000978,2770 C17.6610978,2770 19.0000978,2771.629 19.0000978,2773.5 L19.0000978,2773.5 Z M21.0000978,2773.5 L21.0000978,2773.5 C21.0000978,2770.732 18.9750978,2768 15.0000978,2768 L15.0000978,2761 L17.0000978,2761 C18.1050978,2761 19.0000978,2761.895 19.0000978,2763 L21.0000978,2763 C21.0000978,2760.791 19.2090978,2759 17.0000978,2759 L15.0000978,2759 L15.0000978,2757 L13.0000978,2757 L13.0000978,2759 C9.04209781,2759 7.00009781,2761.722 7.00009781,2764.5 C7.00009781,2767.268 9.02509781,2770 13.0000978,2770 L13.0000978,2777 L11.0000978,2777 C9.89509781,2777 9.00009781,2776.105 9.00009781,2775 L7.00009781,2775 C7.00009781,2777.209 8.79109781,2779 11.0000978,2779 L13.0000978,2779 L13.0000978,2781 L15.0000978,2781 L15.0000978,2779 C18.9580978,2779 21.0000978,2776.278 21.0000978,2773.5 L21.0000978,2773.5 Z" id="dollar-[#303840]"> </path> </g> </g> </g> </g></svg>
                        </span>
                        <span style="font-size: 18px;"><?= $laundry['harga']; ?>/kg</span>
                        <form action=""
                              class="col-md-5 p-0 mx-auto" method="POST">
                            <div class="form-group">

                                <?php if (isset($error)) : ?>
                                    <div class="alert alert-danger text-center">
                                        <b>Username/Password SALAH</b>
                                    </div>
                                <?php endif; ?>

                                <label for="touch-spin-2"
                                    class="form-label">kuantitas</label>
                                <input id="touch-spin-2"
                                           data-toggle="touch-spin"
                                           data-min="-1000000"
                                           data-max="1000000"
                                           data-step="50"
                                           type="number"
                                           value="0"
                                           name="kuantitas"
                                           class="form-control
                                           required"/>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="pesan" class="btn btn-primary">Login</button>
                            </div>
                        </form>
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