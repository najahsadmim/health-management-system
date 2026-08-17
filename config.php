<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "healthcare_system";


$conn = new mysqli(
    $servername,
    $username,
    $password,
    $database
);


if ($conn->connect_error) {

    die("Database Connection Failed: " . $conn->connect_error);

}

echo "Database Connected Successfully";

?>