<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("location:../index.php");
}
include "../../includes/koneksi.php";
include "../../includes/baseurl.php";

$title = "";
$menu  = "";

$id_aspirasi = intval($_GET['aspirasi'] ?? 0);

// Ambil data aspirasi + siswa
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT tb_aspirasi.*, tb_user.nama, tb_user.id_user
    FROM tb_aspirasi
    JOIN tb_user ON tb_user.id_user = tb_aspirasi.id_user
    WHERE tb_aspirasi.id_aspirasi = '$id_aspirasi'
"));

if (!$data) {
    echo "Aspirasi tidak ditemukan!";
    exit;
}

$user_id = $data['id_user'];
?>

<?php include "../layout/header.php"; ?>
<?php include "../layout/sidebar.php"; ?>

<head>
    <link rel="stylesheet" href="<?= base_url . 'assets/css/chat.css' ?>">
</head>

<div class="flex-fill d-flex flex-column">
    <?php include "../layout/topbar.php"; ?>

    <!-- CONTENT -->
    <main class="p-4 overflow-auto">
        <h4 class="mb-3">
            Chat Feedback<br>
            <small class="text-muted">
                Siswa: <?= htmlspecialchars($data['nama']); ?>
            </small>
        </h4>

        <!-- BOX CHAT -->
        <div class="card shadow-sm mb-3" style="height: 400px; overflow-y: auto;">
            <div class="card-body d-flex flex-column" id="chatContent">

                <?php
                $chat = mysqli_query($koneksi, "
                SELECT * FROM tb_feedback
                WHERE id_aspirasi = '$id_aspirasi'
                ORDER BY created_at ASC
            ");

                if (mysqli_num_rows($chat) > 0) :

                    while ($c = mysqli_fetch_assoc($chat)) :

                        $isAdmin = $c['pengirim'] == 'admin';
                        ?>

                        <div class="mb-2 <?= $isAdmin ? 'text-end' : 'text-start' ?>">

                            <!-- NAMA -->
                            <div class="chat-name mb-1">
                                <?= $isAdmin ? 'Admin' : htmlspecialchars($data['nama']); ?>
                            </div>

                            <!-- BUBBLE -->
                            <div class="chat-bubble d-inline-block px-3 py-2 rounded-3
                        <?= $isAdmin ? 'bg-primary text-white' : 'bg-success text-white' ?>">
                                <?= htmlspecialchars($c['isi_feedback']) ?>
                            </div>

                            <!-- WAKTU -->
                            <div class="chat-time small text-muted">
                                <?= date('H:i, d M', strtotime($c['created_at'])) ?>
                            </div>

                        </div>

                    <?php
                        endwhile;

                    else :
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
                <input type="text" name="pesan" class="form-control rounded-3" placeholder="Tulis pesan..." required>

                <button class="btn btn-primary rounded-3">
                    Kirim
                </button>
            </div>
        </form>
    </main>
</div>

<script>
// Auto scroll ke bawah
var chatBox = document.getElementById("chatContent");
chatBox.scrollTop = chatBox.scrollHeight;
</script>

<?php include "../layout/footer.php" ?>