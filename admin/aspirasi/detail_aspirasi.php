<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("location:../index.php");
}
include "../../includes/koneksi.php";
include "../../includes/baseurl.php";

$title = "Detail Aspirasi";
$menu  = "detail_aspirasi";

// VALIDASI ID
if (!isset($_GET['id'])) {
    header("Location: index.php");
}

$id = intval($_GET['id']);

// UQERY DETAIL ASPIRASI
$data = mysqli_query($koneksi, "
    SELECT 
        a.*,
        k.ket_kategori,
        u.nama AS nama_user
    FROM tb_aspirasi a
    LEFT JOIN tb_kategori k ON a.id_kategori = k.id_kategori
    LEFT JOIN tb_user u ON a.id_user = u.id_user
    WHERE a.id_aspirasi = '$id'
") or die(mysqli_error($koneksi));

$row = mysqli_fetch_assoc($data);

// JIKA DATA TIDAK DITEMUKAN
if (!$row) {
    echo "<script>alert('Data aspirasi tidak ditemukan');window.location='index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Aspirasi</title>
    <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include "../layout/header.php"; ?>
    <?php include "../layout/sidebar.php"; ?>

    <div class="flex-fill d-flex flex-column">
        <?php include "../layout/topbar.php"; ?>

        <!-- CONTENT -->
        <main class="p-4 overflow-auto">

            <div class="container mt-4">
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detail Aspirasi</h5>
                        <span class="badge bg-<?=
                                                    $row['status'] == 'menunggu' ? 'secondary' : ($row['status'] == 'proses' ? 'warning' : 'danger')
                                                ?>">
                            <?= ucfirst($row['status']) ?>
                        </span>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <!-- FOTO -->
                            <div class="col-md-4">
                                <?php if (!empty($row['foto'])) : ?>
                                    <img src="<?= base_url ?>assets/uploads/aspirasi/<?= $row['foto'] ?>" class="img-fluid rounded">
                                <?php else : ?>
                                    <div class="border rounded p-4 text-center text-muted">
                                        Tidak ada foto
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- DETAIL -->
                            <div class="col-md-8">
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="150">Pengirim</th>
                                        <td>: <?= $row['nama_user'] ?? '-' ?></td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td>: <?= $row['ket_kategori'] ?? '-' ?></td>
                                    </tr>
                                    <tr>
                                        <th>Lokasi</th>
                                        <td>: <?= $row['lokasi'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <td>: <?= date('d M Y H:i', strtotime($row['created_at'])) ?></td>
                                    </tr>
                                </table>

                                <hr>

                                <h6>Isi Aspirasi</h6>
                                <p><?= nl2br($row['isi_aspirasi']) ?></p>

                                <hr>

                                <!-- FORM UPDATE STATUS -->
                                <label class="form-label">Ubah Status</label>
                                <?php
                                $status = $row['status'];

                                if ($status == 'menunggu') {
                                    $nextStatus = 'proses';
                                    $btnText = 'Proses Aspirasi';
                                    $btnClass = 'btn-warning';
                                } elseif ($status == 'proses') {
                                    $nextStatus = 'selesai';
                                    $btnText = 'Selesaikan Aspirasi';
                                    $btnClass = 'btn-success';
                                } else {
                                    $nextStatus = '';
                                    $btnText = 'Sudah Selesai';
                                    $btnClass = 'btn-secondary';
                                }
                                ?>
                                <div class="d-flex gap-2">

                                    <?php if ($status == 'menunggu') : ?>

                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#prosesModal" data-id="<?= $row['id_aspirasi'] ?>">
                                            Proses Aspirasi
                                        </button>

                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-id="<?= $row['id_aspirasi'] ?>">
                                            Tolak
                                        </button>

                                    <?php elseif ($status == 'proses') : ?>

                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#selesaiModal" data-id="<?= $row['id_aspirasi'] ?>">
                                            Selesaikan
                                        </button>

                                    <?php else : ?>

                                        <button class="btn btn-secondary" disabled>
                                            <?= ucfirst($status) ?>
                                        </button>

                                    <?php endif; ?>

                                    <a href="index.php" class="btn btn-secondary">
                                        Kembali
                                    </a>

                                    <?php if ($status != 'selesai' && $status != 'ditolak') : ?>
                                        <a href="<?= base_url ?>admin/feedback/feedback_chat.php?aspirasi=<?= $row['id_aspirasi'] ?>" class="btn btn-primary ms-auto">
                                            <i class="bi bi-chat-dots"></i> Chat
                                        </a>
                                    <?php endif; ?>

                                </div>

                            </div>
                            <!-- MODAL proses -->
                            <div class="modal fade" id="prosesModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST" action="update_status.php">
                                            <div class="modal-header bg-info text-white">
                                                <h5 class="modal-title">Proses Aspirasi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                <p>
                                                    <b>Apakah anda yakin ingin memproses aspirasi ini?</b>
                                                    <br>
                                                    Anda akan mengubah status aspirasi ke tahap Penanganan.

                                                    Setelah tindakan ini dikonfirmasi:
                                                    <div class="bg-warning-subtle p-3 rounded mt-2">
                                                        <ul>
                                                            <li>Aspirasi akan masuk ke proses tindak lanjut.</li>
                                                            <li>Status tidak dapat dikembalikan ke Ditolak.</li>
                                                            <li>Perubahan bersifat permanen.</li>
                                                        </ul>

                                                        Pastikan keputusan sudah sesuai sebelum melanjutkan.
                                                    </div>
                                                </p>
                                                <input type="hidden" name="id_aspirasi" value="<?= $row['id_aspirasi'] ?>">
                                                <input type="hidden" name="status" value="proses">

                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-warning">Proses Aspirasi</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- MODAL selesai -->
                            <div class="modal fade" id="selesaiModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST" action="update_status.php">
                                            <div class="modal-header bg-success text-white">
                                                <h5 class="modal-title">Apakah anda yakin untuk menyelesaikan aspirasi ini?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                <p>Anda akan menyelesaikan aspirasi ini.
                                                    <br>
                                                    <b>Setelah dikonfirmasi:</b>
                                                    <div class="bg-success-subtle p-3 rounded mt-2">
                                                        <ul>
                                                            <li>Status akan berubah menjadi <strong>Selesai</strong>.</li>
                                                            <li>Aspirasi dianggap telah ditindaklanjuti sepenuhnya.</li>
                                                            <li>Status tidak dapat diubah kembali ke tahap sebelumnya.</li>
                                                        </ul>
                                                    </div>
                                                    <b>⚠️ Tindakan ini tidak dapat dibatalkan.</b>
                                                </p>
                                                <input type="hidden" name="id_aspirasi" value="<?= $row['id_aspirasi'] ?>">
                                                <input type="hidden" name="status" value="selesai">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Selesaikan</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- MODAL HAPUS -->
                            <div class="modal fade" id="hapusModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST" action="update_status.php">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">Hapus Aspirasi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                <p><b>Anda akan menolak aspirasi ini.</b>
                                                    <br>
                                                    <b>Setelah dikonfirmasi:</b>
                                                    <div class="bg-danger-subtle p-3 rounded mt-2">
                                                        <ul>
                                                            <li>Status akan berubah menjadi <strong>Ditolak</strong>.</li>
                                                            <li>Aspirasi tidak dapat diproses atau diselesaikan kembali.</li>
                                                            <li>Keputusan bersifat final dan tidak dapat diubah.</li>
                                                        </ul>
                                                    </div>
                                                    <b>⚠️ Pastikan keputusan sudah benar sebelum melanjutkan.</b>
                                                </p>
                                                <input type="hidden" name="id_aspirasi" value="<?= $row['id_aspirasi'] ?>">
                                                <input type="hidden" name="status" value="Ditolak">

                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">Tolak</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    </main>
    </div>

    <?php include "../layout/footer.php"; ?>
</body>

</html>