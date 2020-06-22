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

    if (isset($_SESSION['Id']) && $_SESSION['Id'] != $stand["Stand_Id"]) {
        $is_favourit = returnFavouritCars($car["License_Plate"], $_SESSION['Id'], $con);
    } else $is_favourit = false;

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

    if (isset($_POST["photos"]) && isset($_POST["id_car"])) {
        foreach ($_POST["photos"] as $photo) {
            DeletePhotos($photo, $_POST["id_car"], $con);
        }
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
                        <?php if ($photos == null) : ?>
                            <img src="<?= ROOT_PATH ?>Public/Images/Car_Photos/no_image_car.png" alt="No image found">
                        <?php endif ?>
                        <!-- Left and right controls -->
                        <a class="carousel-control-prev" href="#carouselcarimg" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#carouselcarimg" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>

                    </div>
                </div>
            </div>

            <div class="card shadow mb-4" id="card_photos">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4><small>Fotografias <i class="fa fa-photo"></i></small></h4>
                        </div>
                        <div class="col text-right">
                            <a type="button" onclick="Photos()"><img src="<?php echo ROOT_PATH ?>Icons/arrows-Expand.svg" style="width: 20px; height: 20px" id="IMG_CBP"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="CBP" style="display:none">
                    <div class="row ml-4 mr-4" id="photos">
                        <?php if ($photos != null) : ?>
                            <?php foreach ($photos as $photo) : ?>
                                <div>
                                    <img class="img-photo mr-2 mb-4" src="<?= ROOT_PATH ?>Public/Images/Car_Photos/<?= $photo["License_Plate"] . "/" . $photo["Name"] ?>" id="<?= $photo["Id_Image"] ?>">
                                    <input class="checkbox-photo" type="checkbox" id="<?= $photo["Id_Image"] ?>">
                                </div>
                            <?php endforeach ?>
                        <?php endif ?>
                        <div class="img-add" onclick="$('#ModalAddPhoto').modal()">
                            <div class="text-center">
                                <i class=" fa fa-image fa-2x" style="position: relative; top:30px;"></i>
                            </div>
                        </div>
                    </div>
                    <hr style="width: 100%;">
                    <div class="row">
                        <div class="col">
                            <button class="float-right btn btn-outline-danger" data-toggle="modal" data-target="#ModalDelete">Apagar <i class="fa fa-trash"></i></button>
                        </div>
                    </div>
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
                        <div class="col-md-2" id="info_coner">

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
                    <button class="btn btn-outline-success float-right" data-toggle="modal" data-target="#ModalSendMessage" id="btn_msg">Deixe uma mensagem</button>
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
        var favourits = '<a class="float-right" type="button" onclick="favorits(<?= isset($_SESSION["Id"]) ? $_SESSION["Id"] : false ?>,<?= $stand["Stand_Id"] ?>)"><i id="icon_fav" class="<?= isset($is_favourit) && $is_favourit ? "fa fa-star" : "fa fa-star-o" ?>" style="font-size:25px;"></i></a>';

        if (visitor != null) {
            if (visitor != owner && !isadmin) {
                $("#div_btn_edit").remove();
                $("#card_photos").remove();
                $("#info_coner").append(favourits);
            } else {
                $("#btn_msg").remove();
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
    });

    function SeeChks() {
        var id_car = "<?= $id ?>";
        var array = new Array();
        var index = -1;
        var aux = 0;

        $(".checkbox-photo").each(function(i, obj) {
            aux++;

            var isChecked = $(obj).is(":checked");
            if (isChecked == true) {
                index++;
                array[index] = $(obj).attr('id');
                aux--;
            }
        });

        if (array.length != 0) {
            if (aux >= 3) {
                DeletePhotos(array, id_car);
            } else {
                $("#ModalDeleteErrorTooMutch").modal();
            }
        } else {
            $("#ModalDeleteErrorNoData").modal();
        }
    }

    function DeletePhotos(photos, id_car) {
        console.log(photos);
        $.ajax({
            type: "POST",
            url: "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>",
            data: {
                photos,
                id_car
            },
            success: function(response) {
                window.location.href = "Car_Profile.php?id=<?= urlencode(base64_encode($id)) ?>";
            }
        });
    }

    function Photos() {
        var div = document.getElementById("CBP");
        var img = document.getElementById("IMG_CBP");

        if (div.style.display === "none") {
            $(div).show(500);
            img.src = "<?php echo ROOT_PATH ?>Icons/arrows-collapse.svg";
        } else {
            $(div).hide(500);
            img.src = "<?php echo ROOT_PATH ?>Icons/arrows-expand.svg";
        }
    }

    function favorits(user, car) {
        if (user == false) {
            //coockies UwU
        } else {
            $.ajax({
                type: "POST",
                url: "../assets/favourits.php",
                data: {
                    user,
                    car,
                },
                success: function(response) {
                    $("#icon_fav").toggleClass('fa-star fa-star-o');
                }
            });
        }
    }
</script>