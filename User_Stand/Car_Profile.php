<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAuto_PT/");
define("INCLUDE_PATH", __DIR__);
include("../Public/Config.php");
include("../assets/car_stand.php");
include("../assets/stand_user.php");
include("../assets/user_info.php");

if (isset($_GET['id'])) {
    $id = urldecode(base64_decode($_GET['id']));

    $data = returnCar($id, $con);

    if ($data != null) {
        $photos = returnAllCarPhotos($id, $con);
    } else {
    }
} else {
    //redirect to 404 page error
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["id"]) && isset($_POST["redirect"]) && isset($_POST["brand"]) && isset($_POST["model"]) && isset($_POST["year"]) && isset($_POST["kms"]) && isset($_POST["description"]) && isset($_POST["price"])){
        if(isset($_POST["fuel"])){
            $fuel = $_POST["fuel"];
        }else{
            $fuel = "";
        }

        if(isset($_POST["gear"])){
            $gear = $_POST["gear"];
        }else{
            $gear = "";
        }

        $id= $_POST["id"];
        UpdateCar($id,$_POST["brand"],$_POST["model"],$_POST["kms"],$_POST["year"],$fuel,$gear,$_POST["description"],$_POST["price"],$con);
        header("Location: ". ROOT_PATH . "User_Stand/Car_Profile.php?id=" . $_POST["redirect"] ."");
    }
}

include("../layout/header.php");
include("../layout/menu.php");
?>

<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-2 col-sm-2">
        </div>
        <div class="col-md-6 col-sm-6">
            <div>
                <div id="carouselcarimg" class="carousel slide shadow-lg mb-4" data-ride="carousel">

                    <!-- Indicators -->
                    <ul class="carousel-indicators">
                        <?php
                        for ($i = 0; $i < count($photos); $i++) {
                            echo '<li data-target="#carouselcarimg" data-slide-to="' . $i . '" class="active"></li>';
                        }
                        ?>
                    </ul>

                    <!-- The slideshow -->
                    <div class="carousel-inner">
                        <?php
                        if ($photos != null) {
                            $aux = 1;
                            foreach ($photos as $photo) {
                                if ($aux == 1) {
                                    echo '<div class="carousel-item active">
                        <img src="' . ROOT_PATH . 'Public/Images/Car_Photos/' . $photo["License_Plate"] . '/' . $photo["Name"] . '" alt="' . $data["Brand"] . " " . $data["Model"] . '">
                    </div>';
                                } else {
                                    echo '<div class="carousel-item">
                        <img src="' . ROOT_PATH . 'Public/Images/Car_Photos/' . $photo["License_Plate"] . '/' . $photo["Name"] . '" alt="' . $data["Brand"] . " " . $data["Model"] . '">
                    </div>';
                                }
                                $aux++;
                            }
                        }
                        ?>
                        <!-- Left and right controls -->
                        <a class="carousel-control-prev" href="#carouselcarimg" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#carouselcarimg" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>

                    </div>
                    <!--                     <div class="top-left-car-price rounded shadow-lg">
                        <span class="font-weight-bold" style="font-size: 25px;"><?= $data["Price"] ?><i class="fa fa-euro"></i></span>
                    </div> -->
                </div>
            </div>
            <div class="card shadow-lg ml-5 mr-5 mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <h5>Detalhes</h5>
                        </div>
                        <div class="col-md-2" id="div_btn_edit">
                            <button class="btn btn-outline-secondary float-right" data-toggle="modal" data-target="#ModalUpdateCar">Editar</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h6><strong>Tipo de Combustível</strong></h6>

                            <div class="mt-n2">
                                <?php
                                if ($data["Type_Fuel"] == 1) {
                                    $type_f = "Gasolina";
                                } else {
                                    $type_f = "Diesel";
                                }
                                ?>
                                <small><?= $type_f ?></small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="float-right">
                                <h6><strong>Tipo de Transmição</strong></h6>

                                <div class="mt-n2">
                                    <?php
                                    if ($data["Type_Gear"] == 1) {
                                        $type_g = "Manual";
                                    } else if ($data["Type_Gear"] == 2) {
                                        $type_g = "Automatico";
                                    } else {
                                        $type_g = "CVT";
                                    }
                                    ?>
                                    <small><?= $type_g ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-4">
                        <div class="col">
                            <h6><strong>Descrição</strong></h6>

                            <div class="mt-n2">
                                <small><?= $data["Description"] ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 card-car-info">
            <div class="card shadow-lg">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <h6>Informações do veiculo</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5><strong><?= $data["Brand"] . " " . $data["Model"] ?></strong></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <small><?= $data["Year"] . " / " . $data["Kms"] . "Km" ?></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        </div>
                        <div class="col">
                            <h5 class="float-right"><strong><?= $data["Price"] ?><i class="fa fa-euro"></i></strong></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("../Includes/modal_updatecardata.php")?>

<?php include("../layout/footer.php") ?>