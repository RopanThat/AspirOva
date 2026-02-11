<?php
session_start();

$_SESSION['menu'] = "";
include "../includes/baseurl.php";
session_destroy();
header("location:" . base_url . "");
