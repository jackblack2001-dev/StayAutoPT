<?php
session_start();
//TODO: Alterar inserção na db para com Prepare (ver standregister)
include('Public/config.php');
include('assets/user_info.php');
include("PHPMailer/Mail_Shooter.php");
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAutoPT/");
define("INCLUDE_PATH", __DIR__);

$Mail = $Name = $Phone = $Password = $REPassword = "";

$Mail_ERROR = $Name_ERROR  = $Phone_ERROR = $Password_ERROR = $REPassword_ERROR = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["TXT_Mail"]))) {
        $Mail_ERROR = "Por favor insira o Email";
    } else {
        $Mail = trim($_POST["TXT_Mail"]);
    }

    if (empty(trim($_POST["TXT_Name"]))) {
        $Name_ERROR = "Por favor insira o Nome";
    } else {
        $Name = trim($_POST["TXT_Name"]);
    }

    if (empty(trim($_POST["TXT_Phone"]))) {
        $Phone_ERROR = "Insira um Número de Telefone";
    } else if (strlen(trim($_POST["TXT_Phone"])) > 9 || strlen(trim($_POST["TXT_Phone"])) < 9) {
        $Phone_ERROR = "Por favor Introduza um Número de Telefone Válido";
    } else {
        $Phone = trim($_POST["TXT_Phone"]);
    }

    if (empty(trim($_POST["TXT_Password"]))) {
        $Password_ERROR = "Insira a palavra passe";
    } else if (strlen(trim($_POST['TXT_Password'])) < 8) {
        $Password_ERROR = "A Palavra-passe tem que ter no mínimo 8 caracteres";
    } else {
        $Password = trim($_POST["TXT_Password"]);
    }

    if (empty(trim($_POST["TXT_REPassword"]))) {
        $REPassword_ERROR = "Por favor repita a Palavra-passe";
    } else {
        $REPassword = trim($_POST["TXT_REPassword"]);

        if ($REPassword != $Password) {
            $REPassword_ERROR = "As Palavras-passe não coincidem";
        } else {
            $hased_password = password_hash($Password, PASSWORD_DEFAULT);
        }
    }

    //Inscerção BD
    if (empty($Mail_ERROR) && empty($Name_ERROR) && empty($Phone_ERROR) && empty($Password_ERROR) && empty($REPassword_ERROR)) {

        $sql = "SELECT Email FROM Users WHERE Email = '$Mail'";
        $Result = $con->query($sql);
        if ($Result->num_rows == 0) {
            insertUser($Name, $Mail, $Phone, 2, $hased_password, $con);
            $subject = "Comfirme a sua Conta StayAuto Portugal";

            $message = '<div class="row">
                            <div class="col">
                                <h3>Comfirme o seu Email</h3>
                    
                                <p>Caro(a) ' . $Name . '</p>
                    
                                <p>Muito obrigado por se registar em StayAuto Portugal, para concluir o registo da sua conta tem que ativa-la, para isso clique no botão abaixo</p>
                                <a href="http://localhost/StayAutoPT/ActivateAcount.php?id=' . base64_encode($Mail) . '" class="btn btn-outline-success">Ativar Conta</a>
                            </div>
                        </div>';

            ShootMail($subject, $message, $Mail);
        } else {
            echo "Erro ao criar Conta, tente novamente mais tarde";
        }
    }
}

include("layout/header.php");
include("layout/menu.php");
?>
<div class="container">

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="container">
            <div class="row" id="register">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <br>
                    <h2>Criar uma Conta</h2>
                    <br>

                    Email
                    <input type="email" class="form-control" name="TXT_Mail" value="<?php echo $Mail ?>">
                    <label class="text-danger"><?php echo $Mail_ERROR ?></label><br>
                    Nome
                    <input type="text" class="form-control" name="TXT_Name" value="<?php echo $Name ?>">
                    <label class="text-danger"><?php echo $Name_ERROR ?></label><br>
                    Telemovel
                    <input type="text" class="form-control" name="TXT_Phone" value="<?php echo $Phone ?>">
                    <label class="text-danger"><?php echo $Phone_ERROR ?></label><br>
                    Palavra-passe
                    <input type="password" class="form-control" name="TXT_Password" value="<?php echo $Password ?>">
                    <label class="text-danger"><?php echo $Password_ERROR ?></label><br>
                    Repetir Palavra-passe
                    <input type="password" class="form-control" name="TXT_REPassword" value="<?php echo $REPassword ?>">
                    <label class="text-danger"><?php echo $REPassword_ERROR ?></label><br>

                    <button class="btn btn-danger" type="submit">Registar</button>
                </div>
                <div class="col-sm-4"></div>
            </div>
        </div>
    </form>
</div>

<?php include("layout/footer.php") ?>