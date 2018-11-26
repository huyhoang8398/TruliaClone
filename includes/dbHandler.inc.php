<?php
$dbServerName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "loginsystem";

$conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed ".mysqli_connect_error());
}
