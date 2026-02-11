<?php
include "../../includes/koneksi.php";

$nis  = $_POST['nis'];
$nama_siswa     = $_POST['nama'];
$id_kelas       = $_POST['id_kelas'];
$email          = $_POST['email'];
$jenis_kelamin  = $_POST['jenis_kelamin'];
$role           = $_POST['role'];

// password default
$default_password = ($role == 'admin') ? 'admin123' : 'siswa123';
$password = md5($default_password);


$sql = "INSERT INTO tb_user (nis, nama, id_kelas, email, jenis_kelamin, role, password)
            VALUES ('$nis', '$nama_siswa', '$id_kelas', '$email', '$jenis_kelamin', '$role', '$password')";
$sql_eksekusi = mysqli_query($koneksi, $sql);
if ($sql_eksekusi) {
    header("location:index.php");
} else {
    echo "Gagal menambahkan siswa baru!";
}
