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

    $sql= "SELECT Brand, SUM(Price) AS Price FROM cars WHERE State = 2 GROUP BY Brand DESC LIMIT 3";

    if($Result=$con->query($sql)){
        if($Result->num_rows == 3){
            while($row = $Result->fetch_array()){
                $data[] = $row;
            }
            return $data;
        }
        else{
            return null;
        }
    }
}

#region Car Photos
function InsertPhotos($con,$id,$name){
    $sql = "INSERT INTO Cars_Images (License_Plate, Name) VALUES(?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ss', $id,$name);
    $stmt->execute();
    if ($stmt == true) {
        return true;
    }else{
        return false;
    }
}
#endregion