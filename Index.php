<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAuto_PT/");
define("INCLUDE_PATH", __DIR__);
include("includes/header.php");
include("includes/menu.php");
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="carousel slide mt-4" data-ride="carousel" id="CS">
                <ol class="carousel-indicators">
                    <li data-target="#CS" data-slide-to="0" class="active"></li>
                    <li data-target="#CS" data-slide-to="1"></li>
                    <li data-target="#CS" data-slide-to="2"></li>
                    <li data-target="#CS" data-slide-to="3"></li>
                    <li data-target="#CS" data-slide-to="4"></li>
                    <li data-target="#CS" data-slide-to="5"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="<?php echo ROOT_PATH . 'Public/Images/Profile/defult_user.jpg' ?>" alt="">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="" alt="">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="" alt="">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="" alt="">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="" alt="">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="" alt="">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#CS" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#CS" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>