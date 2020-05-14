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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
       //verify license plate
       if(empty(trim($_POST["TXT_LicensePlate"])))
       $License_Plate_ERROR = "Por favor introduza a matricula";
       else if (strlen(trim($_POST["TXT_LicensePlate"])) < 4)
       $License_Plate_ERROR = "Matricula incorreta";
       else
       $License_Plate = $_POST["TXT_LicensePlate"];

       //verify KMS
       if($_POST["TXT_Miles"] != "" && (int)trim($_POST["TXT_Miles"]) >= 0)
       $Kms=$_POST["TXT_Miles"];
       else
       $Kms_ERROR = "Por favor introduza os kilometros do veiculo"; 
   
       //verify Type_gear

        if($_POST["SEL_GearBox"] <1 && $_POST["SEL_GearBox"]>3)
        $Type_Gear_ERROR= "Selecione o tipo de Transmição";
        else 
           $Type_Gear=$_POST["SEL_GearBox"];  

       //verify Brand
       if(strlen(trim($_POST["TXT_Brand"]))==0)
       $Brand_ERROR = "Por favor introduza a Marca do Veiculo";
       else if(strlen(trim($_POST["TXT_Brand"]))<3)
       $Brand_ERROR = "Por favor introduza uma Marca Válida";
       else if(strlen(trim($_POST["TXT_Brand"]))>50)
       $Brand_ERROR = "A marca não pode ser maior que 50 caracteres";
       else
       $Brand=$_POST["TXT_Brand"];

      //verify Model
      if(strlen(trim($_POST["TXT_Model"]))>=3 && strlen(trim($_POST["TXT_Model"]))<=50)
        $Model = $_POST["TXT_Model"];
      else
      $Model_ERROR = "O modelo não pode ser maior que 50 caracteres"; 

     //verify Fuel 
     if (!isset($_POST["SEL_Fuel"]))
     $Type_Fuel_ERROR = "Introduza um combustivel valido";
     else
     $Type_Fuel=$_POST["SEL_Fuel"];


     //verify Price
     if ($_POST["TXT_Price"]>=1)
     $Price=$_POST["TXT_Price"];
     else
      $Price_ERROR="Tem que colocar preço valido";

     //verify description
     if (empty(trim($_POST["TXT_Description"])))
     $Description_ERROR="Tem que escrever na descrição ";
     else
     $Description=$_POST["TXT_Description"];

       
       //verify year
       if(empty(trim($_POST["TXT_Year"])))
       $Year_ERROR = "Por favor introduza o ano do veiculo";
       else if(strlen(trim($_POST["TXT_Year"]>=1920 && $_POST["TXT_Year"]<= date ("Y"))))
       $Year = $_POST["TXT_Year"];
       else $Year_ERROR = "A data tem que ser maior que 1920 e menor ou igual ".date("Y") ;

        if (empty($License_Plate_ERROR) && empty($Kms_ERROR) && empty($Year_ERROR) && empty($Type_Gear_ERROR) && empty($Brand_ERROR) && empty($Model_ERROR) && empty($Type_Fuel_ERROR) && empty($Price_ERROR) && empty($Description_ERROR)) {
            $data[] = returnStand($_SESSION['Id'],$con);
            $sql = "INSERT INTO Cars (License_Plate, Stand_Id, Kms, Year, Type_Gear, Brand, Model, Type_Fuel, Price, Description, State, Views, CreatedCar, UpdatedCar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '1', '0', CURRENT_TIMESTAMP, NULL)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('siiiissids', $License_Plate, $data[0]['Stand_Id'], $Kms, $Year, $Type_Gear, $Brand, $Model, $Type_Fuel, $Price, $Description);
            $stmt->execute();
            if($stmt == true)
             header("location: Garage.php");
        }
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

<style>
.div_error{
    padding-top: 0px;
    padding-bottom: 20px;
}
</style>

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
                            </div>
                            <div class="div_error">
                                <small class="form-text text-danger"><?php echo $Year_ERROR?></small>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Kilometros</span>
                                </div>
                                <input type="text" class="form-control" name="TXT_Miles" id="intKms">
                                <small class="form-text text-danger"><?php echo $Kms_ERROR?></small>
                            </div>

                            <div class="input-group mb-3">
                                <select class="form-control" name="SEL_Fuel">
                                    <option value="" disabled selected>Tipo de Combustivel</option>
                                    <option value="1">Gasolina</option>
                                    <option value="2">Diesel</option>
                                </select>
                                <small class="form-text text-danger"><?php echo $Type_Fuel_ERROR?></small>
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
                                <small class="form-text text-danger"><?php echo $Type_Gear_ERROR?></small>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Marca</span>
                                </div>
                                <input type="text" class="form-control" name="TXT_Brand">
                                <small class="form-text text-danger"><?php echo $Brand_ERROR?></small>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Modelo</span>
                                </div>
                                <input type="text" class="form-control" name="TXT_Model">
                                <small class="form-text text-danger"><?php echo $Model_ERROR?></small>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Preço</span>
                                </div>
                                <input type="number" min="1" step="any" class="form-control" name="TXT_Price">
                                <small class="form-text text-danger"><?php echo $Price_ERROR?></small>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Descrição</span>
                        </div>
                        <textarea name="TXT_Description" class="form-control" rows="5"></textarea>
                        <small class="form-text text-danger"><?php echo $Description_ERROR?></small>
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

setInputFilter(document.getElementById("intYear"), function(value) {
    return /^-?\d*$/.test(value);
});

setInputFilter(document.getElementById("intKms"), function(value) {
    return /^-?\d*$/.test(value);
});
</script>

</html>