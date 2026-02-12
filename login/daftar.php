<?php
include "../includes/navbar_utama.php";
include "../includes/koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar | AspirOva</title>

</head>

<body class="min-vh-100" style="background: linear-gradient(135deg, #8B5CF6, #4F7DFF);">
    <div class="container d-flex align-items-center justify-content-center mt-5">
        <div class="card shadow-lg border-0 rounded-4 w-100" style="max-width: 700px;">
            <div class="card-body p-4 p-md-5">

                <!-- LOGO / TITLE -->
                <div class="text-center mb-4">
                    <h3 class="fw-semibold mb-1">AspirOva</h3>
                    <p class="text-secondary mb-0">Daftar untuk menyampaikan aspirasi</p>
                </div>

                <!-- FORM -->
                <form action="cek_daftar.php" method="POST">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control form-control-lg" placeholder="Masukkan nama lengkap">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">NIS</label>
                            <input type="number" name="nis" class="form-control form-control-lg" placeholder="Masukkan NIS">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control form-control-lg" placeholder="Masukkan email">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="Masukkan password">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select form-select-lg">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kelas</label>
                        <select class="form-select" id="nama_kelas" name="id_kelas" required>
                            <option value="" selected disabled hidden>Pilih Kelas</option>
                            <?php
                            $sql_kelas = "SELECT * FROM tb_kelas";
                            $sql_kelas_exe = mysqli_query($koneksi, $sql_kelas);
                            while ($data_kelas = mysqli_fetch_array($sql_kelas_exe)) {
                                echo "<option value='" . $data_kelas['id_kelas'] . "'>" . $data_kelas['nama_kelas'] . "</option>";
                            }
                            ?>
                        </select>

                        <button type="submit"
                            class="btn btn-gradient btn-lg w-100 mt-5">
                            Daftar
                        </button>
                </form>
            </div>
        </div>
    </div>
    <?php include "../includes/footer.php"; ?>
</body>

</html>