<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAuto_PT/");
define("INCLUDE_PATH", __DIR__);
include_once('../Public/config.php');
include_once('../assets/stand_user.php');
include_once('../assets/role_checker.php');

if (isset($_SESSION['Profile'])) {
    roleStand($_SESSION['Profile']);
}

$data[] = returnStand($_SESSION['Id'], $con);
if ($data[0] === null) {
    //Triger para uma função js??
}

include("../includes/header.php");
include("../includes/menu.php");
?>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 col-sm-1">
        </div>
        <div class="col-md-8 col-sm-10 mt-4">
            <img src="<?php echo ROOT_PATH . 'Public/Images/Profile/defult_user.jpg' ?>" alt="<?php echo $data[0]['Name'] ?>" id="photo" class="shadow-lg">
            <div class="bottom-right-stand mr-4">
                <h4><?php echo $data[0]["Name"] ?></h4>
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
                                <?php echo $data[0]["Views"]?>
                            </div>
                        </div>
                        <div class="col-auto text-gray">
                            <img src="<?= ROOT_PATH ?>icons/eye.svg" style="width: 35px; height: 35px;">
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
                            <img src="<?= ROOT_PATH ?>icons/euro.svg" style="width: 35px; height: 35px;">
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
                            <img src="<?= ROOT_PATH ?>icons/envelope.svg" style="width: 35px; height: 35px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card shadow">
                <div class="card-header">
                    <h6>O carro mais visto</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="<?php echo ROOT_PATH . 'Public/Images/Profile/defult_user.jpg' ?>" alt="" style="width: 100%; height: 100%;">
                        </div>
                        <div class="col-md-6">
                            <div class="row card-title">
                                <h4>Marca + Modelo</h4>
                            </div>
                            <div class="row">
                                100<img class="ml-1" src="<?= ROOT_PATH ?>icons/eye.svg">
                            </div>
                        </div>
                    </div>
                </div>
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

    /*     function HideDiv() {
            var div = document.getElementById("Main_div");
            if (<?php $Sflag ?> == false) {
                div.hidden = true;
            }
        } */
</script>