<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("location:../index.php");
}
include "../../includes/koneksi.php";
include "../../includes/baseurl.php";

$title = "Aspirasi";
$menu  = "aspirasi";

/* ======================
TOTAL DATA
====================== */
$q_aspirasi = mysqli_query($koneksi, "SELECT id_aspirasi FROM tb_aspirasi");
$total_aspirasi = mysqli_num_rows($q_aspirasi);

/* ======================
DATA ASPIRASI
====================== */
$data = mysqli_query($koneksi, "
    SELECT 
        a.*, 
        k.ket_kategori,
        u.nama
    FROM tb_aspirasi a
    JOIN tb_kategori k ON a.id_kategori = k.id_kategori
    JOIN tb_user u ON a.id_user = u.id_user
    ORDER BY a.id_aspirasi DESC
") or die(mysqli_error($koneksi));
?>

<?php include "../layout/header.php"; ?>
<?php include "../layout/sidebar.php"; ?>

<div class="flex-fill d-flex flex-column">
    <?php include "../layout/topbar.php"; ?>

    <!-- CONTENT -->
    <main class="p-4 overflow-auto">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Manajemen Aspirasi</h4>
                <small class="text-muted">Kelola dan tindak lanjuti aspirasi siswa</small>
            </div>
        </div>

        <!-- SUMMARY -->
        <div class="row mb-4 d-flex align-items-center justify-content-center">
            <div class="col-md-4">
                <div class="card rounded-4 shadow-sm">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="bg-info-subtle text-info rounded-3 p-3">
                            <i class="bi bi-chat-left-dots fs-4"></i>
                        </div>
                        <div>
                            <small class="text-muted">Total Aspirasi</small>
                            <h4 class="fw-bold mb-0"><?= $total_aspirasi ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD LIST -->
        <div class="row g-4">

            <?php while ($row = mysqli_fetch_assoc($data)) : ?>

                <?php
                // badge status
                if ($row['status'] == 'menunggu') {
                    $badge = 'secondary';
                } elseif ($row['status'] == 'proses') {
                    $badge = 'warning';
                } else {
                    $badge = 'success';
                }

                // foto
                if ($row['foto'] != '') {
                    $foto = base_url . "assets/uploads/aspirasi/" . $row['foto'];
                } else {
                    $foto = base_url . "assets/no-image.png";
                }
                ?>

                <div class="col-md-4">
                    <div class="card h-100 rounded-4 shadow-sm">

                        <img src="<?= $foto ?>" class="card-img-top rounded-top-4"
                            style="height:200px; object-fit:cover;">

                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge bg-primary"><?= $row['ket_kategori'] ?></span>
                                <span class="badge bg-<?= $badge ?>">
                                    <?= ucfirst($row['status']) ?>
                                </span>
                            </div>

                            <p class="mb-2 text-muted" style="font-size:14px;">
                                <?= substr($row['isi_aspirasi'], 0, 120) ?>...
                            </p>

                            <small class="text-muted mb-1">
                                <i class="bi bi-geo-alt"></i> <?= $row['lokasi'] ?>
                            </small>
                            <small class="text-muted mb-1">
                                <i class="bi bi-person"></i> <?= $row['nama'] ?>
                            </small>
                            <small class="text-muted">
                                <i class="bi bi-calendar"></i>
                                <?= date('d M Y', strtotime($row['created_at'])) ?>
                            </small>

                            <div class="mt-auto d-flex gap-2 pt-3">
                                <a href="detail_aspirasi.php?id=<?= $row['id_aspirasi'] ?>"
                                    class="btn btn-info btn-sm w-100">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <a href="hapus_aspirasi.php?id=<?= $row['id_aspirasi'] ?>"
                                    onclick="return confirm('Yakin ingin menghapus aspirasi ini?')"
                                    class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </a>

                            </div>
                        </div>

                    </div>
                </div>

            <?php endwhile; ?>

            <?php if ($total_aspirasi == 0): ?>
                <div class="col-12 text-center text-muted">
                    Belum ada aspirasi
                </div>
            <?php endif; ?>

        </div>

    </main>
</div>

<?php include "../layout/footer.php"; ?>