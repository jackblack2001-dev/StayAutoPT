<?php

function remove_tmp_US()
{
    $cars = glob("../User_Stand/tmp/".$_SESSION['Id']."/*");
    foreach ($cars as $car) {
        if (is_file($car))
            unlink($car);
    }

    $banners = glob("../User_Stand/tmp/".$_SESSION['Id']."/banner/*");
    foreach ($banners as $banner) {
        if (is_file($banner))
            unlink($banner);
    }

    $badges = glob("../User_Stand/tmp/".$_SESSION['Id']."/badge/*");
    foreach ($badges as $badge) {
        if (is_file($badge))
            unlink($badge);
    }
}
