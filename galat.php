<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kegagalan Sistem</title>
    <?php
    include "includes/baseurl.php";
    ?>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-icons/bootstrap-icons.css">
</head>

<body class="bg-primary">
    <?php
    if (!isset($_GET['pesan'])) {
        $judul = "kesalahan sistem";
        $isi   = "perubahan tidak disimpan";
        $link  = "base_url";
        $ikon   = "";
        $tombol = "Landing Page";
        $wtom   = "btn-danger";
    } else if ($_GET['pesan'] == "Gagallogin") {
        $judul = "kombinasi email dan kata sandi salah";
        $isi   = "kombinasi email dan kata sandi tidak ditemukan. pastikan email dan kata sandi ditulis dengan benar";
        $link  = base_url . "login";
        $ikon   = "bi-arrow-right";
        $tombol = "Kembali ke halaman login";
        $wtom   = "btn-warning";
    } else if ($_GET['pesan'] == "gagalinputkelas") {
        $judul = "data kelas gagal di input";
        $isi   = "maafkan kami ada kesalahan sistem akan segera kami perbaiki";
        $link  = base_url . "admin/kelas";
        $ikon   = "bi-arrow-right";
        $tombol = "Kembali ke halaman login";
        $wtom   = "btn-danger";
    }


    ?>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="bg-light text-center shadow rounded p-5">
            <h2><?= $judul; ?></h2>
            <p><?= $isi; ?></p>
            <a href="<?= $link; ?>" class="btn <?= $wtom; ?> mt-3"><?= $tombol; ?></a>
        </div>
    </div>
</body>

</html>