<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("location:../index.php");
}
include "../../includes/koneksi.php";
include "../../includes/baseurl.php";

$title = "Daftar Siswa";
$menu  = "siswa";
?>

<?php include "../layout/header.php"; ?>
<?php include "../layout/sidebar.php"; ?>

<div class="flex-fill d-flex flex-column">
    <?php include "../layout/topbar.php"; ?>

    <!-- CONTENT -->
    <main class="p-4 overflow-auto">

        <div class="container-fluid">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold mb-1">Manajemen Siswa</h4>
                    <small class="text-muted">
                        Kelola data siswa, akun, dan status akses
                    </small>
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-outline-danger rounded-3">
                        <i class="bi bi-file-earmark-pdf me-1"></i> Export PDF
                    </button>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary rounded-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-person-plus me-1"></i> Tambah Siswa
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Siswa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="input_siswa.php" method="post">
                                        <div class="mb-3">
                                            <label for="nis" class="form-label">NIS</label>
                                            <input type="text" class="form-control" id="nis" name="nis" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama_siswa" class="form-label">Nama Siswa</label>
                                            <input type="text" class="form-control" id="nama" name="nama" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama_kelas" class="form-label">Kelas</label>

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
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="text" class="form-control" id="password" name="password" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                                <option value="" selected disabled hidden>Pilih Jenis Kelamin</option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                            </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Tambah Siswa</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- STAT -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card rounded-4 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-people fs-3 text-primary"></i>
                                <div>
                                    <h6 class="mb-0">Total Siswa</h6>
                                    <h4 class="fw-bold mb-0">1,254</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card rounded-4 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-gender-male fs-3 text-info"></i>
                                <div>
                                    <h6 class="mb-0">Laki-laki</h6>
                                    <h4 class="fw-bold mb-0">620</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card rounded-4 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-gender-female fs-3 text-danger"></i>
                                <div>
                                    <h6 class="mb-0">Perempuan</h6>
                                    <h4 class="fw-bold mb-0">634</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card rounded-4 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-person-badge fs-3 text-success"></i>
                                <div>
                                    <h6 class="mb-0">Akun Aktif</h6>
                                    <h4 class="fw-bold mb-0">1,200</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEARCH -->
            <form method="GET" class="row g-2 mb-4">
                <div class="col-md-4">
                    <input type="text"
                        name="keyword"
                        class="form-control"
                        placeholder="Cari nama / NIS / email..."
                        value="<?= $_GET['keyword'] ?? '' ?>"
                        autofocus>
                </div>
            </form>



            <!-- TABLE -->
            <div class="card rounded-4 shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Daftar Kelas</h6>

                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nis</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Email</th>
                                <th>Jenis Kelamin</th>
                                <th>Role</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $keyword = $_GET['keyword'] ?? '';

                                $sql = "SELECT tb_user.*, tb_kelas.nama_kelas
                                        FROM tb_user
                                        JOIN tb_kelas 
                                            ON tb_user.id_kelas = tb_kelas.id_kelas
                                        WHERE tb_user.role = 'siswa'";

                                if ($keyword != '') {
                                    $sql .= " AND (
                                        tb_user.nama LIKE '%$keyword%' OR
                                        tb_user.nis LIKE '%$keyword%' OR
                                        tb_kelas.nama_kelas LIKE '%$keyword%' OR
                                        tb_user.email LIKE '%$keyword%' OR
                                        tb_user.jenis_kelamin LIKE '%$keyword%'
                                    )";
                                }
                            $sql_eksekusi =  mysqli_query($koneksi, $sql);
                            $nomor = 1;
                            while ($data = mysqli_fetch_array($sql_eksekusi)) {
                                echo "<tr>";
                                echo "  <td>" . $nomor++ . "</td>";
                                echo "  <td>" . $data['nis'] . "</td>";
                                echo "  <td>" . $data['nama'] . "</td>";
                                echo "  <td>" . $data['nama_kelas'] . "</td>";
                                echo "  <td>" . $data['email'] . "</td>";
                                echo "  <td>" . $data['jenis_kelamin'] . "</td>";
                                echo "  <td>" . $data['role'] . "</td>";
                            ?>
                                <td class="text-end">
                                    <!-- Button Modal Ubah & Hapus -->
                                    <button class="btn btn-sm btn-outline-warning me-2" data-bs-toggle="modal" data-bs-target="#modalubah<?= $nomor; ?>"><i class="bi bi-pencil-square fs-5"></i></button>
                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalhapus<?= $nomor; ?>"><i class="bi bi-trash fs-5"></i></button>
                                </td>
                                <!-- Modal Ubah-->
                                <div class="modal fade" id="modalubah<?= $nomor; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="update_siswa.php" method="post">

                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Siswa <?= $data['nama'] . " | NIS = " . $data['nis']; ?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label for="" class="mt-2">Nis</label>
                                                            <input type="hidden" name="id_user" id="" value="<?= $data['id_user']; ?>">
                                                            <input type="number" name="nis" id="" class="form-control mt-1" value="<?= $data['nis']; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label for="" class="mt-2">Nama Lengkap</label>
                                                            <input type="text" name="nama" id="" class="form-control mt-1" value="<?= $data['nama']; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label for="" class="mt-2">Kelas</label>
                                                            <select name="id_kelas" id="" class="form-select mt-1">
                                                                <?php
                                                                $sql_kelas = "SELECT * FROM tb_kelas";
                                                                $sql_kelas_exe = mysqli_query($koneksi, $sql_kelas);
                                                                while ($data_kelas = mysqli_fetch_array($sql_kelas_exe)) {
                                                                    if ($data['id_kelas'] == $data_kelas['id_kelas']) {
                                                                        echo "<option value='" . $data_kelas['id_kelas'] . "' selected>" . $data_kelas['nama_kelas'] . "</option>";
                                                                    } else {
                                                                        echo "<option value='" . $data_kelas['id_kelas'] . "'>" . $data_kelas['nama_kelas'] . "</option>";
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label for="" class="mt-2">Email</label>
                                                            <input type="email" name="email" id="" class="form-control mt-1" value="<?= $data['email']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label for="" class="mt-2">Jenis Kelamin</label>
                                                            <select class="form-select mt-1" name="jenis_kelamin" id="">
                                                                <option value="L" <?php if ($data['jenis_kelamin'] == 'L') {
                                                                                        echo "selected";
                                                                                    } ?>>Laki-laki</option>
                                                                <option value="P" <?php if ($data['jenis_kelamin'] == 'P') {
                                                                                        echo "selected";
                                                                                    } ?>>Perempuan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <input type="submit" value="ubah data" class="btn btn-warning">
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Modal Ubah -->

                                <!-- Modal Hapus-->
                                <div class="modal fade" id="modalhapus<?= $nomor; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h1 class="modal-title fs-5 text-light" id="exampleModalLabel">Hapus Kelas <?= $data['nama_kelas']; ?></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus kelas <b><?= $data['nama_kelas']; ?></b>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <a href="hapus_siswa.php?id_user=<?= $data['id_user']; ?>" class="btn btn-danger">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Modal Hapus -->
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
<?php include "../layout/footer.php"; ?>