<?php
session_start();
include "../../includes/koneksi.php";

if ($_SESSION['role'] != 'admin') {
    header("location:../index.php");
    exit;
}

$id_admin    = intval($_SESSION['id_user']);
$id_aspirasi = intval($_POST['id_aspirasi']);
$pesan       = mysqli_real_escape_string($koneksi, $_POST['pesan']);

if (!empty($pesan)) {

    mysqli_query($koneksi, "
        INSERT INTO tb_feedback 
        (id_user, id_aspirasi, isi_feedback, pengirim)
        VALUES 
        ('$id_admin', '$id_aspirasi', '$pesan', 'admin')
    ");
}

header("location:feedback_chat.php?aspirasi=$id_aspirasi");
exit;
