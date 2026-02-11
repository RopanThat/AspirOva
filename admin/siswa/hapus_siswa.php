<?php

include "../../includes/koneksi.php";

$id_user = $_GET['id_user'];

$sql = "DELETE FROM tb_user WHERE id_user='$id_user'";
$sql_eksekusi = mysqli_query($koneksi, $sql);
if ($sql_eksekusi) {
    header("location:index.php");
} else {
    echo "GAGAL HAPUS DATA";
}
