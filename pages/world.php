<?php

    //include '/home/mumeora/dbconfig.php';
    include '../scripts/dbconfig.php';

    $locid =  $_SESSION["locid"];
    $locQuery = "SELECT name, type, description, location, other FROM world WHERE id='$locid';";
    $result = mysqli_query($conn, $locQuery);
    $location = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];

    $name = $location['name'];
    $type = $location['type'];
    $description = $location['description'];
    $loc = $location['location'];
    $other = $location['other'];


    $typePlaceholder = "e.g country, island, kingdom";
    $descPlaceholder= "e.g This is where our main characters venture on their second quest.";
    $locPlaceholder = "Explain where this is e.g this is an island off the west coast of Anatolia";
    $otherPlaceholder = "Anything else you want to mention about this place e.g climate, customs, cuisine, etc";

    //Get img id of current location
    $query2 = "SELECT img_id FROM world WHERE id='$locid';";
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
        <div id="world-grid-container">
            <div id="item1">
                <?php
                    if ($imgId === NULL){ 
                        $buttontext = "Upload";?>
                        <div class="nolocimg">
                            Choose an image for this location.
                        </div>
                <?php }
                    else {
                        $buttontext = "Update";
                        $imageSrc = "../uploads/".$imgName;
                        echo "<img class='locimg' src='$imageSrc'/>";
                    }
                ?>

                <div class="grid-img">
                    <form method="POST" action="../scripts/addlocimg.inc.php" enctype="multipart/form-data">
                        <input type="file" name="locImg" required/>
                        <button class="button-reg" type="submit" name="submitImg"> <?php echo $buttontext; ?> </button>
                    </form>
                </div>
            </div>

            <div id="info">
                <input 
                    class="h3input" 
                    value="<?php echo $name; ?>" 
                    onchange="updateLocation(<?php echo $locid ?>, 'name', event)"
                /> <br>
                
                <p style="display: inline"> &nbsp; Type: &nbsp; &nbsp; &nbsp; &nbsp;</p> 
                <input 
                    class="pinput"  
                    value="<?php if($type !== NULL){echo $type;} ?>" 
                    onchange="updateLocation(<?php echo $locid ?>, 'type', event)"
                    placeholder="<?php echo htmlentities($typePlaceholder);?>"
                /> <br> <br>
                
                <textarea 
                    class="mtextarea"
                    onchange="updateLocation(<?php echo $locid ?>, 'description', event)"
                    placeholder="<?php echo htmlentities($descPlaceholder);?>"
                ><?php if($description !== NULL){echo $description;} ?></textarea>
            </div>

            <div id="location">
                <h3 style="margin: 0px;"> Location </h3>
                <textarea 
                    class="fwtextarea"
                    onchange="updateLocation(<?php echo $locid ?>, 'location', event)"
                    placeholder="<?php echo htmlentities($locPlaceholder);?>"
                ><?php if($loc !== NULL){echo $loc;} ?></textarea>
            </div>

            <div id="other">
                <h3 style="margin: 0px;"> Other </h3>
                <textarea 
                    class="ltextarea"
                    onchange="updateLocation(<?php echo $locid ?>, 'other', event)"
                    placeholder="<?php echo htmlentities($otherPlaceholder);?>"
                ><?php if($other !== NULL){echo $other;} ?></textarea> 
            </div>
        </div>

        <button 
            class="tabs-del-button" 
            onclick="deleteLocation(<?php echo $locid ?>)"
        > Delete </button>

        
    </body>

</html>
