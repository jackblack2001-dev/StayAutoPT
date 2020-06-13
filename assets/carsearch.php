<?php
include("../Public/config.php");
include("car_stand.php");

if (isset($_GET["search"])) {
    if (!$_GET["search"]) {
        $cars = returnAllCars($con);
        CarShow($cars);
    }
}

function CarShow($cars){
    if ($cars != null) {
        
    }else{
        //error
    }
}
