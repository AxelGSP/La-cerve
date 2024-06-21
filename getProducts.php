<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "la_cerve";

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, image_path, price FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<section class='smenu-product' data-id='" . $row["id"] . "' data-name='" . $row["name"] . "' data-price='" . $row["price"] . "' style='background-image: url(\"" . $row["image_path"] . "\");'>";
        echo "<div class='content'>";
        echo "<div class='name'>" . $row["name"] . "</div>";
        echo "<div class='price'> Precio: $" . $row["price"] . "</div>";
        echo "</div>";
        echo "</section>";
    }
}

$conn->close();
?>