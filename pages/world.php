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

    if ($type !== NULL){$typeDisplay = $type;}
    else{
        $typeDisplay = "e.g country, island, kingdom";
    }

    if ($description !== NULL){$descDisplay = $description;}
    else{
        $descDisplay = "This is where our main characters venture on their second quest.";
    }

    if ($loc !== NULL){$locDisplay = $loc;}
    else{
        $locDisplay = "Explain where this is e.g this is an island off the west coast of Anatolia";
    }

    if ($other !== NULL){$otherDisplay = $other;}
    else{
        $otherDisplay = "Anything else you want to mention about this place e.g climate, customs, cuisine, etc";
    }
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
                <div> Image </div>
                <input type="file" id="locImg" name="locImg" />
                <button type="submit" style="display:none"> Submit </button>
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
                    value="<?php echo $typeDisplay; ?>" 
                    onchange="updateLocation(<?php echo $locid ?>, 'type', event)"
                /> <br> <br>
                
                <textarea 
                    class="mtextarea"
                    onchange="updateLocation(<?php echo $locid ?>, 'description', event)"><?php echo $descDisplay; ?> 
                </textarea>
            </div>

            <div id="location">
                <h3 style="margin: 0px;"> Location </h3>
                <textarea 
                    class="fwtextarea"
                    onchange="updateLocation(<?php echo $locid ?>, 'location', event)"><?php echo $locDisplay; ?> 
                </textarea>
            </div>

            <div id="other">
                <h3 style="margin: 0px;"> Other </h3>
                <textarea 
                    class="ltextarea"
                    onchange="updateLocation(<?php echo $locid ?>, 'other', event)"><?php echo $otherDisplay; ?> 
                </textarea> 
            </div>
        </div>

        
    </body>

</html>
