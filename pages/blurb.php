<?php
    //include '/home/mumeora/dbconfig.php';
    include '../scripts/dbconfig.php';

    if (!isset($_SESSION["userid"])){
        header("location:../index.php?error=notloggedin");
    }

    //Get blurb of current project
    $currprojid = $_SESSION["projid"];
    $query = "SELECT blurb FROM projects WHERE id='$currprojid';";
    $result = mysqli_query($conn, $query);
    $blurb = mysqli_fetch_all($result, MYSQLI_ASSOC)[0]["blurb"];

?> 


<!DOCTYPE html>
<html>
    <head> 
        <link rel="stylesheet" href="../style/tabs.css"/>
        <script src="../scripts/main.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>

    
    <body>
        <div id="bookcover">
            Book Cover
        </div>

        <form method="POST" action="../scripts/addprojimg.inc.php" enctype="multipart/form-data">
            <input type="file" name="projImg"/>
            <button type="submit" name="submitImg"> Upload </button>
        </form>

        <textarea id="blurbinput" onchange="updateBlurb(event)"> 
            <?php 
                if($blurb !== NULL){
                    echo $blurb;
                }
                else{
                    echo "Start typing your blurb here...";
                }
            ?>
        </textarea>
       
    </body>

</html>
