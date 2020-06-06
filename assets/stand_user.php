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
        $sql = "SELECT * FROM Stands S 
        INNER JOIN Config_Stands C
        ON
        C.Stand_Id = S.Stand_Id 
        WHERE User_Id = '$id'";
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

function returnNews($id, $con)
{
    $sql = "SELECT News_Id, U.Name, Title, Text, CreatedNews FROM News N
    INNER JOIN Stands S ON
    N.Stand_Id = S.Stand_Id
    INNER JOIN Users U ON
    N.User_Id = U.User_Id
    WHERE N.Stand_Id = $id AND State = 1";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows >= 1) {
            while ($row = $Result->fetch_array()) {
                $data[] = $row;
            }
            return $data;
        }
    }
}

function returnLastNew($id, $con)
{
    $sql = "SELECT User_Id, Title, Text, CreatedNews FROM News WHERE News_Id = (SELECT MAX(News_Id) FROM News) AND Stand_Id = $id AND State = 1";
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

function returnNew($idnews, $idstand, $con)
{
    $sql = "SELECT U.Name, Title, Text, CreatedNews FROM News N
    INNER JOIN Stands S ON
    N.Stand_Id = S.Stand_Id
    INNER JOIN Users U ON
    N.User_Id = U.User_Id
    WHERE News_Id = $idnews AND N.Stand_Id = $idstand AND State = 1";
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
#endregion
#region Updates

function UpdateStand($id, $name, $adress, $phone, $con)
{
    if ($name != "") {
        $sql = "UPDATE Stands SET Name = '$name' WHERE Stand_Id = $id";
        $con->query($sql);
    }

    if ($adress != "") {
        $sql = "UPDATE Stands SET Adress = '$adress' WHERE Stand_Id = $id";
        $con->query($sql);
    }

    if ($phone != "") {
        $sql = "UPDATE Stands SET Phone = '$phone' WHERE Stand_Id = $id";
        $con->query($sql);
    }
}

function UpdateStandItemsOrder($array, $id, $con)
{
    $items = $data = "";

    foreach ($array as $item) {
        if (!empty($item)) {
            $items .= $item . ":";
        }
    }

    $data = substr($items, 0, -1);

    $sql = "UPDATE Config_Stands SET ItemsOrder = '$data' WHERE Stand_Id = $id";
    if ($con->query($sql) != true) {
        return false;
    } else {
        return true;
    }
}

function UpdateStandNumCarN($id, $numrows, $con)
{
    $sql = "UPDATE Config_Stands SET NumCarN = $numrows WHERE Stand_Id = $id";
    if ($con->query($sql) != true) {
        return false;
    } else {
        return true;
    }
}

function UpdateStandBanner($bannername, $id, $con)
{
    $sql = "UPDATE Stands SET Banner = '$bannername' WHERE Stand_Id = $id";
    if ($con->query($sql) != true) {
        return false;
    } else {
        return true;
    }
}

function UpdateStandBadge($badgename, $id, $con)
{
    $sql = "UPDATE Stands SET Badge = '$badgename' WHERE Stand_Id = $id";
    if ($con->query($sql) != true) {
        return false;
    } else {
        return true;
    }
}

function UpdateNewsId($id, $standid, $con)
{
    $sql = "UPDATE Config_Stands SET Id_News = '$id' WHERE Stand_Id = '$standid'";
    if ($con->query($sql) != true) {
        return false;
    } else {
        return true;
    }
}

function UpdateNew($id, $title, $text, $con)
{
    $sql = "UPDATE News SET Title = '$title', Text = '$text' WHERE News_Id = '$id'";
    if ($con->query($sql) != true) {
        return false;
    } else {
        return true;
    }
}
#endregion
#region Insert
function InsertNews($standid, $userid, $title, $text, $con)
{
    $sql = "INSERT INTO News(Stand_Id,User_Id,Title,Text,State) Values(?,?,?,?,1)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('iiss', $standid, $userid, $title, $text);
    $stmt->execute();
}
