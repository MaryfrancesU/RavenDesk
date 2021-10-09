<?php
    //include '/home/mumeora/dbconfig.php';
    include '../scripts/dbconfig.php';

    if (!isset($_SESSION["userid"])){
        header("location:../index.php?error=notloggedin");
    }
    else if ($_SESSION["userid"] !== $_SESSION["projuser"]){
         header("location:../pages/dashboard.php?error=noaccess");
    }
    else{
        echo $_GET["pid"]."<br>";
        echo "Proj ID: ".$_SESSION["projid"]."<br>";
        echo "Proj ID Type: ".gettype($_SESSION["projid"])."<br><br>";

        echo "Proj User: ".$_SESSION["projuser"]."<br>";
        echo "Proj User Type: ".gettype($_SESSION["userid"])."<br><br>";
        echo "Proj Name: ".$_SESSION["projname"]."<br>";
    }

?>
