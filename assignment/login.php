<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Σελίδα εισόδου</title>
    <link href="CSS/login.css" rel="Stylesheet" type="text/css" />
    <link rel="icon" href="18741175_10203160921379776_424017798_n.jpg">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
    <body>
        <div id="login-container">
            <form id="form" action="login.php" method="post">
                <label>Username: &nbsp;</label>
                <input type="text" name="Username" placeholder="Username" required><br><br>
                <label>Password: &nbsp;</label>
                <input type="password" id="txtPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" name="Password" readonly  
         onfocus="this.removeAttribute('readonly');" placeholder="Password (Example123!)" required><br><br>
                <input class="center" type="submit" value="Login">
                
            </form>
        </div>
    </body>
</html>


<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "testdb";
    
$conn = new mysqli($servername, $username, $password, $database);
    
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(!empty($_POST["Username"]) && isset($_POST["Username"]) && !empty($_POST["Password"]) && isset($_POST["Password"])) {
    
    $sql = "SELECT User_id,Username,Password FROM users WHERE Username='".$_POST["Username"]."'";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        $user_row = $result->fetch_array(MYSQLI_BOTH);
        if(password_verify($_POST["Password"], $user_row['Password'])) {
            
            $_SESSION['user_session'] = $user_row['Username'];
            header('Location: profile.php');
            return true;
        }else {
            echo "<script language='javascript'>";
            echo "alert('Wrong username or password!');";
            echo "</script>";
            return false;
        }
    } else {
        echo "<script language='javascript'>";
        echo "alert('Wrong username or password!');";
        echo "</script>";
    }
}



$conn->close();

?>