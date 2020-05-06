<?php
session_start();
include_once('stand_user.php');
include_once('../Public/config.php');

if($_SERVER["REQUEST_METHOD"] == "GET")
{
    if(isset($_GET['SCCL5']) && $_GET['SCCL5'] == "true")
    {
        ShowCarCarsLast5($con);
    }
    else
    {
        $search = "";

        if(isset($_GET['search']) && trim($_GET['search'])!="")
        {
            $search = $_GET['search'];
            ShowCarCarsSearch($search,$con);
        }
        else
        {
            ShowCarCars($con);
        }   
    }
} 

function ShowCarCarsLast5($con)
{
    $card = "";
    $data[] = returnStand($_SESSION["Id"], $con);

    if (!is_null($data[0])) {
        $id = $data[0]['Stand_Id'];
        $sql = "SELECT * FROM Cars ORDER BY CreatedCar desc limit 5";
        if ($Result = $con->query($sql)) {
            if ($Result->num_rows >= 1) {
                while($row = $Result->fetch_array()){
                    $cars[] = $row;
                }

                $fuel = $typegear = "";
                    foreach ($cars as $row) {
            
                        if($row['Type_Fuel'] == 0){
                            $fuel = "Gasolina";
                        }else{
                            $fuel = "Diesel";
                        }
            
                        if($row['Type_Gear'] == 0){
                            $typegear = "Manual";
                        }else if($row['Type_Gear'] == 1){
                            $typegear = "Automático";
                        }
                        else{
                            $typegear = "CVT";
                        }
            
                        $card .=  "<div class='col-md'>
                        <div class='card' style='width: 340px'>
                            <img class='card-img-top' src='/Public/Images/Fotos/Carros/".''.".jpg' alt='".$row['Brand']." ".$row['Model']."' style='width: 100%, heigth= 50%'>
                            <div class='card-body'>
                                <h4 class='card-title'>".$row['Brand']." ".$row['Model']." - ".$row['Price']."€</h4>
                                <hr>
                                <p class='card-text text-right'>".$row['Year']."</p>
                                <p class='card-text text-right'>".$fuel." / ".$typegear."</p>
                                <p class='card-text'>".$row['Kms']." Km</p>
                                <hr>
                                #Botao para editar
                            </div>
                        </div>
                        </br>
                    </div>";
                    }
                    echo $card;

            } else                     
            echo '<div style="border-width:3px;border-style:dashed; color: lightgray">
                        <br>
                        <h3 class="text-center">
                            Sem resultados :\
                        </h3>
                        <br>
                    </div>';
        }
    } else $ERROR_No_Data_Stand = true;
}

function ShowCarCars($con)
{
    include_once('../Public/config.php');

    $ERROR_No_Data_Car = false;
    $card = "";
    $data[] = returnStand($_SESSION["Id"], $con);

    if (!is_null($data[0])) {
        $id = $data[0]['Stand_Id'];
        $sql = "SELECT * FROM Cars WHERE Stand_id = '$id'";
        if ($Result = $con->query($sql)) {
            if ($Result->num_rows >= 1) {
                while($row = $Result->fetch_array()){
                    $cars[] = $row;
                }
            } else $ERROR_No_Data_Car = true;
        }
    } else $ERROR_No_Data_Stand = true;

    $fuel = $typegear = "";
    if (!$ERROR_No_Data_Car) {
        foreach ($cars as $row) {

            if($row['Type_Fuel'] == 0){
                $fuel = "Gasolina";
            }else{
                $fuel = "Diesel";
            }

            if($row['Type_Gear'] == 0){
                $typegear = "Manual";
            }else if($row['Type_Gear'] == 1){
                $typegear = "Automático";
            }
            else{
                $typegear = "CVT";
            }

            $card .=  "<div class='col-md'>
            
            <div class='card' style='width: 340px'>
                <img class='card-img-top' src='/Public/Images/Fotos/Carros/".''.".jpg' alt='".$row['Brand']." ".$row['Model']."' style='width: 100%, heigth= 50%'>
                <div class='card-body'>
                    <h4 class='card-title'>".$row['Brand']." ".$row['Model']." - ".$row['Price']."€</h4>
                    <p class='card-text text-right'>".$row['Year']."</p>
                    <p class='card-text text-right'>".$fuel." / ".$typegear."</p>
                    <p class='card-text'>".$row['Kms']." Km</p>
                    <p class='card-text'>".$row['Description']."</p>
                    #Botao para editar
                </div>
            </div>
            </br>
        </div>";
        }
        echo $card;
    } else {
        return '<div style="border-width:3px;border-style:dashed; color: lightgray">
            <br>
            <h3 class="text-center">
                Ainda não adicionou nenhum Carro
            </h3>
            <br>
        </div>';
    }
}

function ShowCarCarsSearch($search,$con)
{
    $card = "";
    $data[] = returnStand($_SESSION["Id"], $con);

    if (!is_null($data[0])) {
        $id = $data[0]['Stand_Id'];
        $sql = "SELECT * FROM `cars` WHERE `Stand_Id` = $id 
        AND `Brand` LIKE '%$search%' OR `Model` LIKE '%$search%'";
        if ($Result = $con->query($sql)) {
            if ($Result->num_rows >= 1) {
                while($row = $Result->fetch_array()){
                    $cars[] = $row;
                }

                $fuel = $typegear = "";
                    foreach ($cars as $row) {
            
                        if($row['Type_Fuel'] == 0){
                            $fuel = "Gasolina";
                        }else{
                            $fuel = "Diesel";
                        }
            
                        if($row['Type_Gear'] == 0){
                            $typegear = "Manual";
                        }else if($row['Type_Gear'] == 1){
                            $typegear = "Automático";
                        }
                        else{
                            $typegear = "CVT";
                        }
            
                        $card .=  "<div class='col-md'>
                        
                        <div class='card' style='width: 340px'>
                            <img class='card-img-top' src='/Public/Images/Fotos/Carros/".''.".jpg' alt='".$row['Brand']." ".$row['Model']."' style='width: 100%, heigth= 50%'>
                            <div class='card-body'>
                                <h4 class='card-title'>".$row['Brand']." ".$row['Model']." - ".$row['Price']."€</h4>
                                <p class='card-text text-right'>".$row['Year']."</p>
                                <p class='card-text text-right'>".$fuel." / ".$typegear."</p>
                                <p class='card-text'>".$row['Kms']." Km</p>
                                <p class='card-text'>".$row['Description']."</p>
                                #Botao para editar
                            </div>
                        </div>
                        </br>
                    </div>";
                    }
                    echo $card;

            } else                     
            echo '<div style="border-width:3px;border-style:dashed; color: lightgray">
                        <br>
                        <h3 class="text-center">
                            Sem resultados :\
                        </h3>
                        <br>
                    </div>';
        }
    } else $ERROR_No_Data_Stand = true;
}

?>