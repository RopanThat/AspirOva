<?php
include "../../includes/koneksi.php";

$id_user        = $_POST['id_user'];
$nis            = $_POST['nis'];
$nama_siswa     = $_POST['nama'];
$id_kelas       = $_POST['id_kelas'];
$email          = $_POST['email'];
$jenis_kelamin  = $_POST['jenis_kelamin'];

$sql = "UPDATE tb_user
        SET nis='$nis',
        nama='$nama_siswa',
        id_kelas='$id_kelas',
        email='$email',
        jenis_kelamin='$jenis_kelamin'
        WHERE id_user = '$id_user'";
$sql_query = mysqli_query($koneksi, $sql);
if ($sql_query) {
    header("location:index.php");
} else {
    echo "data gagal diubah";
}
