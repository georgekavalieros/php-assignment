<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "testdb";
    
$conn = new mysqli($servername, $username, $password, $database);
    
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO photos (photo, Username, comment) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $photo, $user, $comment);

$photo = $_POST["photo"];
$user = $_POST["owner"];
$comment = $_POST["comment"];

$stmt->execute();

$stmt->close();

echo "<script language='javascript'>";
echo "window.location.href='profile.php'";
echo "</script>";
?>
