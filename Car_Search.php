<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAutoPT/");
define("INCLUDE_PATH", __DIR__);
include("assets/user_info.php");
include("public/config.php");


$sql = "SELECT * FROM brand ";
if ($Result = $con->query($sql)) {
    if ($Result->num_rows >= 1) {
        while ($row = $Result->fetch_array()) {
            $Brand[] = $row;
        }
    }
}
include("layout/header.php");
include("layout/menu.php");
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <!-- divisoria -->
        </div>
        <div class="col-md-8">
            <div class="row">
                <!-- minha area de trabalho -->
                <div class="card shadow" style="width: 100%;">

                    <div class="card-header">
                        <h4>Filtros</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="Brandselected">Marca</label>
                                    <select title="Marca" id="Brandselected" class="form-control" name="Brandselected">
                                        <option>Selecione uma Marca</option>
                                        <?php if (isset($Brands)) : ?>
                                            <?php foreach ($Brands as $brand) : ?>

                                                <option value="<?= $brand["brand_id"] ?>"><?= $brand["name"] ?></option>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="fuelselected">Combustivel</label>
                                    <select title="Combustivel" id="fuelselected" class="form-control" name="fuelselected">
                                        <option>Selecione um Combustivel</option>
                                        <option value="0">Gasolina</option>
                                        <option value="1">Disel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="trasmisaoselected">Trasmisão</label>
                                    <select title="Trasmisão" id="trasmisaoselected" class="form-control" name="Trasmisaoselected">
                                        <option>Selecione um tipo de trasmição</option>
                                        <option value="0">Manual</option>
                                        <option value="1">SemiAutomatica</option>
                                        <option value="2">Automatica</option>
                                        <option value="3">CVT</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4" id="cars_show">
                </div>
                <div class="card shadow-lg">
                    <!-- parte david -->
                    <div class="card-body">
                        <div class="row">
                            <img src="Public/Images/Car_Photos/no_image_car.png" alt="" style="width: 250px; height: 170px;">
                            <div class="col ml-2">
                                <h4><strong>O meu carro</strong></h4>
                            </div>
                            <div class="col">
                                <h2 class="float-right">4000 <i class="fa fa-euro"></i></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <!-- divisoria -->
            </div>
        </div>
    </div>

    <?php include("layout/footer.php"); ?>

    <script>
        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "assets/carsearch.php",
                data: {
                    search: false,
                },
                success: function(response) {
                    $("#cars_show").html(response);
                }
            });
        })
    </script>