<?php
include("../Master.php");
include_once(INCLUDE_PATH . "../Public/Config.php");

$id = $_SESSION["Id"];

if (isset($id)) {
    $sql = "SELECT * FROM Users WHERE User_Id = $id";
    $Result = $con->query($sql);
    if ($Result->num_rows == 1) {
        if ($row = $Result->fetch_array()) {
            $row;
        }
    } else {
        null;
    }
} else {
    null;
}

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
        filter: saturate(83%);
        position: relative;
    }

    .Img_Profile {
        width: 180px;
        height: 180px;
        margin-left: 0px;
        filter: blur(0px);
    }

    .Div_Profile_Name {
        text-align: center;
        vertical-align: middle;
        padding-bottom: 0px;
    }

    .Header {
        padding-top: 17px;
        font-size: 35px;
        font-family: 'Open Sans', sans-serif;
        opacity: 1;
        filter: blur(0px) brightness(100%) contrast(100%) grayscale(0%) hue-rotate(0deg) invert(0%);
    }
    </style>

    <div class="container" style="margin-top: 60px;margin-right: 400px;margin-left: 400px;">
        <div style="vertical-align: middle;text-align: center;">
            <img class="text-center Img_Banner" src="../Public/Images/User_Banners/defult_profile_banner.jpg" /></div>
        <div style="margin-top: -100px;text-align: center;vertical-align: middle;">
            <img class="rounded-circle Img_Profile" src="../Public/Images/Profile/defult_user.jpg" /></div>
        <div class="Div_Profile_Name">
            <h1 class="Header"><?php echo $row["Name"]?></h1>
            <hr style="width: 500px;" />
        </div>
    </div>
</body>

</html>