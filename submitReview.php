<?php

session_start();

$server = "localhost";
$username = "root";
$password = "";
$database = "la_cerve";

$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $stars = $_POST['rating'];
    $description = $_POST['opinion'];

    $stmt = $conn->prepare("INSERT INTO reviews (stars, description, user) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $stars, $description, $username);

    if ($stmt->execute()) {
        echo "Review saved successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>