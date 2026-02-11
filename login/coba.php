<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | AspirOva</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="min-vh-100 d-flex align-items-center justify-content-center"
    style="background: linear-gradient(135deg, #8B5CF6, #4F7DFF);">

    <div class="card shadow-lg border-0 rounded-4" style="width: 100%; max-width: 420px;">
        <div class="card-body p-4 p-md-5">

            <!-- LOGO / TITLE -->
            <div class="text-center mb-4">
                <h3 class="fw-semibold mb-1">AspirOva</h3>
                <p class="text-secondary mb-0">Masuk untuk menyampaikan aspirasi</p>
            </div>

            <!-- FORM -->
            <form>
                <div class="mb-3">
                    <label class="form-label">Email / Username</label>
                    <input type="text" class="form-control form-control-lg" placeholder="Masukkan email atau username">
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control form-control-lg" placeholder="Masukkan password">
                </div>

                <div class="mb-2 text-end">
                    <a href="#" class="text-decoration-none text-primary">Lupa password?</a>
                </div>

                <button type="submit"
                    class="btn btn-primary btn-lg w-100">
                    Login
                </button>
            </form>

            <!-- FOOTER -->
            <div class="text-center mt-4">
                <span class="text-secondary">Belum punya akun?</span>
                <a href="#" class="text-decoration-none fw-medium text-primary">Daftar</a>
            </div>

        </div>
    </div>

</body>

</html>