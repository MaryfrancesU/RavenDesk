<?php
    //include '/home/mumeora/dbconfig.php';
    include '../scripts/dbconfig.php';

    if (!isset($_SESSION["userid"])){
        $loggedIn = false;
    }
    else{
        $loggedIn = true;
    }
?>


<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <title> The Raven Desk </title>
        <link rel="stylesheet" href="../style/main.css"/>
        <script src="../scripts/main.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>


    <body>
        <div class="stars"> </div>
        <div class="nav-row">
            <?php if($loggedIn === true) {
                echo '<a href="../scripts/auth/logoutuser.inc.php"> Logout </a>';
            } ?>
            <div class="header-row">
                <img id="logo" src="../style/img/logo.png" onclick="logo()">
                <h1> Using The Raven Desk </h1>
            </div>
        </div>

        <div id="tutorial-container">
        <div id="toc">
            <h3> Table of Contents </h3>
            <a href="#parts"> Parts of a Project </a> <br>
            <a href="#blurb"> The Blurb Tab </a> <br>
            <a href="#plot"> The Plot Tab </a> <br>
            <a href="#char"> The Characters Tab </a> <br>
            <a href="#loc"> The Locations Tab </a> <br>
            <a href="#ency"> The Encyclopedia Tab </a>
        </div>

        <div id="tutorial-body">
            <h1> Creating a Project </h1>
            <p> A project on The Raven Desk represents a book or series you're working on! magna. Fusce
                lobortis egestas lectussed eleifend. Nullam at pretium nibh. Donec est neque, dictum ut 
                egestas quis, dapibus in massa. Vestibulum vestibulum ullamcorper erat, ac laoreet justo 
                bibendum ut. In sed mattis odio, in consectetur augue. 
            </p>


            <br>
            <h2 id="parts"> Parts of a Project </h2>
            <p> no matter what genre </p>
            <ul>
                <li> Blurb: </li>
                <li> Plot: </li>
                <li> Characters: </li>
                <li> Blurb: </li>
                <li> 
                    Encyclopedia: Maybe there's something that exists in your world that doesn't exist in ours. 
                    Maybe it's a shiny McGuffin or a cool invention. Maybe magic exists in your world and you 
                    want to keep track of the rules. Maybe there's a special word or phrase that means something
                    unique to your story, or maybe you just want to make sure to remember it. No matter what it is,
                    you can write an encyclopedia article about it!
                </li>
            </ul> 
            <p> Confused on how to do any of that? Click on the links on the table of contents, 
                or keep scrolling to find out! </p> 


            <br>
            <h2 id="blurb"> Blurb </h2>
                Meaning
            <h3> character stuff </h3>
            <p> Howdie who </p>
            
            <br>
            <h2 id="plot"> Plot </h2>
                Meaning
            <h3> character stuff </h3>
            <p> Howdie who </p>
            
            <br>
            <h2 id="char"> Characters </h2>
                Meaning
            <h3> character stuff </h3>
            <p> Howdie who </p>
            
            <br>
            <h2 id="loc"> Locations </h2>
                Meaning
            <h3> character stuff </h3>
                <p> Howdie who </p>
            
            <br/>
            <h2 id="ency"> Encyclopedia </h2>
                Meaning
            <h3> character stuff </h3>
                Howdie who
            

        </div>
        </div>


        <button onclick="topFunction()" id="go-top" title="Go to top">Top</button>
        

        <?php 
            if($loggedIn === true) {?>

                <div id="tutorial-footer">
                    <p> Now that you're done learning, get writing! </p> 
                    <button onclick='logo()'> Go to My Dashboard </button>
                </div>
               
            <?php } 
            else{?>
                <div id="tutorial-footer">
                    <p> Now that you're done learning, get writing! </p>
                    <a href="../index.php"> <button> Go to Log In Page </button> </a>
                </div>
            <?php }
        ?>


        <script> 
            window.onscroll = function() {scrollFunction()};
            function scrollFunction() {
                var topButton = document.getElementById("go-top");
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    topButton.style.display = "block";
                } else {
                    topButton.style.display = "none";
                }
            }

            function topFunction() {
                document.body.scrollTop = 0; // For Safari
                document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
            }
        </script>
    </body>
</html>