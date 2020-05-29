<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAuto_PT/");
define("INCLUDE_PATH", __DIR__);
include("../Public/Config.php");
include("../assets/role_checker.php");
include("../assets/stand_user.php");
include("../assets/user_info.php");

roleStand();

$data[] = returnStand($_SESSION['Id'], $con);

if ($data[0] === null) {
    header("location: StandRegister.php");
}

include("../includes/header.php");
include("../includes/menu.php");
?>

<div class="container-fluid" id="Main_div">
    <br>
    <div class="row">
        <div class="col">
            <h4>Ultimos carros adicionados</h4>
        </div>
        <div class="col-sm-2">
            <a href="CarRegister.php" class="btn btn-outline-success float-right">Adicionar Carro</a>
        </div>
    </div>
    <hr class="mb-4">
    <div class="row" id="TabLast5" style="vertical-align: middle">
    </div>

    <br>

    <div class="row">
        <div class="col">
            <h4>Todos os carros</h4>
        </div>
        <div class="col-sm-2" style="padding-left: 40px">
            <input type="text" placeholder="Procurar" class="form-control float-right" onkeyup="CCS(this.value)" id="Search">
        </div>
    </div>
    <hr class="mb-4">

    <div class="row" id="TabSearch">
    </div>

</div>
<div id="Error_div">
    <div class="card shadow" style="width: 340px;">
        <div class="card-body no-padding">
            <div class="col no-padding">
                <img src="<?php echo ROOT_PATH . 'Public/Images/Profile/defult_user.jpg' ?>" alt="exemplo" style="width: 100%; height: 340px">
                <div class="bottom-right-car shadow-lg" style="background-color: #0a3f82e0;">
                    <span style="font-size:25px">150.000€</span>
                </div>
            </div>
            <div class="col no-padding">
                <div class="card-title margins">
                    <h5><small class="font-weight-bold">Ford GT 1995...</small></h5>
                    <p class="card-text">1995</p>
                    <p class="card-text text-right">100.000.000km</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("../Includes/footer.php") ?>

<script>
    window.onload = function() {
        CCSL5();
        CCS("");
    };

    function CCSL5() {
        $.ajax({
            type: "GET",
            url: "../assets/carcard.php",
            data: {
                SCCL5: true
            },
            success: function(response) {
                $("#TabLast5").html(response);
            }
        });
    };

    function CCS(str) {
        $.ajax({
            type: "GET",
            url: "../assets/carcard.php",
            data: {
                SCCL5: false,
                search: str
            },
            success: function(response) {
                $("#TabSearch").html(response);
            }
        });
    };
</script>