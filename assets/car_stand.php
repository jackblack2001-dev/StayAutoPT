<?php
include_once('Public/config.php');
include_once('stand_user.php');
$Cflag = true;
$Cresult = "";
if ($Sflag) {
    $id = $Srow['Stand_Id'];
    $sql = "SELECT * FROM Cars WHERE Stand_id = '$id'";
    if ($Cresult = $con->query($sql)) {
        if ($Cresult->num_rows >=1) {
        } else $Cflag = false;
    }
}
