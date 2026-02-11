<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("location:../index.php");
}
include "../../includes/koneksi.php";
include "../../includes/baseurl.php";

$title = "Chat Feedback";
$menu  = "feedback";

// Ambil user ID dari query string
$user_id = $_GET['user'] ?? 0;

// Ambil nama siswa
$user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama FROM tb_user WHERE id_user='$user_id'"));
?>

<head>
    <link rel="stylesheet" href="<?= base_url . "assets/css/chat.css" ?>">
</head>
<?php include "../layout/header.php"; ?>
<?php include "../layout/sidebar.php"; ?>

<div class="flex-fill d-flex flex-column">
    <?php include "../layout/topbar.php"; ?>

    <!-- CONTENT -->
    <main class="p-4 overflow-auto v-100">
        <h4>Chat dengan: <?= $user['nama'] ?></h4>
        <div class="card shadow-sm mb-3" style="height: 400px; overflow-y: auto;" id="chatBox">
            <div class="card-body d-flex flex-column" id="chatContent">
                <?php
                $chats = mysqli_query($koneksi, "
                    SELECT feedback_chat.*, tb_user.nama 
                    FROM feedback_chat
                    JOIN tb_user ON tb_user.id_user = feedback_chat.user_id
                    WHERE feedback_chat.user_id='$user_id'
                    ORDER BY created_at ASC
                ");

                while ($c = mysqli_fetch_assoc($chats)) {
                    $isAdmin = $c['pengirim'] == 'admin';
                ?>
                    <div class="mb-2 <?= $isAdmin ? 'text-end' : 'text-start' ?>">

                        <!-- TAG PENGIRIM -->
                        <div class="chat-name mb-1">
                            <?= $isAdmin ? 'Admin' : $c['nama']; ?>
                        </div>


                        <!-- BUBBLE CHAT -->
                        <div class="chat-bubble d-inline-block <?= $isAdmin ? 'bg-primary text-white' : 'bg-success text-light' ?>">
                            <?= $c['pesan'] ?>
                        </div>

                        <!-- WAKTU -->
                        <div class="chat-time">
                            <?= date('H:i, d M', strtotime($c['created_at'])) ?>
                        </div>

                    </div>

                <?php } ?>
            </div>
        </div>

        <!-- Form Kirim Pesan -->
        <form method="POST" action="proses_chat.php">
            <input type="hidden" name="user_id" value="<?= $user_id ?>">
            <div class="chat-input-wrapper">
                <input type="text" name="pesan" class="chat-input" placeholder="Tulis pesan..." required>
                <button class="chat-send-btn" type="submit">
                    Kirim
                </button>
            </div>

        </form>
    </main>
</div>

<?php include "../layout/footer.php"; ?>