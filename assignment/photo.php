<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Φωτογραφία</title>
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
                $photos = $_SESSION['photos'];
        
                foreach($photos as $photo) {
                    if($photo->getId() == $_GET["id"]) {
                        $pvar = $photo->getCover();
                        $powner = $photo->getOwner();
                        $pdate = $photo->getDate();
                        break;
                    }
                }
                echo '<div class="container">';
                echo '<div class="photo2" id="'.$_GET["id"].'">Uploaded by:<b> '.$powner.'</b> at <b>'.$pdate.'</b><img id="image" src="'.$pvar.'" alt="photo">';
                echo "</div>";
                
                
                echo '<form class="form" action="comment.php?id='.$_GET["id"].'" method="post">';
                echo 'Comment here:<br><textarea name="comment"></textarea><br>';
                echo '<input class="hidden" type="text" name="owner" value="'.$_SESSION['user_session'].'">';
                echo '<input class="hidden" type="text" name="photo" value="'.$pvar.'">';
                echo '<input type="submit" value="Υποβολή Σχολίου"></form>';
            
                echo '<form class="form" action="rate.php?id='.$_GET["id"].'" method="post">';
                echo '<input class="hidden" type="text" name="photo" value="'.$pvar.'">';
                echo '<input class="hidden" type="text" name="owner" value="'.$_SESSION['user_session'].'">';
                echo '<input type="number" name="rating" min="1" max="5">';
                echo '<input type="submit" value="Υποβολή Βαθμολογίας"></form>';
            
                echo '</div>';
                
                $numOfRatings = 0;
                $rating = 0;
                echo '<div id="comment-container">Comment Section:';
                foreach($photos as $photo) {
                    if($pvar == $photo->getCover()) {
                        if($photo->getComment() != null) {
                            echo "<div class='comment'>";
                            echo $photo->getOwner()."<hr><br>".$photo->getComment()."<br>";
                        }
                        
                        if($photo->getRating() != null) {
                            $rating += $photo->getRating();
                            $numOfRatings++;
                        }
                        
                        echo "</div>";
                    }
                }
                echo '</div>';
                
                if($numOfRatings != 0 ) {
                    $rating /= $numOfRatings;
                }else {
                    $rating = 0;
                }
                
                echo "<div class='form'>Average Rating: ".$rating." / 5</div>";
                
                $myRating = 0;
                foreach($photos as $photo) {
                    if($_SESSION['user_session'] == $photo->getOwner()) {
                        $myRating = $photo->getRating();
                    }    
                }
                echo "<div class='form'>Your Rating: ".$myRating." / 5</div>";
                
                
                
                
                if($_SESSION['user_session'] == $powner) {
                    echo '<button id="changeContr0" type="button">Αλλαγή εφέ 1</button>';
                    echo '<button id="changeContr1" type="button">Αλλαγή εφέ 2</button>';
                    echo '<button id="changeContr2" type="button">Αλλαγή εφέ 3</button>';
                    echo '<button id="changeContr3" type="button">Αλλαγή εφέ 4</button>';
                    echo '<button id="changeContr4" type="button">Αλλαγή εφέ 5</button>';
                }
                
            }
            
            
            ?>
            
        </section>
        <script type="text/javascript" src="photo.js"></script>
    </body>
</html>
