<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAutoPT/");
define("INCLUDE_PATH", __DIR__);
include('stand_user.php');
include('car_stand.php');
include('../Public/config.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['SCCLX']) && $_GET['SCCLX'] == "true" && isset($_GET['rows'])) {
        ShowCarCarsLastX($_GET['rows'], $con);
    } else {
        $search = "";

        if (isset($_GET['search']) && trim($_GET['search']) != "") {
            $search = $_GET['search'];
            ShowCarCarsSearch($search, $con);
        } else {
            ShowCarCars($con);
        }
    }
}

function error($aux)
{
    $message = "";
    if ($aux == 0) {
        $message = "Ainda não inseriu nenhum carro";
    } else {
        $message = "Sem resultados :/";
    }

    echo '<div class="col mb-4" style="border-width:3px;border-style:dashed; color: lightgray">
<br>
<h3 class="text-center">
    ' . $message . '
</h3>
<br>
</div>';
}

function card($Name, $Price, $Year, $Kms, $Imgpath, $id)
{
    return "<div class='card shadow margins mb-4' style='width: 340px;'>
    <a class='a-cars' href=" . ROOT_PATH . 'User_Stand/Car_Profile.php?id=' . urlencode(base64_encode($id)) . ">
    <div class='card-body no-padding'>
        <div class='col no-padding'>
            <img src='" . ROOT_PATH . "Public/Images/Car_Photos/" . $Imgpath . "' alt='" . $Name . "' style='width: 100%; height: 340px'>
            <div class='bottom-right-car shadow-lg'>
                <span style='font-size:25px'>" . $Price . "€</span>
            </div>
        </div>
        <div class='col no-padding'>
            <div class='card-title margins'>
                <h5><small class='font-weight-bold'>" . $Name . "</small></h5>
                <p class='card-text'>" . $Year . "</p>
                <p class='card-text text-right'>" . $Kms . "km</p>
            </div>
        </div>
    </div>
    </a>
</div>";
}

function ShowCarCarsLastX($numrows, $con)
{
    $card = "";
    if (isset($_GET["id"])) {
        $data = returnUrlStand($_GET["id"], $con);
    } else {
        $data = returnStand($_SESSION["Id"], $con);
    }

    if (isset($_GET['up']) && $_GET['up'] == true) {
        UpdateStandNumCarN($data["Stand_Id"], $numrows, $con);
    }

    $cars = returnCarsLastX($data['Stand_Id'], $numrows, $con);

    if ($cars != null) {
        foreach ($cars as $row) {
            $card .= card($row["Model"], $row["Price"], $row["Year"], $row["Kms"], $row["Card_Image"], $row["License_Plate"]);
        }
    } else {
        $card = error(0);
    }
    echo $card;
}

function ShowCarCars($con)
{
    include_once('../Public/config.php');

    $card = "";
    if (isset($_GET["id"])) {
        $data = returnUrlStand($_GET["id"], $con);
    } else {
        $data = returnStand($_SESSION["Id"], $con);
    }

    $cars = returnStandCars($data["Stand_Id"], $con);

    if ($cars == 0) {
        error(0);
    } else {
        foreach ($cars as $row) {
            $card .= card($row["Model"], $row["Price"], $row["Year"], $row["Kms"], $row["Card_Image"], $row["License_Plate"]);
        }
        echo $card;
    }
}

function ShowCarCarsSearch($search, $con)
{
    $card = "";
    if (isset($_GET["id"])) {
        $data = returnUrlStand($_GET["id"], $con);
    } else {
        $data = returnStand($_SESSION["Id"], $con);
    }

    $cars = returnCarsSearch($data["Stand_Id"], $search, $con);

    if ($cars == 1) {
        error(1);
    } else {
        foreach ($cars as $row) {
            $card .= card($row["Model"], $row["Price"], $row["Year"], $row["Kms"], $row["Card_Image"], $row["License_Plate"]);
        }
        echo $card;
    }
}
