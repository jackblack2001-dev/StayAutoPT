<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAutoPT/");
define("INCLUDE_PATH", __DIR__);
include("../Public/config.php");
include("../assets/user_info.php");
include("../assets/message_user.php");
include("../assets/stand_user.php");
include("../assets/role_checker.php");

roleUser();

$stand_fav = returnAllSubscriptions($_SESSION["Id"], $con);

include("../layout/header.php");
include("../layout/menu.php");
?>

<div class="container">
    <div class="row mt-4">
        <div class="col-md-9">
            <h3><strong></i> Subscrições</strong></h3>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" placeholder="Pesquisa" id="stand_search">
        </div>
    </div>
    <hr>
    <div class="row" id="stand_fav_display">
        <?php if ($stand_fav != null) : ?>
            <?php foreach ($stand_fav as $row) : ?>
                <div class="card shadow-lg" style="width: 100%;">
                    <div class="card-body">
                        <div class="row">
                            <img class="rounded" src="../Public/Images/Stand_Banners/<?= $row["Banner_Name"] ?>" alt="" style="width: 250px; height: 170px;">
                            <div class="col ml-2">
                                <h4><strong><a class="a-cars" href="<?= ROOT_PATH ?>User_Stand/Stand_Profile.php?id=<?= $row["Stand_Id"] ?>"><?= $row["Name"] ?></a></strong></h4>
                                <small><?= $row["name_location"] ?> <i class="fa fa-map-marker" style="color: red;"></i></small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php else : ?>
            <div class="col mb-4" style="border-width:3px;border-style:dashed; color: lightgray">
                <br>
                <h3 class="text-center">
                    Ainda não Subscreveu nenhum stand
                </h3>
                <br>
            </div>
        <?php endif ?>
    </div>
</div>

<?php include("../layout/footer.php"); ?>
<script>
    $(document).ready(function() {
        var have_cars = "<?= $stand_fav == null ? true : false ?>";

        if (have_cars == 1) {
            $("#stand_search").prop("disabled", true);
        }

        $("#stand_search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#stand_fav_display .card").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>