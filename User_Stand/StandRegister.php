<?php
include('Master.php');
include_once('Public/config.php');
include_once('assets/stand_user.php');

if (!isset($_SESSION['Id']) || empty($_SESSION['Id'])) {
    header("location: Index.php");
} else {
    if (isset($_SESSION['Profile']) && $_SESSION['Profile'] == '2') {
        if (!$Sflag) {

            $Name = $Phone = $Adress = $Locality = $Banner = "";
            $Name_ERROR = $Phone_ERROR = $Adress_ERROR = $Locality_ERROR = $Banner_ERROR = "";

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

                if (empty($_POST['TXT_Locality'])) {
                    $Locality_ERROR = "Deve indicar a sua Localidade";
                } else {
                    $Locality = $_POST['TXT_Locality'];
                }

                if(empty($Name_ERROR) && empty($Phone_ERROR) && empty($Adress_ERROR) && empty($Locality_ERROR)){

                    $sql = "INSERT INTO Stands(User_Id,Phone,Adress,Locality,Name,Views) VALUES(?,?,?,?,?,0)";
                    $stmt = $con->prepare($sql);
                    $stmt -> bind_param('issss',$_SESSION['Id'],$Phone,$Adress,$Locality,$Name);
                    $stmt ->execute();

                    //header("location: Stand_Dashboard.php");
                }

                //Verificação da foto do Stand
                /*if (empty($_POST['TXT_Name'])) {
                    $Name_ERROR = "Deve indicar o Titulo/Nome do seu Stand";
                } else {
                    $Name = $_POST['TXT_Name'];
                } */
            }
        } else {
            header("location: Index.php");
        }
    } else {
        header("location: Index.php");
    }
}

?>
<!DOCTYPE html>

<head>
    <title>Criar Stand</title>
</head>

<body>
    <div class="container">
        <br />
        <h3>Registar Stand</h3>
        <hr>
        <div class="container">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <label>Titulo do Stand <sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" name="TXT_Name" value="<?php echo $Name?>">
                <small class="text-danger"><?php echo $Name_ERROR?></small><br />

                <label>Contacto Telefonico <sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" name="TXT_Phone" value="<?php echo $Phone?>">
                <small class="text-danger"><?php echo $Phone_ERROR?></small>

                <br>
                <div class="row">
                    <div class="col">
                        <label>Morada <sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" name="TXT_Adress" value="<?php echo $Adress?>">
                        <small class="text-danger"><?php echo $Adress_ERROR?></small>
                    </div>
                    <div class="col">
                        <label>Localidade <sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" name="TXT_Locality" value="<?php echo $Locality?>">
                        <small class="text-danger"><?php echo $Locality_ERROR?></small>
                    </div>
                </div>
                <br>

                <label>Foto de Capa <sup class="text-danger">*</sup></label><br>
                <input type="file" class="" name="FILE_Banner"><br /><br />
                <small class="text-danger"><?php echo $Banner_ERROR?></small>

                <br />
                <button type="submit" class="btn btn-success">Registar Stand</button>
            </form>
        </div>
    </div>
</body>

</html>