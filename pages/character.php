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
                <div> Image </div>
                <input type="file" id="charImg" name="charImg" />
                <button id="hi" type="submit" style="display:none"> Submit </button>
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
                
                <textarea class="mtextarea"> Description</textarea>
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
                <textarea class="stextarea"> Typical attire </textarea>

                <p style="margin: 0px;"> Other </p>
                <textarea class="mtextarea"> Has a star shaped tattoo under left eye </textarea>
                

            </div>

            <div id="personality"> 
                <h3 style="margin: 0px;"> Personality </h3>
                <textarea class="ltextarea"> Cool calm and collected </textarea>
            </div>

            
            <div id="backstory"> 
                <h3 style="margin: 0px;"> Backstory </h3>
                <textarea class="ltextarea"> Was found under the roof of the nunnery </textarea>
            </div>
        </div>

    </body>

    <script>
        $("#charImg").on("change", function(){
            $("#hi").css ("display", "block");
        });

    </script>

</html>
