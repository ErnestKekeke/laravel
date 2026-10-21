<?php
// // for docker 
// $host = "db";
// $user = "user";
// $password = "password";
// $database = "formdb";

// for local host
$host = "localhost";
$user = "root";
$password = "";
$database = "phpdockerdb";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}