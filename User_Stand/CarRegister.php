<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAuto_PT/");
define("INCLUDE_PATH", __DIR__);
include('../assets/remove_cache.php');
include('../assets/user_info.php');
include('../Public/Config.php');
include('../assets/stand_user.php');
include('../assets/role_checker.php');
include('../assets/car_stand.php');

$License_Plate = $Kms = $Year = $Type_Gear = $Brand = $Model = $Type_Fuel = $Price = $Description = $files = "";
$License_Plate_ERROR = $Kms_ERROR = $Year_ERROR = $Type_Gear_ERROR = $Brand_ERROR = $Model_ERROR = $Type_Fuel_ERROR = $Price_ERROR = $Description_ERROR = $File_ERROR = "";

roleStand();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //verify license plate
    if (empty(trim($_POST["TXT_LicensePlate"]))) {
        $License_Plate_ERROR = "Por favor introduza a matricula";
    } else if (strlen(trim($_POST["TXT_LicensePlate"])) < 4) {
        $License_Plate_ERROR = "Matricula incorreta";
    } else
        $License_Plate = strtoupper($_POST["TXT_LicensePlate"]);

    //verify KMS
    if ($_POST["TXT_Miles"] != "" && (int) trim($_POST["TXT_Miles"]) >= 0)
        $Kms = $_POST["TXT_Miles"];
    else {
        $Kms_ERROR = "Por favor introduza os kilometros do veiculo";
    }


    //verify Type_gear
    if (!isset($_POST["SEL_GearBox"])) {
        $Type_Gear_ERROR = "Selecione o tipo de Transmição";
    } else {
        $Type_Gear = $_POST["SEL_GearBox"];
    }

    //verify Brand
    if (strlen(trim($_POST["TXT_Brand"])) == 0) {
        $Brand_ERROR = "Por favor introduza a Marca do Veiculo";
    } else if (strlen(trim($_POST["TXT_Brand"])) < 3) {
        $Brand_ERROR = "Por favor introduza uma Marca Válida";
    } else if (strlen(trim($_POST["TXT_Brand"])) > 50) {
        $Brand_ERROR = "A marca não pode ser maior que 50 caracteres";
    } else
        $Brand = $_POST["TXT_Brand"];

    //verify Model
    if (strlen(trim($_POST["TXT_Model"])) >= 3 && strlen(trim($_POST["TXT_Model"])) <= 50)
        $Model = $_POST["TXT_Model"];
    else {
        $Model_ERROR = "O modelo não pode ser menor que 3 e maior que 50 caracteres";
    }

    //verify Fuel 
    if (!isset($_POST["SEL_Fuel"])) {
        $Type_Fuel_ERROR = "Introduza um combustivel valido";
    } else
        $Type_Fuel = $_POST["SEL_Fuel"];


    //verify Price
    if ($_POST["TXT_Price"] >= 1)
        $Price = $_POST["TXT_Price"];
    else {
        $Price_ERROR = "Tem que colocar preço valido";
    }


    //verify description
    if (empty(trim($_POST["TXT_Description"]))) {
        $Description_ERROR = "Tem que escrever na descrição ";
    } else
        $Description = $_POST["TXT_Description"];


    //verify year
    if (empty(trim($_POST["TXT_Year"]))) {
        $Year_ERROR = "Por favor introduza o ano do veiculo";
    } else if (strlen(trim($_POST["TXT_Year"] >= 1920 && $_POST["TXT_Year"] <= date("Y"))))
        $Year = $_POST["TXT_Year"];
    else {
        $Year_ERROR = "A data tem que ser maior que 1920 e menor ou igual " . date("Y");
    }

    //images
    $files = scandir('../User_Stand/tmp/' . $_SESSION['Id'], 1);
    array_splice($files, -2);
    if ($files) {
        $filecount = count($files);
        if ($filecount < 5) {
            $File_ERROR = "Deve inserir no mínimo 5 fotografias";
        }
    } else {
        $File_ERROR = "Tem que incluir fotografias do carro";
    }

    if (empty($License_Plate_ERROR) && empty($Kms_ERROR) && empty($Year_ERROR) && empty($Type_Gear_ERROR) && empty($Brand_ERROR) && empty($Model_ERROR) && empty($Type_Fuel_ERROR) && empty($Price_ERROR) && empty($Description_ERROR) && empty($File_ERROR)) {
        $data[] = returnStand($_SESSION['Id'], $con);
        $sql = "INSERT INTO Cars (License_Plate, Stand_Id, Kms, Year, Type_Gear, Brand, Model, Type_Fuel, Price, Description, State, Views, CreatedCar, UpdatedCar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '1', '0', CURRENT_TIMESTAMP, NULL)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('siiiissids', $License_Plate, $data[0]['Stand_Id'], $Kms, $Year, $Type_Gear, $Brand, $Model, $Type_Fuel, $Price, $Description);
        $stmt->execute();
        if ($stmt == true) {
            foreach ($files as $file) {
                $fileTempName = 'tmp/' . $_SESSION['Id'] . '/' . $file;
                $fileDestination = "../Public/Images/Car_Photos/" . $License_Plate;

                InsertPhotos($con, $License_Plate, $file);

                if (!is_dir($fileDestination)) {
                    mkdir($fileDestination);
                }

                $fileDestination .= "/" . $file;
                rename($fileTempName, $fileDestination);
            }

            header("location: Garage.php");
        }
    } else {
        remove_tmp_US();
    }
} else {
    remove_tmp_US();
}

include("../includes/header.php");
include("../includes/menu.php");
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm"></div>
        <div class="col-sm">
            <br />
            <h2>Registar Carro</h2>
            <br />
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <div class="row">
                    <div class="col">

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Matricula</span>
                            </div>
                            <input type="text" class="form-control" name="TXT_LicensePlate" id="TXT_LicensePlate" value="<?= $License_Plate ?>">
                            <small class="form-text text-danger"><?php echo $License_Plate_ERROR ?></small>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Ano</span>
                            </div>
                            <input type="text" class="form-control" name="TXT_Year" id="intYear" value="<?= $Year ?>">
                            <small class="form-text text-danger"><?php echo $Year_ERROR ?></small>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Kilometros</span>
                            </div>
                            <input type="text" class="form-control" name="TXT_Miles" id="intKms" value="<?= $Kms ?>">
                            <small class="form-text text-danger"><?php echo $Kms_ERROR ?></small>
                        </div>

                        <div class="input-group mb-3">
                            <select class="form-control" name="SEL_Fuel">
                                <option value="" disabled selected>Tipo de Combustivel</option>
                                <option value="1">Gasolina</option>
                                <option value="2">Diesel</option>
                            </select>
                            <small class="form-text text-danger"><?php echo $Type_Fuel_ERROR ?></small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <select class="form-control" name="SEL_GearBox">
                                <option value="" disabled selected default>Tipo de Transmição</option>
                                <option value="1">Manual</option>
                                <option value="2">Automático</option>
                                <option value="3">CVT</option>
                            </select>
                            <small class="form-text text-danger"><?php echo $Type_Gear_ERROR ?></small>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Marca</span>
                            </div>
                            <input type="text" class="form-control" name="TXT_Brand" value="<?= $Brand ?>">
                            <small class="form-text text-danger"><?php echo $Brand_ERROR ?></small>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Modelo</span>
                            </div>
                            <input type="text" class="form-control" name="TXT_Model" value="<?= $Model ?>">
                            <small class="form-text text-danger"><?php echo $Model_ERROR ?></small>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Preço</span>
                            </div>
                            <input type="number" min="1" step="any" class="form-control" name="TXT_Price" value="<?= $Price ?>">
                            <small class="form-text text-danger"><?php echo $Price_ERROR ?></small>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Descrição</span>
                    </div>
                    <textarea name="TXT_Description" class="form-control" rows="5"><?= $Description ?></textarea>
                    <small class="form-text text-danger"><?php echo $Description_ERROR ?></small>
                </div>

                <input type="file" name="carphotos" id="photos" accept="image/*">
                <small class="form-text text-danger"><?php echo $File_ERROR ?></small>

                <div class="row mt-4 mb-4 ml-2" id="thumbnails">
                </div>

                <div class="row mt-4 mb-4 ml-2" id="thumbnails_error">
                </div>

                <button class="btn btn-outline-success mb-4" type="submit" id="BTN_Submit">Registar Carro</button>
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>

<?php include("../includes/footer.php") ?>

<script>
    $("#photos").change(function() {
        photo = new FormData();
        if ($(this).prop('files').length > 0) {
            for (var i = 0; i < $(this).prop('files').length; i++) {
                photo.append("file", $(this).prop('files')[i]);
            }

            photo.append("who", "car");
            photo.append("type", "thumbnail");
            photo.append("id", <?= $_SESSION['Id'] ?>);
            sendthumbnail(photo);
        }
    });

    function sendthumbnail(photo) {
        $.ajax({
            url: "../assets/photosubmit.php",
            type: "POST",
            data: photo,
            processData: false,
            contentType: false,
            success: function(photos) {
                $("#photos").val("");
                if (photos.includes("alert")) {
                    $("#thumbnails_error").append(photos);
                } else {
                    $("#thumbnails").append(photos);
                }
            }
        });
    }

    setInputFilter(document.getElementById("intYear"), function(value) {
        return /^-?\d*$/.test(value);
    });

    setInputFilter(document.getElementById("intKms"), function(value) {
        return /^-?\d*$/.test(value);
    });
</script>