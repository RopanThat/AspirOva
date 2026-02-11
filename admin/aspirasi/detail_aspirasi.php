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
    exit;
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
                                                $row['status'] == 'menunggu' ? 'warning' : ($row['status'] == 'proses' ? 'primary' : 'success')
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
                                <form method="post">
                                    <label class="form-label">Ubah Status</label>
                                    <div class="d-flex gap-2">
                                        <select name="status" class="form-select w-auto">
                                            <option value="menunggu" <?= $row['status'] == 'menunggu' ? 'selected' : '' ?>>Menunggu</option>
                                            <option value="proses" <?= $row['status'] == 'proses' ? 'selected' : '' ?>>Proses</option>
                                            <option value="selesai" <?= $row['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                                        </select>
                                        <button type="submit" name="update" class="btn btn-primary">
                                            Simpan
                                        </button>
                                        <a href="index.php" class="btn btn-secondary">
                                            Kembali
                                        </a>
                                    </div>
                                </form>

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

    <?php
    // PROSES UPDATE STATUS
    if (isset($_POST['update'])) {
        $status = $_POST['status'];

        mysqli_query($koneksi, "
        UPDATE tb_aspirasi 
        SET status='$status'
        WHERE id_aspirasi='$id'
    ");

        echo "<script>
        alert('Status berhasil diperbarui');
        window.location='detail_aspirasi.php?id=$id';
    </script>";
    }
    ?>
</body>

</html>