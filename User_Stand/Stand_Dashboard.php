<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAuto_PT/");
define("INCLUDE_PATH", __DIR__);
include('../Public/config.php');
include('../assets/stand_user.php');
include('../assets/role_checker.php');
include("../assets/user_info.php");
include("../assets/car_stand.php");

roleStand();

$imgurl = "";

$data = returnStand($_SESSION['Id'], $con);
if ($data === null) {
    header("location: StandRegister.php");
} else {
    if ($data["Banner"] != null) {
        $imgurl = "../Public/Images/Stand_Banners/" . $data["Stand_Id"] . "/" . $data["Banner"];
    } else {
        $imgurl = "../Public/Images/Stand_Banners/";
    }
}

$car = returnMostViewed($data["Stand_Id"], $con);
if ($car["Card_Image"] == null) {
    $name = FirtPhotoInserted($car["License_Plate"], $con);

    if ($name == false) {
        $imgname = "Public/Images/Car_Photos/no_image_car.png";
    } else {
        $imgname = "Public/Images/Car_Photos/".$car["License_Plate"] . "/" . $name;
    }
} else {
    $imgname = "Public/Images/Car_Photos/".$car["License_Plate"] . "/" . $car["Card_Image"];
}
$Name = $car["Brand"] . " " . $car["Model"];

if (strlen($Name) > 15) {
    substr($Name, 0, 15) . "...";
}

include("../includes/header.php");
include("../includes/menu.php");
?>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 col-sm-1">
        </div>
        <div class="col-md-8 col-sm-10 mt-4" style="padding-left: 62px; padding-right: 62px;">
            <div class="div-overlay-sd">
                <img src="<?php echo $imgurl ?>" alt="<?php echo $data['Name'] ?>" id="photo" class="shadow-lg">
                <div class="overlay-sd" id="overlay">
                    <h3 class="text-center">
                        <div style="margin-top:140px">Pagina do Stand</div>
                    </h3>
                </div>
            </div>
            <div class="bottom-right-stand mr-4">
                <h4><?php echo $data["Name"] ?></h4>
            </div>
        </div>
        <div class="col-md-2 col-sm-1">
        </div>
    </div>
</div>
<div class="container mt-4">
    <div class="row">
        <div class="col-md">
            <div class="card shadow border-left-primary mb-4">
                <div class="card-body">
                    <div class="row aling-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase font-weight-bold text-xs">
                                Número Total de Visualizações
                            </div>
                            <div class="text-dark font-weight-bold h5 mb-0">
                                <?php echo $data["Views"] ?>
                            </div>
                        </div>
                        <div class="col-auto text-gray">
                            <i class="fa fa-eye fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow border-left-success mb-4">
                <div class="card-body">
                    <div class="row aling-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase font-weight-bold text-xs">
                                Número Total de Vendas
                            </div>
                            <div class="text-dark font-weight-bold h5 mb-0">
                                0
                            </div>
                        </div>
                        <div class="col-auto text-gray">
                            <i class="fa fa-euro fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow border-left-warning mb-4">
                <div class="card-body">
                    <div class="row aling-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase font-weight-bold text-xs">
                                Novos Pedidos
                            </div>
                            <div class="text-dark font-weight-bold h5 mb-0">
                                0
                            </div>
                        </div>
                        <div class="col-auto text-gray">
                            <i class="fa fa-envelope fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card shadow sd-most-view-car" style="width: 340px">
                <div class="card-body no-padding">
                    <div class="col no-padding">
                        <img src="<?php echo ROOT_PATH . $imgname ?>" alt="exemplo" style="width: 100%; height: 340px">
                        <div class="bottom-right-car shadow-lg">
                            <span style="font-size:25px"><?= $car["MV"] ?> <i class="fa fa-eye"></i></span>
                        </div>
                    </div>
                    <div class="col no-padding">
                        <div class="card-title margins">
                            <h5><small class="font-weight-bold"><?= $Name ?></small></h5>
                            <p class="card-text"><?= $car["Year"] ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="top-left-most-view-car rounded-left rounded-right shadow-lg">
                <span class="font-weight-bold" style="font-size:25px">O Mais Visto<i class="fa fa-trophy"></i></span>
            </div>
        </div>
    </div>
    <div class="card shadow mt-4">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10 col-sm-10">
                    <h6>Estatisticas <img src="<?php echo ROOT_PATH ?>Icons/pie-chart.svg" style="margin-bottom: 5px;width: 20px;height: 20px;"></img></h6>
                </div>
                <div class="col-md-2 col-sm-2 text-right">
                    <a type="button" onclick="Statistics()"><img src="<?php echo ROOT_PATH ?>Icons/arrows-Expand.svg" style="width: 20px; height: 20px" id="IMG_CBS"></a>
                </div>
            </div>
        </div>
        <div class="card-body" id="CBS">

        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>

<script>
    $("#overlay").click(function() {
        window.location = "<?php echo ROOT_PATH ?>User_Stand/Stand_Profile.php";
    })

    function Statistics() {
        var div = document.getElementById("CBS");
        var img = document.getElementById("IMG_CBS");

        if (div.style.display === "none") {
            $(div).show(500);
            img.src = "<?php echo ROOT_PATH ?>Icons/arrows-collapse.svg";
        } else {
            $(div).hide(500);
            img.src = "<?php echo ROOT_PATH ?>Icons/arrows-expand.svg";
        }
    }
</script>