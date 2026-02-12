<?php
include "../../includes/koneksi.php";


if (isset($_POST['id_aspirasi'])) {

    $id = $_POST['id_aspirasi'];
    $statusBaru = $_POST['status'];

    // Ambil status sekarang
    $data = mysqli_fetch_assoc(mysqli_query(
        $koneksi,
        "SELECT status FROM tb_aspirasi WHERE id_aspirasi='$id'"
    ));

    $statusSekarang = $data['status'];

    // Validasi aturan
    if (
        $statusSekarang == 'menunggu' &&
        ($statusBaru == 'proses' || $statusBaru == 'ditolak')
    ) {
        mysqli_query($koneksi, "UPDATE tb_aspirasi 
                                SET status='$statusBaru' 
                                WHERE id_aspirasi='$id'");
    } elseif ($statusSekarang == 'proses' && $statusBaru == 'selesai') {

        mysqli_query($koneksi, "UPDATE tb_aspirasi 
                                SET status='$statusBaru' 
                                WHERE id_aspirasi='$id'");
    }
    
    // selain itu tidak akan diproses

    header("Location: index.php");
}
