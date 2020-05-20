<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAuto_PT/");
define("INCLUDE_PATH", __DIR__);
include_once('../Public/config.php');
include_once('../assets/stand_user.php');
include_once('../assets/role_checker.php');

if (isset($_SESSION['Profile'])) {
    roleStand($_SESSION['Profile']);
} else {
    header("location: index.php");
}

$data[] = returnStand($_SESSION['Id'], $con);
if ($data[0] === null) {
    //Triger para uma função js??
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["Order"])) {
        UpdateStandItemsOrder($_POST["Order"], $data[0]["Stand_Id"], $con);
    }
}

include("../includes/header.php");
include("../includes/menu.php");
?>

<div class="container">
    <div class="div-overlay-stand-profile-banner mt-4">
        <img class="text-center Img_Banner shadow" src="../Public/Images/User_Banners/defult_profile_banner.jpg" />
        <div></div>
        <div class="overlay-stand-profile-banner" id="ovelay-banner">
            <h3 class="text-center">
                <i class="fa fa-image fa-4x" style="position: relative; top: 130px;"></i>
            </h3>
        </div>
    </div>
    <div class="div-overlay-stand-profile-badge">
        <img class="rounded-circle Img_Profile shadow-lg" src="../Public/Images/Profile/defult_user.jpg" />
        <div class="overlay-stand-profile-badge rounded-circle Img_Profile" id="overlay-badge">
            <h3 class="text-center">
                <i class="fa fa-image fa-2x" style="position: relative; top: 60px;"></i>
            </h3>
        </div>
    </div>
    <div class="container">
        <div class="card shadow-lg mt-lg-n5 mb-4" id="">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <h6>Exibir</h6>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-outline-success float-right" id="BTN_Save" onclick="Save()">Salvar <i class="fa fa-floppy-o"></i></button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <select class="form-control" onchange="Showitems(this)">
                    <option value="" disabled selected id="default">Selecione um Item a Exibir</option>
                    <option value="0" id="news">Notícias</option>
                    <option value="1" id="featured">Carros em Destaque</option>
                    <option value="2" id="new_car">Novidades</option>
                    <option value="3" id="premiers">Estreias</option>
                </select>
            </div>
        </div>
        <div id="items"></div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>

<script>
    function cards(request) {
        if (request == "n") {
            return '<div class="card shadow mb-4" id="card_n">' +
                '<div class="card-header">' +
                '<div class="row">' +
                '<div class="col-md-11">' +
                '<h5>Notícias do Stand</h5>' +
                '</div>' +
                '<div class="col-md-1 text-danger">' +
                '<a class="float-right" type="button" onclick="Remove(news)"><i class="fa fa-trash-o" onhover(swapico(this))><i></a>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="card-body">' +
                '</div>' +
                '</div>';
        }

        if (request == "c") {
            return '<div class="card shadow mb-4" id="card_c">' +
                '<div class="card-header">' +
                '<div class="row">' +
                '<div class="col-md-11">' +
                '<h5>Em Destaque</h5>' +
                '</div>' +
                '<div class="col-md-1 text-danger">' +
                '<a class="float-right" type="button" onclick="Remove(featured)"><i class="fa fa-trash-o" id="ir"><i></a>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="card-body">' +
                '</div>' +
                '</div>';
        }

        if (request == "nc") {
            return '<div class="card shadow mb-4" id="card_nc">' +
                '<div class="card-header">' +
                '<div class="row">' +
                '<div class="col-md-11">' +
                '<h5>Novidades</h5>' +
                '</div>' +
                '<div class="col-md-1 text-danger">' +
                '<a class="float-right" type="button" onclick="Remove(new_car)"><i class="fa fa-trash-o" id="ir"><i></a>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="card-body">' +
                '</div>' +
                '</div>';
        }

        if (request == "p") {
            return '<div class="card shadow mb-4" id="card_p">' +
                '<div class="card-header">' +
                '<div class="row">' +
                '<div class="col-md-11">' +
                '<h5>Brevemente</h5>' +
                '</div>' +
                '<div class="col-md-1 text-danger">' +
                '<a class="float-right" type="button" onclick="Remove(premiers)"><i class="fa fa-trash-o" id="ir"><i></a>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="card-body">' +
                '</div>' +
                '</div>';
        }
    }

    $(document).ready(function() {
        var Items = "<?php echo $data[0]["ItemsOrder"] ?>";
        var items = Items.split(":");

        $(items).each(function() {
            if (this == "card_n") {
                $("#items").append(cards("n"));
                $("#news").hide();
            }

            if (this == "card_c") {
                $("#items").append(cards("c"));
                $("#featured").hide();
            }

            if (this == "card_nc") {
                $("#items").append(cards("nc"));
                $("#new_car").hide();
            }

            if (this == "card_p") {
                $("#items").append(cards("p"));
                $("#premiers").hide();
            }

        })
    })

    function swapico(i) {
        $(i).hover(
            function() {
                $(this).toggleClass("fa-trash fa-trash-o");
            });

    }

    function Save() {
        var $array = [];
        $('div.card').each(function() {
            if ($(this).attr('id') != "") {
                var id = $(this).attr('id');
                $array.push(id);
            }
        });
        if ($array != null) {
            $.ajax({
                type: "POST",
                url: "<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>",
                data: {
                    Order: $array
                },
                success: function(response) {
                    /* Place Toaster */
                }
            });
        }
    }

    function Showitems(selected) {

        if ($(selected).val() == 0) {
            if ($("#card_n").length == 0) {
                $("#items").append(cards("n"));
                $("#news").hide();
                $("#default").prop("selected", true);
            }
        }

        if ($(selected).val() == 1) {
            if ($("#card_c").length == 0) {
                $("#items").append(cards("c"));
                $("#featured").hide();
                $("#default").prop("selected", true);
            }
        }

        if ($(selected).val() == 2) {
            if ($("#card_nc").length == 0) {
                $("#items").append(cards("nc"));
                $("#new_car").hide();
                $("#default").prop("selected", true);
            }
        }

        if ($(selected).val() == 3) {
            if ($("#card_p").length == 0) {
                $("#items").append(cards("p"));
                $("#premiers").hide();
                $("#default").prop("selected", true);
            }
        }

        if ($("#card_n").length != 0 && $("#card_c").length != 0 && $("#card_nc").length != 0 && $("#card_p").length != 0) {
            $("#default").text("Não há mais nada para Exibir!");
        }
    }

    function Remove(id) {
        if ($(id).val() == 0) {
            $("#card_n").remove();
            $("#news").show();
        }

        if ($(id).val() == 1) {
            $("#card_c").remove();
            $("#featured").show();
        }

        if ($(id).val() == 2) {
            $("#card_nc").remove();
            $("#new_car").show();
        }

        if ($(id).val() == 3) {
            $("#card_p").remove();
            $("#premiers").show();
        }

        if ($("#card_n").length == 0 || $("#card_c").length == 0 || $("#card_nc").length == 0 || $("#card_p").length == 0) {
            $("#default").text("Selecione um Item a Exibir");
        }
    }
</script>