<?php
session_start();
include_once("user_info.php");
include_once("../Public/config.php");

$search = "";
$type = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET['search']) && trim($_GET['search']) != "") {
        $search = $_GET['search'];
    }

    if (isset($_GET['type'])) {
        $type = $_GET['type'];
    }
}

$Data = returnUsers($con, $_SESSION['Id']);

if ($Data == null) {
    throw new Exception("Empty no data");
}

function Row($email, $name, $profile, $updateaccount,$id)
{
    return '<div class="row">
    <div class="col-md-1">
    </div>
    <div class="col-md-3 col-sm-3">
        ' . $email . '
    </div>
    <div class="col-md-3 col-sm-3">
        ' . $name . '
    </div>
    <div class="col-md-1 col-sm-2">
        ' . $profile . '
    </div>
    <div class="col-md-2 col-sm-2">
        ' . $updateaccount . '
    </div>
    <div class="col-md-2 col-sm-2 text-center">
        <a href="../User/Profile.php?id='.$id.'" class="btn btn-outline-info">Perfil</a>
    </div>
</div>
<hr style="border: 1px solid rgba(0, 0, 0, 0.1);">';
}

$Card = "";

try {
    foreach ($Data as $row) {

        if ($type == 3) {
            if (empty($search)) {
                $Profile = "";
                if ($row["Profile"] == 2) {
                    $Profile = "Empresário";
                } else if ($row["Profile"] == 1) {
                    $Profile = "Cliente";
                } else {
                    $Profile = "Admin";
                }

                $Card .= Row($row["Email"], $row["Name"], $Profile, $row["updateAccount"], $row["User_Id"]);
            } else if (strpos(strtolower($row["Email"]), strtolower($search)) !== false || strpos(strtolower($row["Name"]), strtolower($search)) !== false || strpos(strtolower($row["Phone"]), strtolower($search)) !== false) {
                $Profile = "";
                if ($row["Profile"] == 2) {
                    $Profile = "Empresário";
                } else if ($row["Profile"] == 1) {
                    $Profile = "Cliente";
                } else {
                    $Profile = "Admin";
                }

                $Card .= Row($row["Email"], $row["Name"], $Profile, $row["updateAccount"], $row["User_Id"]);
            }
        } else {
            if ($row["Profile"] == $type) {
                if (empty($search)) {
                    $Profile = "";
                    if ($row["Profile"] == 2) {
                        $Profile = "Empresário";
                    } else if ($row["Profile"] == 1) {
                        $Profile = "Cliente";
                    } else {
                        $Profile = "Admin";
                    }

                    $Card .= Row($row["Email"], $row["Name"], $Profile, $row["updateAccount"], $row["User_Id"]);
                } else if (strpos(strtolower($row["Email"]), strtolower($search)) !== false || strpos(strtolower($row["Name"]), strtolower($search)) !== false || strpos(strtolower($row["Phone"]), strtolower($search)) !== false) {
                    $Profile = "";
                    if ($row["Profile"] == 2) {
                        $Profile = "Empresário";
                    } else if ($row["Profile"] == 1) {
                        $Profile = "Cliente";
                    } else {
                        $Profile = "Admin";
                    }

                    $Card .= Row($row["Email"], $row["Name"], $Profile, $row["updateAccount"], $row["User_Id"]);
                }
            }
        }
    }
} catch (Exception $e) {
    $Card = '<div style="border-width:3px;border-style:dashed; color: lightgray">
    <br>
    <h3 class="text-center">
        Sem resultados :\
    </h3>
    <br>
</div>';
}

echo $Card;
