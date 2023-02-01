<?php

$host = "localhost";
$dbname = "webshop";
$Db_username = "root";
$Db_password = "";

$con = new mysqli($host, $Db_username, $Db_password, $dbname);

if ($con->connect_errno) {
    die("connection error: " . $con->error);
}

return $con;
