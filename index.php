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

    <div class="header-row">
        <img id="logo" src="style/img/logo.png">
        <h1> The Raven Desk </h1>
    </div>

    <div class="index-container">

        <div class="row">
            <div class="formbox">
                <form method="post" action="createuser.inc.php">
                    <h3> Sign Up </h3>
                    <!-- <label for="email"> Email </label> -->
                    <input type="email" name="emailSignup" required placeholder="Email"> 

                    <!-- <label for="pass">Password</label> -->
                    <input type="password" name="passSignup" required placeholder="Password"> 

                    <!-- <label for="conf">Confirm Password</label> -->
                    <input type="password" name="confSignup" required placeholder="Confirm Password"> 

                    <button type="submit" name="submitSignup"> Sign Up </button>
                </form>
            </div>

            <div class="formbox">
                <form method="post" action="loginuser.inc.php">
                    <h3> Log In </h3>
                    <!-- <label for="loginEmail"> Email </label> -->
                    <input type="email" name="loginEmail" required placeholder="Email">

                    <!-- <label for="loginPass">Password</label> -->
                    <input type="password" name="loginPass" required placeholder="Password">

                    <button type="submit" name="submit2"> Log In </button>
                </form>
                
            </div>

        </div> <!-- end of row class-->

    </div> <!-- end of index container -->

  </body>
</html>