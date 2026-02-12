<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "siswa") {
    header("location:../index.php");
}

include "../../includes/koneksi.php";
include "../../includes/navbar_siswa.php";

$id_user = $_SESSION['id_user'];

$aspirasi = mysqli_query($koneksi, "
    SELECT 
        tb_aspirasi.*,
        tb_user.nama
    FROM tb_aspirasi
    JOIN tb_user 
        ON tb_user.id_user = tb_aspirasi.id_user
    WHERE tb_aspirasi.id_user = '$id_user'
    ORDER BY tb_aspirasi.created_at DESC
");
?>

<main class="flex-fill">
    <div class="container mt-4">

        <h3 class="fw-bold mb-4">Riwayat Aspirasi Saya</h3>

        <?php if (mysqli_num_rows($aspirasi) > 0) { ?>

            <div class="row">

                <?php while ($a = mysqli_fetch_assoc($aspirasi)) { ?>

                    <?php
                            // Badge Status
                            if ($a['status'] == 'proses') {
                                $badge = 'bg-warning text-dark';
                            } elseif ($a['status'] == 'selesai') {
                                $badge = 'bg-success text-dark';
                            } elseif ($a['status'] == 'ditolak') {
                                $badge = 'bg-danger text-light';
                            } else {
                                $badge = 'bg-secondary text-light';
                            }

                            // Foto
                            if ($a['foto'] != '') {
                                $foto = base_url . "assets/uploads/aspirasi/" . $a['foto'];
                            } else {
                                $foto = base_url . "assets/no-image.png";
                            }

                            $status = $a['status'];
                            ?>

                    <div class="col-12 col-md-6 mb-4">
                        <div class="card border-2 shadow rounded-4 h-100 aspirasi-card overflow-hidden">

                            <!-- GAMBAR -->
                            <img src="<?= $foto ?>" class="w-100" style="height:200px; object-fit:cover;">

                            <div class="card-body d-flex flex-column">

                                <!-- STATUS -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <span class="badge <?= $badge ?> mb-2">
                                            <?= ucfirst($a['status']); ?>
                                        </span>
                                    </div>
                                </div>
                                <!-- ISI -->
                                <p class="text-muted mb-3">
                                    <?= substr($a['isi_aspirasi'], 0, 120); ?>...
                                </p>

                                <!-- TANGGAL -->
                                <small class="text-muted mb-3">
                                    Dikirim pada <?= date('d M Y H:i', strtotime($a['created_at'])) ?>
                                </small>

                                <!-- BUTTON AREA -->
                                <?php if (in_array($status, ['menunggu', 'proses'])) { ?>
                                    <div class="mt-auto d-flex gap-2 flex-wrap">

                                        <?php if ($status == 'menunggu') { ?>

                                            <button class="btn btn-sm btn-warning rounded-3" data-bs-toggle="modal" data-bs-target="#editModal<?= $a['id_aspirasi']; ?>">
                                                Edit
                                            </button>

                                            <button class="btn btn-sm btn-danger rounded-3" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $a['id_aspirasi']; ?>">
                                                Hapus
                                            </button>

                                        <?php } ?>

                                        <a href="../feedback/feedback_chat.php?id=<?= $a['id_aspirasi']; ?>" class="btn btn-sm btn-primary rounded-3 ms-auto">
                                            <i class="bi bi-chat-dots"></i> Chat
                                        </a>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>

                    <!-- ================= MODAL EDIT ================= -->
                    <div class="modal fade" id="editModal<?= $a['id_aspirasi']; ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <form action="edit_aspirasi.php" method="POST">
                                <div class="modal-content rounded-4 border-0">

                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Aspirasi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" name="id_aspirasi" value="<?= $a['id_aspirasi']; ?>">

                                        <label class="form-label">Isi Aspirasi</label>
                                        <textarea name="isi_aspirasi" class="form-control rounded-3" rows="4" required><?= $a['isi_aspirasi']; ?></textarea>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">
                                            Batal
                                        </button>

                                        <button type="submit" class="btn btn-warning text-dark rounded-3">
                                            Simpan Perubahan
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- ================= MODAL HAPUS ================= -->
                    <div class="modal fade" id="hapusModal<?= $a['id_aspirasi']; ?>" tabindex="-1">
                        <div class="modal-dialog modal-sm">
                            <form action="hapus_aspirasi.php" method="POST">
                                <div class="modal-content rounded-4 border-0">

                                    <div class="modal-body text-center p-4">

                                        <input type="hidden" name="id_aspirasi" value="<?= $a['id_aspirasi']; ?>">

                                        <h5 class="mb-3">Hapus Aspirasi?</h5>
                                        <p class="text-muted small">
                                            Aspirasi yang dihapus tidak dapat dikembalikan.
                                        </p>

                                        <div class="d-flex gap-2 justify-content-center">
                                            <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">
                                                Batal
                                            </button>

                                            <button type="submit" class="btn btn-danger rounded-3">
                                                Hapus
                                            </button>
                                        </div>

                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                <?php } ?>

            </div>

        <?php } else { ?>

            <div class="text-center py-5">
                <h5 class="text-muted">Belum ada aspirasi</h5>
                <p class="text-muted">Silakan buat aspirasi baru terlebih dahulu.</p>
            </div>

        <?php } ?>

    </div>
</main>

<?php include "../../includes/footer.php" ?>