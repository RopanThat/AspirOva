<?php
include "../../includes/koneksi.php";

$id  = $_POST['id_aspirasi'];
$isi = $_POST['isi_aspirasi'];

mysqli_query($koneksi, "
    UPDATE tb_aspirasi
    SET isi_aspirasi='$isi',
        updated_at = NOW()
    WHERE id_aspirasi='$id'
");

header("location:index.php");
