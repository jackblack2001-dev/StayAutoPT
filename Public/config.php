<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'David');
define('DB_PASSWORD', 'Ddsc2001');
define('DB_NAME', 'SAP_PT');

$con = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
if($con == false){
    die("ERRO: de ligação ao servidor. " . $con->connect_error);
}

$con->set_charset("utf8");
?>