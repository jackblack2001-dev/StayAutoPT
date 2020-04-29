<?php
include('../Master.php');
include_once('../Public/config.php');
include_once('../assets/stand_user.php');
include_once(INCLUDE_PATH . '../assets/role_checker.php');
roleStand($_SESSION['Profile']);

$data[] = returnStand($_SESSION['Id'], $con);
if ($data[0] === null) {
    //Triger para uma função js??
}
?>

<!DOCTYPE html>

<head>
    <title>O meu Stand</title>
</head>

<style>
    #photo {
        border-right-style: solid;
        border-bottom-style: solid;
        border-left-style: solid;
        border-width: 1px;

        width: 100%;
        height: 280px;
    }

    .padding {
        padding-left: 150px;
        padding-right: 150px;
    }
</style>

<body>
    <div class="container-fluid padding">
        <div class="row">
            <div class="col-md-12">
                <img src="<?php echo ROOT_PATH.'Public/Images/Profile/defult_user.jpg'?>" alt="<?php echo $data[0]['Name'] ?>" id="photo" class="img-fluid">
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid" id="Main_div">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h4>Número de Visualizações</h4>
                    <h3><?php echo $data[0]['Views'] ?></h3>
                </div>
                <span class="border-left"></span>
                <div class="col text-center">
                    <h4>Qualquer coisa</h4>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    function HideDiv() {
        var div = document.getElementById("Main_div");
        if (<?php $Sflag ?> == false) {
            div.hidden = true;
        }
    }
</script>

</html>