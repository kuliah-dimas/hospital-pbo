<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "hospital";

$conn = mysqli_connect($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
