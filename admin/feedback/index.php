<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("location:../index.php");
}
include "../../includes/koneksi.php";
include "../../includes/baseurl.php";

$title = "Feedback";
$menu  = "feedback";

$q_feedback = mysqli_query($koneksi, "SELECT id_feedback FROM tb_feedback");
$total_feedback = mysqli_num_rows($q_feedback);

$q_aspirasi = mysqli_query($koneksi, "SELECT id_aspirasi FROM tb_aspirasi");
$total_aspirasi = mysqli_num_rows($q_aspirasi);
?>

<?php include "../layout/header.php"; ?>
<?php include "../layout/sidebar.php"; ?>

<div class="flex-fill d-flex flex-column">
    <?php include "../layout/topbar.php"; ?>

    <!-- CONTENT -->
    <main class="p-4 overflow-auto">
        <h2 class="mb-4">Manajemen Feedback</h2>

        <!-- Card Statistik -->
        <div class="row mb-4 d-flex align-items-center justify-content-center">
            <div class="col-md-4">
                <div class="card rounded-4 shadow-sm">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="bg-info-subtle text-info rounded-3 p-3">
                            <i class="bi bi-chat-dots-fill fs-4"></i>

                        </div>
                        <div>
                            <small class="text-muted">Total feedback</small>
                            <h4 class="fw-bold mb-0"><?= $total_feedback ?></h4>
                        </div>
                    </div>
                </div>
            </div>
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





        <!-- Daftar Aspirasi Singkat -->
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Aspirasi Terbaru</h5>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <?php
                    $query = mysqli_query($koneksi, "SELECT a.*, u.nama FROM tb_aspirasi a JOIN tb_user u ON a.id_user=u.id_user ORDER BY a.created_at DESC LIMIT 5");
                    while ($row = mysqli_fetch_assoc($query)) { ?>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong><?= $row['nama'] ?></strong> - <?= substr($row['isi_aspirasi'], 0, 50) ?>...
                                <div class="text-muted small"><?= date('d M Y', strtotime($row['created_at'])) ?></div>
                            </div>
                            <a href="<?= base_url ?>admin/feedback/feedback_chat.php?user=<?= $row['id_user'] ?>" class="btn btn-primary btn-sm">Chat</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>
</div>
<?php include "../layout/footer.php"; ?>