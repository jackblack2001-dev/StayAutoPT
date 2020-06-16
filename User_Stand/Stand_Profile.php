<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAutoPT/");
define("INCLUDE_PATH", __DIR__);
include('../Public/config.php');
include('../assets/stand_user.php');
include('../assets/role_checker.php');
include("../assets/message_user.php");
include("../assets/user_info.php");

roleStand();

$imgbanner = $imgbadge = "";

$who = "stand";
$data = returnStand($_SESSION['Id'], $con);

if ($data === null) {
    header("location: StandRegister.php");
} else {
    $id = $data["Stand_Id"];
    $news = returnNews($data["Stand_Id"], $con);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (isset($_POST["Order"])) {
        UpdateStandItemsOrder($_POST["Order"], $data["Stand_Id"], $con);
    }

    if (isset($_POST["name"]) && isset($_POST["adress"]) && isset($_POST["phone"]) /* && isset($_POST["locality"]) */) {
        $id = $data["Stand_Id"];
        UpdateStand($id, $_POST["name"], $_POST["adress"], $_POST["phone"], $con);
        header("Refresh:0");
    }
}

include("../layout/header.php");
include("../layout/menu.php");
?>

<div class="container">
    <div class="div-overlay-stand-profile-banner mt-4">
        <img class="text-center Img_Banner shadow" src="../Public/Images/Stand_Banners/<?= $data["Banner_Name"] ?>" />
        <div class="overlay-stand-profile-banner" id="overlay-banner">
            <h3 class="text-center">
                <i class="fa fa-image fa-4x" style="position: relative; top: 130px;"></i>
            </h3>
        </div>
        <div class="top-right-stand-name rounded-left rounded-right shadow-lg">
            <span class="font-weight-bold" style="font-size:25px"><?= $data["Name"] ?></span>
        </div>
    </div>
    <div class="div-overlay-stand-profile-badge">
        <img class="rounded-circle Img_Profile shadow-lg" src="../Public/Images/Stand_Badge/<?= $data["Badge_Name"] ?>" />
        <div class="overlay-stand-profile-badge rounded-circle Img_Profile" id="overlay-badge">
            <h3 class="text-center">
                <i class="fa fa-image fa-2x" style="position: relative; top: 60px;"></i>
            </h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-lg mt-lg-n5 mb-5">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <h4>Informações</h4>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-outline-secondary float-right" id="BTN_Edit_Stand" data-toggle="modal" data-target="#ModalUpdateStand">Editar</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <dl>
                            <dt>
                                <h5>Localidade</h5>
                            </dt>
                            <dd>
                                <h4><small><?= $data["Locality"] ?></small></h4>
                            </dd>
                        </dl>
                        <dl>
                            <dt>
                                <h5>Contacto</h5>
                            </dt>
                            <dd>
                                <h4><small><?= $data["Phone"] ?></small></h4>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="div-google-map col-md-8 mb-5 mt-n5">
                <div class="google-map" id="map">
                </div>
                <div class="top-left-stand-map-placeholder rounded-right shadow-lg">
                    <span class="font-weight-bold" style="font-size:25px">Onde pode nos encontrar</span>
                </div>
            </div>
        </div>

        <div class="card shadow-lg mb-4" id="Edit_Exbitions">
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

<?php include("../Includes/modal_uploadphoto.php"); ?>
<?php include("../Includes/modal_newnews.php"); ?>
<?php include("../Includes/modal_updatestanddata.php") ?>

<?php include("../layout/footer.php"); ?>

<script>
    $(document).ready(function() {
        geocode();
    })

    function geocode() {
        var location = '<?= $data["Adress"] ?>';
        axios.get('https://maps.googleapis.com/maps/api/geocode/json', {
                params: {
                    address: location,
                    key: 'AIzaSyABimp-LZ3oqqXlRN3aKPHqyKO_g-cwKMs'
                }
            })
            .then(function(response) {
                //console.log(response);
            })
            .catch(function(error) {
                console.log(error);
            })
    }

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(40.660811, -7.907742),
            zoom: 12
        });
    }

    function CCSLX(div, rows, up) {
        $.ajax({
            type: "GET",
            url: "../assets/carcard.php",
            data: {
                SCCLX: true,
                rows,
                up
            },
            success: function(response) {
                $("#" + div + "").html(response);
            }
        });
    };

    function UpdateNews(id_news) {
        var id_stand = "<?= $data["Stand_Id"] ?>";
        $.ajax({
            type: "GET",
            url: "../assets/stand_news.php",
            data: {
                id_stand,
                id_news,
                aux: true
            },
            success: function(response) {
                var obj = JSON.parse(response);

                $('#UTitle').val(obj.Title);
                $('#Id').val(id_news);
                CKEDITOR.instances["UText"].setData(obj.Text);
                $('#ModalUpdateNews').modal('show');
            }
        });
    }

    function GetNews(id_news) {
        var id_stand = "<?= $data["Stand_Id"] ?>";
        $.ajax({
            type: "GET",
            url: "../assets/stand_news.php",
            data: {
                id_stand,
                id_news
            },
            success: function(response) {
                $("#card_news").html(response);
            }
        });
    }

    $("#overlay-banner").click(function() {
        $("#ModalUpdateBanner").modal();
    })

    $("#overlay-badge").click(function() {
        $("#ModalUpdateBadge").modal();
    })

    function cards(request) {
        if (request == "n") {
            return '<div class="card shadow mb-4" id="card_n">' +
                '<div class="card-header">' +
                '<div class="row">' +
                '<div class="col-md-11">' +
                '<h5>Notícias do Stand</h5>' +
                '</div>' +
                '<div class="col-md-1 text-danger">' +
                '<a class="float-right" type="button" onclick="Remove(news)"><i class="fa fa-trash-o"></i></a>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="card-body">' +
                '<div class="row mb-4">' +
                '<div class="col-md-6">' +
                '<div class="btn-group" role="group">' +
                '<button type="button" class="btn btn-outline-secondary" id="BTN_Last" onclick="GetNews(0)">Ultima Notícia</button>' +
                '<button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#ModalSelectNews">Selecionar Notícia</button>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-6">' +
                '<button type="button" class="btn btn-outline-success float-right" data-toggle="modal" data-target="#ModalCreateNews">Adicionar Notícia</button>' +
                '</div>' +
                '</div>' +
                '<div class="row" id="card_news">' +
                '</div>' +
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
                '<a class="float-right" type="button" onclick="Remove(featured)"><i class="fa fa-trash-o" id="ir"></i></a>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="card-body">' +
                '<div class="row mb-4">' +
                '<div class="col-md-6">' +
                '<div class="btn-group" role="group">' +
                '<button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#ModalSelectNews">Selecionar Carros</button>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="div_nc" id="c_cars">' +
                '</div>' +
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
                '<a class="float-right" type="button" onclick="Remove(new_car)"><i class="fa fa-trash-o" id="ir"></i></a>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="card-body">' +
                '<div class="row mb-4">' +
                '<div class="col-md-3">' +
                '<div class="form-group">' +
                '<label for="ncar"><strong>Nº de Carros a Mostrar</strong></label>' +
                '<select class="form-control" onchange="UpdateNC(this)" name="ncar" id="ncar">' +
                '<option value="1" id="news">1</option>' +
                '<option value="2" id="featured">2</option>' +
                '<option value="3" id="new_car">3</option>' +
                '<option value="4" id="premiers">4</option>' +
                '<option value="5" id="premiers">5</option>' +
                '<option value="6" id="premiers">6</option>' +
                '<option value="7" id="premiers">7</option>' +
                '<option value="8" id="premiers">8</option>' +
                '<option value="9" id="premiers">9</option>' +
                '<option value="10" id="premiers">10</option>' +
                '</select>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="div_nc" id="new_cars">' +
                '</div>' +
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
                '<a class="float-right" type="button" onclick="Remove(premiers)"><i class="fa fa-trash-o" id="ir"></i></a>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="card-body">' +
                '</div>' +
                '</div>';
        }
    }

    $(document).ready(function() {
        var Items = "<?php echo $data["ItemsOrder"] ?>";
        var items = Items.split(":");

        $(items).each(function() {
            if (this == "card_n") {
                $("#items").append(cards("n"));
                GetNews(<?= $data["Id_News"] ?>)
                $("#news").hide();
            }

            if (this == "card_c") {
                $("#items").append(cards("c"));
                $("#featured").hide();
            }

            if (this == "card_nc") {
                $("#items").append(cards("nc"));
                $("#ncar").val("<?= $data["NumCarN"] ?>")
                CCSLX("new_cars", <?= $data["NumCarN"] ?>, false);
                $("#new_car").hide();
            }

            if (this == "card_p") {
                $("#items").append(cards("p"));
                $("#premiers").hide();
            }

        })

        if ($("#card_n").length != 0 && $("#card_c").length != 0 && $("#card_nc").length != 0 && $("#card_p").length != 0) {
            $("#default").text("Não há mais nada para Exibir!");
        }
    })

    function UpdateNC(sel) {
        CCSLX("new_cars", $(sel).val(), true);
    }

    $(document).ready(function() {
        $("#news_search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#table_news tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    function Save() {
        var $array = [];
        $('div.card').each(function() {
            if ($(this).attr('id') != "" && $(this).attr('id') != "Edit_Exbitions") {
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
                $("#BTN_Last").focus();
                GetNews(<?= $data["Id_News"] ?>);
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
                CCSLX("new_cars", <?= $data["NumCarN"] ?>, false);
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