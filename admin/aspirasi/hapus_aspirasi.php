<?php

include "../../includes/koneksi.php";

$id_aspirasi = $_GET['id'];

$sql = "DELETE FROM tb_aspirasi WHERE id_aspirasi='$id_aspirasi'";
$sql_eksekusi = mysqli_query($koneksi, $sql);

if ($sql_eksekusi) {
    header("location:index.php");
} else {
    echo "GAGAL HAPUS DATA";
}
