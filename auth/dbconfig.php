<?php 
$SERVER = "localhost";
$USER = "root";
$PASS = "";
$DB = "web-app";
$conn = new mysqli($SERVER, $USER, $PASS, $DB);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
