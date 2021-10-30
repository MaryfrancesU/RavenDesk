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
                <input class="h3input" value="<?php echo "First Name Last Name"; ?>" onchange=""> <br>
                 
                    <p  style="display: inline"> &nbsp;&nbsp; Aliases: &nbsp; </p> 
                    <input class="pinput" value="e.g The Silver Alchemist"/> <br>
                
                    <p style="display: inline"> &nbsp;&nbsp; Age: &nbsp; &nbsp; &nbsp; &nbsp;</p> 
                    <input class="pinput" type="number" value="24"/> 
                
                <textarea class="mtextarea"> Description</textarea>
            </div>
            
            <div id="appearance1"> 
                <h3 style="margin: 0px;"> Appearance </h3>

                <div class="label-input"> 
                    <p> Eyes: &nbsp; </p> 
                    <input class="pinput" value="color, shape... "/> 
                </div>

                <div class="label-input"> 
                    <p> Hair: &nbsp; </p> 
                    <input class ="pinput" value="color, length, style..."/>
                </div>

                <div class="label-input"> 
                    <p> Body: &nbsp; </p> 
                    <input class="pinput" value="height, weight, build..."/>
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
