<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("location:../index.php");
}
include "../../includes/koneksi.php";
include "../../includes/baseurl.php";

$title = "Daftar Kategori";
$menu  = "kategori";

// Total Kelas dan Siswa
$q_kategori = mysqli_query($koneksi, "SELECT id_kategori FROM tb_kategori");
$total_kategori = mysqli_num_rows($q_kategori);
?>

<?php include "../layout/header.php"; ?>
<?php include "../layout/sidebar.php"; ?>

<div class="flex-fill d-flex flex-column">
    <?php include "../layout/topbar.php"; ?>

    <!-- CONTENT -->
    <main class="p-4 overflow-auto">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Manajemen Kategori</h4>
                <small class="text-muted">Kelola data kategori dan jumlah item</small>
            </div>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary rounded-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-plus-circle me-1"></i> Tambah Kategori
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="input_kategori.php" method="post">
                                <div class="mb-3">
                                    <label for="ket_kategori" class="form-label">Nama Kategori</label>
                                    <input type="text" class="form-control" id="ket_kategori" name="ket_kategori" required>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah Kategori</button>
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
                            <small class="text-muted">Total Kategori</small>
                            <h4 class="fw-bold mb-0"><?= $total_kategori ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FILTER -->
        <div class="row g-2 mb-3">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Cari nama kategori...">
            </div>
        </div>

        <!-- TABLE -->
        <div class="card rounded-4 shadow-sm">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Daftar Kategori</h6>

                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM tb_kategori";
                        $sql_eksekusi =  mysqli_query($koneksi, $sql);
                        $nomor = 1;
                        while ($data = mysqli_fetch_array($sql_eksekusi)) {
                            echo "<tr>";
                            echo "  <td>" . $nomor++ . "</td>";
                            echo "  <td>" . $data['ket_kategori'] . "</td>";
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
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Kategori <?= $data['ket_kategori'] . " | ID = " . $data['id_kategori']; ?></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label for="" class="mt-2">Nama Kategori</label>
                                                        <input type="hidden" name="id_kategori" id="" value="<?= $data['id_kategori']; ?>">
                                                        <input type="text" name="ket_kategori" id="" class="form-control mt-1" value="<?= $data['ket_kategori']; ?>">
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
                                            <h1 class="modal-title fs-5 text-light" id="exampleModalLabel">Hapus Kategori <?= $data['ket_kategori']; ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah anda yakin ingin menghapus kategori <b><?= $data['ket_kategori']; ?></b>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            <a href="hapus_kategori.php?id_kategori=<?= $data['id_kategori']; ?>" class="btn btn-danger">Hapus</a>
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