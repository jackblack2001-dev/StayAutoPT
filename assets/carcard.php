<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAuto_PT/");
define("INCLUDE_PATH", __DIR__);
include_once('stand_user.php');
include_once('../Public/config.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['SCCL5']) && $_GET['SCCL5'] == "true") {
        ShowCarCarsLast5($con);
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
    if($aux==0){
        $message = "Ainda não inseriu nenhum carro";
    }else{
        $message = "Sem resultados :/";
    }

    return '<div class="col" style="border-width:3px;border-style:dashed; color: lightgray">
<br>
<h3 class="text-center">
    '.$message.'
</h3>
<br>
</div>';
}

function card($Name, $Price, $Year, $Kms, $Imgpath)
{
    return "<div class='card shadow margins mb-4' style='width: 340px;'>
    <div class='card-body no-padding'>
        <div class='col no-padding'>
            <img src='" . ROOT_PATH . "Public/Images/Profile/defult_user.jpg' alt='" . $Name . "' style='width: 100%; height: 340px'>
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
</div>";
}

function ShowCarCarsLast5($con)
{
    $card = "";
    $data[] = returnStand($_SESSION["Id"], $con);

    if (!is_null($data[0])) {
        $id = $data[0]['Stand_Id'];
        $sql = "SELECT * FROM Cars WHERE Stand_Id = $id ORDER BY CreatedCar desc limit 5";
        if ($Result = $con->query($sql)) {
            if ($Result->num_rows >= 1) {
                while ($row = $Result->fetch_array()) {
                    $cars[] = $row;
                }

                $string = "";
                $Name = "";
                foreach ($cars as $row) {
                    $string = $row["Brand"] . " " . $row["Model"];

                    if (strlen($string) > 15) {
                        $Name = substr($string, 0, 15) . "...";
                    } else {
                        $Name = $string;
                    }

                    $card .= card($Name, $row["Price"], $row["Year"], $row["Kms"], "");
                }
                echo $card;
            } else
                echo error(0);
        }
    } else return null;
}

function ShowCarCars($con)
{
    include_once('../Public/config.php');

    $card = "";
    $data[] = returnStand($_SESSION["Id"], $con);

    if (!is_null($data[0])) {
        $id = $data[0]['Stand_Id'];
        $sql = "SELECT * FROM Cars WHERE Stand_id = '$id'";
        if ($Result = $con->query($sql)) {
            if ($Result->num_rows >= 1) {
                while ($row = $Result->fetch_array()) {
                    $cars[] = $row;
                }

                $string = "";
                $Name = "";
                foreach ($cars as $row) {
                    $string = $row["Brand"] . " " . $row["Model"];

                    if (strlen($string) > 15) {
                        $Name = substr($string, 0, 15) . "...";
                    } else {
                        $Name = $string;
                    }

                    $card .= card($Name, $row["Price"], $row["Year"], $row["Kms"], "");
                }
                echo $card;
            } else {
                return error(0);
            }
        }
    } else return null;
}

function ShowCarCarsSearch($search, $con)
{
    $card = "";
    $data[] = returnStand($_SESSION["Id"], $con);

    if (!is_null($data[0])) {
        $id = $data[0]['Stand_Id'];
        $sql = "SELECT * FROM `cars` WHERE `Stand_Id` = $id 
        AND `Brand` LIKE '%$search%' OR `Model` LIKE '%$search%'";
        if ($Result = $con->query($sql)) {
            if ($Result->num_rows >= 1) {
                while ($row = $Result->fetch_array()) {
                    $cars[] = $row;
                }

                $string = "";
                $Name = "";
                foreach ($cars as $row) {
                    $string = $row["Brand"] . " " . $row["Model"];

                    if (strlen($string) > 15) {
                        $Name = substr($string, 0, 15) . "...";
                    } else {
                        $Name = $string;
                    }

                    $card .= card($Name, $row["Price"], $row["Year"], $row["Kms"], "");
                }
                echo $card;
            } else
                echo error(1);
        }
    } else return null;
}
