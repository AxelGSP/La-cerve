<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "la_cerve";

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$table = $data['table'];
$id = $data['id'];
$columns = $data['data'];

// Generate the SET part of the SQL query
$setParts = [];
foreach ($columns as $column => $value) {
    $setParts[] = "$column = '" . $conn->real_escape_string($value) . "'";
}
$setString = implode(', ', $setParts);

$sql = "UPDATE $table SET $setString WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

$conn->close();
?>