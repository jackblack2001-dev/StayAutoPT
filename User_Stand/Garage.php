<?php
include('../Master.php');
include_once('../assets/stand_user.php');
include_once('../assets/carcard.php');
include_once('../Public/config.php');

$ERROR_No_Data_Stand = false;
$ERROR_No_Data_Car = false;

$data[] = returnStand($_SESSION["Id"], $con);

if (!is_null($data[0])) {
    $id = $data[0]['Stand_Id'];
    $sql = "SELECT * FROM Cars WHERE Stand_id = '$id' LIMIT 10";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows >= 1) {
            if ($row = $Result->fetch_array()) {
                $cars[] = $row;
            }
        } else $ERROR_No_Data_Car = true;
    }
} else $ERROR_No_Data_Stand = true;

?>

<!DOCTYPE html>

<head>
    <title>Garagem</title>
</head>

<body>
    <div class="container-fluid" id="Main_div">
        <br>
        <div class="row">
            <div class="col">
                <h4>Ultimos carros adicionados</h4>
            </div>
            <div class="col-sm-2">
                <a href="CarRegister.php" class="btn btn-outline-success">Adicionar Carro</a>
            </div>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table">
                <?php
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

                        echo "<div class='col-sm-4'>
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
                    echo '<div style="border-width:3px;border-style:dashed; color: lightgray">
                        <br>
                        <h3 class="text-center">
                            Ainda não adicionou nenhum Carro
                        </h3>
                        <br>
                    </div>';
                } ?>
            </table>
        </div>

        <br>

        <div class="row">
            <div class="col">
                <h4>Todos os carros</h4>
            </div>
            <div class="col-sm-2" style="padding-right: 40px">
                <input type="text" placeholder="Procurar" class="form-control">
            </div>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table">
                <?php 
                echo ShowCarCars($data,"SELECT * FROM Cars WHERE Stand_id = '$id'",$con);
                //UwU es gay
                //UwU dorifto
                ?>
            </table>
        </div>
    </div>
    <div id="Error_div">
        <?//UwU?>
    </div>
</body>

<script>
var div1 = document.getElementById("Main_div");
var div2 = document.getElementById("Error_div");
var aux = < ? php echo json_encode($ERROR_No_Data_Stand); ? > ;
if (aux == true) {
    div1.style.display = 'none';
    div2.style.display = 'block';
} else {
    div2.style.display = 'none';
    div1.style.display = 'block';
}
</script>

</html>