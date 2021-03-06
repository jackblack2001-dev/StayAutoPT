<?php

#region DataProcessing
function DataProcessing($data, $iscard, $con)
{
    //fuel Processing
    if ($data["Type_Fuel"] == 1) {
        $data["Type_Fuel"] = "Gasolina";
    } else {
        $data["Type_Fuel"] = "Diesel";
    }

    //gear Processing
    if (isset($data["Type_Gear"])) {
        if ($data["Type_Gear"] == 1) {
            $data["Type_Gear"] = "Manual";
        } else if (isset($data["Type_Gear"]) == 2) {
            $data["Type_Gear"] = "Automatico";
        } else {
            $data["Type_Gear"] = "CVT";
        }
    }

    //car name Processing
    $Name = $data["Brand"] . " " . $data["Model"];

    if ($iscard) {
        if (strlen($Name) > 15) {
            $data["Model"] = substr($Name, 0, 15) . "...";
        } else {
            $data["Model"] = $Name;
        }
    } else {
        $data["Model"] = $Name;
    }

    //image Processing
    if ($data["Card_Image"] == null) {
        $name = FirtPhotoInserted($data["License_Plate"], $con);

        if ($name == false) {
            $data["Card_Image"] = "no_image_car.png";
        } else {
            $data["Card_Image"] = $data["License_Plate"] . "/" . $name;
        }
    } else {
        $name = $data["License_Plate"] . "/" . $data["Card_Image"];
        $data["Card_Image"] = $name;
    }

    return $data;
}
#endregion


#region SELECT
function returnPaginationCars($sql_body, $page, $num_rows_on_page, $con)
{
    $sql = "$sql_body LIMIT ?,?";

    if ($stmt = $con->prepare($sql)) {
        $calc_page = ($page - 1) * $num_rows_on_page;
        $stmt->bind_param('ii', $calc_page, $num_rows_on_page);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows >= 1) {
            while ($row = $result->fetch_assoc()) {
                $data[] = DataProcessing($row, false, $con);
            }
            return $data;
        } else return null;
    }
}

function SeeLicensePlateExists($lp, $con)
{
    $sql = "SELECT * FROM Cars WHERE License_Plate = '$lp'";
    $Result = $con->query($sql);
    if ($Result->num_rows == 1) {
        return true;
    } else return false;
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
    $sql = "SELECT * FROM Cars WHERE Stand_Id = $id AND State = 1 ORDER BY CreatedCar desc limit $numrows";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows >= 1) {
            while ($row = $Result->fetch_array()) {
                $cars[] = DataProcessing($row, true, $con);
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
            if ($row = $Result->fetch_assoc()) {
                return DataProcessing($row, false, $con);
            }
        }
    }
}

function returnStandCars($id, $con)
{
    $sql = "SELECT * FROM Cars WHERE Stand_id = '$id' AND State = 1";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows >= 1) {
            while ($row = $Result->fetch_assoc()) {
                $cars[] = DataProcessing($row, true, $con);
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
    $sql = "SELECT * FROM Cars WHERE Stand_Id = '$id' AND State = 1 AND Model LIKE '%$search%'";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows >= 1) {
            while ($row = $Result->fetch_array()) {
                $cars[] = DataProcessing($row, true, $con);
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

#region Stand_Dashboard_Statistics
function returnTotalNumcars($id, $con)
{
    $sql = "SELECT COUNT(*) AS NumCars FROM Cars WHERE Stand_Id = $id";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows == 1) {
            if ($row = $Result->fetch_array()) {
                return $row;
            }
        } else {
            return 0;
        }
    }
}

function returnTotalAvailablecars($id, $con)
{
    $sql = "SELECT COUNT(*) AS AvailableCars FROM Cars WHERE Stand_Id = $id AND State = 1";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows == 1) {
            if ($row = $Result->fetch_array()) {
                return $row;
            }
        } else {
            return 0;
        }
    }
}

function returnTotalSellcars($id, $con)
{
    $sql = "SELECT COUNT(*) AS SelledCars, SUM(Price) AS TotalPrice FROM Cars WHERE Stand_Id = $id AND State = 2";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows == 1) {
            if ($row = $Result->fetch_array()) {
                return $row;
            }
        } else {
            return null;
        }
    }
}

function returnCarStandViews($id, $con)
{
    $sql = "SELECT SUM(C.Views) AS CarViews, S.Views AS StandViews, SUM(C.Views) + S.Views AS TotalViews FROM Cars C INNER JOIN Stands S ON C.Stand_Id = S.Stand_Id WHERE C.Stand_Id = $id AND C.State = 1";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows == 1) {
            if ($row = $Result->fetch_array()) {
                return $row;
            }
        } else {
            return 0;
        }
    }
}

function returnFavourits($id, $con)
{
    $sql = "SELECT COUNT(*) AS Favourits FROM Cars_Favourits WHERE Stand_Id = $id";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows == 1) {
            if ($row = $Result->fetch_array()) {
                return $row;
            }
        } else {
            return 0;
        }
    }
}

#endregion
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

function UpdateCarPrice($id, $price, $con)
{
    $sql = "UPDATE Cars SET Price = $price WHERE License_Plate = '$id'";
    $con->query($sql);
}

function SellCar($id, $con)
{
    $sql = "UPDATE Cars SET State = 2 WHERE License_Plate = '$id'";
    $con->query($sql);
}

function RemoveCar($id, $con)
{
    $sql = "UPDATE Cars SET State = 0 WHERE License_Plate = '$id'";
    $con->query($sql);
}

function UpdateCarViews($id, $con)
{
    $sql = "UPDATE Cars SET Views = Views + 1 WHERE Stand_Id = $id";
    $con->query($sql);
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

function DeletePhotos($id_photo, $id_car, $con)
{
    $sql = "UPDATE Cars_Images SET State = 0 WHERE Id_Image = '$id_photo' AND License_Plate = '$id_car'";
    $con->query($sql);
}
#endregion
#region Favourits
function returnAllFavouritCars($id, $con)
{
    $sql = "SELECT * FROM Cars C
            INNER JOIN Cars_Favourits CF
            ON
            CF.License_Plate = C.License_Plate
            WHERE CF.User_Id = $id AND CF.State = 1 AND C.State = 1";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows >= 1) {
            while ($row = $Result->fetch_array()) {
                $data[] =  DataProcessing($row, true, $con);
            }
            return $data;
        } else return null;
    }
}

function returnCookieFavouritCars($array, $con)
{
    $sql = 'SELECT * FROM Cars WHERE License_Plate IN (' . implode(",", $array) . ')';
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows >= 1) {
            while ($row = $Result->fetch_array()) {
                $data[] =  DataProcessing($row, true, $con);
            }
            return $data;
        } else return null;
    }
}

function returnFavouritCars($cid, $uid, $con)
{
    $sql = "SELECT * FROM Cars_Favourits WHERE License_Plate = '$cid' AND User_Id = '$uid' AND State = 1";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows == 1) {
            return true;
        } else return false;
    }
}

function seeifFavouritExistCars($cid, $uid, $con)
{
    $sql = "SELECT * FROM Cars_Favourits WHERE License_Plate = '$cid' AND User_Id = $uid";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows == 1) {
            return true;
        } else return false;
    }
}

function manageFavouritsCars($user, $car, $con)
{
    if (seeifFavouritExistCars($car, $user, $con)) {
        $sql = "SELECT State FROM Cars_Favourits WHERE License_Plate = '$car' AND User_Id = $user";
        if ($Result = $con->query($sql)) {
            if ($Result->num_rows == 1) {
                if ($row = $Result->fetch_array()) {
                    $state = $row["State"];

                    if ($state == 0) {
                        $sql = "UPDATE Cars_Favourits SET State = 1 WHERE License_Plate = '$car' AND User_Id = $user";
                        $con->query($sql);
                    }

                    if ($state == 1) {
                        $sql = "UPDATE Cars_Favourits SET State = 0 WHERE License_Plate = '$car' AND User_Id = $user";
                        $con->query($sql);
                    }
                }
            }
        }
    } else {
        $sql = "INSERT INTO Cars_Favourits(License_Plate,User_Id,State) VALUES(?,?,1)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('si', $car, $user);
        $stmt->execute();
    }
}
#endregion
#region Search Data Cars
function RecordSearch($Min_Year, $Max_Year, $Min_Price, $Max_Price, $Min_Kms, $Max_Kms, $Type_Fuel, $Type_Gear, $Locality, $con)
{
    $sql = "INSERT INTO Search_Data_Car(Min_Year,Max_Year,Min_Price,Max_Price,Min_Kms,Max_Kms,Type_Fuel,Type_Gear,Locality) VALUES(?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('iiiiiiiii', $Min_Year, $Max_Year, $Min_Price, $Max_Price, $Min_Kms, $Max_Kms, $Type_Fuel, $Type_Gear, $Locality);
    $stmt->execute();
}
#endregion