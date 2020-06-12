<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAuto_PT/");
define("INCLUDE_PATH", __DIR__);
include("Public/config.php");
include("assets/user_info.php");
include("assets/stand_user.php");

$stands = returnStandsRandom5($con);

include("layout/header.php");
include("layout/menu.php");
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="carousel slide shadow-lg mt-4" data-ride="carousel" id="CS">

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
                                imgs($stand["Banner"], $stand["User_Id"], $stand["Name"],$ini);
                            } else {
                                $ini = "carousel-item";
                                imgs($stand["Banner"], $stand["User_Id"], $stand["Name"],$ini);
                            }
                            $aux++;
                        }
                    }

                    function imgs($img, $id, $title,$ini)
                    {
                        echo '<div class="'.$ini.'">
                                    <img src="Public/Images/Stand_Banners/' . $id . '/' . $img . '" alt="' . $title . '">
                                    <div class="carousel-caption">
                                        <h3>' . $title . '</h3>
                                    </div>
                                </div>';
                    }
                    ?>

                </div>
                <a class="carousel-control-prev" href="#carouselcarimg" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#carouselcarimg" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>

<?php include("layout/footer.php") ?>