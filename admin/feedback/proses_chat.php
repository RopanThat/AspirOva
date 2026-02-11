<?php
session_start();
include "../../includes/koneksi.php";

// cek login
if (!isset($_SESSION['id_user'])) {
    header("location:../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user_id  = $_POST['user_id'];
    $admin_id = $_SESSION['id_user'];
    $pesan    = mysqli_real_escape_string($koneksi, $_POST['pesan']);

    // validasi pesan tidak kosong
    if (!empty($pesan)) {

        $query = "INSERT INTO feedback_chat 
                    (user_id, admin_id, pengirim, pesan) 
                  VALUES 
                    ('$user_id', '$admin_id', 'admin', '$pesan')";

        mysqli_query($koneksi, $query);
    }

    // kembali ke halaman chat
    header("location:feedback_chat.php?user=" . $user_id);
    exit;
}
