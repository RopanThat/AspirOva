<?php

session_start();

include "../includes/koneksi.php";
$email = $_POST["email"];
$password = $_POST["password"];

$hash_password = md5($password);

$sql = "SELECT * FROM tb_user WHERE email='$email' AND password='$hash_password'";
$sql_eksekusi = mysqli_query($koneksi, $sql);
$hitung = mysqli_num_rows($sql_eksekusi);
$data = mysqli_fetch_array($sql_eksekusi);
if ($hitung == 1) {
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['nis'] = $data['nis'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['role'] = $data['role'];
    $_SESSION['menu']   = "beranda";


    if ($data['role'] == 'admin') {
        header("Location:../admin");
    } else if ($data['role'] == 'siswa') {
        header("Location:../siswa");
    }
    exit;
} else {
    header("Location:../galat.php?pesan=Gagallogin");
}

?>