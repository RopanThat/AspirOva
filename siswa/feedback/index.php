<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != "siswa") {
    header("location:../index.php");
}
include "../../includes/koneksi.php";
include "../../includes/navbar_siswa.php";

$id_user = $_SESSION['id_user'];

$query = mysqli_query($koneksi, "
    SELECT a.*, u.nama
    FROM tb_aspirasi a
    JOIN tb_user u ON a.id_user = u.id_user
    WHERE a.id_user = '$id_user'
    ORDER BY a.created_at DESC
");

?>

<div class="flex-fill d-flex flex-column">

    <!-- CONTENT -->
    <main class="p-4 overflow-auto">

        <!-- Daftar Aspirasi Singkat -->

        <div class="flex-fill d-flex flex-column">

            <main class="p-4 overflow-auto">

                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Aspirasi Saya</h5>
                    </div>

                    <div class="card-body">
                        <div class="list-group">

                            <?php if (mysqli_num_rows($query) > 0): ?>

                                <?php while ($row = mysqli_fetch_assoc($query)) { ?>

                                    <div class="list-group-item d-flex justify-content-between align-items-center">

                                        <div>
                                            <b><?= $row['nama']; ?></b> -
                                            <?= substr($row['isi_aspirasi'], 0, 50); ?>...
                                            <br>

                                            <small class="text-muted">
                                                <?= date('d M Y', strtotime($row['created_at'])) ?>
                                            </small>
                                        </div>

                                        <a href="feedback_chat.php?id=<?= $row['id_aspirasi']; ?>"
                                            class="btn btn-primary btn-sm rounded-3">
                                            Chat
                                        </a>

                                    </div>

                                <?php } ?>

                            <?php else: ?>

                                <div class="text-center text-muted">
                                    Belum ada aspirasi yang dikirim.
                                </div>

                            <?php endif; ?>

                        </div>
                    </div>
                </div>

            </main>
        </div>


    </main>
</div>