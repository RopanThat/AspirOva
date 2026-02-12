<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != "siswa") {
    header("location:../index.php");
}

include "../../includes/koneksi.php";
include "../../includes/navbar_siswa.php";

$id_user      = $_SESSION['id_user'];
$id_aspirasi  = $_GET['id'] ?? 0;

// Pastikan aspirasi milik siswa
$aspirasi = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT * FROM tb_aspirasi 
    WHERE id_aspirasi='$id_aspirasi' 
    AND id_user='$id_user'
"));

if (!$aspirasi) {
    echo "Aspirasi tidak ditemukan!";
}
?>

<link rel="stylesheet" href="<?= base_url . "assets/css/chat.css" ?>">

<div class="container py-4">

    <h4 class="mb-3">Chat Feedback</h4>
    <p class="text-muted small">
        <?= substr($aspirasi['isi_aspirasi'], 0, 100) ?>...
    </p>

    <!-- BOX CHAT -->
    <div class="card shadow-sm mb-3" style="height: 400px; overflow-y: auto;">
        <div class="card-body d-flex flex-column" id="chatContent">

            <?php
            $chat = mysqli_query($koneksi, "
                SELECT tb_feedback.*, tb_user.nama, tb_user.role
                FROM tb_feedback
                JOIN tb_user ON tb_user.id_user = tb_feedback.id_user
                WHERE tb_feedback.id_aspirasi = '$id_aspirasi'
                ORDER BY tb_feedback.created_at ASC
            ");

            if (mysqli_num_rows($chat) > 0):

                while ($c = mysqli_fetch_assoc($chat)):

                    $isAdmin = $c['role'] == 'admin';
            ?>

                    <div class="mb-2 <?= $isAdmin ? 'text-start' : 'text-end' ?>">

                        <!-- NAMA PENGIRIM -->
                        <div class="chat-name mb-1">
                            <?= htmlspecialchars($c['nama']); ?>
                        </div>

                        <!-- BUBBLE CHAT -->
                        <div class="chat-bubble d-inline-block px-3 py-2 rounded-3
                        <?= $isAdmin ? 'bg-light text-dark' : 'bg-primary text-white' ?>">
                            <?= htmlspecialchars($c['isi_feedback']) ?>
                        </div>

                        <!-- WAKTU -->
                        <div class="chat-time small text-muted">
                            <?= date('H:i, d M', strtotime($c['created_at'])) ?>
                        </div>

                    </div>

                <?php
                endwhile;

            else:
                ?>

                <div class="text-center text-muted">
                    Belum ada pesan.
                </div>

            <?php endif; ?>

        </div>
    </div>

    <!-- FORM KIRIM -->
    <form method="POST" action="proses_chat.php">
        <input type="hidden" name="id_aspirasi" value="<?= $id_aspirasi ?>">

        <div class="d-flex gap-2">
            <input type="text"
                name="pesan"
                class="form-control rounded-3"
                placeholder="Tulis pesan..."
                required>

            <button class="btn btn-primary rounded-3">
                Kirim
            </button>
        </div>
    </form>

</div>

<script>
// Auto scroll ke bawah saat halaman load
var chatBox = document.getElementById("chatContent");
chatBox.scrollTop = chatBox.scrollHeight;
</script>
