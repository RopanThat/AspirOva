<?php
include "../includes/navbar_utama.php";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | AspirOva</title>

</head>

<body class="min-vh-100" style="background: linear-gradient(135deg, #8B5CF6, #4F7DFF);">
    <div class="container d-flex align-items-center justify-content-center mt-5">
        <div class="card shadow-lg border-0 rounded-4 w-100" style="max-width: 420px;">
            <div class="card-body p-4 p-md-5">

                <!-- LOGO / TITLE -->
                <div class="text-center mb-4">
                    <h3 class="fw-semibold mb-1">AspirOva</h3>
                    <p class="text-secondary mb-0">Masuk untuk menyampaikan aspirasi</p>
                </div>

                <!-- FORM -->
                <form action="cek_login.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control form-control-lg" placeholder="Masukkan email">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="Masukkan password">
                    </div>

                    <div class="mb-2 text-center">
                        <a href="#" class="text-decoration-none text-primary">Lupa password?</a>
                    </div>

                    <button type="submit"
                        class="btn btn-gradient btn-lg w-100">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>