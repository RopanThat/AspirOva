<div class="d-flex">

    <!-- SIDEBAR -->
    <aside class="bg-white border-end p-4 d-flex flex-column vh-100" style="width:260px">
        <h4 class="fw-bold mb-4">AspirOva</h4>

        <ul class="nav nav-pills flex-column gap-1 small">

            <li class="nav-item">
                <a class="nav-link <?= ($menu ?? '') == 'dashboard' ? 'active fw-semibold' : 'text-secondary' ?>"
                    href="dashboard.php">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= ($menu ?? '') == 'aspirasi' ? 'active fw-semibold' : 'text-secondary' ?>"
                    href="aspirasi.php">
                    <i class="bi bi-chat-left-text me-2"></i> Aspirasi
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= ($menu ?? '') == 'kelas' ? 'active fw-semibold' : 'text-secondary' ?>"
                    href="kelas.php">
                    <i class="bi bi-easel me-2"></i> Kelas
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= ($menu ?? '') == 'siswa' ? 'active fw-semibold' : 'text-secondary' ?>"
                    href="siswa.php">
                    <i class="bi bi-people me-2"></i> Siswa
                </a>
            </li>

        </ul>

        <div class="mt-auto small text-muted">
            © AspirOva Admin
        </div>
    </aside>

    <!-- MAIN -->
    <div class="flex-fill d-flex flex-column">

        <!-- TOPBAR -->
        <nav class="navbar bg-white border-bottom px-4">
            <div>
                <div class="fw-semibold">Halo, Admin 👋</div>
                <small class="text-muted">Selamat datang di AspirOva</small>
            </div>

            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-bell fs-5"></i>

                <div class="dropdown">
                    <a class="dropdown-toggle text-decoration-none text-dark"
                        data-bs-toggle="dropdown" href="#">
                        Admin
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- CONTENT -->
        <main class="p-4">
            <?php
            // ISI KONTEN DARI HALAMAN
            if (isset($content)) {
                include $content;
            }
            ?>
        </main>

    </div>
</div>