<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("location:../index.php");
}
include "../includes/koneksi.php";
include "../includes/baseurl.php";

$title = "Dashboard";
$menu  = "dashboard";
?>

<?php include "layout/header.php"; ?>
<?php include "layout/sidebar.php"; ?>

<div class="flex-fill d-flex flex-column">
    <?php include "layout/topbar.php"; ?>

    <!-- CONTENT -->
    <main class="p-4 overflow-auto">

        <!-- SECTION TITLE -->
        <div class="mb-4">
            <h5 class="fw-bold mb-1">Ringkasan Aspirasi</h5>
            <small class="text-muted">Pantau status aspirasi siswa secara real-time</small>
        </div>

        <!-- STAT CARDS -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card rounded-4 shadow-sm">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="bg-primary-subtle text-primary rounded-3 p-3">
                            <i class="bi bi-chat-dots fs-4"></i>
                        </div>
                        <div>
                            <small class="text-muted">Total Aspirasi</small>
                            <h4 class="fw-bold mb-0">1,254</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card rounded-4 shadow-sm">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="bg-warning-subtle text-warning rounded-3 p-3">
                            <i class="bi bi-person-badge fs-4"></i>
                        </div>
                        <div>
                            <small class="text-muted">Total Siswa</small>
                            <h4 class="fw-bold mb-0">87</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card rounded-4 shadow-sm">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="bg-info-subtle text-info rounded-3 p-3">
                            <i class="bi bi-collection fs-4"></i>
                        </div>
                        <div>
                            <small class="text-muted">Total Kelas</small>
                            <h4 class="fw-bold mb-0">126</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card rounded-4 shadow-sm">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="bg-success-subtle text-success rounded-3 p-3">
                            <i class="bi bi-tags fs-4"></i>
                        </div>
                        <div>
                            <small class="text-muted">Total Kategori</small>
                            <h4 class="fw-bold mb-0">1,041</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">

            <!-- ASPIRASI TERBARU -->
            <div class="col-md-6">
                <div class="card rounded-4 shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">Aspirasi Terbaru</h6>

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <img src="https://i.pravatar.cc/40?img=1" class="rounded-circle">
                                <div>
                                    <div class="fw-semibold">Dita</div>
                                    <small class="text-muted">Fasilitas Sekolah</small>
                                </div>
                            </div>
                            <span class="badge bg-warning-subtle text-warning">Menunggu</span>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <img src="https://i.pravatar.cc/40?img=2" class="rounded-circle">
                                <div>
                                    <div class="fw-semibold">Riski</div>
                                    <small class="text-muted">Lingkungan</small>
                                </div>
                            </div>
                            <span class="badge bg-primary-subtle text-primary">Diproses</span>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <img src="https://i.pravatar.cc/40?img=3" class="rounded-circle">
                                <div>
                                    <div class="fw-semibold">Sari</div>
                                    <small class="text-muted">Kegiatan</small>
                                </div>
                            </div>
                            <span class="badge bg-success-subtle text-success">Selesai</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CHART -->
            <div class="col-md-6">
                <div class="card rounded-4 shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">Statistik Aspirasi</h6>
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include "layout/footer.php"; ?>