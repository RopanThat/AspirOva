<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("location:../index.php");
}
include "../../includes/koneksi.php";
include "../../includes/baseurl.php";

$title = "Daftar Kelas";
$menu  = "kelas";

// Total Kelas dan Siswa
$q_kelas = mysqli_query($koneksi, "SELECT id_kelas FROM tb_kelas");
$total_kelas = mysqli_num_rows($q_kelas);
$q_siswa = mysqli_query($koneksi, "SELECT id_user FROM tb_user WHERE role='siswa'");
$total_siswa = mysqli_num_rows($q_siswa);
?>
<head>
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css" />
</head>
<?php include "../layout/header.php"; ?>
<?php include "../layout/sidebar.php"; ?>

<div class="flex-fill d-flex flex-column">
    <?php include "../layout/topbar.php"; ?>

    <!-- CONTENT -->
    <main class="p-4 overflow-auto">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Manajemen Kelas</h4>
                <small class="text-muted">Kelola data kelas dan jumlah siswa</small>
            </div>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary rounded-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-plus-circle me-1"></i> Tambah Kelas
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="input_kelas.php" method="post">
                                <div class="mb-3">
                                    <label for="nama_kelas" class="form-label">Nama Kelas</label>
                                    <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                                    <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" required>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah Kelas</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- SUMMARY -->
        <div class="row d-flex align-items-center justify-content-center g-3 mb-4">
            <div class="col-md-4">
                <div class="card rounded-4 shadow-sm">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="bg-primary-subtle text-primary rounded-3 p-3">
                            <i class="bi bi-easel fs-4"></i>
                        </div>
                        <div>
                            <small class="text-muted">Total Kelas</small>
                            <h4 class="fw-bold mb-0"><?= $total_kelas ?></h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card rounded-4 shadow-sm">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="bg-info-subtle text-info rounded-3 p-3">
                            <i class="bi bi-people fs-4"></i>
                        </div>
                        <div>
                            <small class="text-muted">Total Siswa</small>
                            <h4 class="fw-bold mb-0"><?= $total_siswa ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FILTER -->
        <div class="row g-2 mb-3">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Cari nama kelas...">
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option>Semua Tingkat</option>
                    <option>X</option>
                    <option>XI</option>
                    <option>XII</option>
                </select>
            </div>
        </div>

        <!-- TABLE -->
        <div id="myTable" class="display card rounded-4 shadow-sm">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Daftar Kelas</h6>

                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Tahun Ajaran</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM tb_kelas";
                        $sql_eksekusi =  mysqli_query($koneksi, $sql);
                        $nomor = 1;
                        while ($data = mysqli_fetch_array($sql_eksekusi)) {
                            echo "<tr>";
                            echo "  <td>" . $nomor++ . "</td>";
                            echo "  <td>" . $data['nama_kelas'] . "</td>";
                            echo "  <td>" . $data['tahun_ajaran'] . "</td>";
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
                                        <form action="update_kelas.php" method="post">

                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Kelas <?= $data['nama_kelas'] . " | ID = " . $data['id_kelas']; ?></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label for="" class="mt-2">Nama Kelas</label>
                                                        <input type="hidden" name="id_kelas" id="" value="<?= $data['id_kelas']; ?>">
                                                        <input type="text" name="nama_kelas" id="" class="form-control mt-1" value="<?= $data['nama_kelas']; ?>">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label for="" class="mt-2">Tahun Ajaran</label>
                                                        <input name="tahun_ajaran" id="" class="form-control mt-1" value="<?= $data['tahun_ajaran']; ?>">
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
                                            <a href="hapus_kelas.php?id_kelas=<?= $data['id_kelas']; ?>" class="btn btn-danger">Hapus</a>
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


    </main>
</div>
<?php include "../layout/footer.php"; ?>