<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != "siswa") {
    header("location:../index.php");
}
include "../../includes/koneksi.php";
include "../../includes/navbar_siswa.php";

$title = "";
$menu  = "";
?>

<head>
    <style>
        .form-control {
            width: 100% !important;
            padding: 10px;
        }

        .upload-box {
            border: 2px dashed #dcdcdc;
            background: #fafafa;
            transition: 0.3s;
        }

        .upload-box:hover {
            border-color: #7b5cff;
            background: #f5f3ff;
        }

        .toast-notif {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            padding: 14px 18px;
            border-radius: 14px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            z-index: 9999;
            min-width: 260px;
            animation: slideIn 0.4s ease;
        }

        .icon-success {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, #6a8cff, #7b5cff);
            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(40px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>

<body>
    <!-- NOTIF MEN -->
    <?php if (isset($_GET['status']) && $_GET['status'] == "berhasil") { ?>

        <div class="toast-notif" id="toastNotif">
            <div class="d-flex align-items-center">
                <div class="icon-success me-3">✓</div>
                <div>
                    <div class="fw-semibold">Berhasil!</div>
                    <small class="text-muted">
                        Aspirasi berhasil dikirim.
                    </small>
                </div>
            </div>
        </div>

    <?php } ?>

    <div class="" style="background: linear-gradient(135deg, #8B5CF6, #4F7DFF);">
        <div class="flex-fill d-flex flex-column">

            <!-- CONTENT -->
            <main class="p-4 overflow-auto">

                <div class="container mt-4 mb-5 d-flex align-items-center justify-content-center">
                    <!-- CARD FORM -->
                    <div class="card border-0 shadow-lg rounded-4 v-100" style="max-width: 700px;">
                        <div class="card-body p-4">
                            <!-- Header -->
                            <div class="mb-4 text-center">
                                <h3 class="fw-bold mb-1">Kirim Aspirasi</h3>
                                <p class="text-muted">
                                    Sampaikan aspirasi atau laporan untuk meningkatkan kenyamanan sekolah.
                                </p>
                            </div>
                            <hr>
                            <form action="input_aspirasi.php" method="POST" enctype="multipart/form-data">

                                <div class="row g-3">

                                    <!-- Lokasi -->
                                    <div class="col-lg-12 mb-3">
                                        <label class="form-label fw-semibold">Lokasi Kejadian</label>
                                        <input type="text"
                                            name="lokasi"
                                            class="form-control rounded-3"
                                            placeholder="Contoh: Lapangan / Kelas 10 RPL 1"
                                            required>
                                    </div>
                                </div>
                                <div class="">
                                    <!-- Kategori -->
                                    <div class="col-lg-12 mb-3">
                                        <label class="form-label fw-semibold">Kategori</label>
                                        <select name="id_kategori" class="form-select rounded-3" required>
                                            <option value="" selected disabled hidden>-- Pilih Kategori --</option>

                                            <?php
                                            $kategori = mysqli_query($koneksi, "SELECT * FROM tb_kategori");
                                            while ($k = mysqli_fetch_array($kategori)) {
                                            ?>
                                                <option value="<?= $k['id_kategori']; ?>">
                                                    <?= $k['ket_kategori']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Isi Aspirasi -->
                                    <div class="col-lg-12 mb-3">
                                        <label class="form-label fw-semibold">Isi Aspirasi</label>
                                        <textarea name="isi_aspirasi"
                                            rows="5"
                                            class="form-control rounded-3"
                                            placeholder="Tuliskan aspirasi atau laporan secara jelas..."
                                            required></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Upload Foto -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label fw-semibold">Foto Pendukung (Opsional)</label>

                                        <div class="upload-box rounded-4 text-center p-4 position-relative">
                                            <input type="file"
                                                name="foto"
                                                id="foto"
                                                accept="image/*"
                                                class="d-none">

                                            <div id="upload-area" style="cursor:pointer;">
                                                <img id="preview-img"
                                                    src=""
                                                    class="img-fluid mb-2 d-none"
                                                    style="max-height:200px; border-radius:12px;">

                                                <div id="upload-text">
                                                    <i class="bi bi-image fs-1 text-muted"></i>
                                                    <p class="mb-0 text-muted">
                                                        Klik untuk upload gambar
                                                    </p>
                                                    <small class="text-muted">JPG / PNG (Max 2MB)</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <!-- BUTTON -->
                                <div class="d-flex justify-content-end gap-2 mt-3">
                                    <a href="dashboard.php"
                                        class="btn btn-light rounded-3 px-4">
                                        Batal
                                    </a>

                                    <button type="submit"
                                        class="btn text-white rounded-3 px-4"
                                        style="background: linear-gradient(135deg,#6a8cff,#7b5cff);">
                                        Kirim Aspirasi →
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>

            </main>

        </div>
    </div>
</body>
<script>
    const fotoInput = document.getElementById('foto');
    const uploadArea = document.getElementById('upload-area');
    const previewImg = document.getElementById('preview-img');
    const uploadText = document.getElementById('upload-text');

    uploadArea.addEventListener('click', () => {
        fotoInput.click();
    });

    fotoInput.addEventListener('change', function() {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewImg.classList.remove('d-none');
                uploadText.classList.add('d-none');
            }

            reader.readAsDataURL(file);
        }
    });
</script>

<script>
    setTimeout(() => {
        const notif = document.getElementById('toastNotif');
        if (notif) {
            notif.style.opacity = '0';
            notif.style.transform = 'translateX(40px)';
            setTimeout(() => notif.remove(), 300);
        }
    }, 3000);
</script>


<?php include "../../includes/footer.php"; ?>