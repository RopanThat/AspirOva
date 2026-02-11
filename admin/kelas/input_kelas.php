<?php
include "../../includes/koneksi.php";

$nama_kelas  = $_POST['nama_kelas'];
$tahun_ajaran   = $_POST['tahun_ajaran'];

$sql = "INSERT INTO tb_kelas (nama_kelas, tahun_ajaran)
            VALUES ('$nama_kelas', '$tahun_ajaran')";
$sql_eksekusi = mysqli_query($koneksi, $sql);
if ($sql_eksekusi) {
    header("location:index.php");
} else {
    echo "Gagal menambahkan kelas baru!";
}
