<?php
    //include '/home/mumeora/dbconfig.php';
    include 'scripts/dbconfig.php';
?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <title> The Raven Desk </title>
    <link rel="stylesheet" href="style/main.css"/>
  </head>


  <body>
    <div class="stars"> </div>

    <div class="header-row">
        <img id="logo" src="style/img/logo.png">
        <h1> The Raven Desk </h1>
    </div>

    <div class="index-container">

        <div class="row">
            <div class="formbox">
                <form method="post" action="scripts/auth/createuser.inc.php">
                    <h3> Sign Up </h3>
                    
                    <input type="email" name="emailSignup" required placeholder="Email"> 
                    <input type="password" name="passSignup" required placeholder="Password"> 
                    <input type="password" name="confSignup" required placeholder="Confirm Password"> 

                    <button type="submit" name="submitSignup"> Sign Up </button>

                    <?php
                        if (isset($_GET["error"])){
                            if ($_GET["error"] == "emailtaken"){
                                echo "<p class='authError'> Email taken </p>";
                            }
                            else if ($_GET["error"] == "passwordmismatch"){
                                echo "<p class='authError'> Passwords don't match </p>";
                            }
                            else if ($_GET["error"] == "custmtfailed" or $_GET["error"] == "etstmtfailed"){
                                echo "<p class='authError'> Something went wrong, try again. </p>";
                            }
                        }
	                ?>
                </form>
            </div>

            <div class="formbox">
                <form method="post" action="scripts/auth/loginuser.inc.php">
                    <h3> Log In </h3>

                    <input type="email" name="emailLogin" required placeholder="Email">
                    <input type="password" name="passLogin" required placeholder="Password">

                    <button type="submit" name="submitLogin"> Log In </button>

                    <?php
                        if (isset($_GET["error"])){
                            if ($_GET["error"] == "emailerr"){
                                echo "<p class='authError'> Email doesn't exist </p>";
                            }
                            else if ($_GET["error"] == "passerr"){
                                echo "<p class='authError'> Incorrect login </p>";
                            }
                        }
	            ?>
                </form>
                
            </div>

        </div> <!-- end of row class-->

    </div> <!-- end of index container -->

  </body>
</html>