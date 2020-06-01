<?php

function returnAllCars($con)
{
    $data = null;

    $sql = "SELECT * FROM Cars";

    if ($Result = $con->query($sql)) {
        if ($Result->num_rows >= 1) {
            while ($row = $Result->fetch_array()) {
                $data[] = $row;
            }
            return $data;
        }
    }
}

function returnCarsViews($con)
{
    $sql = "SELECT SUM(Views) AS Views FROM Cars";

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

function returnMoreViewedCar($id, $con)
{
    $sql = "SELECT *,Name FROM Cars 
            INNER JOIN Cars_Images
            ON Cars.License_Plate = Cars_Images.License_Plate
            WHERE Stand_Id = $id";
}

function returnCarsLast5($id, $con)
{
    if (!is_null($id)) {
        $sql = "SELECT * FROM Cars WHERE Stand_Id = $id ORDER BY CreatedCar desc limit 5";
        if ($Result = $con->query($sql)) {
            if ($Result->num_rows >= 1) {
                while ($row = $Result->fetch_array()) {
                    $cars[] = $row;
                }

                return $cars;
            } else return false;
        } else return false;
    } else return false;
}

function returnCars($id, $con)
{
    if (!is_null($id)) {
        $sql = "SELECT * FROM Cars WHERE Stand_id = '$id' AND State = 1";
        if ($Result = $con->query($sql)) {
            if ($Result->num_rows >= 1) {
                while ($row = $Result->fetch_array()) {
                    $cars[] = $row;
                }

                return $cars;
            } else return 0;
        } else return false;
    } else return false;
}

function returnCarsSearch($id, $search, $con)
{
    if (!is_null($id)) {
        $sql = "SELECT * FROM `cars` WHERE `Stand_Id` = $id 
        AND `Brand` LIKE '%$search%' OR `Model` LIKE '%$search%'";
        if ($Result = $con->query($sql)) {
            if ($Result->num_rows >= 1) {
                while ($row = $Result->fetch_array()) {
                    $cars[] = $row;
                }

                return $cars;
            } else return 1;
        } else return false;
    } else return false;
}

function ThreeMoreRentable($con)
{
    $data = null;

    $sql = "SELECT Brand, SUM(Price) AS Price FROM cars WHERE State = 2 GROUP BY Brand DESC LIMIT 3";

    if ($Result = $con->query($sql)) {
        if ($Result->num_rows == 3) {
            while ($row = $Result->fetch_array()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return null;
        }
    }
}

function returnMostViewed($id,$con)
{
    $sql = "SELECT License_Plate, Brand, Model, Year, Card_Image , MAX(Views) AS MV FROM Cars WHERE Stand_Id = $id AND State = 1 GROUP BY License_Plate ORDER BY MV DESC LIMIT 1";
    if($Result = $con->query($sql)){
        if($Result->num_rows == 1){
            if($row = $Result->fetch_array()){
                return $row;
            }
        }
    }
}

#region Car Photos
function FirtPhotoInserted($id, $con)
{
    $sql = "SELECT MIN(License_Plate), Name FROM cars_images WHERE License_Plate = '$id' AND State = '1'";

    if ($Result = $con->query($sql)) {
        if ($Result->num_rows == 1) {
            if ($row = $Result->fetch_array()) {
                return $row["Name"];
            } else return false;
        } else return false;
    } else return false;
}

function InsertPhotos($con, $id, $name)
{
    $sql = "INSERT INTO Cars_Images (License_Plate, Name) VALUES(?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ss', $id, $name);
    $stmt->execute();
    if ($stmt == true) {
        return true;
    } else {
        //500 ERROR => header("Location: .../500.html")
        return false;
    }
}
#endregion