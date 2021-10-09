<?php
    //include '/home/mumeora/dbconfig.php';
    include '../scripts/dbconfig.php';

    if (!isset($_SESSION["userid"])){
        header("location:../index.php?error=notloggedin");
    }

?>


<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <title> The Raven Desk </title>
        <link rel="stylesheet" href="../style/main.css"/>
    </head>

    <body>
        <div class="nav-row">
            <a href="../scripts/auth/logoutuser.inc.php"> Logout </a>
            <div class="header-row">
                <img id="logo" src="../style/img/logo.png">
                <h1> Projects </h1>
            </div>
        </div>

        <div class="projects-grid-container">
            <div id="item1"> <a href="#">+</a> </div>
            <div> That One Time I Got Reincarnated As A Slime </div>
            <div> Title </div>
            <div> Title </div>
            <div> Title </div>
        </div>
    
        
    </body>


</html>
