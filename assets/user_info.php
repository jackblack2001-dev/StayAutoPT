<?php
#region SELECT 
function returnUser($id, $con)
{
    if (isset($id)) {
        $sql = "SELECT * FROM Users WHERE User_Id = '$id'";
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

function SeeEmailExists($id, $con)
{
    $sql = "SELECT Email FROM Users WHERE Email = '$id'";
    $Result = $con->query($sql);
    if ($Result->num_rows == 1) {
        return true;
    } else {
        return false;
    }
}

function returnUsers($con, $id)
{
    $sql = "SELECT * FROM Users WHERE User_Id != $id";
    $Result = $con->query($sql);
    if ($Result->num_rows >= 1) {
        while ($row = $Result->fetch_array()) {
            $Users[] = $row;
        }
        return $Users;
    } else {
        return null;
    }
}

function returnUsersCount($con)
{
    $sql = "SELECT COUNT(*) AS Users FROM Users WHERE Profile != 0";

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

function returnUsersCountType($type, $con)
{
    if ($type == 1) {
        $sql = "SELECT COUNT(*) AS Clientes FROM Users WHERE Profile = 1";

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

    if ($type == 2) {
        $sql = "SELECT COUNT(*) AS Empresarios FROM Users WHERE Profile = 2";

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
}

function returnUsersSearch($con, $search)
{
    $sql = "SELECT * FROM Users 
        WHERE Name = $search OR Email = $search";
    $Result = $con->query($sql);
    if ($Result->num_rows >= 1) {
        while ($row = $Result->fetch_array()) {
            $Users[] = $row;
        }
        return $Users;
    } else {
        return null;
    }
}
#endregion
#region INSERT
function insertUser($Name, $Mail, $Phone, $profile, $hased_password, $con)
{
    $sql = "INSERT INTO Users(Name,Email,Phone,Profile,Password) VALUES(?,?,?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('sssis', $Name, $Mail, $Phone, $profile, $hased_password);
    $stmt->execute();
}
#endregion
#region UPDATE
function UpdatePhone($phone, $id, $con)
{
    $sql = "UPDATE Users SET Phone = $phone WHERE User_Id = $id";
    if ($con->query($sql) != true) {
        return false;
    } else {
        return true;
    }
}

function UpdateUserBanner($bannername, $id, $con)
{
    $sql = "UPDATE Users SET Banner = '$bannername' WHERE User_Id = $id";
    if ($con->query($sql) != true) {
        return false;
    } else {
        return true;
    }
}

function UpdateUserBadge($badgename, $id, $con)
{
    $sql = "UPDATE Users SET Badge = '$badgename' WHERE User_Id = $id";
    if ($con->query($sql) != true) {
        return false;
    } else {
        return true;
    }
}

function ActivateAcount($id,$con){
    $sql = "UPDATE Users SET IsActivated = 1 WHERE Email = '$id'";
    if ($con->query($sql) != true) {
        return false;
    } else {
        return true;
    }
}
#endregion
