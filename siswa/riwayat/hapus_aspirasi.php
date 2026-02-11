<?php
include "../../includes/koneksi.php";

$id = $_POST['id_aspirasi'];

mysqli_query($koneksi, "
    DELETE FROM tb_aspirasi
    WHERE id_aspirasi='$id'
");

header("location:index.php");
