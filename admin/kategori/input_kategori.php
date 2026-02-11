<?php

include "../../includes/koneksi.php";

$ket_kategori  = $_POST['ket_kategori'];


$sql = "INSERT INTO tb_kategori (ket_kategori)
            VALUES ('$ket_kategori')";
$sql_eksekusi = mysqli_query($koneksi, $sql);
if ($sql_eksekusi) {
    header("location:index.php");
} else {
    echo "Gagal menambahkan kelas baru!";
}
?>