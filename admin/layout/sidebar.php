

<aside class="bg-white border-end p-4 d-flex flex-column" style="width:260px">
    <!-- <h4 class="fw-bold mb-4">AspirOva</h4> -->
    <img src="<?= base_url ?>assets/fix_logo.png" alt="AspirOva Logo" class="mb-4" width="180">

    <ul class="nav nav-pills flex-column gap-1 fs-5">

        <li class="nav-item">
            <a class="nav-link <?= ($menu == 'dashboard') ? 'active fw-semibold' : 'text-secondary' ?>"
                href="<?= base_url ?>admin">
                <i class="bi bi-speedometer2 me-1"></i> Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= ($menu == 'kelas') ? 'active fw-semibold' : 'text-secondary' ?>"
                href="<?= base_url ?>admin/kelas">
                <i class="bi bi-easel me-1"></i> Kelas
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= ($menu == 'siswa') ? 'active fw-semibold' : 'text-secondary' ?>"
                href="<?= base_url ?>admin/siswa">
                <i class="bi bi-people me-1"></i> Siswa
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= ($menu == 'kategori') ? 'active fw-semibold' : 'text-secondary' ?>"
                href="<?= base_url ?>admin/kategori">
                <i class="bi bi-tags me-1"></i> Kategori
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= ($menu == 'aspirasi') ? 'active fw-semibold' : 'text-secondary' ?>"
                href="<?= base_url ?>admin/aspirasi">
                <i class="bi bi-chat-dots me-1"></i> Aspirasi
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= ($menu == 'feedback') ? 'active fw-semibold' : 'text-secondary' ?>"
                href="<?= base_url ?>admin/feedback">
                <i class="bi bi-people me-1"></i> Feedback
            </a>
        </li>

    </ul>

    <div class="mt-auto small text-muted">
        © AspirOva Admin
    </div>
</aside>