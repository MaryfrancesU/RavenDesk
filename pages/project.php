<?php
    //include '/home/mumeora/dbconfig.php';
    include '../scripts/dbconfig.php';

    if (!isset($_SESSION["userid"])){
        header("location:../index.php?error=notloggedin");
    }

    //Check to make sure the current user is the owner of the project
    $_SESSION["projid"] = intval($_GET['pid']);
    $currprojid = $_SESSION["projid"];

    $query = "SELECT user_id, name FROM projects WHERE id='$currprojid';";
    $result = mysqli_query($conn, $query);
	$currentProject = mysqli_fetch_all($result, MYSQLI_ASSOC);
    print_r($currentProject);
    
    $_SESSION["projuser"] = intval($currentProject[0]['user_id']);
    $_SESSION["projname"] = $currentProject[0]['name'];


    if ($_SESSION["userid"] !== $_SESSION["projuser"]){
        header("location:../pages/dashboard.php?error=noaccess");
    }
    else{
        echo "<br><br>PID from URL: ".$_GET["pid"]."<br><br>";

        echo "Proj ID: ".$_SESSION["projid"]."<br>";
        echo "Proj ID Type: ".gettype($_SESSION["projid"])."<br><br>";

        echo "Curr User: ".$_SESSION["userid"]."<br>";
        echo "Curr User Type: ".gettype($_SESSION["userid"])."<br>";
        echo "Proj User: ".$_SESSION["projuser"]." (".$_SESSION["useremail"].")<br>";
        echo "Proj User Type: ".gettype($_SESSION["projuser"])."<br><br>";
        echo "Proj Name: ".$_SESSION["projname"]."<br>";
    }

?>
