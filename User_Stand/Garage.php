<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAutoPT/");
define("INCLUDE_PATH", __DIR__);
include("../Public/Config.php");
include("../assets/role_checker.php");
include("../assets/stand_user.php");
include("../assets/message_user.php");
include("../assets/user_info.php");

if (isset($_GET["id"])) {
    $data = returnStandGet($_GET["id"], $con);

    if ($data === null) {
        //404
    }
} else {
    $data = returnStand($_SESSION['Id'], $con);

    if ($data === null) {
        header("location: StandRegister.php");
    }
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
        <div class="col-sm-2" id="btn_add_car">
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
            <input type="text" placeholder="Procurar por Modelo" class="form-control float-right" onkeyup="CCS(this.value)" id="Search">
        </div>
    </div>
    <hr class="mb-4">

    <div class="row" id="TabSearch">
    </div>

</div>

<?php include("../layout/footer.php") ?>

<script>
    $(document).ready(function() {
        var owner = "<?= $data["User_Id"] ?>";
        var visitor = "<?= isset($_SESSION["Id"]) ? $_SESSION["Id"] : "0" ?>";

        if (visitor != owner) {
            $("#btn_add_car").remove();
        }

        CCSL5();
        CCS("");
    })

    function CCSL5() {
        var id = "<?= $data["Stand_Id"] ?>";
        $.ajax({
            type: "GET",
            url: "../assets/carcard.php",
            data: {
                SCCLX: true,
                rows: 5,
                id
            },
            success: function(response) {
                $("#TabLast5").html(response);
            }
        });
    };

    function CCS(str) {
        var id = "<?= $data["Stand_Id"] ?>";
        $.ajax({
            type: "GET",
            url: "../assets/carcard.php",
            data: {
                SCCLX: false,
                search: str,
                id
            },
            success: function(response) {
                $("#TabSearch").html(response);
            }
        });
    };
</script>