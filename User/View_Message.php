<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAutoPT/");
define("INCLUDE_PATH", __DIR__);
include('../Public/config.php');
include('../assets/stand_user.php');
include('../assets/car_stand.php');
include('../assets/role_checker.php');
include("../assets/user_info.php");
include("../assets/message_user.php");

roleUser();

if (isset($_GET["id"])) {
    $id = urldecode(base64_decode($_GET["id"]));

    viewMessage($id, $_SESSION["Id"], $con);

    $message = returnMessage($id, $_SESSION["Id"], $con);

    $name = FirtPhotoInserted($message["License_Plate"], $con);

    if ($name == false) {
        $imgname = ROOT_PATH . "Public/Images/Car_Photos/no_image_car.png";
    } else {
        $imgname = ROOT_PATH . "Public/Images/Car_Photos/" . $message["License_Plate"] . "/" . $name;
    }
} else {
    //404
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["Title"]) && isset($_POST["Proposital"]) && isset($_POST["Message"]) && isset($_POST["Car_Id"]) && isset($_POST["User_Id"])) {
        insertMessageStand($_POST["Car_Id"], $_SESSION["Id"], $_POST["User_Id"], $_POST["Title"], $_POST["Message"], $_POST["Proposital"], $con);
    }
}

include("../layout/header.php");
include("../layout/menu.php");
?>

<div class="container mt-5">
    <div class="row mt-5">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <h4><strong><?= $message["Title"] ?></strong></h4>
                        </div>
                        <div class="col-md-2">
                            <?= $message["CreatedMessage"] ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">
                            <h6><strong>Mensagem</strong></h6>
                        </label>
                        <p class="mt-n4"><?= $message["Message"] ?></p>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col"></div>
                        <div class="col">
                            <a class="a-cars float-right mb-n2" href="<?= ROOT_PATH ?>User/Profile.php?id=<?= $message["User_Id"] ?>&&o=<?= urlencode(base64_encode("View_Message.php?id=" . urlencode(base64_encode($id)))) ?>">De: <?= $message["Name"] ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mt-2">
                <div class="card-body">
                    <?php if ($message["Neg_Price"] != 0) : ?>
                        <div class="form-group mb-n2">
                            <label><strong>Negoçiação do preço de: </strong></label>
                            <span class="ml-2"><?= $message["Price"] ?>€ para <?= $message["Neg_Price"] ?>€ (Diferença de <span style="color: red;"><?= $message["Price"] - $message["Neg_Price"] ?>€ <i class="fa fa-arrow-down"></i></span>)</span>
                        </div>
                    <?php else : ?>
                        <label class="mb-n2"><strong>Sem Negociação de Preço</strong></label>
                    <?php endif ?>
                </div>
            </div>
            <div class="card shadow mt-5 mb-4" id="card_response">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4><strong>Responder a mensagem</strong></h4>
                        </div>
                        <div class="col text-right">
                            <a type="button" onclick="Message()"><img src="<?php echo ROOT_PATH ?>Icons/arrows-Expand.svg" style="width: 20px; height: 20px" id="IMG_CBR"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="CBR" style="display:none">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label><strong>Título</strong><sup style="color: red;">*</sup></label>
                                <input class="form-control" type="text" id="title">
                                <small class="form-text text-danger" id="title_error"></small>
                            </div>
                        </div>
                    </div>
                    <?php if ($message["Neg_Price"] != 0) : ?>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="checkbox" id="proposital">
                                    <label><strong>Aceita Proposta</strong></label>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                    <div class="row mt-3">
                        <div class="col">
                            <div class="form-group">
                                <label><strong>Mensagem</strong><sup style="color: red;">*</sup></label>
                                <textarea id="message"></textarea>
                                <script>
                                    CKEDITOR.replace('message');
                                </script>
                                <small class="form-text text-danger" id="message_error"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2 mb-n3">
                        <div class="col text-right">
                            <div class="form-group">
                                <button class="btn btn-outline-success" onclick="sendMessage()">Enviar <i class="fa fa-send"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow" style="width: 340px">
                <div class="card-body no-padding">
                    <div class="col no-padding">
                        <img src="<?= $imgname ?>" style="width: 100%; height: 340px">
                        <div class="bottom-right-car shadow-lg">
                            <span style="font-size:25px"><?= $message["Price"] ?> <i class="fa fa-euro"></i></span>
                        </div>
                    </div>
                    <div class="col no-padding">
                        <div class="card-title margins">
                            <a class="a-cars" href="../User_Stand/Car_Profile.php?id=<?= urlencode(base64_encode($message["License_Plate"])) ?>">
                                <h5 class="mt-3"><small class="font-weight-bold"><?= $message["Brand"] . " " . $message["Model"] ?></small></h5>
                            </a>
                            <p class="card-text"><?= $message["Year"] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include("../layout/footer.php"); ?>
<script>
    function sendMessage() {
        var Title = $("#title").val();

        var Proposital = 0;
        if ($("#proposital").prop("checked") == true) {
            Proposital = 1;
        }

        var Message = CKEDITOR.instances['message'].getData();

        if (Title == "") {
            $("#title_error").text("Tem que indicar o título");
        } else {
            $("#title_error").text("");
        }

        if (Message == "") {
            $("#message_error").text("Tem que indicar a mensagem");
        } else {
            $("#message_error").text("");
        }

        if (Title != "" && Message != "") {
            $.ajax({
                type: "POST",
                url: "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>",
                data: {
                    Car_Id: "<?= $message["License_Plate"] ?>",
                    User_Id: "<?= $message["User_Id"] ?>",
                    Title,
                    Proposital,
                    Message
                },
                success: function(response) {
                    $("#title").val("");
                    CKEDITOR.instances['message'].setData('');
                    $("#CBR").hide(500);
                    document.getElementById("IMG_CBR").src = "<?= ROOT_PATH ?>Icons/arrows-expand.svg";
                }
            });
        }
    }

    function Message() {
        var div = document.getElementById("CBR");
        var img = document.getElementById("IMG_CBR");

        if (div.style.display === "none") {
            $(div).show(500);
            img.src = "<?= ROOT_PATH ?>Icons/arrows-collapse.svg";
        } else {
            $(div).hide(500);
            img.src = "<?= ROOT_PATH ?>Icons/arrows-expand.svg";
        }
    }
</script>