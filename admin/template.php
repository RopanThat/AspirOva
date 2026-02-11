<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    header("location:../index.php");
}
include "../../includes/koneksi.php";
include "../../includes/baseurl.php";

$title = "";
$menu  = "";
?>

<?php include "../layout/header.php"; ?>
<?php include "../layout/sidebar.php"; ?>

<div class="flex-fill d-flex flex-column">
    <?php include "../layout/topbar.php"; ?>

    <!-- CONTENT -->
    <main class="p-4 overflow-auto">



    </main>
</div>