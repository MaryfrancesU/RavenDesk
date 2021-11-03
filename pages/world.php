<?php

    //include '/home/mumeora/dbconfig.php';
    include '../scripts/dbconfig.php';

    $locid =  $_SESSION["locid"];
    $locQuery = "SELECT name FROM world WHERE id='$locid';";
    $result = mysqli_query($conn, $locQuery);
    $location = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];

    $name = $location['name'];
?>


<!DOCTYPE html>
<html>
    <head> 
        <link rel="stylesheet" href="../style/tabs.css"/>
        <script src="../scripts/main.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>

    <body>
        <input 
            class="h3input" 
            value="<?php echo $name; ?>" 
            onchange=""
        /> <br>
        This is the locations page.
    </body>

</html>
