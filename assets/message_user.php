<?php

#region Selects

function badgeNumNewMessages($id, $con)
{
    $sql = "SELECT COUNT(*) AS New_Messages FROM Messages WHERE Receiver_Id = $id AND Viewed = 0";
    $Result = $con->query($sql);
    if ($Result->num_rows  == 1) {
        if ($row = $Result->fetch_array()) {
            return $row;
        }
    } else return null;
}

function returnUserMessages($id, $con)
{
    $sql = "SELECT * FROM Messages WHERE Receiver_Id = $id ORDER BY CreatedMessage";
    $Result = $con->query($sql);
    if ($Result->num_rows  >= 1) {
        while ($row = $Result->fetch_array()) {
            $data[] = $row;
        }
        return $data;
    } else return null;
}
#endregion

#region Inserts
function insertMessage($idC, $idS, $idR, $title, $message, $price, $con)
{
    $sql = "INSERT INTO Messages(User_Id,Receiver_Id,License_Plate,Title,Message,Neg_Price) VALUES(?,?,?,?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('iisssi', $idS, $idR, $idC, $title, $message, $price);
    $stmt->execute();
}
#endregion