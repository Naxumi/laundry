<?php
    $_SESSION['guest']         = true;
    // $_SESSION['role']          = null;
?>
<div class="mdk-drawer js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-dark-pickled-bluewood sidebar-left" data-perfect-scrollbar>

            <!-- Sidebar Content -->

            <!-- <div class="d-flex align-items-center navbar-height">
                <form action="index.php" class="search-form search-form--black mx-16pt pr-0 pl-16pt">
                    <input type="text" class="form-control pl-0" placeholder="Search">
                    <button class="btn" type="submit"><i class="material-icons">search</i></button>
                </form>
            </div> -->

            <a href="index.php" class="sidebar-brand ">
                <!-- <img class="sidebar-brand-icon" src="assets/images/illustration/student/128/white.svg" alt="Luma"> -->

                <span class="avatar avatar-xl sidebar-brand-icon h-auto">

                    <span class="material-icons avatar-title rounded bg-primary"><img src="assets/images/logo/black-70@2x.png" class="img-fluid" alt="logo" /></span>

                </span>

                <span>Luma</span>
            </a>
            <ul class="sidebar-menu">

                <li class="sidebar-menu-item <?php echo isActive('index.php'); ?>">
                    <a class="sidebar-menu-button" href="index.php">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">home</span>
                        <span class="sidebar-menu-text">Home</span>
                    </a>
                </li>
                <li class="sidebar-menu-item <?php echo isActive('laundry.php'); ?>">
                    <a class="sidebar-menu-button" href="laundry.php">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">local_laundry_service</span>
                        <span class="sidebar-menu-text">Laundry</span>
                    </a>
                </li>
                <li class="sidebar-menu-item <?php echo isActive('pesanan.php'); ?>">
                    <a class="sidebar-menu-button" href="pesanan.php">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">post_add</span>
                        <span class="sidebar-menu-text">Pesanan</span>
                    </a>
                </li>
                <li class="sidebar-menu-item <?php echo isActive('riwayat.php'); ?>">
                    <a class="sidebar-menu-button" href="riwayat.php">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">poll</span>
                        <span class="sidebar-menu-text">Riwayat</span>
                    </a>
                </li>

                <!-- Dashboard -->
                <?php if (isset($_SESSION['petugaslogin'])) : ?>
                    <div class="sidebar-heading">Petugas</div>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" data-toggle="collapse" href="#order">
                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">receipt</span>
                            Order
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse sm-indent" id="order">
                            <li class="sidebar-menu-item <?php echo isActive('adminindex.php'); ?>">
                                <a class="sidebar-menu-button" href="adminindex.php">
                                    <span class="sidebar-menu-text">Dashboard</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo isActive('adminordermasuk.php'); ?>">
                                <a class="sidebar-menu-button" href="adminordermasuk.php">
                                    <span class="sidebar-menu-text">Order Masuk</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo isActive('adminordercuci.php'); ?>">
                                <a class="sidebar-menu-button" href="adminordercuci.php">
                                    <span class="sidebar-menu-text">Cuci</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo isActive('adminordersetrika.php'); ?>">
                                <a class="sidebar-menu-button" href="adminordersetrika.php">
                                    <span class="sidebar-menu-text">Setrika</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo isActive('adminorderkirim.php'); ?>">
                                <a class="sidebar-menu-button" href="adminorderkirim.php">
                                    <span class="sidebar-menu-text">Kirim</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item <?php echo isActive('adminorderdalampengiriman.php'); ?>">
                                <a class="sidebar-menu-button" href="adminorderdalampengiriman.php">
                                    <span class="sidebar-menu-text">Dalam Pengiriman</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <!-- CRUD -->
                <?php if (isset($_SESSION['petugaslogin'])) : ?>
                    <?php if ($_SESSION['role'] == 'admin') : ?>
                        <div class="sidebar-heading">Admin</div>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" data-toggle="collapse" href="#client">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">dvr</span>
                                Client
                                <span class="ml-auto sidebar-menu-toggle-icon"></span>
                            </a>
                            <ul class="sidebar-submenu collapse sm-indent" id="client">
                                <li class="sidebar-menu-item <?php echo isActive('admin_crudclient.php'); ?>">
                                    <a class="sidebar-menu-button" href="admin_crudclient.php">
                                        <span class="sidebar-menu-text">Dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item <?php echo isActive('admin_crudclient_tambah.php'); ?>">
                                    <a class="sidebar-menu-button" href="admin_crudclient_tambah.php">
                                        <span class="sidebar-menu-text">Tambah</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" data-toggle="collapse" href="#petugas">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">dvr</span>
                                Petugas
                                <span class="ml-auto sidebar-menu-toggle-icon"></span>
                            </a>
                            <ul class="sidebar-submenu collapse sm-indent" id="petugas">
                                <li class="sidebar-menu-item <?php echo isActive('admin_crudpetugas.php'); ?>">
                                    <a class="sidebar-menu-button" href="admin_crudpetugas.php">
                                        <span class="sidebar-menu-text">Dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item <?php echo isActive('admin_crudpetugas_tambah.php'); ?>">
                                    <a class="sidebar-menu-button" href="admin_crudpetugas_tambah.php">
                                        <span class="sidebar-menu-text">Tambah</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" data-toggle="collapse" href="#jenislaundry">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">dvr</span>
                                Jenis Laundry
                                <span class="ml-auto sidebar-menu-toggle-icon"></span>
                            </a>
                            <ul class="sidebar-submenu collapse sm-indent" id="jenislaundry">
                                <li class="sidebar-menu-item <?php echo isActive('admin_crudjenislaundry.php'); ?>">
                                    <a class="sidebar-menu-button" href="admin_crudjenislaundry.php">
                                        <span class="sidebar-menu-text">Dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar-menu-item <?php echo isActive('admin_crudjenislaundry_tambah.php'); ?>">
                                    <a class="sidebar-menu-button" href="admin_crudjenislaundry_tambah.php">
                                        <span class="sidebar-menu-text">Tambah</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" data-toggle="collapse" href="#transaksi">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">dvr</span>
                                Transaksi
                                <span class="ml-auto sidebar-menu-toggle-icon"></span>
                            </a>
                            <ul class="sidebar-submenu collapse sm-indent" id="transaksi">
                                <li class="sidebar-menu-item <?php echo isActive('admin_crudtransaksi.php'); ?>">
                                    <a class="sidebar-menu-button" href="admin_crudtransaksi.php">
                                        <span class="sidebar-menu-text">Dashboard</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Akun -->
                <?php if (isset($_SESSION['login']) || isset($_SESSION['petugaslogin'])) : ?>
                    <div class="sidebar-heading">Profil</div>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" data-toggle="collapse" href="#account_menu">
                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">account_box</span>
                            Account
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse sm-indent" id="account_menu">
                            <li class="sidebar-menu-item <?php echo isActive('edit_akun.php'); ?>">
                                <?php if (isset($_SESSION['login'])) : ?>
                                    <a class="sidebar-menu-button " href="edit_akun.php">
                                        <span class="sidebar-menu-text">Edit Akun</span>
                                    </a>
                                <?php endif; ?>
                                <?php if (isset($_SESSION['petugaslogin'])) : ?>
                                    <a class="sidebar-menu-button <?php echo isActive('adminedit_akun.php'); ?>" href="adminedit_akun.php">
                                        <span class="sidebar-menu-text">Edit Akun</span>
                                    </a>
                                <?php endif; ?>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button <?php echo isActive('logout.php'); ?>" href="logout.php">
                                    <span class="sidebar-menu-text">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>

            <!-- // END Sidebar Content -->

        </div>
    </div>
</div>