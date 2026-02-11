<?php
session_start();
//Pengecekan jika tidak ada session role atau rolenya selain admin maka akan di kick ke halaman landing page
if (!isset($_SESSION['role']) || $_SESSION['role'] != "siswa") {
    header("location:../index.php");
}

include "../includes/koneksi.php";
include "../includes/navbar_siswa.php";

$title = "Dashboard Siswa";
$menu  = "dashboard_siswa";
?>

<head>
    <link rel="stylesheet" href="<?= base_url . 'assets/css/siswa.css' ?>">
</head>
<main class="flex-fill py-4 bg-light">
    <div class="container-fluid">
        <section class="hero text-dark bg-light min-vh-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5 pt-5 ms-5">
                        <h1 class="display-6 fw-bold mt-5">Halo, <?= $_SESSION['nama'] ?> 👋</h1>
                        <p class="lead fs-4 mt-3">Ayo kirim aspirasi dan saranmu untuk meningkatkan kualitas sekolah!</p>
                        <a href="<?= base_url . 'siswa/aspirasi' ?>" class="btn fs-5 btn-gradient">Kirim Aspirasi <i class="bi bi-arrow-right"></i></a>
                    </div>
                    <div class="col-lg-6">
                        <img src="<?= base_url . 'assets/siswa.png' ?>" alt="Image Error" width="100%" class="mt-5">
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="container mt-4">

        <!-- CARD BESAR DASHBOARD -->
        <div class="card border-0 shadow-sm rounded-4 p-4">

            <!-- JUDUL -->
            <div class="mb-4">
                <h5 class="fw-bold mb-1">Dashboard Siswa</h5>
                <span class="text-muted small">
                    Ringkasan aspirasi dan menu utama siswa
                </span>
            </div>

            <div class="row mb-4">

                <!-- SEDANG DIPROSES -->
                <div class="col-md-4 mb-3">
                    <div class="status-card proses-card d-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center">
                            <div class="status-icon bg-primary-subtle">
                                <i class="bi bi-hourglass-split text-primary"></i>
                            </div>

                            <div class="ms-3">
                                <h6 class="mb-0 fw-semibold">Sedang Diproses</h6>
                                <small class="text-muted">Aspirasi berjalan</small>
                            </div>
                        </div>

                        <div class="status-count">2</div>
                    </div>
                </div>

                <!-- SELESAI -->
                <div class="col-md-4 mb-3">
                    <div class="status-card selesai-card d-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center">
                            <div class="status-icon bg-success-subtle">
                                <i class="bi bi-check-circle text-success"></i>
                            </div>

                            <div class="ms-3">
                                <h6 class="mb-0 fw-semibold">Selesai</h6>
                                <small class="text-muted">Aspirasi diterima</small>
                            </div>
                        </div>

                        <div class="status-count">5</div>
                    </div>
                </div>

                <!-- DITOLAK -->
                <div class="col-md-4 mb-3">
                    <div class="status-card ditolak-card d-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center">
                            <div class="status-icon bg-warning-subtle">
                                <i class="bi bi-exclamation-circle text-warning"></i>
                            </div>

                            <div class="ms-3">
                                <h6 class="mb-0 fw-semibold">Ditolak</h6>
                                <small class="text-muted">Tidak disetujui</small>
                            </div>
                        </div>

                        <div class="status-count">1</div>
                    </div>
                </div>

            </div>


            <div class="row mt-3">

                <!-- RIWAYAT ASPIRASI -->
                <div class="col-md-6 mb-3">
                    <div class="menu-card riwayat-card">
                        <div class="d-flex align-items-start">

                            <div class="menu-icon bg-warning-subtle">
                                <i class="bi bi-list-check text-warning"></i>
                            </div>

                            <div class="flex-grow-1 ms-3">
                                <h5 class="fw-bold mb-1">Riwayat Aspirasi</h5>
                                <p class="text-muted mb-3">
                                    Lihat status dan riwayat aspirasi yang pernah kamu ajukan.
                                </p>

                                <a href="riwayat" class="btn btn-soft-warning">
                                    Lihat Riwayat
                                </a>
                            </div>

                            <div class="menu-arrow">
                                <i class="bi bi-chevron-right"></i>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- FEEDBACK ADMIN -->
                <div class="col-md-6 mb-3">
                    <div class="menu-card feedback-card">
                        <div class="d-flex align-items-start">

                            <div class="menu-icon bg-primary-subtle">
                                <i class="bi bi-chat-dots text-primary"></i>
                            </div>

                            <div class="flex-grow-1 ms-3">
                                <h5 class="fw-bold mb-1">Feedback Admin</h5>
                                <p class="text-muted mb-3">
                                    Lihat dan balas chat dari admin seputar aspirasi kamu.
                                </p>

                                <a href="feedback" class="btn btn-soft-primary">
                                    Lihat Pesan
                                </a>
                            </div>

                            <div class="menu-arrow">
                                <i class="bi bi-chevron-right"></i>
                            </div>

                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>



</main>