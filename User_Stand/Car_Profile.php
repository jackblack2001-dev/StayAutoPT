<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAutoPT/");
define("INCLUDE_PATH", __DIR__);
include("../Public/Config.php");
include("../assets/car_stand.php");
include("../assets/stand_user.php");
include("../assets/message_user.php");
include("../assets/user_info.php");

if (isset($_GET['id'])) {
    $id = urldecode(base64_decode($_GET['id']));

    $car = returnCar($id, $con);

    $stand = returnCarStand($id, $con);

    if ($car != null) {
        $photos = returnAllCarPhotos($id, $con);
    } else {
    }
} else {
    //redirect to 404 page error
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"]) && isset($_POST["redirect"]) && isset($_POST["brand"]) && isset($_POST["model"]) && isset($_POST["year"]) && isset($_POST["kms"]) && isset($_POST["description"]) && isset($_POST["price"])) {
        if (isset($_POST["fuel"])) {
            $fuel = $_POST["fuel"];
        } else {
            $fuel = "";
        }

        if (isset($_POST["gear"])) {
            $gear = $_POST["gear"];
        } else {
            $gear = "";
        }

        $id = $_POST["id"];
        UpdateCar($id, $_POST["brand"], $_POST["model"], $_POST["kms"], $_POST["year"], $fuel, $gear, $_POST["description"], $_POST["price"], $con);
        header("Location: " . ROOT_PATH . "User_Stand/Car_Profile.php?id=" . $_POST["redirect"] . "");
    }

    if (isset($_POST["id_car"]) && isset($_POST["redirect"]) && isset($_POST["id_stand_owner"]) && isset($_POST["title"])  && isset($_POST["message"])) {

        if (isset($_POST["price_neg"])) {
            $price = $_POST["price_neg"];
        } else {
            $price = null;
        }

        insertMessage($_POST["id_car"], $_SESSION["Id"], $_POST["id_stand_owner"], $_POST["title"], $_POST["message"], $price, $con);
        header("Location: " . ROOT_PATH . "User_Stand/Car_Profile.php?id=" . $_POST["redirect"] . "");
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
                        <?php if (isset($photos)) : ?>
                            <?php for ($i = 0; $i < count($photos); $i++) : ?>
                                <li data-target="#carouselcarimg" data-slide-to="<?= $i ?>" class="active"></li>
                            <?php endfor ?>
                        <?php endif ?>
                    </ul>

                    <!-- The slideshow -->
                    <div class="carousel-inner">
                        <?php if ($photos != null) : ?>
                            <?php $aux = 1 ?>
                            <?php foreach ($photos as $photo) : ?>
                                <div class="carousel-item <?= $aux == 1 ? "active" : "" ?>">
                                    <img src="<?= ROOT_PATH ?>Public/Images/Car_Photos/<?= $photo["License_Plate"] . "/" . $photo["Name"] ?>" alt="<?= $car["Model"] ?>">
                                </div>
                                <?php $aux++ ?>
                            <?php endforeach ?>
                        <?php endif ?>
                        <!-- Left and right controls -->
                        <a class="carousel-control-prev" href="#carouselcarimg" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#carouselcarimg" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>

                    </div>
                    <!--                     <div class="top-left-car-price rounded shadow-lg">
                        <span class="font-weight-bold" style="font-size: 25px;"><?= $car["Price"] ?><i class="fa fa-euro"></i></span>
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
                                <small><?= $car["Type_Fuel"] ?></small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="float-right">
                                <h6><strong>Tipo de Transmição</strong></h6>

                                <div class="mt-n2">
                                    <small><?= $car["Type_Gear"] ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-4">
                        <div class="col">
                            <h6><strong>Descrição</strong></h6>

                            <div class="mt-n2">
                                <small><?= $car["Description"] ?></small>
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
                            <h5><strong><?= $car["Model"] ?></strong></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <small><?= $car["Year"] . " / " . $car["Kms"] . "Km" ?></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        </div>
                        <div class="col">
                            <h5 class="float-right"><strong><?= $car["Price"] ?><i class="fa fa-euro"></i></strong></h5>
                        </div>
                    </div>
                    <hr>
                    <button class="btn btn-outline-success float-right" data-toggle="modal" data-target="#ModalSendMessage">Deixe uma mensagem</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("../Includes/modal_updatecardata.php") ?>

<?php include("../layout/footer.php") ?>

<script>
    $(document).ready(function() {
        var owner = "<?= $stand["User_Id"] ?>";
        var visitor = "<?= isset($_SESSION["Id"]) ? $_SESSION["Id"] : null ?>";
        var isadmin = "<?= isset($_SESSION["Profile"]) && $_SESSION["Profile"] == 0 ? true : false ?>"

        if (visitor != null) {
            if (visitor != owner && !isadmin) {
                $("#div_btn_edit").remove();
            }
        }

        $("#price_neg").hide();
    });

    $("#chk_neg").change(function() {
        if ($(this).prop("checked") == true) {
            $("#price_neg").show();
        } else {
            $("#price_neg").hide();
        }
    })
</script>