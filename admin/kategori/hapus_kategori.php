<?php

include "../../includes/koneksi.php";

$id_kategori = $_GET['id_kategori'];

$sql = "DELETE FROM tb_kategori WHERE id_kategori='$id_kategori'";
$sql_eksekusi = mysqli_query($koneksi, $sql);
if ($sql_eksekusi) {
    header("location:index.php");
} else {
    echo "GAGAL HAPUS DATA";
}
