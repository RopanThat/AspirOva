<?php 

    include "baseurl.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url . 'bootstrap/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?= base_url . 'bootstrap-icons/bootstrap-icons.css' ?>">
    <style>
        .btn-gradient {
            background: linear-gradient(135deg, #8B5CF6, #4F7DFF);
            color: #ffffff;
            border: none;
            padding: 12px 28px;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(79, 125, 255, 0.3);
        }

        .btn-gradient:hover {
            background: linear-gradient(135deg, #7C3AED, #3B82F6);
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(79, 125, 255, 0.45);
            color: #ffffff;
        }

        .btn-gradient:active {
            transform: translateY(0);
            box-shadow: 0 6px 16px rgba(79, 125, 255, 0.3);
        }
    </style>
</head>

<body>
    <!-- Awal Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand mx-5" href="#">
                <img src="<?= base_url . 'assets/fix_logo.png' ?>" alt="" width="180">
            </a>
            <!-- <a href="" class="navbar-brand fw-bold">AspirOva</a> -->
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="" class="nav-link fs-5 px-3">Home</a></li>
                    <li class="nav-item"><a href="" class="nav-link fs-5 px-3">Fitur</a></li>
                    <li class="nav-item"><a href="" class="nav-link fs-5 px-3">Tentang</a></li>
                    <li class="nav-item"><a href="" style="background-color: #4F7DFF" class="btn text-white fs-5 px-3 mx-5">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!--Akhir navbar -->
</body>

</html>