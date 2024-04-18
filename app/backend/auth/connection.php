<?php
$servername = "mysql57.unoeuro.com";
$username = "defiregutterpaatur_dk";
$password = "dFBEwgAbGmnRck9tzx6H";
$dbname = "defiregutterpaatur_dk_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}