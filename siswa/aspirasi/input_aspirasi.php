<?php
session_start();
include "../../includes/koneksi.php";

$id_user      = $_SESSION['id_user'];
$id_kategori  = $_POST['id_kategori'];
$lokasi       = $_POST['lokasi'];
$isi          = $_POST['isi_aspirasi'];
$status       = "menunggu";
$nama_file = $_FILES['foto']['name'];
$tmp       = $_FILES['foto']['tmp_name'];

$folder = "../../assets/uploads/aspirasi/";

if ($nama_file != "") {

    $ext = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png'];

    if (!in_array($ext, $allowed)) {
        echo "File harus gambar!";
        exit;
    }

    // biar nama file ga bentrok
    $nama_baru = time() . '_' . $nama_file;

    move_uploaded_file($tmp, $folder . $nama_baru);
} else {
    $nama_baru = NULL;
}

$query = mysqli_query($koneksi, "
    INSERT INTO tb_aspirasi
    (id_user, id_kategori, lokasi, isi_aspirasi, status, foto, created_at)
    VALUES
    ('$id_user','$id_kategori','$lokasi','$isi','$status','$nama_baru',NOW())
");

header("location:index.php?status=berhasil");
