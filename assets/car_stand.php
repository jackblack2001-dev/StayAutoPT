<?php

function returnAllCars($con)
{
    $data = null;

    $sql = "SELECT * FROM Cars";

    if($Result=$con->query($sql)){
        if($Result->num_rows >= 1){
            while($row = $Result->fetch_array()){
                $data[] = $row;
            }
            return $data;
        }
    }
}

function returnCarsViews($con)
{
    $sql = "SELECT SUM(Views) AS Views FROM Cars";

    if($Result=$con->query($sql)){
        if($Result->num_rows == 1){
            if($row = $Result->fetch_array()){
                return $row;
            }
            else{
                return null;
            }
        }
    }
}

function ThreeMoreRentable($con)
{
    $data = null;

    $sql= "SELECT Brand, SUM(Price)
            FROM Cars
            WHERE State = 2
            ORDER BY Brand desc LIMIT 5";

    if($Result=$con->query($sql)){
        if($Result->num_rows >= 1){
            while($row = $Result->fetch_array()){
                $data[] = $row;
            }
            return $data;
        }
    }
}
