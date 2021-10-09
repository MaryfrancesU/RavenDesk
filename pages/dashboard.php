<?php
    //include '/home/mumeora/dbconfig.php';
    include '../scripts/dbconfig.php';

    if (isset($_SESSION["userid"])){
			echo "<p> User with id ".$_SESSION["userid"]." is logged in.";
		}
    else {
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

  <style>
    p{
      color: white;
    }
  </style>

  <body>
    <a href="../scripts/auth/logoutuser.inc.php"> Logout </a>
  </body>


</html>
