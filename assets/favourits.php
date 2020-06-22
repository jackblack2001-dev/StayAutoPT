<?php
include('../Public/config.php');
include('stand_user.php');
include('car_stand.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["user"]) && isset($_POST["stand"])) {
        manageFavourits($_POST["user"], $_POST["stand"], $con);
    }

    if (isset($_POST["user"]) && isset($_POST["car"])) {
        manageFavouritsCars($_POST["user"], $_POST["car"], $con);
    }
}
