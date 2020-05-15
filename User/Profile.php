<?php
include("../Master.php");
include_once("../assets/user_info.php");
include_once("../Public/Config.php");

$row = null;
$id = "";

$IsOwner = $IsAdmin = false;

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $row = returnUser($id, $con);
    } else {
        $id = $_SESSION['Id'];
        $row = returnUser($id, $con);
    }

    if ($id === $_SESSION['Id']) {
        $IsOwner = true;
    } else {
        if ($_SESSION['Profile'] === 0) {
            $IsAdmin = true;
        }
    }

    $datetime = explode(" ", $row["createdAccount"]);
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

?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>

<body>
    <style>
        .Img_Banner {
            height: 400px;
            width: 940px;
            padding-top: 20px;
            position: relative;
        }

        .Img_Profile {
            width: 180px;
            height: 180px;
            margin-left: 0px;
            filter: blur(0px);
        }

        .overlay {
            position: absolute;
            top: 80px;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            transition: .3s ease;
        }

        .div-overlay {
            margin-top: -100px;
            text-align: center;
            vertical-align: middle;
            position: relative;
        }

        .div-overlay:hover .overlay {
            opacity: 1;
        }

        .Header {
            padding-top: 17px;
            font-size: 35px;
            font-family: 'Open Sans', sans-serif;
            opacity: 1;
            filter: blur(0px) brightness(100%) contrast(100%) grayscale(0%) hue-rotate(0deg) invert(0%);
        }

        .card {
            margin-right: 2.5rem !important;
            margin-left: 2.5rem !important;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm">
                <a class="btn btn-outline-primary mt-4" href="<?phP echo ROOT_PATH ?>User_Admin/Index_Users.php" id="BTN_Back">Voltar</a>
            </div>
            <div class="col-xl col-md">
                <img class="text-center Img_Banner" src="../Public/Images/User_Banners/defult_profile_banner.jpg" />
                <div class="div-overlay">
                    <img class="rounded-circle Img_Profile" src="../Public/Images/Profile/defult_user.jpg" />
                    <div class="overlay" id="overlay">
                        <button>Teste</button>
                    </div>
                </div>
                <div class="text-center mb-5">
                    <h1 class="Header"><?php echo $row["Name"] ?></h1>
                    <hr style="width: 500px;" />
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
                                    <input class="form-control" type="email" placeholder="<?php echo $row["Email"] ?>" name="email" disabled id="IE">
                                    <label for="IE" class="small text-danger" id="LIE" style="display:none"></label>
                                </div>
                            </div>
                            <div class="col-md col-sm">
                                <div class="form-group">
                                    <label for="phone"><strong>Telemóvel</strong></label>
                                    <input class="form-control" type="text" placeholder="<?php echo $row["Phone"] ?>" name="phone" disabled id="IP">
                                    <label for="IP" class="small text-danger" id="LIP" style="display:none"></label>
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
                            <div class="col-md-2 col-sm-10 text-right">
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
            <div class="col-sm">
                <div class="card shadow mt-4">
                    <div class="card-body">
                        depois
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

<script>
    $(document).ready(function() {
        var IsOwner = "<?= $IsOwner ?>"
        var IsAdmin = "<?= $IsAdmin ?>"

        if (IsOwner) {
            $("#BTN_Back").remove();
        } else if (IsAdmin) {
            //barrita do admin
        }else{
            $("#BTN_Edit").remove();
            $("#overlay").remove();
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

</html>