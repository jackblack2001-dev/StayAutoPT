<?php

#region SELECT
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
        } else return null;
    } else return null;
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

function returnMostViewedCar5($con)
{
    $sql = "SELECT * FROM Cars WHERE State = 1 ORDER BY VIEWS DESC LIMIT 5";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows >= 1) {
            while ($row = $Result->fetch_array()) {
                $cars[] = $row;
            }

            return $cars;
        } else return false;
    } else return false;
}

function returnCarsLastX($id, $numrows, $con)
{
    $sql = "SELECT * FROM Cars WHERE Stand_Id = $id ORDER BY CreatedCar desc limit $numrows";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows >= 1) {
            while ($row = $Result->fetch_array()) {
                $cars[] = $row;
            }

            return $cars;
        } else return false;
    } else return false;
}

function returnCar($id, $con)
{
    $sql = "SELECT * FROM Cars WHERE License_Plate = '$id'";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows == 1) {
            while ($row = $Result->fetch_array()) {
                return $row;
            }
        }
    }
}

function returnCars($id, $con)
{
    $sql = "SELECT * FROM Cars WHERE Stand_id = '$id' AND State = 1";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows >= 1) {
            while ($row = $Result->fetch_array()) {
                $cars[] = $row;
            }

            return $cars;
        } else return 0;
    } else return false;
}

function returnRandomCar6($con)
{
    $sql = "SELECT * FROM Cars WHERE State = 1 ORDER BY RAND() LIMIT 6";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows >= 1) {
            while ($row = $Result->fetch_array()) {
                $cars[] = $row;
            }

            return $cars;
        } else return false;
    } else return false;
}

function returnCarsSearch($id, $search, $con)
{
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

function returnMostViewed($id, $con)
{
    $sql = "SELECT License_Plate, Brand, Model, Year, Card_Image , MAX(Views) AS MV FROM Cars WHERE Stand_Id = $id AND State = 1 GROUP BY License_Plate ORDER BY MV DESC LIMIT 1";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows == 1) {
            if ($row = $Result->fetch_array()) {
                return $row;
            }
        }
    }
}
#endregion

#region UPDATE
function UpdateCar($id, $brand, $model, $kms, $year, $type_fuel, $type_gear, $description, $price, $con)
{
    if ($brand != "") {
        $sql = "UPDATE Cars SET Brand = '$brand' WHERE License_Plate = '$id'";
        if ($con->query($sql) != true) {
            return false;
        }
    }

    if ($model != "") {
        $sql = "UPDATE Cars SET Model = '$model' WHERE License_Plate = '$id'";
        if ($con->query($sql) != true) {
            return false;
        }
    }

    if ($kms != "") {
        $sql = "UPDATE Cars SET Kms = '$kms' WHERE License_Plate = '$id'";
        if ($con->query($sql) != true) {
            return false;
        }
    }

    if ($year != "") {
        $sql = "UPDATE Cars SET Year = '$year' WHERE License_Plate = '$id'";
        if ($con->query($sql) != true) {
            return false;
        }
    }

    if ($type_fuel != "") {
        $sql = "UPDATE Cars SET Type_Fuel = '$type_fuel'WHERE License_Plate = '$id'";
        if ($con->query($sql) != true) {
            return false;
        }
    }

    if ($type_gear != "") {
        $sql = "UPDATE Cars SET Type_Gear = '$type_gear' WHERE License_Plate = '$id'";
        if ($con->query($sql) != true) {
            return false;
        }
    }

    if ($description != "") {
        $sql = "UPDATE Cars SET Description = '$description' WHERE License_Plate = '$id'";
        if ($con->query($sql) != true) {
            return false;
        }
    }

    if ($price != "") {
        $sql = "UPDATE Cars SET Price = '$price' WHERE License_Plate = '$id'";
        if ($con->query($sql) != true) {
            return false;
        }
    }
}
#endregion

#region Car Photos
function returnAllCarPhotos($id, $con)
{
    $sql = "SELECT * FROM Cars_Images WHERE License_Plate = '$id' AND State = '1'";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows >= 1) {
            while ($row = $Result->fetch_array()) {
                $data[] = $row;
            }
            return $data;
        }
    }
}

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