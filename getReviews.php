<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "la_cerve";

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT user, stars, description FROM reviews ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='review'>";
        echo "<div class='user'>Usuario: " . $row["user"] . "</div>";
        echo "<div class='rating'>Estrellas: " . $row["stars"] . "</div>";
        echo "<div class='opinion'>" . $row["description"] . "</div>";
        echo "</div>";
    }
} else {
    echo "No hay reseñas todavía";
}

$conn->close();
?>
