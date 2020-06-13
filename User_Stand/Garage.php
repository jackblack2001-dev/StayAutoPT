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

include("../layout/header.php");
include("../layout/menu.php");
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
    <div class="div_5" id="TabLast5" style="vertical-align: middle">
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

<?php include("../layout/footer.php") ?>

<script>
    $(document).ready(function() {
        CCSL5();
        CCS("");
    })

    function CCSL5() {
        $.ajax({
            type: "GET",
            url: "../assets/carcard.php",
            data: {
                SCCLX: true,
                rows: 5
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
                SCCLX: false,
                search: str
            },
            success: function(response) {
                $("#TabSearch").html(response);
            }
        });
    };
</script>