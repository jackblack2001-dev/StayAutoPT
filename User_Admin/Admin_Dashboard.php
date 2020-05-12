<?php
include_once('../Master.php');
include_once('../Public/config.php');
include_once('../assets/car_stand.php');
include_once('../assets/stand_user.php');
include_once('../assets/user_info.php');

$Stand[] = returnStandsViews($con);
$Cars[] = returnCarsViews($con);
$Users[] = returnUsersCount($con);

$UsersC[] = returnUsersCountType(1,$con);
$UsersE[] = returnUsersCountType(2,$con);
?>
<!DOCTYPE html>

<body>
    <style>
    .container-fluid {
        padding-left: 40px;
        padding-right: 40px;
    }

    .text-dark {
        color: #5a5c69 !important;
    }

    .card {
        border: 1px #8c8e8cd1;
    }

    .border-left-primary {
        border-left: .25rem solid #4e73df !important;
    }

    .border-left-success {
        border-left: .25rem solid #1cc88a !important;
    }

    .border-left-warning {
        border-left: .25rem solid #f6c23e !important;
    }

    .border-left-danger {
        border-left: .25rem solid #e74a3b !important;
    }

    .aling-items-center {
        align-items: center !important;
    }

    .no-gutters {
        margin-right: 0;
        margin-left: 0;
    }

    .text-xs {
        font-size: .7rem;
    }
    </style>

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
                                    <?php echo $Stand[0]["Views"] + $Cars[0]["Views"]?>
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
                                    <?php echo $Users[0]["Users"]?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h6>Estatisticas <img src="<?php echo ROOT_PATH?>Icons/pie-chart.svg"
                                style="margin-bottom: 5px;width: 20px;height: 20px;"></img></h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small"></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6>As 3 Marcas Mais Rentáveis</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="threeMoreRentable">
                        </canvas>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6>Tipo de Utilizadores</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="UsersPercentage">
                        </canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

<script src="<?=ROOT_PATH?>bootstrap/js/mdb.js"></script>
<script>

window.onload = function() {
    ChartTMR();
    ChartUP();
};

function ChartTMR() {
    var ctxP = document.getElementById("threeMoreRentable").getContext('2d');
    var myPieChart = new Chart(ctxP, {
        plugins: [ChartDataLabels],
        type: 'pie',
        data: {
            labels: ["Red", "Green", "Yellow"],
            datasets: [{
                data: [210, 130, 120],
                backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C"],
                hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870"]
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

function ChartUP() {
    var Cli = <?php echo $UsersC[0]["Clientes"]?>;
    var Emp = <?php echo $UsersE[0]["Empresarios"]?>;

    var ctxF = document.getElementById("UsersPercentage").getContext('2d');

    var myPieChart = new Chart(ctxF, {
        plugins: [ChartDataLabels],
        type: 'pie',
        data: {
            labels: ["Clientes","Empresários"],
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
</script>

</html>