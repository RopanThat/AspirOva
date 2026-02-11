<?php
// fallback kalau session belum ada
$jk = $_SESSION['jenis_kelamin'] ?? 'L';

// tentukan avatar
if ($jk == 'P') {
    $avatar = base_url . "assets/women.png";
} else {
    $avatar = base_url . "assets/man.png";
}
?>

<nav class="navbar bg-white border-bottom px-4">
    <div>
        <div class="fw-semibold">Welcome, Admin 👋</div>
        <small class="text-muted">Selamat datang di AspirOva</small>
    </div>

    <div class="d-flex align-items-center gap-3">
        <!-- AVATAR -->
        <img src="<?= $avatar ?>"
            alt="Avatar"
            class="rounded-circle"
            width="36"
            height="36"
            style="object-fit: cover;">

        <div class="dropdown">
            <a class="dropdown-toggle text-dark text-decoration-none"
                data-bs-toggle="dropdown">
                <?= $_SESSION['nama']; ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="<?= base_url ?>login/cek_logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>