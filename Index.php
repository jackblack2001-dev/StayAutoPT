<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAuto_PT/");
define("INCLUDE_PATH", __DIR__);
include("includes/header.php");
include("includes/menu.php");
?>

<?php include("includes/footer.php")?>