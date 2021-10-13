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
    
    $_SESSION["projuser"] = intval($currentProject[0]['user_id']);
    $_SESSION["projname"] = $currentProject[0]['name'];


    if ($_SESSION["userid"] !== $_SESSION["projuser"]){
        header("location:../pages/dashboard.php?error=noaccess");
    }
    // else{
    //     echo "<br><br>PID from URL: ".$_GET["pid"]."<br><br>";

    //     echo "Proj ID: ".$_SESSION["projid"]."<br>";
    //     echo "Proj ID Type: ".gettype($_SESSION["projid"])."<br><br>";

    //     echo "Curr User: ".$_SESSION["userid"]."<br>";
    //     echo "Curr User Type: ".gettype($_SESSION["userid"])."<br>";
    //     echo "Proj User: ".$_SESSION["projuser"]." (".$_SESSION["useremail"].")<br>";
    //     echo "Proj User Type: ".gettype($_SESSION["projuser"])."<br><br>";
    //     echo "Proj Name: ".$_SESSION["projname"]."<br>";
    // }

?>

<!DOCTYPE html>
<html>
    <head>
        <title> The Raven Desk </title>
        <link rel="stylesheet" href="../style/main.css"/>
        <script src="../scripts/main.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    </head>


    <body>
        <div class="nav-row">
            <a href="../scripts/auth/logoutuser.inc.php"> Logout </a>
            <div class="header-row">
                <img id="logo" src="../style/img/logo.png">
                <h1> <?php  echo $_SESSION["projname"]; ?> </h1>
            </div>
        </div>


        <!-- TAB MENU -->
        <div id="tabmenu">
            <button class="tablinks" onclick="openTab(event, 'blurb')" id="defaultOpen"> Blurb </button>
            <button class="tablinks" onclick="openTab(event, 'blurb')"> Plot </button>
            <button class="tablinks" onclick="openTab(event, 'characters')"> Characters </button>
            <button class="tablinks" onclick="openTab(event, 'blurb')"> World </button>
            <button class="tablinks" onclick="openTab(event, 'blurb')"> Encylopedia </button>
        </div>


        <!-- CHARACTER TAB SUBMENU -->
        <div id="chartab">
            <button class="ctablinks" onclick="openSubTab(event, 'Tokyo')">Tokyo</button>
            <button class="ctablinks" onclick="openSubTab(event, 'Kyoto')">Kyoto</button>
            <button class="ctablinks" onclick="openSubTab(event, 'Osaka')">Osaka</button>
        </div>


        <!-- ALL TAB CONTENT -->
        <div id="blurb" class="tabcontent">
            <iframe src="blurb.php"> </iframe>
        </div>

        <div id="characters" class="tabcontent">
            <iframe src="character.php"> </iframe>
        </div>

        <div id="Tokyo" class="tabcontent">
            <h3>Tokyo</h3>
            <p>Tokyo is the most well-known city in Japan.</p>
        </div>

        <div id="Kyoto" class="tabcontent">
            <h3>Kyoto</h3>
            <p>Kyoto is the former capital of Japan.</p>
        </div>

        <div id="Osaka" class="tabcontent">
            <h3>Osaka</h3>
            <p>Osaka is a city in the south of Japan.</p>
        </div>


        <script>
            document.getElementById("defaultOpen").click();
        </script>
    </body>

</html>
