<?php
include("../Master.php");
include_once("../assets/user_info.php");
include_once(INCLUDE_PATH . "../Public/Config.php");

$row = returnUser($_SESSION['Id'],$con);

?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>

<body>
    <style>
    .Img_Banner {
        height: 400px;
        width: 940px;
        padding-top: 20px;
        position: relative;
    }

    .Img_Profile {
        width: 180px;
        height: 180px;
        margin-left: 0px;
        filter: blur(0px);
    }

    .overlay {
        position: absolute;
        top: 80px;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100%;
        width: 100%;
        opacity: 0;
        transition: .3s ease;
    }

    .div-overlay{
        margin-top: -100px;
        text-align: center;
        vertical-align: middle;
        position: relative;
    }

    .div-overlay:hover .overlay{
        opacity:1;
    }

    .Header {
        padding-top: 17px;
        font-size: 35px;
        font-family: 'Open Sans', sans-serif;
        opacity: 1;
        filter: blur(0px) brightness(100%) contrast(100%) grayscale(0%) hue-rotate(0deg) invert(0%);
    }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm">
            </div>
            <div class="col-xl col-md">
                <img class="text-center Img_Banner" src="../Public/Images/User_Banners/defult_profile_banner.jpg" />
                <div class="div-overlay">
                    <img class="rounded-circle Img_Profile" src="../Public/Images/Profile/defult_user.jpg" />
                    <div class="overlay">
                        <button>fm,nasdvbcfhjzSvfcbzx</button>
                    </div>
                </div>
                <div class="text-center">
                    <h1 class="Header"><?php echo $row["Name"]?></h1>
                    <hr style="width: 500px;" />
                </div>
            </div>
            <div class="col-sm">
            </div>
        </div>

    </div>
</body>

</html>