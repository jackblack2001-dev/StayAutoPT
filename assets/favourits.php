<?php
include('../Public/config.php');
include('stand_user.php');
include('car_stand.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["user"]) && isset($_POST["stand"])) {
        manageFavourits($_POST["user"], $_POST["stand"], $con);
    }

    if (isset($_POST["user"]) && isset($_POST["car"])) {
        manageFavouritsCars($_POST["user"], base64_decode($_POST["car"]), $con);
    }

    if (isset($_POST["cookie"])) {
        $cookie_name = "cars_favourits";
        if (!isset($_COOKIE[$cookie_name])) {
            setcookie($cookie_name, $_POST["cookie"], time() + (86400 * 30), "/");
        } else {
            if (strpos($_COOKIE[$cookie_name], $_POST["cookie"]) !== false) {
                $string = str_replace($_POST["cookie"], "", $_COOKIE[$cookie_name]);
                setcookie($cookie_name, $string, time() + (86400 * 30), "/");
            }else{
                $string = $_COOKIE[$cookie_name] . $_POST["cookie"];
                setcookie($cookie_name, $string, time() + (86400 * 30), "/");
            }
        }
    }
}
