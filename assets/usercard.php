<?php

include_once("user_info.php");
include_once("../Public/config.php");

$search = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET['search']) && trim($_GET['search']) != "") {
        $search = $_GET['search'];
    }
}

$Data = returnUsers($con);

foreach($Data as $rows)
{

}
