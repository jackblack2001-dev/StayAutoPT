<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAuto_PT/");
define("INCLUDE_PATH", __DIR__);
include("../Public/Config.php");
include("../assets/role_checker.php");
include("../assets/stand_user.php");
include("../assets/user_info.php");


$id = urldecode(base64_decode($_GET['id']));

include("../includes/header.php");
include("../includes/menu.php");
?>

<?php include("../Includes/footer.php") ?>