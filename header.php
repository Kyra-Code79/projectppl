<?php
date_default_timezone_set("Asia/Jakarta");
$tglHariIni = date('Y-m-d');

session_start();
$id_pegawai   = $_SESSION['id_pegawai'];
$nama_pegawai = $_SESSION['nama_pegawai'];
$jabatan      = $_SESSION['jabatan'];
$photo        = $_SESSION['photo'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= $judul; ?></title>

    <!-- CSS -->
    <!-- Custom fonts for this template-->
    <link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="assets/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/component-chosen.css" />

    <!-- JavaScript-->
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="assets/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- <script src="js/demo/datatables-demo.js"></script> -->
    <script src="js/simple.money.format.js"></script>
    <script type="text/javascript" src="js/chosen.jquery.js"></script>
    <script type="text/javascript" src="js/init.js"></script>
    <script src="js/style.js"></script>

    <style>
        tr>td {
            vertical-align: middle !important;
        }

        .lebar {
            height: 30px !important;
            font-size: 14px;
            width: 130px;
        }

        .transaksiAksi2:hover {
            cursor: pointer;
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-text mx-3"><?= $judul; ?></div>
            </a>

            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <?php
            if (($jabatan == "Admin" or $jabatan == "Manajer") and $jabatan != "Kasir") { ?>
                <?php
                if ($jabatan == "Admin") { ?>
                    <!-- User Login -->
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">
                            <i class="fas fa-fw fa-user"></i>
                            <span>User Login</span>
                        </a>
                    </li>
                <?php
                } else { ?>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fas fa-fw fa-cog"></i>
                            <span>Master</span>
                        </a>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <!-- Pegawai -->
                                <a class="collapse-item" href="pegawai.php">
                                    <i class="fas fa-fw fa-users"></i>
                                    <span>Employee</span>
                                </a>

                                <!-- Jenis Menu -->
                                <a class="collapse-item" href="jenis-menu.php">
                                    <i class="fas fa-fw fa-clipboard-list"></i>
                                    <span>Dish Menu</span>
                                </a>

                                <!-- Daftar Menu -->
                                <a class="collapse-item" href="menu.php">
                                    <i class="fas fa-fw fa-clipboard-list"></i>
                                    <span>Menu List</span>
                                </a>

                                <!-- Daftar Menu -->
                                <a class="collapse-item" href="table.php">
                                    <i class="fas fa-fw fa-clipboard-list"></i>
                                    <span>Table List</span>
                                </a>
                            </div>
                        </div>
                    </li>

            <?php
                }
            } ?>

            <?php
            if ($jabatan == "Kasir") { ?>
                <!-- Transaksi -->
                <li class="nav-item">
                    <a class="nav-link" href="transaksi.php">
                        <i class="fas fa-fw fa-clipboard-list"></i>
                        <span>Transaction</span>
                    </a>
                </li>
            <?php
            } ?>

            <?php
            if ($jabatan == "Admin" or $jabatan == "Manajer" or $jabatan == "Kasir") { ?>
                <li class="nav-item">
                    <a class="nav-link" href="order-customer.php">
                        <i class="fas fa-fw fa-clipboard-list"></i>
                        <span>Order Customer</span>
                    </a>
                </li>
            <?php
            }
            ?>

            <?php
            if ($jabatan == "Manajer" or $jabatan == "Admin") { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-edit"></i>
                        <span>Reports</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                            <!-- Laporan pegawai -->
                            <a class="collapse-item" href="laporan-pegawai.php">
                                <i class="fas fa-fw fa-clipboard-list"></i>
                                <span>Employee's Profile</span>
                            </a>

                            <!-- Laporan Jenis Menu -->
                            <a class="collapse-item" href="laporan-jenis-menu.php">
                                <i class="fas fa-fw fa-clipboard-list"></i>
                                <span>Dish Menu Report</span>
                            </a>

                            <!-- Laporan Menu -->
                            <a class="collapse-item" href="laporan-menu.php">
                                <i class="fas fa-fw fa-clipboard-list"></i>
                                <span>Menu Report</span>
                            </a>

                            <!-- Laporan Transaksi -->
                            <a class="collapse-item" href="laporan-transaksi.php">
                                <i class="fas fa-fw fa-clipboard-list"></i>
                                <span>Transactions Report</span>
                            </a>
                        </div>
                    </div>
                </li>

            <?php
            } ?>

            <?php
            if ($jabatan == "Kasir") { ?>
                <!-- Laporan Transaksi -->
                <li class="nav-item">
                    <a class="nav-link" href="laporan-transaksi.php">
                        <i class="fas fa-fw fa-clipboard-list"></i>
                        <span>Transactions Report</span>
                    </a>
                </li>
            <?php
            } ?>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Search -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= ($nama_pegawai); ?> |
                                    <?= ($jabatan); ?></span>
                                <img class="img-profile rounded-circle" src="photo/<?= $photo; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400">Logout</i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <!-- Conten Isi -->