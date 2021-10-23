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

    //Get img id of current project
    $query2 = "SELECT img_id FROM projects WHERE id='$currprojid';";
    $result2 = mysqli_query($conn, $query2);
    $imgId = mysqli_fetch_all($result2, MYSQLI_ASSOC)[0]["img_id"];

    //Get img name
    $query3 = "SELECT name FROM images WHERE id='$imgId';";
    $result3 = mysqli_query($conn, $query3);
    $imgName = mysqli_fetch_all($result3, MYSQLI_ASSOC)[0]["name"];

?> 


<!DOCTYPE html>
<html>
    <head> 
        <link rel="stylesheet" href="../style/tabs.css"/>
        <script src="../scripts/main.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>

    
    <body>
        <?php
            if ($imgId === NULL){ 
                $buttontext = "Upload";?>
                <div id="nobookcover">
                    Book Cover
                </div>
            <?php }
            else {
                $buttontext = "Update";
                $imageSrc = "../uploads/".$imgName;
                echo "<img id='bookcover' src='$imageSrc'>";
            }
        ?>
        
        <div id="buttonrow">
            <form method="POST" action="../scripts/addprojimg.inc.php" enctype="multipart/form-data">
                <input type="file" name="projImg" required/>
                <button type="submit" name="submitImg"> <?php echo $buttontext; ?> </button>
            </form>
        </div>

        <textarea class="fwtextarea" onchange="updateBlurb(event)"> 
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
