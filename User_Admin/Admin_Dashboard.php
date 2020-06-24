<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAutoPT/");
define("INCLUDE_PATH", __DIR__);
include('../Public/config.php');
include('../assets/car_stand.php');
include('../assets/stand_user.php');
include('../assets/user_info.php');
include("../assets/message_user.php");
include('../assets/role_checker.php');
include("../assets/statistics.php");

roleAdmin();

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

$total_stands = returnTotalStandsMoney($con);

$threerentstand = return3MorerentableStands($con);

$threecarstand = return3MoreCrasStands($con);

$mostsearchlocality = returnMostSearchLocality($con);

$mostsearchgear = returnMostSearchGear($con);

$mostsearchfuel = returnMostSearchFuel($con);

$mostsearchminyear = returnMostSearchMinYear($con);

$mostsearchmaxyear = returnMostSearchMaxYear($con);

$averageprices = returnAveragePrices($con);

$averagekms = returnAverageKms($con);

include("../layout/header.php");
include("../layout/menu.php");
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
            <div class="card shadow mt-4">
                <div class="card-header">
                    <h5>Estatisticas <i class="fa fa-pie-chart" style="margin-bottom: 5px;width: 20px;height: 20px;"></i></h5>
                </div>
                <div class="card-body">
                    <div class="card shadow">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h6><strong>Total Ganho por todos os Stands: <?= $total_stands ?> <i class="fa fa-euro"></i></strong></h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col">
                                                    <h6><strong>Os 3 Stands Mais rentaveis</strong></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <?php foreach ($threerentstand as $row) : ?>
                                                <h5 class="mt-n2"><a class="a-cars" href="../User_Stand/Stand_Profile.php?id=<?= $row["Stand_Id"] ?>"><small><?= $row["Name"] . " - " . $row["TotalStandMoney"] ?> <i class="fa fa-euro"></i></small></a></h5>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="col">
                                        <div class="card shadow">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col">
                                                        <h6><strong>Os 3 Stands com Mais Carros</strong></h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <?php foreach ($threecarstand as $row) : ?>
                                                    <h5 class="mt-n2"><a class="a-cars" href="../User_Stand/Stand_Profile.php?id=<?= $row["Stand_Id"] ?>"><small><?= $row["Name"] . " - " . $row["TotalStandCars"] ?> <i class="fa fa-car"></i></small></a></h5>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mt-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h5>Estatísticas de Pesquisas <i class="fa fa-search fa-rotate-90"></i></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h6><strong>Localidade mais Procurada</strong></h6>
                                    <p class="mt-n2"><small><?= $mostsearchlocality != null ? $mostsearchlocality : "Dados Insuficientes" ?></small></p>
                                </div>
                                <span style="border-left: 1px solid lightgrey;"></span>
                                <div class="col">
                                    <h6><strong>Tipo de Transmisão mais Procurada</strong></h6>
                                    <?php if ($mostsearchgear != null) : ?>
                                        <?php if ($mostsearchgear == "1") : ?>
                                            <p class="mt-n2"><small>Manual</small></p>
                                        <?php endif ?>
                                        <?php if ($mostsearchgear == "2") : ?>
                                            <p class="mt-n2"><small>Automática</small></p>
                                        <?php endif ?>
                                        <?php if ($mostsearchgear == "3") : ?>
                                            <p class="mt-n2"><small>CVT</small></p>
                                        <?php endif ?>
                                    <?php endif ?>
                                </div>
                                <span style="border-left: 1px solid lightgrey;"></span>
                                <div class="col">
                                    <h6><strong>Tipo de Combustivel mais Procurado</strong></h6>
                                    <?php if ($mostsearchfuel != null) : ?>
                                        <?php if ($mostsearchfuel == "1") : ?>
                                            <p class="mt-n2"><small>Gasolina</small></p>
                                        <?php endif ?>
                                        <?php if ($mostsearchfuel == "2") : ?>
                                            <p class="mt-n2"><small>Diesel</small></p>
                                        <?php endif ?>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Anos de Preferência</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h6><strong>Ano Minimo</strong></h6>
                                                    <p class="mt-n2"><small><?= $mostsearchminyear != null ? $mostsearchminyear : "Dados Insuficientes" ?> <i class="fa fa-calendar"></i></small></p>
                                                </div>
                                                <span style="border-left: 1px solid lightgrey;"></span>
                                                <div class="col">
                                                    <h6><strong>Ano Maximo</strong></h6>
                                                    <p class="mt-n2"><small><?= $mostsearchmaxyear != null ? $mostsearchmaxyear : "Dados Insuficientes" ?> <i class="fa fa-calendar"></i></small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Média do Preço</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h6><strong>Mais Baixo</strong></h6>
                                                    <p class="mt-n2"><small><?= $averageprices != null ? $averageprices["AverageMin"] : "Dados Insuficientes" ?> <i class="fa fa-euro"></i></small></p>
                                                </div>
                                                <span style="border-left: 1px solid lightgrey;"></span>
                                                <div class="col">
                                                    <h6><strong>Mais Alto</strong></h6>
                                                    <p class="mt-n2"><small><?= $averageprices != null ? $averageprices["AverageMax"] : "Dados Insuficientes" ?> <i class="fa fa-euro"></i></small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Média de Kilometros</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h6><strong>Mais Baixo</strong></h6>
                                                    <p class="mt-n2"><small><?= $averagekms != null ? $averagekms["AverageMin"] : "Dados Insuficientes" ?> Kms</small></p>
                                                </div>
                                                <span style="border-left: 1px solid lightgrey;"></span>
                                                <div class="col">
                                                    <h6><strong>Mais Alto</strong></h6>
                                                    <p class="mt-n2"><small><?= $averagekms != null ? $averagekms["AverageMax"] : "Dados Insuficientes" ?> Kms</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

<?php include('../layout/footer.php') ?>

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