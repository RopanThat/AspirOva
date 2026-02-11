<?php
include "baseurl.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suara Siswa</title>
    <link rel="stylesheet" href="<?= base_url ?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url ?>bootstrap-icons/bootstrap-icons.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Awal Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a href="<?= base_url . "admin" ?>" class="navbar-brand fw-bold">Suara Siswa</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a href="<?= base_url . "admin/kelas" ?>" class="nav-link <?php if ($_SESSION['menu'] == 'kelas') {
                                                                                                        echo "active bg-success text-light";
                                                                                                    } ?>">Kelas</a></li>
                    <li class="nav-item"><a href="<?= base_url . "admin/siswa" ?>" class="nav-link <?php if ($_SESSION['menu'] == 'siswa') {
                                                                                                        echo "active bg-success text-light";
                                                                                                    } ?>">Siswa</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Kategori</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Aspirasi</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Umpan Balik</a></li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="<?= base_url . "login/cek_logout.php" ?>" class="btn btn-danger text-light">Keluar</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!--Akhir navbar-->