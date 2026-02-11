<?php

include "../../includes/koneksi.php";

$id_kelas = $_GET['id_kelas'];

$sql = "DELETE FROM tb_kelas WHERE id_kelas='$id_kelas'";
$sql_eksekusi = mysqli_query($koneksi, $sql);
if ($sql_eksekusi) {
    header("location:index.php");
} else {
    echo "GAGAL HAPUS DATA";
}
