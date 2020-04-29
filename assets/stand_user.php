<?php

function returnStand($id, $con)
{
    if (isset($id)) {
        $sql = "SELECT * FROM Stands WHERE User_Id = '$id'";
        $Result = $con->query($sql);
        if ($Result->num_rows == 1) {
            if ($row = $Result->fetch_array()) {
                return $row;
            }
        } else {
            return null;
        }
    } else {
        return null;
    }
}

// $Sflag = true;
// $id = $_SESSION['Id'];
// $Result = "";

// if (isset($id)) {
//     $sql = "SELECT * FROM Stands WHERE User_Id = '$id'";
//     if ($Result = $con->query($sql)) {
//         if ($Result->num_rows == 1) {
//             if ($row = $Result->fetch_array()) {

//             }
//         } else $Sflag = false;
//     }
// }
