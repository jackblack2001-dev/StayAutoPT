<?php
include('../Master.php');
include_once(INCLUDE_PATH . '../Public/config.php');
include_once(INCLUDE_PATH . '../assets/stand_user.php');
include_once(INCLUDE_PATH . '../assets/role_checker.php');

$License_Plate = $Kms = $Year = $Type_Gear = $Brand = $Model = $Type_Fuel = $Price = $Description = "";
$License_Plate_ERROR = $Kms_ERROR = $Year_ERROR = $Type_Gear_ERROR = $Brand_ERROR = $Model_ERROR = $Type_Fuel_ERROR = $Price_ERROR = $Description_ERROR = "";

if (!isset($_SESSION['Id']) || empty($_SESSION['Id'])) {
    header("location: Index.php");
} else {
    roleStand($_SESSION['Profile']);

    //verify license plate
    if(empty(trim($_POST["TXT_LicensePlate"])))
    $License_Plate_ERROR = "Por favor introduza a matricula";
    else if (strlen(trim($_POST["TXT_LicensePlate"])) < 4)
    $License_Plate_ERROR = "Matricula incorreta";
    else
    $License_Plate = $_POST["TXT_LicensePlate"];

    //verify year
    if(empty(trim($_POST["TXT_Year"])))
    $Year_ERROR = "Por favor introduza o ano do veiculo";


    if (empty($License_Plate_ERROR) && empty($Kms_ERROR) && empty($Year_ERROR) && empty($Type_Gear_ERROR) && empty($Brand_ERROR) && empty($Model_ERROR) && empty($Type_Fuel_ERROR) && empty($Price_ERROR) && empty($Description_ERROR)) {
        $sql = "INSERT INTO Cars (License_Plate, Stand_Id, Kms, Year, Type_Gear, Brand, Model, Type_Fuel, Price, Description,State,Views,CreatedCar,UpdatedCar) VALUES (?,?,?,?,?,?,?,?,?,?,1,0,NOW(),null)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('siiiissids', $License_Plate, $Stand_Id, $Kms, $Year, $Type_Gear, $Brand, $Model, $Type_Fuel, $Price, $Description);
        $stmt->execute();
    }
}
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registar Carro</title>
</head>

<body>
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
                                <input type="text" class="form-control" name="TXT_LicensePlate">
                                <small class="form-text text-danger"><?php echo $License_Plate_ERROR?></small>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Ano</span>
                                </div>
                                <input type="text" class="form-control" name="TXT_Year" id="intYear">
                                <small class="form-text text-danger"><?php echo $Year_ERROR?></small>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Kilometros</span>
                                </div>
                                <input type="text" class="form-control" name="TXT_Miles">
                            </div>

                            <div class="input-group mb-3">
                                <select class="form-control" name="SEL_Fuel">
                                    <option value="" disabled selected>Tipo de Combustivel</option>
                                    <option value="1">Gasolina</option>
                                    <option value="2">Diesel</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <select class="form-control" name="SEL_GearBox">
                                    <option value="" disabled selected>Tipo de Transmição</option>
                                    <option value="1">Manual</option>
                                    <option value="2">Automático</option>
                                    <option value="3">CVT</option>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Marca</span>
                                </div>
                                <input type="text" class="form-control" name="TXT_Brand">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Modelo</span>
                                </div>
                                <input type="text" class="form-control" name="TXT_Model">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Preço</span>
                                </div>
                                <input type="number" min="1" step="any" class="form-control" name="TXT_Price">
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Descrição</span>
                        </div>
                        <textarea name="TXT_Description" class="form-control" rows="5"></textarea>
                    </div>
                    <input type="file" name="FILE_CarPhoto01">
                    <br />
                    <br />
                    <button class="btn btn-danger" type="submit">Registar Carro</button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>

<script>

function setInputFilter(textbox, inputFilter) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
        textbox.addEventListener(event, function() {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = "";
            }
        });
    });
}

setInputFilter(document.getElementById("intYear"), function(value) {
  return /^-?\d*$/.test(value); });
</script>

</html>