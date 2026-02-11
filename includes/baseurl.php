<?php
$preUrl = explode("/", $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $preUrl[0] . "/" . $preUrl[1] . "/";
define("base_url", $url);
//echo base_url;
?>