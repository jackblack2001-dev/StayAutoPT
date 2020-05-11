<?php
include_once('../Master.php');
?>
<!DOCTYPE html>

<body>
    <style>
    .container,
    container-fluid {
        padding-left: 1.5rem;
        padding-right: 1.5rem;
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
        <div class="row">
            <div class="col-md-3 col-xl-3 mb-4">
                <div class="card shadow border-left-primary">
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
            <div class="col-md-3 col-xl-3 mb-4">
                <div class="card shadow border-left-primary">
                    <div class="card-body">
                        ola
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xl-3 mb-4">
                <div class="card shadow border-left-primary">
                    <div class="card-body">
                        ola
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>