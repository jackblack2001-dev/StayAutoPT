<?php
#region DataProcessing
function StandProcessing($data)
{
    if (isset($data["Banner_Name"])) {
        if ($data["Banner_Name"] != null) {
            $data["Banner_Name"] = $data["Stand_Id"] . "/" . $data["Banner_Name"];
        } else {
            $data["Banner_Name"] = "default_stand_banner.jpg";
        }
    }

    if (isset($data["Badge_Name"])) {
        if ($data["Badge_Name"] != null) {
            $data["Badge_Name"] = $data["Stand_Id"] . "/" . $data["Badge_Name"];
        } else {
            $data["Badge_Name"] = "default_stand_badge.jpg";
        }
    }

    //TODO: localidades

    return $data;
}
#endregion

#region Selects
function returnPaginationStands($sql_body, $page, $num_rows_on_page, $con)
{
    $sql = "$sql_body LIMIT ?,?";

    if ($stmt = $con->prepare($sql)) {
        $calc_page = ($page - 1) * $num_rows_on_page;
        $stmt->bind_param('ii', $calc_page, $num_rows_on_page);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows >= 1) {
            while ($row = $result->fetch_assoc()) {
                $data[] = StandProcessing($row);
            }
            return $data;
        } else return null;
    }
}

function returnPaginationMessages($id, $page, $num_rows_on_page, $con)
{
    $sql = "SELECT Message_Id, Name, Brand, Model, Title, CreatedMessage, Viewed FROM Messages M
    INNER JOIN Users U
    ON U.User_Id = M.User_Id
    INNER JOIN Cars C
    ON C.License_Plate = M.License_Plate WHERE Receiver_Id = $id ORDER BY CreatedMessage DESC LIMIT ?,?";
    if ($stmt = $con->prepare($sql)) {
        $calc_page = ($page - 1) * $num_rows_on_page;
        $stmt->bind_param('ii', $calc_page, $num_rows_on_page);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows >= 1) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }
}

function returnMessage($id, $u_id, $con)
{
    $sql = "SELECT Receiver_Id, U.User_Id, Title, Message, Neg_Price, Name, M.License_Plate, Brand, Model, Price, Year, CreatedMessage FROM Messages M
    INNER JOIN Users U
    ON U.User_Id = M.User_Id
    INNER JOIN Cars C
    ON C.License_Plate = M.License_Plate
    WHERE Message_Id = $id AND Receiver_Id = $u_id";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows == 1) {
            while ($row = $Result->fetch_assoc()) {
                $date = explode(" ", $row["CreatedMessage"]);
                $row["CreatedMessage"] = $date[0];
                return $row;
            }
        }
    }
}

function viewMessage($id, $u_id, $con)
{
    $sql = "UPDATE Messages SET Viewed = 1 WHERE Message_Id = $id AND Receiver_Id = $u_id";
    $con->query($sql);
}

function returnAllStands($con)
{
    $data = null;

    $sql = "SELECT S.Name AS Stand_Name, SI.Name AS Image_Name FROM Stands S
            INNER JOIN Stands_Images SI
            ON SI.Stand_Id = S.Stand_Id";

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
        INNER JOIN Stands_Badges SB
        ON
        SB.Stand_Id = S.Stand_Id
        INNER JOIN Stands_Banners SBN
        ON
        SBN.Stand_Id = S.Stand_Id
        WHERE User_Id = '$id' AND SB.State = 1 AND SBN.State = 1";
        $Result = $con->query($sql);
        if ($Result->num_rows == 1) {
            if ($row = $Result->fetch_assoc()) {
                return StandProcessing($row);
            }
        } else {
            return null;
        }
    } else {
        return null;
    }
}

function returnLocations($con)
{
    $sql = "SELECT * FROM Locations";
    $Result = $con->query($sql);
    if ($Result->num_rows >= 1) {
        while ($row = $Result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    } else return null;
}

function returnStandLocation($id, $con)
{
    $sql = "SELECT * FROM Locations WHERE local_id = $id";
    $Result = $con->query($sql);
    if ($Result->num_rows == 1) {
        if ($row = $Result->fetch_assoc()) {
            return $row;
        }
    } else return null;
}

function returnSubscriptions($id, $con)
{
    $sql = "SELECT COUNT(*) AS Subscriptions FROM Stands_Favourits WHERE Stand_Id = $id AND State = 1";
    $Result = $con->query($sql);
    if ($Result->num_rows == 1) {
        if ($row = $Result->fetch_assoc()) {
            return $row["Subscriptions"];
        }
    } else {
        return 0;
    }
}

function returnUrlStand($id, $con)
{
    if (isset($id)) {
        $sql = "SELECT * FROM Stands S 
        INNER JOIN Config_Stands C
        ON
        C.Stand_Id = S.Stand_Id
        INNER JOIN Stands_Badges SB
        ON
        SB.Stand_Id = S.Stand_Id
        INNER JOIN Stands_Banners SBN
        ON
        SBN.Stand_Id = S.Stand_Id
        WHERE S.Stand_id = '$id' AND SB.State = 1 AND SBN.State = 1";
        $Result = $con->query($sql);
        if ($Result->num_rows == 1) {
            if ($row = $Result->fetch_assoc()) {
                return StandProcessing($row);
            }
        } else {
            return null;
        }
    } else {
        return null;
    }
}

function returnCarStand($carid, $con)
{
    if (isset($carid)) {
        $sql = "SELECT * FROM Stands S 
        INNER JOIN Cars C
        ON C.Stand_Id = S.Stand_id
        WHERE License_Plate = '$carid'";
        $Result = $con->query($sql);
        if ($Result->num_rows == 1) {
            if ($row = $Result->fetch_assoc()) {
                return $row;
            }
        } else {
            return null;
        }
    } else {
        return null;
    }
}

function returnStandsRandom5($con)
{
    $sql = "SELECT S.Stand_Id,Name, Banner_Name FROM Stands S 
    INNER JOIN Stands_Badges SB
    ON
    SB.Stand_Id = S.Stand_Id
    INNER JOIN Stands_Banners SBN
    ON
    SBN.Stand_Id = S.Stand_Id
    WHERE SB.State = 1 AND SBN.State = 1
    ORDER BY Rand() LIMIT 5";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows >= 1) {
            while ($row = $Result->fetch_array()) {
                $data[] = $row;
            }

            return $data;
        } else {
            return null;
        }
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
    $sql = "SELECT User_Id, Title, Text, CreatedNews FROM News WHERE Stand_Id = $id ORDER BY News_Id DESC LIMIT 1";
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

function returnlastid($con)
{
    $sql = "SELECT MAX(Stand_Id) AS id FROM Stands ORDER BY id LIMIT 1";
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

function returnAllSubscriptions($id, $con)
{
    $sql = "SELECT S.Stand_Id,Name, Banner_Name, L.name_location FROM Stands S 
    INNER JOIN Stands_Badges SB
    ON
    SB.Stand_Id = S.Stand_Id
    INNER JOIN Stands_Banners SBN
    ON
    SBN.Stand_Id = S.Stand_Id
    INNER JOIN Locations L
    ON
    L.local_id = S.Locality
    INNER JOIN Stands_Favourits SF
    ON
    SF.Stand_Id = S.Stand_Id
    WHERE SF.User_Id = $id AND SF.State = 1 AND SB.State = 1 AND SBN.State = 1";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows >= 1) {
            while ($row = $Result->fetch_array()) {
                $data[] =  StandProcessing($row);
            }
            return $data;
        } else return null;
    }
}
#endregion
#region Updates

function UpdateStand($id, $name, $adress, $phone, $locality, $con)
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

    if ($locality != "") {
        $sql = "UPDATE Stands SET Locality = '$locality' WHERE Stand_Id = $id";
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

function UpdateStandViews($id, $con)
{
    $sql = "UPDATE Stands SET Views = Views + 1 WHERE Stand_Id = $id";
    $con->query($sql);
}

#endregion
#region Insert
function InsertStandConfig($id, $con)
{
    $sql = "INSERT INTO Config_Stands(Stand_Id) VALUE(?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    if ($stmt == true) {
        return true;
    } else {
        //500 ERROR => header("Location: .../500.html")
        return false;
    }
}

function InsertStand($Phone, $Adress, $Locality, $Name, $con)
{
    $sql = "INSERT INTO Stands(User_Id,Phone,Adress,Locality,Name,Views) VALUES(?,?,?,?,?,0)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('issis', $_SESSION['Id'], $Phone, $Adress, $Locality, $Name);
    $stmt->execute();
    if ($stmt == true) {
        return true;
    } else {
        //500 ERROR => header("Location: .../500.html")
        return false;
    }
}

function InsertNews($standid, $userid, $title, $text, $con)
{
    $sql = "INSERT INTO News(Stand_Id,User_Id,Title,Text,State) Values(?,?,?,?,1)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('iiss', $standid, $userid, $title, $text);
    $stmt->execute();
}

function insertMessageStand($idC, $idS, $idR, $title, $message, $accepted, $con)
{
    $sql = "INSERT INTO Messages(User_Id,Receiver_Id,License_Plate,Title,Message,Accept_Neg_Price) VALUES(?,?,?,?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('iisssi', $idS, $idR, $idC, $title, $message, $accepted);
    $stmt->execute();
}
#endregion
#region Photos
function InsertBanner($con, $id, $name)
{
    storePreviousBanner($id, $con);

    $sql = "INSERT INTO Stands_Banners (Stand_Id, Banner_Name) VALUES(?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('is', $id, $name);
    $stmt->execute();
    if ($stmt == true) {
        return true;
    } else {
        //500 ERROR => header("Location: .../500.html")
        return false;
    }
}

function InsertBadge($con, $id, $name)
{
    storePreviousBadge($id, $con);

    $sql = "INSERT INTO Stands_Badges (Stand_Id, Badge_Name) VALUES(?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('is', $id, $name);
    $stmt->execute();
    if ($stmt == true) {
        return true;
    } else {
        //500 ERROR => header("Location: .../500.html")
        return false;
    }
}

function storePreviousBadge($id, $con)
{
    $sql = "SELECT Id_Badge FROM Stands_Badges WHERE Stand_Id = $id ORDER BY CreatedBadge DESC LIMIT 1";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows == 1) {
            if ($row = $Result->fetch_array()) {
                $bid = $row["Id_Badge"];
                $sql = "UPDATE Stands_Badges SET State = 0 WHERE Id_Badge = $bid";
                $con->query($sql);
            }
        }
    }
}

function storePreviousBanner($id, $con)
{
    $sql = "SELECT Id_Banner FROM Stands_Banners WHERE Stand_Id = $id ORDER BY CreatedBanner DESC LIMIT 1";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows == 1) {
            if ($row = $Result->fetch_array()) {
                $bid = $row["Id_Banner"];
                $sql = "UPDATE Stands_Banners SET State = 0 WHERE Id_Banner = $bid";
                $con->query($sql);
            }
        }
    }
}
#endregion
#region Favourits
function returnFavourit($sid, $uid, $con)
{
    $sql = "SELECT * FROM Stands_Favourits WHERE Stand_id = $sid AND User_Id = $uid AND State = 1";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows == 1) {
            return true;
        } else return false;
    }
}

function seeifFavouritExist($sid, $uid, $con)
{
    $sql = "SELECT * FROM Stands_Favourits WHERE Stand_id = $sid AND User_Id = $uid";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows == 1) {
            return true;
        } else return false;
    }
}

function manageFavourits($user, $stand, $con)
{
    if (seeifFavouritExist($stand, $user, $con)) {
        $sql = "SELECT State FROM Stands_Favourits WHERE Stand_Id = $stand AND User_Id = $user";
        if ($Result = $con->query($sql)) {
            if ($Result->num_rows == 1) {
                if ($row = $Result->fetch_array()) {
                    $state = $row["State"];

                    if ($state == 0) {
                        $sql = "UPDATE Stands_Favourits SET State = 1 WHERE Stand_Id = $stand AND User_Id = $user";
                        $con->query($sql);
                    }

                    if ($state == 1) {
                        $sql = "UPDATE Stands_Favourits SET State = 0 WHERE Stand_Id = $stand AND User_Id = $user";
                        $con->query($sql);
                    }
                }
            }
        }
    } else {
        $sql = "INSERT INTO Stands_Favourits(Stand_Id,User_Id,State) VALUES(?,?,1)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ii', $stand, $user);
        $stmt->execute();
    }
}
#endregion