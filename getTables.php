<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "la_cerve";

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$table = $_GET['table'];

$sql = "SELECT * FROM $table";
$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>