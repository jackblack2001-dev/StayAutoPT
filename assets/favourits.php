<?php
include('../Public/config.php');
include('stand_user.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["user"]) && isset($_POST["stand"])) {
        manageFavourits($_POST["user"], $_POST["stand"], $con);
    }
}
