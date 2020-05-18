<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAuto_PT/");
define("INCLUDE_PATH", __DIR__);
include('../Public/config.php');
include('../assets/car_stand.php');
include('../assets/stand_user.php');
include('../assets/user_info.php');
include('../assets/role_checker.php');

if (isset($_SESSION['Profile'])) {
    roleAdmin($_SESSION['Profile']);
} else {
    roleAdmin(null);
}

$Stand[] = returnStandsViews($con);
$Cars[] = returnCarsViews($con);
$Users[] = returnUsersCount($con);

$BMR[] = ThreeMoreRentable($con);
$B = null;
$P = null;
$E = false;

if ($BMR[0] != null) {
    foreach ($BMR as $rows) {
        foreach ($rows as $row) {
            $B[] = $row["Brand"];
            $P[] = $row["Price"];
        }
    }
} else {
    $E = true;
    $B = ["0", "0", "0"];
    $P = [0, 0, 0];
}

$UsersC[] = returnUsersCountType(1, $con);
$UsersE[] = returnUsersCountType(2, $con);

include("../includes/header.php");
include("../includes/menu.php");
?>
<div class="container-fluid">
    <h3 class="text-dark mb-4" style="padding-top:1.5rem;">Dashboard</h3>
    <div class="row mb-4">
        <div class="col-md-3 col-xl-3">
            <div class="card shadow border-left-primary mb-4">
                <div class="card-body">
                    <div class="row aling-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase font-weight-bold text-xs">
                                Denuncias
                            </div>
                            <div class="text-dark font-weight-bold h5 mb-0">
                                0
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xl-3">
            <div class="card shadow border-left-primary mb-4">
                <div class="card-body">
                    <div class="row aling-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase font-weight-bold text-xs">
                                Número Total de Visualizações
                            </div>
                            <div class="text-dark font-weight-bold h5 mb-0">
                                <?php echo $Stand[0]["Views"] + $Cars[0]["Views"] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xl-3">
            <div class="card shadow border-left-primary mb-4">
                <div class="card-body">
                    <div class="row aling-items-center no-gutters">
                        <div class="col mr-2">
                            <div class="text-uppercase font-weight-bold text-xs">
                                Número Total de Utilizadores
                            </div>
                            <div class="text-dark font-weight-bold h5 mb-0">
                                <?php echo $Users[0]["Users"] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-7 col-md-8">
                            <h6>Pesquisa Global</h6>
                        </div>
                        <div class="col-sm-5 col-md-4 text-right">
                            <input placeholder="#Tags, Palavras-chave..." type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h4 class="small"></h4>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-header">
                    <h6>Estatisticas <img src="<?php echo ROOT_PATH ?>Icons/pie-chart.svg" style="margin-bottom: 5px;width: 20px;height: 20px;"></img></h6>
                </div>
                <div class="card-body">
                    <h4 class="small"></h4>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-10 col-md-10">
                            <h6>As 3 Marcas Mais Rentáveis (€)</h6>
                        </div>
                        <div class="col-sm-2 col-md-2 text-right">
                            <a type="button" onclick="HR_CBTMR()"><img src="<?php echo ROOT_PATH ?>Icons/arrows-collapse.svg" style="width: 20px; height: 20px" id="IMG_CBTMR"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="CBTMR">
                    <canvas id="threeMoreRentable">
                    </canvas>
                    <div class="text-center rounded" id="TMRError" style="display:none; border-width:3px; border-style:dashed; color: lightslategrey">
                        Sem dados Suficientes
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-10 col-md-10">
                            <h6>Tipo de Utilizadores</h6>
                        </div>
                        <div class="col-sm-2 col-md-2 text-right">
                            <a type="button" onclick="HR_CBUP()"><img src="<?php echo ROOT_PATH ?>Icons/arrows-collapse.svg" style="width: 20px; height: 20px" id="IMG_CBUP"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="CBUP">
                    <canvas id="UsersPercentage">
                    </canvas>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php include('../Includes/footer.php') ?>

<script>
    var aux = "<?php echo $E ?>";

    window.onload = function() {
        var TMR = document.getElementById("threeMoreRentable");
        var TMRError = document.getElementById("TMRError");

        if (aux == 1) {
            TMR.style.display = "none";
            TMRError.style.display = "block";
        } else {
            ChartTMR();
        }
        ChartUP();
    };

    function ChartTMR() {
        var ctxP = document.getElementById("threeMoreRentable").getContext('2d');
        var myPieChart = new Chart(ctxP, {
            plugins: [ChartDataLabels],
            type: 'pie',
            data: {
                labels: ["<?php echo $B[0] ?>", "<?php echo $B[1] ?>", "<?php echo $B[2] ?>"],
                datasets: [{
                    data: [<?php echo $P[0] ?>, <?php echo $P[1] ?>, <?php echo $P[2] ?>],
                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C"],
                    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870"]
                }]
            },
            options: {
                responsive: true,
            }
        });

    }

    function ChartUP() {
        var Cli = <?php echo $UsersC[0]["Clientes"] ?>;
        var Emp = <?php echo $UsersE[0]["Empresarios"] ?>;

        var ctxF = document.getElementById("UsersPercentage").getContext('2d');

        var myPieChart = new Chart(ctxF, {
            plugins: [ChartDataLabels],
            type: 'pie',
            data: {
                labels: ["Clientes", "Empresários"],
                datasets: [{
                    data: [Cli, Emp],
                    backgroundColor: ["#F7464A", "#46BFBD"],
                    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1"]
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'right',
                    labels: {
                        padding: 20,
                        boxWidth: 10
                    }
                },
                plugins: {
                    datalabels: {
                        formatter: (value, ctx) => {
                            let sum = 0;
                            let dataArr = ctx.chart.data.datasets[0].data;
                            dataArr.map(data => {
                                sum += data;
                            });
                            let percentage = (value * 100 / sum).toFixed(2) + "%";
                            return percentage;
                        },
                        color: 'white',
                        labels: {
                            title: {
                                font: {
                                    size: '16'
                                }
                            }
                        }
                    }
                }
            }
        });
    }

    function HR_CBTMR() {
        var div = document.getElementById("CBTMR");
        var img = document.getElementById("IMG_CBTMR");
        if (div.style.display === "none") {
            $(div).show(500);
            img.src = "<?php echo ROOT_PATH ?>Icons/arrows-collapse.svg";
        } else {
            $(div).hide(500);
            img.src = "<?php echo ROOT_PATH ?>Icons/arrows-expand.svg";
        }
    }

    function HR_CBUP() {
        var div = document.getElementById("CBUP");
        var img = document.getElementById("IMG_CBUP");
        if (div.style.display === "none") {
            $(div).show(500);
            img.src = "<?php echo ROOT_PATH ?>Icons/arrows-collapse.svg";
        } else {
            $(div).hide(500);
            img.src = "<?php echo ROOT_PATH ?>Icons/arrows-expand.svg";
        }
    }
</script>