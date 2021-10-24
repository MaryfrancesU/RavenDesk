<?php

    //include '/home/mumeora/dbconfig.php';
    include '../scripts/dbconfig.php';

    $encyid =  $_SESSION["encyid"];
    $query = "SELECT title, description FROM encyclopedia WHERE id='$encyid';";
    $result = mysqli_query($conn, $query);
    $article = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];
    $title = $article['title'];
    $description = $article['description'];

?>

<!DOCTYPE html>
<html>
    <head> 
        <link rel="stylesheet" href="../style/tabs.css"/>
        <script src="../scripts/main.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>

    <body>
        <input class="h3input" value="<?php echo $title; ?>" onchange="updateArticle(<?php echo $encyid ?>, 'title', event)">

        <textarea class="fwtextarea" onchange="updateArticle(<?php echo $encyid ?>, 'desc', event)"><?php if($description !== NULL){echo $description;}
                else{
                    echo "Start typing here...";
                }
            ?>
        </textarea>
    </body>

</html>
