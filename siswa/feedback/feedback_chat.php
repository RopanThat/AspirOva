<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != "siswa") {
    header("location:../index.php");
}
include "../../includes/koneksi.php";
include "../../includes/navbar_siswa.php";

$title = "Chat Feedback";
$menu  = "feedback";

// Ambil user ID dari query string
$user_id = $_SESSION['id_user'];

// Ambil nama siswa
$user = mysqli_fetch_assoc(mysqli_query(
    $koneksi,
    "SELECT nama FROM tb_user WHERE id_user='$user_id'"
));
?>

<head>
    <link rel="stylesheet" href="<?= base_url . "assets/css/chat.css" ?>">
</head>
<div class="flex-fill d-flex flex-column">


    <!-- CONTENT -->
    <main class="p-4 overflow-auto v-100">

        <head>
            <link rel="stylesheet" href="<?= base_url . "assets/css/chat.css" ?>">
        </head>

        <div class="flex-fill d-flex flex-column">

            <main class="p-4 overflow-auto v-100">
                <?php 
                $aspirasi = mysqli_query($koneksi, "SELECT * FROM tb_aspirasi"); 
                $aspirasi_data = mysqli_fetch_assoc($aspirasi);
                ?>

                <h4 class="mb-3">Chat Feedback</h4>
                <p class="text-muted small"><?= substr($aspirasi_data['isi_aspirasi'], 0, 100) ?>...</p>

                <!-- BOX CHAT -->
                <div class="card shadow-sm mb-3"
                    style="height: 400px; overflow-y: auto;"
                    id="chatBox">

                    <div class="card-body d-flex flex-column" id="chatContent">

                        <?php
                        $chats = mysqli_query($koneksi, "
        SELECT *
        FROM feedback_chat
        WHERE user_id='$user_id'
        ORDER BY created_at ASC
    ");

                        if (mysqli_num_rows($chats) > 0):

                            while ($c = mysqli_fetch_assoc($chats)):

                                $isAdmin = $c['pengirim'] == 'admin';
                        ?>

                                <div class="mb-2 <?= $isAdmin ? 'text-start' : 'text-end' ?>">

                                    <!-- NAMA -->
                                    <div class="chat-name mb-1">
                                        <?= $isAdmin ? 'Admin' : 'Anda'; ?>
                                    </div>

                                    <!-- BUBBLE -->
                                    <div class="chat-bubble d-inline-block px-3 py-2 rounded-3
                                    <?= $isAdmin ? 'bg-light text-dark' : 'bg-primary text-white' ?>">
                                        <?= htmlspecialchars($c['pesan']) ?>
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
                    <input type="hidden" name="user_id" value="<?= $user_id ?>">

                    <div class="chat-input-wrapper d-flex gap-2">
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

            </main>
        </div>

    </main>
</div>