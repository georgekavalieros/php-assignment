<?php

$target_file = basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

if (file_exists($target_file)) {
    echo "<script language='javascript'>";
    echo "alert('file already exists.')";
    echo "</script>";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "<script language='javascript'>";
    echo "alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');";
    echo "</script>";
    $uploadOk = 0;
}else
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);




$servername = "localhost";
$username = "root";
$password = "";
$database = "testdb";
    
$conn = new mysqli($servername, $username, $password, $database);
    
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO photos (photo, Username) VALUES (?, ?)");
$stmt->bind_param("ss", $photo, $user);

$photo = basename($_FILES["fileToUpload"]["name"]);
$user = $_POST["owner"];

$stmt->execute();

$stmt->close();

echo "<script language='javascript'>";
echo "window.location.href='profile.php'";
echo "</script>";

?>