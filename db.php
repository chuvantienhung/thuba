<?php
$host = "localhost:8888";
$username = "root";
$password = "0000";
$database = "memo";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
