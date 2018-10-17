<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Άλμπουμ Φωτογραφιών</title>
    <link href="CSS/main.css" rel="Stylesheet" type="text/css" />
    <link rel="icon" href="18741175_10203160921379776_424017798_n.jpg">
</head>
    <body>
        <nav>
            
            <ul>
                <li><a href="profile.php">Αρχική</a></li>
                <li><a href="logout.php">Αποσύνδεση</a></li>
            </ul>
        </nav>
        
        <section>
           
            <?php
            include "photo_class.php";
            session_start();
            if(isset($_SESSION['user_session']) && !empty($_SESSION['user_session'])) {
                
                echo "<h1>hello ".$_SESSION['user_session'].",</h1>";
                
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "testdb";

                $conn = mysqli_connect($servername, $username, $password, $database);
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }   
                
                $sql = "SELECT * FROM photos GROUP BY photo";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="photo" id="'.$row["id"].'"><img src="'.$row["photo"].'" alt="photo"></div>';
                    }
                }
                
                echo '<form class="form" action="uploadPhoto.php" method="post" enctype="multipart/form-data">';
                echo '<input type="file" name="fileToUpload" id="fileToUpload"><br>';
                echo '<input class="hidden" type="text" name="owner" value="'.$_SESSION['user_session'].'">';
                echo '<input type="submit" value="Υποβολή φωτογραφίας" name="submit"></form>';
                
                $j = 0;
                $photos = array();
                
                $sql = "SELECT * FROM photos";
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $photos[$j] = new photo($row["id"], $row["Username"], $row["photo"], $row["rating"], $row["comment"], $row["date"]);
                        $j++;
                    }
                }
                
                $_SESSION['photos'] = $photos;
                                
            } else {
                header("Location: index.php");
            }
            
            ?>
        </section>
        
        <script>
            
            var classname = document.getElementsByClassName("photo");

            for (var i = 0; i < classname.length; i++) {
                classname[i].addEventListener('click', function() {
                var x = this.id;
                window.location.href='photo.php?id='+x;
            }, false);
            }
               
        </script>
    </body>
</html>