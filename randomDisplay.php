<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "la_cerve";

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, image_path FROM products ORDER BY RAND() LIMIT 3";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<img src='" . $row["image_path"] . "' alt='" . $row["name"] . "' class='menu-item'/>";
    }
} else {
    echo "No se encontraron productos.";
}

$conn->close();
?>