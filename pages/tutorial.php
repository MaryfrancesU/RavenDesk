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
                <h1> The Raven Desk </h1>
            </div>
        </div>

        <div id="tutorial-container">
        <div id="toc">
            <h3> Table of Contents </h3>
            <a href="#parts"> Parts of a Project </a> <br>
            <a href="#blurb"> The Blurb Tab </a> <br>
            <a href="#plot"> The Plot Tab </a> <br>
            <a href="#char"> The Characters Tab </a> <br>
            <a href="#loc"> The World Tab </a> <br>
            <a href="#ency"> The Encyclopedia Tab </a>
        </div>

        <div id="tutorial-body">
            <h1> Welcome to the Raven Desk </h1>
            <p> The Raven Desk is a tool for writers of all types to craft, organize and maintain their work.
                We all know as writers that writing isn't always a glamorous craft. We especially know 
                how hard it can be to keep track of all the information that goes into said craft. Our brains
                come up with the most wonderful ideas, then promptly lose them. Physical notebooks are also prone
                to such external forces as spilling water on them and forgetting them on the coffee table.
                Worry not, The Raven Desk is here to help! It will keep track of everything from major plot points
                to the little character quirks that make your work unique and interesting. So you can spend less
                time trying to shuffle through notes written on restaurant napkins and more time actually writing!
            </p> 

            <br>
            <h1> Raven Desk "Projects" </h1>
            <p> A project on The Raven Desk represents a book or series you're working on! Once you log in,
                just click on the giant purple plus sign to name your project and get started. Don't worry --
                this name can always be changed later. 
                Fusce lobortis egestas lectussed eleifend. Nullam at pretium nibh. Donec est neque, dictum ut 
                egestas quis, dapibus in massa. Vestibulum vestibulum ullamcorper erat, ac laoreet justo 
                bibendum ut. In sed mattis odio, in consectetur augue. 
            </p>


            <h2 id="parts"> Parts of a Project </h2>
            <p> The Raven Desk has determined five major categories for all the information that matters
                to your work, no matter what genre of writer you are. </p>
            <ul>
                <li> 
                    <b> Blurb </b>
                    <ul>
                        <li> 
                            What's the premise of your story? 
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat.
                        </li>
                    </ul>
                </li>

                <li> 
                    <b> Plot </b>
                    <ul>
                        <li> 
                            What happens in your story?
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat.
                        </li>
                    </ul>
                </li>

                <li> 
                    <b> Characters </b>
                    <ul>
                        <li> 
                            A category that needs no introduction-- your characters are the heart and
                            soul of your story! Even if you're writing a nonfiction, 
                            lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat.
                        </li>
                    </ul>
                </li>

                <li> 
                    <b> World </b>
                    <ul>
                        <li> 
                            All the cities, kingdoms, planets, and universes that show up in your 
                            story can be edited in the world tab.
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat.
                        </li>
                    </ul>
                </li>

                <li> 
                    <b> Encyclopedia </b>
                    <ul>
                        <li> 
                            Maybe there's something that exists in your world that doesn't exist in ours. 
                            Maybe it's a shiny McGuffin or a cool invention. Maybe magic exists in your world and you 
                            want to keep track of the rules. Maybe there's a special word or phrase that means something
                            unique to your story, or maybe you just want to make sure to remember it. Write an encyclopedia
                            article about it!
                        </li>
                    </ul>
                </li>
            </ul> 
            <p> Confused on how to do any of that? Click on the links on the table of contents, 
                or keep scrolling to find out! </p> 


            <br>
            <h2 id="blurb"> The Blurb Tab </h2>
            <p> 
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute 
                irure dolor in reprehenderit in voluptate velit. 
            </p>
            <h3> Adding a Book Cover </h3>
            <p> 
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                Adding images throughout the site will be basically the same. 
            </p>
            
            <br>
            <h2 id="plot"> The Plot Tab </h2>
            <p> 
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute 
                irure dolor in reprehenderit in voluptate velit. 
            </p>
            <h3> Adding a Book </h3>
            <p> 
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute 
                irure dolor in reprehenderit in voluptate velit. 
            </p>
            <h3> Adding Plot Points </h3>
            <p> 
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute 
                irure dolor in reprehenderit in voluptate velit. 
            </p>
            <h3> Deleting Plot Points </h3>
            <p> 
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute 
                irure dolor in reprehenderit in voluptate velit. 
            </p>
            
            <br>
            <h2 id="char"> The Characters Tab </h2>
            <p> 
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute 
                irure dolor in reprehenderit in voluptate velit. 
            </p>
            <h3> Adding a Character </h3>
            <p> 
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute 
                irure dolor in reprehenderit in voluptate velit. 
            </p>
            <h3> Importing a Character </h3>
            <p> 
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute 
                irure dolor in reprehenderit in voluptate velit. 
            </p>
            <h3> Editing a Character </h3>
            <p> 
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute 
                irure dolor in reprehenderit in voluptate velit. 
            </p>
            
            <br>
            <h2 id="loc"> The World Tab </h2>
            <p> 
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute 
                irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla 
                pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia 
                deserunt mollit anim id est.
            </p>
            
            <br/>
            <h2 id="ency"> The Encyclopedia Tab </h2>
            <p>  
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute 
                irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla 
                pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia 
                deserunt mollit anim id est.
            </p>
            

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