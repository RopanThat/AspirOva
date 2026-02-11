<?php
session_start();
include "../../includes/koneksi.php";

// pastikan yang akses adalah siswa
if (!isset($_SESSION['role']) || $_SESSION['role'] != "siswa") {
    header("location:../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user_id = $_SESSION['id_user'];
    $admin_id = NULL;

    // ambil pesan
    $pesan = mysqli_real_escape_string($koneksi, $_POST['pesan']);

    // validasi pesan tidak kosong
    if (!empty($pesan)) {

        $query = "INSERT INTO feedback_chat
                    (user_id, admin_id, pengirim, pesan)
                VALUES
                    ('$user_id', NULL, 'siswa', '$pesan')";

        mysqli_query($koneksi, $query);
    }

    // kembali ke halaman chat siswa
    header("location:feedback_chat.php");
    exit;
}
