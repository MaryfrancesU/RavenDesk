<?php

    //include '/home/mumeora/dbconfig.php';
    include '../scripts/dbconfig.php';

    $charid =  $_SESSION["charid"];
    $charQuery = "SELECT name FROM characters WHERE id='$charid';";
    $infoQuery = "SELECT alias, age, description, personality, backstory FROM char_basic_info WHERE id='$charid';";
    $looksQuery = "SELECT eyes, hair, body, clothing, other FROM char_appearance WHERE id='$charid';";

    $result1 = mysqli_query($conn, $charQuery);
    $result2 = mysqli_query($conn, $infoQuery);
    $result3 = mysqli_query($conn, $looksQuery);
    $character = mysqli_fetch_all($result1, MYSQLI_ASSOC)[0];
    $basicinfo = mysqli_fetch_all($result2, MYSQLI_ASSOC)[0];
    $appearance = mysqli_fetch_all($result3, MYSQLI_ASSOC)[0];
    
    $name = $character['name'];
    $personality = $basicinfo['personality'];
    $backstory = $basicinfo['backstory'];
    $alias = $basicinfo['alias'];
    $age = $basicinfo['age'];
    $description = $basicinfo['description'];
    $eyes = $appearance['eyes'];
    $hair = $appearance['hair'];
    $body = $appearance['body'];
    $clothing = $appearance['clothing'];
    $other = $appearance['other'];


    if ($age !== NULL){ $ageDisplay = $age;}
        else { $ageDisplay = "24";}
    
    if ($alias !== NULL){ $aliasDisplay = $alias;}
        else { $aliasDisplay = "e.g The Silver Alchemist";}
    
    if ($eyes !== NULL){ $eyesDisplay = $eyes;}
        else { $eyesDisplay = "color, shape... ";}
    
    if ($hair !== NULL){ $hairDisplay = $hair;}
        else { $hairDisplay = "color, length, style...";}
    
    if ($body !== NULL){ $bodyDisplay = $body;}
        else { $bodyDisplay = "height, weight, build...";}

    if ($description !== NULL){$descDisplay = $description;}
    else{
        $descDisplay = "A short description of this character e.g This character is the younger sister of Robin Hood";
    }

    if ($clothing !== NULL){$clothDisplay = $clothing;}
    else{
        $clothDisplay = " Typical attire";
    }

    if ($other !== NULL){$otherDisplay = $other;}
    else{
        $otherDisplay = " Has a star shaped tattoo under left eye";
    }

    if ($personality !== NULL){$persDisplay = $personality;}
    else{
        $persDisplay = " Cool calm and collected";
    }

    if ($backstory !== NULL){$backDisplay = $backstory;}
    else{
        $backDisplay = " Was found under the roof of the nunnery ";
    }

    //Get img id of current character
    $query2 = "SELECT img_id FROM characters WHERE id='$charid';";
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

        <div id="character-grid-container">
            <div id="item1">
                
                <?php
                    if ($imgId === NULL){ 
                        $buttontext = "Upload";?>
                        <div class="nocharimg">
                            Choose an image for this character.
                        </div>
                <?php }
                    else {
                        $buttontext = "Update";
                        $imageSrc = "../uploads/".$imgName;
                        echo "<img class='charimg' src='$imageSrc'/>";
                    }
                ?>

                <div class="grid-img">
                    <form method="POST" action="../scripts/addcharimg.inc.php" enctype="multipart/form-data">
                        <input type="file" name="charImg" required/>
                        <button type="submit" name="submitImg"> <?php echo $buttontext; ?> </button>
                    </form>
                </div>
            </div>

            <div id="info"> 
                <input 
                    class="h3input" 
                    value="<?php echo $name; ?>" 
                    onchange="updateCharacter(<?php echo $charid ?>, 'name', event)"
                /> <br>
                 
                <p  style="display: inline"> &nbsp;&nbsp; Aliases: &nbsp; </p> 
                <input 
                    class="pinput" 
                    value="<?php echo $aliasDisplay; ?>"
                    onchange="updateCharacter(<?php echo $charid ?>, 'alias', event)"
                /> <br>
            
                <p style="display: inline"> &nbsp;&nbsp; Age: &nbsp; &nbsp; &nbsp; &nbsp;</p> 
                <input 
                    class="pinput" 
                    type="number" 
                    value="<?php echo $ageDisplay; ?>" 
                    onchange="updateCharacter(<?php echo $charid ?>, 'age', event)"
                /> 
                
                <textarea 
                    class="mtextarea"
                    onchange="updateCharacter(<?php echo $charid ?>, 'description', event)"><?php echo $descDisplay; ?> 
                </textarea>
            </div>
            
            <div id="appearance1"> 
                <h3 style="margin: 0px;"> Appearance </h3>

                <div class="label-input"> 
                    <p> Eyes: &nbsp; </p> 
                    <input 
                        class="pinput" 
                        value="<?php echo $eyesDisplay; ?>" 
                        onchange="updateCharacter(<?php echo $charid ?>, 'eyes', event)"
                    /> 
                </div>

                <div class="label-input"> 
                    <p> Hair: &nbsp; </p> 
                    <input 
                        class ="pinput" 
                        value="<?php echo $hairDisplay; ?>" 
                        onchange="updateCharacter(<?php echo $charid ?>, 'hair', event)"
                    />
                </div>

                <div class="label-input"> 
                    <p> Body: &nbsp; </p> 
                    <input 
                        class="pinput" 
                        value="<?php echo $bodyDisplay; ?>"
                        onchange="updateCharacter(<?php echo $charid ?>, 'body', event)"
                    />
                </div>
            </div>

            <div id="appearance2"> 
                <h3 style="margin: 0px; visibility: hidden;"> Appearance </h3>

                <p style="margin-bottom: 0px;"> Clothing </p>
                <textarea 
                    class="stextarea"
                    onchange="updateCharacter(<?php echo $charid ?>, 'clothing', event)"><?php echo $clothDisplay; ?>
                </textarea>

                <p style="margin: 0px;"> Other </p>
                <textarea 
                    class="mtextarea"
                    onchange="updateCharacter(<?php echo $charid ?>, 'other', event)"><?php echo $otherDisplay; ?>
                </textarea>
                

            </div>

            <div id="personality"> 
                <h3 style="margin: 0px;"> Personality </h3>
                <textarea 
                    class="ltextarea"
                    onchange="updateCharacter(<?php echo $charid ?>, 'personality', event)"><?php echo $persDisplay; ?> 
                </textarea>
            </div>

            
            <div id="backstory"> 
                <h3 style="margin: 0px;"> Backstory </h3>
                <textarea 
                    class="ltextarea"
                    onchange="updateCharacter(<?php echo $charid ?>, 'backstory', event)"><?php echo $backDisplay; ?>
                </textarea>
            </div>
        </div>

    </body>
</html>
