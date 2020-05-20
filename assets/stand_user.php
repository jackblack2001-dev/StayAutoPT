<?php
#region Selects
function returnAllStands($con)
{
    $data = null;

    $sql = "SELECT * FROM Stands";

    if ($Result = $con->query($sql)) {
        if ($Result->num_rows >= 1) {
            while ($row = $Result->fetch_array()) {
                $data[] = $row;
            }
            return $data;
        }
    }
}

function returnStandsViews($con)
{
    $sql = "SELECT SUM(Views) AS Views FROM Stands";

    if ($Result = $con->query($sql)) {
        if ($Result->num_rows == 1) {
            if ($row = $Result->fetch_array()) {
                return $row;
            } else {
                return null;
            }
        }
    }
}

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
#endregion
#region Updates
function UpdateStandItemsOrder($array, $id, $con)
{
    $items = $data = "";

    foreach ($array as $item) {
        if (!empty($item)) {
            $items .= $item . ":";
        }
    }

    $data = substr($items, 0, -1);

    $sql = "UPDATE Stands SET ItemsOrder = '$data' WHERE Stand_Id = $id";
    if ($con->query($sql) != true) {
        return false;
    } else {
        return true;
    }
}
#endregion


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
