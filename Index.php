<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAutoPT/");
define("INCLUDE_PATH", __DIR__);
include("Public/config.php");
include("assets/user_info.php");
include("assets/stand_user.php");
include("assets/car_stand.php");

$stands = returnStandsRandom5($con);

$cars = returnMostViewedCar5($con);

include("layout/header.php");
include("layout/menu.php");
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="carousel slide shadow-lg mt-4 mb-5" data-ride="carousel" id="CS">

                <!-- indacators -->
                <ul class="carousel-indicators">
                    <?php
                    if ($stands != null) {
                        for ($i = 0; $i < count($stands); $i++) {
                            echo '<li data-target="#CS" data-slide-to="' . $i . '" class="active"></li>';
                        }
                    }
                    ?>
                </ul>

                <!-- The SlideShow -->
                <div class="carousel-inner">
                    <?php
                    if ($stands != null) {
                        $aux = 1;
                        $ini;
                        foreach ($stands as $stand) {
                            if ($aux == 1) {
                                $ini = "carousel-item active";
                                imgs($stand["Banner_Name"], $stand["Stand_Id"], $stand["Name"], $ini);
                            } else {
                                $ini = "carousel-item";
                                imgs($stand["Banner_Name"], $stand["Stand_Id"], $stand["Name"], $ini);
                            }
                            $aux++;
                        }
                    }

                    function imgs($img, $id, $title, $ini)
                    {
                        echo '<div class="' . $ini . '">
                                    <img src="Public/Images/Stand_Banners/' . $id . '/' . $img . '" alt="' . $title . '">
                                    <div class="carousel-caption">
                                        <h3>' . $title . '</h3>
                                    </div>
                                </div>';
                    }
                    ?>

                </div>
                <a class="carousel-control-prev" href="#CS" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#CS" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="font-weight-bold"><i class="fa fa-fire" style="color: tomato;"></i> Os mais Vistos! <i class="fa fa-fire" style="color: tomato;"></i></h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="div-5-most-viewed mb-4">
                        <?php

                        if ($cars != null) {
                            $Aux = 1;
                            foreach ($cars as $car) {

                                if ($Aux == 1) {
                                    $grid = '<span class="font-weight-bold" style="font-size:25px">1º Mais Visto<i class="fa fa-trophy"></i></span>';
                                } else if ($Aux == 2) {
                                    $grid = '<span class="font-weight-bold" style="font-size:25px">2º Mais Visto<i class="fa fa-trophy"></i></span>';
                                } else if ($Aux == 3) {
                                    $grid = '<span class="font-weight-bold" style="font-size:25px">3º Mais Visto<i class="fa fa-trophy"></i></span>';
                                } else {
                                    $grid = "";
                                }

                                if ($car["Card_Image"] == null) {
                                    $name = FirtPhotoInserted($car["License_Plate"], $con);

                                    if ($name == false) {
                                        $imgname = "Public/Images/Car_Photos/no_image_car.png";
                                    } else {
                                        $imgname = "Public/Images/Car_Photos/" . $car["License_Plate"] . "/" . $name;
                                    }
                                } else {
                                    $imgname = "Public/Images/Car_Photos/" . $car["License_Plate"] . "/" . $car["Card_Image"];
                                }
                                $string = $car["Brand"] . " " . $car["Model"];

                                if (strlen($string) > 15) {
                                    $Name = substr($string, 0, 15) . "...";
                                } else {
                                    $Name = $string;
                                }

                                carcards($imgname, $Name, $car["Views"], $car["Year"], $grid);

                                $Aux++;
                            }
                        }

                        function carcards($imgname, $name, $viewsnum, $year, $grid)
                        {
                            echo '<div class="card shadow ml-4 mr-4 mb-4" style="width: 340px">
                                <div class="card-body no-padding">
                                    <div class="col no-padding">
                                        <img src="' . $imgname . '" alt="' . $name . '" style="width: 100%; height: 340px">
                                        <div class="bottom-right-car shadow-lg">
                                            <span style="font-size:25px">' . $viewsnum . ' <i class="fa fa-eye"></i></span>
                                        </div>
                                    </div>
                                    <div class="col no-padding">
                                        <div class="card-title margins">
                                            <h5><small class="font-weight-bold">' . $name . '</small></h5>
                                            <p class="card-text">' . $year . '</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="top-left-5-most-viewed rounded-left rounded-right shadow-lg" id="card_badge">
                                    ' . $grid . '
                                </div>
                            </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row mt-4">
                <div class="col">
                    <h4 class="font-weight-bold">Carros que talvez goste</h4>
                </div>
            </div>
            <div class="row div-other-cars mb-4">
                <?php
                $cars = "";
                $cars = returnRandomCar6($con);

                foreach ($cars as $car) {
                    if ($car["Card_Image"] == null) {
                        $name = FirtPhotoInserted($car["License_Plate"], $con);

                        if ($name == false) {
                            $imgname = "Public/Images/Car_Photos/no_image_car.png";
                        } else {
                            $imgname = "Public/Images/Car_Photos/" . $car["License_Plate"] . "/" . $name;
                        }
                    } else {
                        $imgname = "Public/Images/Car_Photos/" . $car["License_Plate"] . "/" . $car["Card_Image"];
                    }
                    $string = $car["Brand"] . " " . $car["Model"];

                    if (strlen($string) > 15) {
                        $Name = substr($string, 0, 15) . "...";
                    } else {
                        $Name = $string;
                    }

                    othercard($imgname, $Name, $car["Price"], $car["Year"]);
                }

                function othercard($imgname, $name, $price, $year)
                {
                    echo '<div class="card shadow ml-4 mr-4 mt-4" style="width: 340px">
                            <div class="card-body no-padding">
                                <div class="col no-padding">
                                    <img src="' . $imgname . '" alt="' . $name . '" style="width: 100%; height: 340px">
                                    <div class="bottom-right-car shadow-lg">
                                        <span style="font-size:25px">' . $price . ' <i class="fa fa-euro"></i></span>
                                    </div>
                                </div>
                                <div class="col no-padding">
                                    <div class="card-title margins">
                                        <h5><small class="font-weight-bold">' . $name . '</small></h5>
                                        <p class="card-text">' . $year . '</p>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
                ?>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>

<?php include("layout/footer.php") ?>