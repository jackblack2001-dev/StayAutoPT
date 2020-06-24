<?php

function returnMostSearchLocality($con)
{
    $sql = "SELECT Name_Location,COUNT(Locality) AS NumEntries FROM Locations L
            INNER JOIN Search_Data_Car SDC
            ON
            SDC.Locality = L.Local_Id
            GROUP BY Name_Location
            ORDER BY NumEntries DESC LIMIT 1";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows == 1) {
            if ($row = $Result->fetch_array()) {
                return $row["Name_Location"];
            } else {
                return null;
            }
        }
    }
}

function returnMostSearchGear($con)
{
    $sql = "SELECT Type_Gear, COUNT(Type_Gear) AS NumEntries FROM Search_Data_Car
    GROUP BY Type_Gear
    ORDER BY NumEntries DESC LIMIT 1";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows == 1) {
            if ($row = $Result->fetch_array()) {
                return $row["Type_Gear"];
            } else {
                return null;
            }
        }
    }
}

function returnMostSearchFuel($con)
{
    $sql = "SELECT Type_Fuel, COUNT(Type_Fuel) AS NumEntries FROM Search_Data_Car
    GROUP BY Type_Fuel
    ORDER BY NumEntries DESC LIMIT 1";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows == 1) {
            if ($row = $Result->fetch_array()) {
                return $row["Type_Fuel"];
            } else {
                return null;
            }
        }
    }
}

function returnMostSearchMinYear($con)
{
    $sql = "SELECT Min_Year, COUNT(Min_Year) AS NumEntries FROM Search_Data_Car
    GROUP BY Min_Year
    ORDER BY NumEntries DESC LIMIT 1";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows == 1) {
            if ($row = $Result->fetch_array()) {
                return $row["Min_Year"];
            } else {
                return null;
            }
        }
    }
}

function returnMostSearchMaxYear($con)
{
    $sql = "SELECT Max_Year, COUNT(Max_Year) AS NumEntries FROM Search_Data_Car
    GROUP BY Max_Year
    ORDER BY NumEntries DESC LIMIT 1";
    if ($Result = $con->query($sql)) {
        if ($Result->num_rows == 1) {
            if ($row = $Result->fetch_array()) {
                return $row["Max_Year"];
            } else {
                return null;
            }
        }
    }
}

function returnAveragePrices($con)
{
    $sql = "SELECT ROUND(AVG(Min_Price),0) AS AverageMin, ROUND(AVG(Max_Price),0) AS AverageMax FROM Search_Data_Car";
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

function returnAverageKms($con)
{
    $sql = "SELECT ROUND(AVG(Min_Kms),0) AS AverageMin, ROUND(AVG(Max_Kms),0) AS AverageMax FROM Search_Data_Car";
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
