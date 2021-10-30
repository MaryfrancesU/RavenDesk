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


    //Get all project characters
    $charQuery = "SELECT id, name FROM characters WHERE project_id='$currprojid';";
    $charResult = mysqli_query($conn, $charQuery);
	$characters = mysqli_fetch_all($charResult, MYSQLI_ASSOC);


    //Get all project encyclopedia entries, then sort alphabetically
    $encyQuery = "SELECT id, title, description FROM encyclopedia WHERE project_id='$currprojid';";
    $encyResult = mysqli_query($conn, $encyQuery);
	$articles = mysqli_fetch_all($encyResult, MYSQLI_ASSOC);

    $titlearr = array();
    foreach ($articles as $key => $row) {
        $titlearr[$key] = $row['title'];
    }
    array_multisort($titlearr, SORT_ASC, $articles);

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
                <img id="logo" src="../style/img/logo.png" onclick="logo()">
                <h1> <?php  echo $_SESSION["projname"]; ?> </h1>
            </div>
        </div>


        <!-- TAB MENU -->
        <div id="tabmenu">
            <button class="tabbutton tablinks" onclick="openTab(event, 'blurb')" id="btab"> Blurb </button>
            <button class="tabbutton tablinks" onclick="openTab(event, 'plot')" id="ptab"> Plot </button>
            <button class="tabbutton tablinks" onclick="openTab(event, 'characters')" id="ctab"> Characters </button>
            <button class="tabbutton tablinks" onclick="openTab(event, 'world')" id="wtab"> World </button>
            <button class="tabbutton tablinks" onclick="openTab(event, 'encyclopedia')" id="etab"> Encylopedia </button>
        </div>


        <!-- CHARACTER TAB SUBMENU -->
        <div class="subtabmenu" id="chartab">
            <button class="addbutton" onclick="openModal('addCharacterModal')"> + </button>

            <?php
                foreach($characters as $character) { 
                    $charName = $character['name'];
                    $charId = $character['id']; ?>
                    <button class="subtabbutton ctablinks" onclick="openSubTab(event, 'ctablinks', <?php echo $charId ?>)">
                        <?php echo $charName; ?>
                    </button>
                <?php }
            ?>
        </div>

        <!-- WORLD TAB SUBMENU -->
        <div class="submenu" id="worldtab">
        </div>

        <!-- ENCYCLOPEDIA TAB SUBMENU -->
        <div class="subtabmenu" id="encytab">
            <button class="addbutton" onclick="openModal('addEncyclopediaModal')"> + </button>

            <?php
                foreach($articles as $article) { 
                    $title = $article['title'];
                    $articleid = $article['id']; ?>
                    <button class="subtabbutton etablinks" onclick="openSubTab(event, 'etablinks', <?php echo $articleid ?>)">
                        <?php echo $title; ?>
                    </button>
                <?php }
            ?>
        </div>


        <!-- MAJOR TAB CONTENT -->
        <div id="blurb" class="tabcontent">
            <iframe src="blurb.php"> </iframe>
        </div>

        <div id="plot" class="tabcontent">
            <iframe src="plot.php"> </iframe>
        </div>

        <div id="characters" class="tabcontent">
            Welcome to your Characters page!
        </div>

        <div id="world" class="tabcontent">
            <iframe src="world.php"> </iframe>
        </div>

        <div id="encyclopedia" class="tabcontent">
            Welcome to your Encylopedia!
        </div>


        <!-- CHARACTER TAB CONTENT -->
        <?php
            foreach($characters as $character) { 
                $charName = $character['name'];
                $charId = $character['id']; ?>
                <div id=<?php echo $charId;?> class='tabcontent'> 
                    <iframe src="character.php"> </iframe>
                </div>
            <?php }
        ?>


        <!-- ENCYCLOPEDIA TAB CONTENT -->
        <?php
            foreach($articles as $article) { 
                $title = $article['title'];
                $articleid = $article['id']; ?>
                <div id=<?php echo $articleid;?> class='tabcontent'> 
                    <iframe src="encyclopedia.php"> </iframe>
                </div>
            <?php }
        ?>



        <!-- OTHER TAB CONTENT -->
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



        <!-- MODALS -->
        <div id="addCharacterModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('addCharacterModal')"> &times; </span>
                
                <form method="post">
                    <input id="charName" placeholder="Character Name"/>
                    <button type="button" onclick="addCharacter()"> Create </button>
                </form>
            </div>
        </div>

        <div id="addEncyclopediaModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('addEncyclopediaModal')"> &times; </span>
                
                <form method="post">
                    <input id="articleTitle" placeholder="Article Name"/>
                    <button type="button" onclick="addArticle()"> Create </button>
                </form>
            </div>
        </div>
            

        <?php
            if ($_SESSION["defaultOpen"] === "btab"){
                echo "<script> document.getElementById('btab').click(); </script>";
            }
            else if ($_SESSION["defaultOpen"] === "ptab"){
                echo "<script> document.getElementById('ptab').click(); </script>";
            }
            else if ($_SESSION["defaultOpen"] === "ctab"){
                echo "<script> document.getElementById('ctab').click(); </script>";
            }
            else if ($_SESSION["defaultOpen"] === "wtab"){
                echo "<script> document.getElementById('wtab').click(); </script>";
            }
            else {
                echo "<script> document.getElementById('etab').click(); </script>";
            }
        ?>
        
    </body>

</html>
