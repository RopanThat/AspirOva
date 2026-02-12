<?php
session_start();
include "../../includes/koneksi.php";

if ($_SESSION['role'] != 'siswa') {
    header("location:../index.php");
    exit;
}

$id_user     = intval($_SESSION['id_user']); // ID SISWA LOGIN
$id_aspirasi = intval($_POST['id_aspirasi']);
$pesan       = mysqli_real_escape_string($koneksi, $_POST['pesan']);

if (!empty($pesan)) {

    mysqli_query($koneksi, "
        INSERT INTO tb_feedback 
        (id_user, id_aspirasi, isi_feedback, pengirim)
        VALUES 
        ('$id_user', '$id_aspirasi', '$pesan', 'siswa')
    ");
}

header("location:feedback_chat.php?id=$id_aspirasi");
exit;
