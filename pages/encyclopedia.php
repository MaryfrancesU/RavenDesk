<?php

    include '/home/mumeora/dbconfig.php';
    //include '../scripts/dbconfig.php';

    $encyid =  $_SESSION["encyid"];
    $query = "SELECT title, description FROM encyclopedia WHERE id='$encyid';";
    $result = mysqli_query($conn, $query);
    $article = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];
    $title = $article['title'];
    $description = $article['description'];

    //Get img id of current article
     $query2 = "SELECT img_id FROM encyclopedia WHERE id='$encyid';";
     $result2 = mysqli_query($conn, $query2);
     $imgId = mysqli_fetch_all($result2, MYSQLI_ASSOC)[0]["img_id"];
 
     //Get img name
     $query3 = "SELECT name FROM images WHERE id='$imgId';";
     $result3 = mysqli_query($conn, $query3);
     $imgName = mysqli_fetch_all($result3, MYSQLI_ASSOC)[0]["name"];

     $encyPlaceholder = "Start typing here...";

?>

<!DOCTYPE html>
<html>
    <head> 
        <link rel="stylesheet" href="../style/tabs.css"/>
        <script src="../scripts/main.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>

    <body>
        <div id="ency-container">
            <div id="ency-item1">
                <?php
                    if ($imgId === NULL){ 
                        $buttontext = "Upload";?>
                        <div class="noencyimg">
                            Choose an image for this article.
                        </div>
                <?php }
                    else {
                        $buttontext = "Update";
                        $imageSrc = "../uploads/".$imgName;
                        echo "<img class='encyimg' src='$imageSrc'/>";
                    }
                ?>

                <div class="grid-img">
                    <form method="POST" action="../scripts/addencyimg.inc.php" enctype="multipart/form-data">
                        <input type="file" name="encyImg" required/>
                        <button class="button-reg" type="submit" name="submitImg"> <?php echo $buttontext; ?> </button>
                    </form>
                </div>
            </div>

            <div id="ency-item2">
                <input class="h3input-2" value="<?php echo $title; ?>" onchange="updateArticle(<?php echo $encyid ?>, 'title', event)">

                <textarea 
                    class="fwtextarea-long" 
                    onchange="updateArticle(<?php echo $encyid ?>, 'desc', event)"
                    placeholder="<?php echo htmlentities($encyPlaceholder);?>"
                ><?php if($description !== NULL){echo $description;}?></textarea>
            </div>
        </div>

        <button 
            class="tabs-del-button" 
            onclick="deleteArticle(<?php echo $encyid ?>)"
        > Delete </button>

    </body>

</html>
