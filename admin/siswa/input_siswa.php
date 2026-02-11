<?php
include "../../includes/koneksi.php";

$nis  = $_POST['nis'];
$nama_siswa     = $_POST['nama'];
$id_kelas       = $_POST['id_kelas'];
$email          = $_POST['email'];
$password       = $_POST['password'];
$jenis_kelamin  = $_POST['jenis_kelamin'];
$role           = 'siswa';

$password = md5($password);


$sql = "INSERT INTO tb_user (nis, nama, id_kelas, email, password, jenis_kelamin, role )
            VALUES ('$nis', '$nama_siswa', '$id_kelas', '$email', '$password', '$jenis_kelamin', '$role' )";
$sql_eksekusi = mysqli_query($koneksi, $sql);
if ($sql_eksekusi) {
    header("location:index.php");
} else {
    echo "Gagal menambahkan siswa baru!";
}
