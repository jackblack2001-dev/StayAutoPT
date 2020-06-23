<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAutoPT/");
define("INCLUDE_PATH", __DIR__);
include("Public/config.php");
include("assets/user_info.php");
include("assets/message_user.php");
include("assets/car_stand.php");

$car_fav = null;

if (isset($_SESSION["Id"])) {
    $car_fav = returnAllFavouritCars($_SESSION["Id"], $con);
} else {
    if (isset($_COOKIE["cars_favourits"])) {
        $Lp = explode("=", $_COOKIE["cars_favourits"]);
        foreach ($Lp as $lp) {
            $clean = base64_decode($lp);
            if ($clean != "") {
                $License_Plates[] = "'" . $clean . "'";
            }
        }

        $car_fav = returnCookieFavouritCars($License_Plates, $con);
    }
}

include("layout/header.php");
include("layout/menu.php");
?>

<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-10">
            <h3><strong><i class="fa fa-star"></i> Favoritos <i class="fa fa-star"></i></strong></h3>
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control" placeholder="Pesquisa" id="cars_search">
        </div>
    </div>
    <hr>
    <div class="row" id="car_fav_display">
        <?php if ($car_fav != null) : ?>
            <?php foreach ($car_fav as $car) : ?>
                <div class="card shadow ml-4 mr-4 mb-4" style="width: 340px">
                    <div class="card-body no-padding">
                        <div class="col no-padding">
                            <img src="Public/Images/Car_Photos/<?= $car["Card_Image"] ?>" alt="<?= $car["Model"] ?>" style="width: 100%; height: 340px">
                            <div class="bottom-right-car shadow-lg">
                                <span style="font-size:25px"><?= $car["Price"] ?> <i class="fa fa-euro"></i></span>
                            </div>
                        </div>
                        <div class="col no-padding">
                            <div class="card-title margins">
                                <a class="a-cars" href="<?= ROOT_PATH ?>User_Stand/Car_Profile.php?id=<?= urlencode(base64_encode($car["License_Plate"])) ?>">
                                    <h5><small class="font-weight-bold"><?= $car["Model"] ?></small></h5>
                                </a>
                                <p class="card-text"><?= $car["Year"] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php else : ?>
            <div class="col mb-4" style="border-width:3px;border-style:dashed; color: lightgray">
                <br>
                <h3 class="text-center">
                    Ainda não adicionou nenhum carro aos Favoritos
                </h3>
                <br>
            </div>
        <?php endif ?>
    </div>
</div>

<?php include("layout/footer.php"); ?>
<script>
    $(document).ready(function() {
        var have_cars = "<?= $car_fav == null ? true : false ?>";

        if (have_cars == 1) {
            $("#cars_search").prop("disabled", true);
        }

        $("#cars_search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#car_fav_display .card").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>