<?php

function ShowCarCars($data,$sql,$con)
{
    $ERROR_No_Data_Car = false;
    
    if (!is_null($data[0])) {
        $id = $data[0]['Stand_Id'];
        if ($Result = $con->query($sql)) {
            if ($Result->num_rows >= 1) {
                if ($row = $Result->fetch_array()) {
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

            return "<div class='col-sm-4'>
            </br>
            <div class='card' style='width: 350px'>
                <img class='card-img-top' src='/Public/Images/Fotos/Carros/".''.".jpg' alt='Card image' style='width: 100%, heigth= 50%'>
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

?>