<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Σελίδα Εγγραφής</title>
    <link href="CSS/login.css" rel="Stylesheet" type="text/css" />
    <link rel="icon" href="18741175_10203160921379776_424017798_n.jpg">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
    <body onload="onLoad()">
        
        <div id="login-container">
            <form id="form" action="register.php" method="post" onsubmit="functSubmit()">
                <label>Όνομα: &nbsp;</label>
                <input type="text" name="Firstname" placeholder="Όνομα" required><br><br>
                <label>Επώνυμο: &nbsp;</label>
                <input type="text" name="Lastname" placeholder="Επώνυμο" required><br><br>
                <label>Username: &nbsp;</label>
                <input type="text" name="Username" placeholder="Username" required><br><br>
                <label>Password: &nbsp;</label>
                <input type="password" id="txtPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" name="Password" readonly  
         onfocus="this.removeAttribute('readonly');" placeholder="Password example: Password1!" required><br><br>
                <label>Confirm Password: &nbsp;</label>
                <input type="password" id="txtConfirmPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" name="Confirm-Password" readonly  
         onfocus="this.removeAttribute('readonly');" placeholder="Confirm Password" required><br><br>
                <label>E-mail:&nbsp;</label>
                <input type="email" name="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="Example@email.com" required><br><br>
                <div class="g-recaptcha" data-sitekey="6Lf-GSMTAAAAAKvB6OED7wIOfUA_1zJ3Mf4TrtGq"></div>
                <input id="center" type="submit" value="Register">
                
            </form>
        </div>
        
        <script language="JavaScript">
                
                function functSubmit(event){
                    var password = document.getElementById('txtPassword').value;
                    var ConfirmPassword = document.getElementById('txtConfirmPassword').value;
                    var flag = true;
                    if (password != ConfirmPassword) {
                        alert('The passwords do not match!');
                        flag = false;
                    }
                    return flag;
                    
                }
                
                
        </script>
        

         
        
    </body>
</html>


<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "testdb";
    
$conn = new mysqli($servername, $username, $password, $database);
    
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(!empty($_POST["Username"]) && isset($_POST["Username"]) && !empty($_POST["Password"]) && isset($_POST["Password"]) && !empty($_POST["Email"]) && isset($_POST["Email"]) && !empty($_POST["g-recaptcha-response"]) && isset($_POST["g-recaptcha-response"])) {
    
    #RECAPTCHA 
    $secret = "6Lf-GSMTAAAAAO5Lvtd7mWPiDXnnl0tG4ZQK-ZK1";
    $ip = $_SERVER["REMOTE_ADDR"];
    $captcha = $_POST["g-recaptcha-response"];
    $result = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
    echo "<br>";
    $array = json_decode($result, TRUE);
    echo "<br>";
    
    
    #OPTIONS OF HASHED PASSWORD
    $options = [
        'cost' => 11,
        'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    ];
    
    
    
    #SQL QUERY
    $sql = "SELECT username FROM users WHERE Username='".$_POST["Username"]."'";
    $result = $conn->query($sql);
    
    #CHECK USERNAME AND RECAPTCHA
    if($array["success"]) {
        if($result->num_rows > 0) {
            echo "<script language='javascript'>";
            echo "alert('The selected name already exists.');";
            echo "</script>";
        } else {
            if($_POST["Password"] == $_POST["Confirm-Password"]) {
            $stmt = $conn->prepare("INSERT INTO users (Firstname, Lastname, Email, Username, Password) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $firstname, $lastname, $email, $usr, $psw);

            $firstname = $_POST["Firstname"];
            $lastname = $_POST["Lastname"];
            $email = $_POST["Email"];
            $usr = $_POST["Username"];
            $psw = password_hash($_POST["Password"], PASSWORD_BCRYPT, $options);
            $stmt->execute();

            $stmt->close();
            
            
                echo "<script language='javascript'>";
                echo "alert('Registered successfully!');";
                echo "window.location.href='index.php'";
                echo "</script>";
            }
            

        }
    }else {
            echo "<script language='javascript'>";
            echo "alert('Please fill in the reCaptcha box.');";
            echo "</script>";
    }

    
}
$conn->close();

?>