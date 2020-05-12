<?php

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

function returnUsers($con)
{
        $sql = "SELECT * FROM Users";
        $Result = $con->query($sql);
        if ($Result->num_rows >= 1) {
            while($row = $Result->fetch_array()) {
                $Users[] = $row;
            }
            return $Users;
        } else {
            return null;
        }
}

function returnUsersCount($con)
{
    $sql = "SELECT COUNT(*) AS Users FROM Users";

    if($Result=$con->query($sql)){
        if($Result->num_rows == 1){
            if($row = $Result->fetch_array()){
                return $row;
            }
            else{
                return $data;
            }
        }
    }
}

function returnUsersCountType($type,$con)
{
    if($type == 1){
        $sql = "SELECT COUNT(*) AS Clientes FROM Users WHERE Profile = 1";

        if($Result=$con->query($sql)){
            if($Result->num_rows == 1){
                if($row = $Result->fetch_array()){
                    return $row;
                }
                else{
                    return $data;
                }
            }
        }
    }

    if($type == 2){
        $sql = "SELECT COUNT(*) AS Empresarios FROM Users WHERE Profile = 2";

        if($Result=$con->query($sql)){
            if($Result->num_rows == 1){
                if($row = $Result->fetch_array()){
                    return $row;
                }
                else{
                    return $data;
                }
            }
        }
    }
}

function returnUsersSearch($con,$search)
{
        $sql = "SELECT * FROM Users 
        WHERE Name = $search OR Email = $search";
        $Result = $con->query($sql);
        if ($Result->num_rows >= 1) {
            while($row = $Result->fetch_array()) {
                $Users[] = $row;
            }
            return $Users;
        } else {
            return null;
        }
}