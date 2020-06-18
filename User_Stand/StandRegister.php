<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAutoPT/");
define("INCLUDE_PATH", __DIR__);
include('../assets/remove_cache.php');
include('../Public/config.php');
include('../assets/stand_user.php');
include('../assets/role_checker.php');
include("../assets/message_user.php");
include("../assets/user_info.php");

roleStand();

$Name = $Phone = $Adress = $Locality = $Banner = "";
$Name_ERROR = $Phone_ERROR = $Adress_ERROR = $Locality_ERROR = $banner_ERROR = $badge_ERROR = "";

$locations = returnLocations($con);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST['TXT_Name'])) {
        $Name_ERROR = "Deve indicar o Titulo/Nome do seu Stand";
    } else {
        $Name = $_POST['TXT_Name'];
    }

    if (empty($_POST['TXT_Phone'])) {
        $Phone_ERROR = "Deve indicar o Contacto telefonico do seu Stand";
    } else {
        $Phone = $_POST['TXT_Phone'];
    }

    if (empty($_POST['TXT_Adress'])) {
        $Adress_ERROR = "Deve indicar o Endereço do seu Stand";
    } else {
        $Adress = $_POST['TXT_Adress'];
    }

    if (!isset($_POST['TXT_Locality'])) {
        $Locality_ERROR = "Deve indicar a sua Localidade";
    } else {
        $Locality = $_POST['TXT_Locality'];
    }

    //banner
    $banner = scandir('../User_Stand/tmp/' . $_SESSION['Id'] . '/banner', 1);
    array_splice($banner, -2);
    if (!$banner) {
        $banner_ERROR = "Tem que incluir um Banner";
    }

    //badge
    $badge = scandir('../User_Stand/tmp/' . $_SESSION['Id'] . '/badge', 1);
    array_splice($badge, -2);
    if (!$badge) {
        $badge_ERROR = "Tem que incluir um Badge";
    }

    if (empty($Name_ERROR) && empty($Phone_ERROR) && empty($Adress_ERROR) && empty($Locality_ERROR) && empty($banner_ERROR) && empty($badge_ERROR)) {


        if (InsertStand($Phone, $Adress, $Locality, $Name, $con) == true) {

            $data = returnlastid($con);

            if (InsertStandConfig($data["id"], $con) == true) {
                $bannerTempName = 'tmp/' . $_SESSION['Id'] . '/banner/' . $banner[0];
                $bannerDestination = "../Public/Images/Stand_Banners/" . $data["id"];

                $badgeTempName = 'tmp/' . $_SESSION['Id'] . '/badge/' . $badge[0];
                $badgeDestination = "../Public/Images/Stand_Badge/" . $data["id"];

                InsertBanner($con, $data["id"], $banner[0]);

                InsertBadge($con, $data["id"], $badge[0]);

                if (!is_dir($bannerDestination)) {
                    mkdir($bannerDestination, 0777, true);
                }

                if (!is_dir($badgeDestination)) {
                    mkdir($badgeDestination, 0777, true);
                }

                $bannerDestination .= "/" . $banner[0];
                rename($bannerTempName, $bannerDestination);

                $badgeDestination .= "/" . $badge[0];
                rename($badgeTempName, $badgeDestination);

                header("location: Stand_Dashboard.php");
            }
        }
    } else {
        remove_tmp_US();
    }
} else {
    remove_tmp_US();
}

include("../layout/header.php");
include("../layout/menu.php");
?>

<div class="container">
    <br />
    <h3>Registar Stand</h3>
    <hr>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <label>Titulo do Stand <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" name="TXT_Name" value="<?php echo $Name ?>">
            <small class="text-danger"><?php echo $Name_ERROR ?></small><br />

            <label>Contacto Telefonico <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" name="TXT_Phone" value="<?php echo $Phone ?>">
            <small class="text-danger"><?php echo $Phone_ERROR ?></small>

            <br>
            <div class="row">
                <div class="col">
                    <label>Morada <sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="TXT_Adress" value="<?php echo $Adress ?>">
                    <small class="text-danger"><?php echo $Adress_ERROR ?></small>
                </div>
                <div class="col">
                    <label>Localidade <sup class="text-danger">*</sup></label>
                    <select class="form-control" name="TXT_Locality">
                        <option value="" selected disabled>Selecione uma Localidade</option>
                        <?php if (isset($locations)) : ?>
                            <?php foreach ($locations as $location) : ?>
                                <option value="<?= $location["local_id"] ?>"><?= $location["name_location"] ?></option>
                            <?php endforeach ?>
                        <?php endif ?>
                    </select>
                    <small class="text-danger"><?php echo $Locality_ERROR ?></small>
                </div>
            </div>
            <br>

            <div class="row mb-4">
                <div class="col">
                    <div class="mb-4">
                        <label>Foto de Perfil <sup class="text-danger">*</sup></label><br>
                        <input type="file" class="form-control-file" id="bagde">
                        <small class="text-danger"><?php echo $badge_ERROR ?></small>
                    </div>

                    <div class="row mt-4 mb-4 ml-2" id="thumbnails_badge">
                    </div>

                    <div class="row mt-4 mb-4 ml-2" id="thumbnails_badge_error">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-4">
                        <label>Foto de Banner<sup class="text-danger">*</sup></label><br>
                        <input type="file" class="form-control-file" id="banner">
                        <small class="text-danger"><?php echo $banner_ERROR ?></small>
                    </div>

                    <div class="row mt-4 mb-4 ml-2" id="thumbnails_banner">
                    </div>

                    <div class="row mt-4 mb-4 ml-2" id="thumbnails_banner_error">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Registar Stand</button>
        </form>
    </div>
</div>

<?php include("../layout/footer.php"); ?>
<script>
    $("#banner").change(function() {
        photo = new FormData();
        if ($(this).prop('files').length > 0) {
            for (var i = 0; i < $(this).prop('files').length; i++) {
                photo.append("file", $(this).prop('files')[i]);
            }

            photo.append("who", "stand");
            photo.append("type", "thumbnail_banner");
            photo.append("id", <?= $_SESSION['Id'] ?>);

            $.ajax({
                url: "../assets/photosubmit_standregister.php",
                type: "POST",
                data: photo,
                processData: false,
                contentType: false,
                success: function(photos) {
                    $("#banner").val("");
                    if (photos.includes("alert")) {
                        $("#thumbnails_banner_error").append(photos);
                    } else {
                        <?php remove_tmp_US(); ?>
                        $("#thumbnails_banner").empty();
                        $("#thumbnails_banner").append(photos);
                    }
                }
            });
        }
    });

    $("#bagde").change(function() {
        photo = new FormData();
        if ($(this).prop('files').length > 0) {
            for (var i = 0; i < $(this).prop('files').length; i++) {
                photo.append("file", $(this).prop('files')[i]);
            }

            photo.append("who", "stand");
            photo.append("type", "thumbnail_badge");
            photo.append("id", <?= $_SESSION['Id'] ?>);

            $.ajax({
                url: "../assets/photosubmit_standregister.php",
                type: "POST",
                data: photo,
                processData: false,
                contentType: false,
                success: function(photos) {
                    $("#banner").val("");
                    if (photos.includes("alert")) {
                        $("#thumbnails_badge_error").append(photos);
                    } else {
                        <?php remove_tmp_US(); ?>
                        $("#thumbnails_badge").empty();
                        $("#thumbnails_badge").append(photos);
                    }
                }
            });
        }
    });
</script>