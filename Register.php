<?php
//TODO: Alterar inserção na db para com Prepare (ver standregister)
require_once 'Public/config.php';

$Mail = $Name = $Phone = $Password = $REPassword = "";

$Mail_ERROR = $Name_ERROR  = $Phone_ERROR = $Password_ERROR = $REPassword_ERROR = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["TXT_Mail"]))) {
        $Mail_ERROR = "Por favor insira o Email";
    } else {
        $Mail = trim($_POST["TXT_Mail"]);

        //TODO: Realizar a verif do email, para ver se este existe

    }

    if (empty(trim($_POST["TXT_Name"]))) {
        $Name_ERROR = "Por favor insira o Nome";
    } else {
        $Name = trim($_POST["TXT_Name"]);
    }

    if (empty(trim($_POST["TXT_Phone"]))) {
        $Phone_ERROR = "Insira um Número de Telefone";
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
        $sql = "INSERT INTO Users(Name,Email,Phone,Profile,Password) VALUES('$Name','$Mail','$Phone',1,'$hased_password')";

        if ($con->query($sql)) {
            if ($con->affected_rows == 1) {
                // Depois de fazer o registo pede-se a validação da conta
                header("location: Index.php");
                exit;
            } else {
                echo "Opss. A conta não foi registada na base de dados.";
            }
        } else {
            echo "Opss. Algo aconteceu. Tente mais tarde.";
        }
    }
}


?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registar</title>
</head>

<body>
    <div><?php include("Master.php"); ?></div>
    <div class="container">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="container">
                <div class="row">
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
</body>

</html>