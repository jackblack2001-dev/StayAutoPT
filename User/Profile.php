<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAutoPT/");
define("INCLUDE_PATH", __DIR__);
include("../assets/user_info.php");
include("../Public/Config.php");
include("../assets/message_user.php");
include("../assets/role_checker.php");

roleUser();

$imgbanner = $imgbadge = "";

$data = null;
$who = "user";
$id = "";

$IsOwner = $IsAdmin = false;

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $data = returnUser($id, $con);

        if ($data["Banner"] != null) {
            $imgbanner = "../Public/Images/User_Banners/" . $data["User_Id"] . "/" . $data["Banner"];
        } else {
            $imgbanner = "../Public/Images/User_Banners/defult_user_banner.jpg";
        }

        if ($data["Badge"] != null) {
            $imgbadge = "../Public/Images/User_Badge/" . $data["User_Id"] . "/" . $data["Badge"];
        } else {
            $imgbadge = "../Public/Images/User_Badge/default_user_badge.jpg";
        }
    } else {
        $id = $_SESSION['Id'];
        $data = returnUser($id, $con);

        if ($data["Banner"] != null) {
            $imgbanner = "../Public/Images/User_Banners/" . $data["User_Id"] . "/" . $data["Banner"];
        } else {
            $imgbanner = "../Public/Images/User_Banners/defult_user_banner.jpg";
        }

        if ($data["Badge"] != null) {
            $imgbadge = "../Public/Images/User_Badge/" . $data["User_Id"] . "/" . $data["Badge"];
        } else {
            $imgbadge = "../Public/Images/User_Badge/default_user_badge.jpg";
        }
    }

    if ($id == $_SESSION['Id']) {
        $IsOwner = true;
    } else {
        if ($_SESSION['Profile'] == 0) {
            $IsAdmin = true;
        }
    }

    $datetime = explode(" ", $data["createdAccount"]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $email = $phone = "";
        if (isset($_POST['Email'])) {
            if (!empty($_POST['Email'])) {
                $email = $_POST['Email'];
                //Enviar Mail de confirmação a criatura
            }
        }

        if (isset($_POST['Phone'])) {
            if (!empty($_POST['Phone'])) {
                $phone = $_POST['Phone'];

                $error = UpdatePhone($phone, $id, $con);
                if (!$error) {
                    //error
                }
            }
        }
    } else {
        //error
    }
}

include("../layout/header.php");
include("../layout/menu.php");
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <a class="btn btn-outline-primary mt-4" href="<?phP echo ROOT_PATH ?>User_Admin/Index_Users.php" id="BTN_Back" style="display:none;">Voltar</a>
        </div>
        <div class="col-md-6">
            <div class="div-overlay-profile-banner mt-4">
                <img class="text-center Img_Banner shadow" src="<?php echo $imgbanner ?>" />
                <div class="overlay-profile-banner" id="overlay-banner">
                    <h3 class="text-center">
                        <i class="fa fa-image fa-4x" style="position: relative; top: 130px;"></i>
                    </h3>
                </div>
            </div>
            <div class="div-overlay-profile-badge">
                <img class="rounded-circle Img_Profile shadow-lg" src="<?php echo $imgbadge ?>" />
                <div class="overlay-profile-badge rounded-circle Img_Profile" id="overlay-badge">
                    <h3 class="text-center">
                        <i class="fa fa-image fa-2x" style="position: relative; top: 60px;"></i>
                    </h3>
                </div>
            </div>
            <div class="div_profile_name text-center mb-5">
                <h1 class="Header"><?php echo $data["Name"] ?></h1>
                <hr style="width: 100%;" />
            </div>

            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8 col-sm-7">
                            <h5>Informações Pessoais</h5>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <button class="btn btn-outline-danger float-right" id="BTN_Cancel" onclick="Cancel()" style="display: none">Cancelar</button>
                        </div>
                        <div class="col-md-1 col-sm-2">
                            <button class="btn btn-outline-secondary float-right" id="BTN_Edit" onclick="Edit()">Editar</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md col-sm">
                            <div class="form-group">
                                <label for="email"><strong>Email</strong></label>
                                <input class="form-control" type="email" placeholder="<?php echo $data["Email"] ?>" name="email" disabled id="IE">
                            </div>
                        </div>
                        <div class="col-md col-sm">
                            <div class="form-group">
                                <label for="phone"><strong>Telemóvel</strong></label>
                                <input class="form-control" type="tel" placeholder="<?php echo $data["Phone"] ?>" name="phone" disabled id="IP">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10 col-sm-10">
                            <h5>Outras Informações</h5>
                        </div>
                        <div class="col-md-2 col-sm-2 text-right">
                            <a type="button" onclick="MoreInfo()"><img src="<?php echo ROOT_PATH ?>Icons/arrows-Expand.svg" style="width: 20px; height: 20px" id="IMG_CBMI"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="CBMI" style="display:none">
                    <div class="row">
                        <div class="col-md col-sm">
                            <div class="form-group">
                                <label for="CA"><strong>Conta Criada Em:</strong></label>
                                <input class="form-control" type="text" placeholder="<?php echo $datetime[0] ?>" name="CA" disabled>
                            </div>
                        </div>
                        <div class="col-md col-sm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow mt-4">
                <div class="card-body">
                    depois
                </div>
            </div>
        </div>
    </div>

</div>

<?php include("../Includes/modal_uploadphoto.php") ?>
<?php include("../layout/footer.php") ?>

<script>
    $("#overlay-banner").click(function() {
        $("#ModalUpdateBanner").modal();
    })

    $("#overlay-badge").click(function() {
        $("#ModalUpdateBadge").modal();
    })

    $(document).ready(function() {
        var IsOwner = "<?= $IsOwner ?>"
        var IsAdmin = "<?= $IsAdmin ?>"

        if (IsOwner) {
            $("#BTN_Back").remove();
        } else if (IsAdmin) {
            $("#BTN_Back").show();
            //barrita do admin
        } else {
            $("#BTN_Back").show();
            $("#BTN_Edit").remove();
            $("#overlay").remove();
            $("#overlay-banner").remove();
            $("#overlay-badge").remove();
        }
    })

    setInputFilter(document.getElementById("IP"), function(value) {
        return /^-?\d*$/.test(value);
    })

    function MoreInfo() {
        var div = document.getElementById("CBMI");
        var img = document.getElementById("IMG_CBMI");

        if (div.style.display === "none") {
            $(div).show(500);
            img.src = "<?php echo ROOT_PATH ?>Icons/arrows-collapse.svg";
        } else {
            $(div).hide(500);
            img.src = "<?php echo ROOT_PATH ?>Icons/arrows-expand.svg";
        }
    }

    function Val(Email, Phone) {

        if (!Email == "") {
            if (!Email.includes("@") || !Email.includes(".")) {
                $("#LIE").text("Formato de Email incorreto");
                $("#LIE").show();
                return false;
            }
        } else if (!Phone == "") {
            if (Phone.length < 9 || Phone.length > 9) {
                $("#LIP").text("Número de telemovel incorreto");
                $("#LIP").show();
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    function Edit() {
        var id = "<?php echo $id ?>";

        var button = document.getElementById("BTN_Edit");
        var inputEmail = document.getElementById("IE");
        var inputPhone = document.getElementById("IP");

        var Email = $(inputEmail).val();
        var Phone = $(inputPhone).val();

        if (button.classList.contains("btn-outline-secondary")) {
            $("#BTN_Cancel").show();
            $(inputEmail).prop("disabled", false);
            $(inputPhone).prop("disabled", false);
            button.classList.replace("btn-outline-secondary", "btn-outline-success")
            button.type = "submit";
            button.innerHTML = "Salvar";
        } else if (Val(Email, Phone)) {
            Cancel();
            $.ajax({
                type: "POST",
                url: "<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>",
                data: {
                    Email,
                    Phone,
                    id
                },
                success: function() {
                    if (Email != "") {
                        inputEmail.placeholder = Email;
                    }
                    if (Phone != "") {
                        inputPhone.placeholder = Phone;
                    }
                    $(inputEmail).val("");
                    $(inputPhone).val("");
                }
            })
        }
    }

    function Cancel() {
        $("#IE").prop("disabled", true);
        $("#IP").prop("disabled", true);
        document.getElementById("BTN_Edit").classList.replace("btn-outline-success", "btn-outline-secondary")
        document.getElementById("BTN_Edit").removeAttribute("type");
        document.getElementById("BTN_Edit").innerHTML = "Editar";
        $("#BTN_Cancel").hide();
        $("#LIE").hide();
        $("#LIP").hide();
    }
</script>