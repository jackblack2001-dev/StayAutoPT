<?php
include('../Master.php');

/* if (!is_null($data[0])) {
    $id = $data[0]['Stand_Id'];
    $sql = "SELECT * FROM Cars WHERE Stand_id = '$id' LIMIT 10";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows >= 1) {
            if ($row = $Result->fetch_array()) {
                $cars[] = $row;
            }
        } else $ERROR_No_Data_Car = true;
    }
} else $ERROR_No_Data_Stand = true; */

?>

<!DOCTYPE html>

<head>
    <title>Garagem</title>
</head>

<body>
    <div class="container-fluid" id="Main_div">
        <br>
        <div class="row">
            <div class="col">
                <h4>Ultimos carros adicionados</h4>
            </div>
            <div class="col-sm-2">
                <a href="CarRegister.php" class="btn btn-outline-success">Adicionar Carro</a>
            </div>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table" id="TabLast5">
            </table>
        </div>

        <br>

        <div class="row">
            <div class="col">
                <h4>Todos os carros</h4>
            </div>
            <div class="col-sm-2" style="padding-right: 40px">
                <input type="text" placeholder="Procurar" class="form-control" onkeyup="CCS(this.value)" id="Search">
            </div>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table" id="TabSearch">
            </table>
        </div>
    </div>
    <div id="Error_div">
        <?//UwU?>
    </div>
</body>

<script>

window.onload = function(){
    CCSL5();
    CCS("");
};

function CCSL5() {
    $.ajax({
        type: "GET",
        url: "../assets/carcard.php",
        data: {
            SCCL5: true
        },
        success: function(response) {
            $("#TabLast5").html(response);
        }
    });
};

function CCS(str) {
    $.ajax({
        type: "GET",
        url: "../assets/carcard.php",
        data: {
            SCCL5: false,
            search: str
        },
        success: function(response) {
            $("#TabSearch").html(response);
        }
    });
};

/* var div1 = document.getElementById("Main_div");
var div2 = document.getElementById("Error_div");
var aux = php echo json_encode($ERROR_No_Data_Stand);
if (aux == true) {
    div1.style.display = 'none';
    div2.style.display = 'block';
} else {
    div2.style.display = 'none';
    div1.style.display = 'block';
} */
</script>

</html>