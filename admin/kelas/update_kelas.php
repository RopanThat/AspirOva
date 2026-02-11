<?php
include "../../includes/koneksi.php";

$id_kelas        = $_POST['id_kelas'];
$nama_kelas      = $_POST['nama_kelas'];
$tahun_ajaran       = $_POST['tahun_ajaran'];

$sql = "UPDATE tb_kelas 
        SET nama_kelas='$nama_kelas',
        tahun_ajaran='$tahun_ajaran'
        WHERE id_kelas = '$id_kelas'";
$sql_query = mysqli_query($koneksi, $sql);
if ($sql_query) {
    header("location:index.php");
} else {
    echo "data gagal diubah";
}
