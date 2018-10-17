<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "testdb";
    
$conn = new mysqli($servername, $username, $password, $database);
    
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO photos (photo, Username, rating) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $photo, $user, $rating);

$photo = $_POST["photo"];
$user = $_POST["owner"];
$rating = $_POST["rating"];

$stmt->execute();

$stmt->close();

echo "<script language='javascript'>";
sleep(1);
echo "window.location.href='profile.php'";
echo "</script>";

?>