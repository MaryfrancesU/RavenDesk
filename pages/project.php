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

    
    //Get all projects belonging to user
    $curruserid = intval($currentProject[0]['user_id']);
    $query2 = "SELECT id, name FROM projects WHERE user_id='$curruserid';";
    $result2 = mysqli_query($conn, $query2);
	$userProjects = mysqli_fetch_all($result2, MYSQLI_ASSOC);

    //Get all project books
    $bookQuery = "SELECT id, title FROM books WHERE project_id='$currprojid';";
    $bookResult = mysqli_query($conn, $bookQuery);
	$books = mysqli_fetch_all($bookResult, MYSQLI_ASSOC);

    //Get all project characters
    $charQuery = "SELECT id, name FROM characters WHERE project_id='$currprojid';";
    $charResult = mysqli_query($conn, $charQuery);
	$characters = mysqli_fetch_all($charResult, MYSQLI_ASSOC);

    //Get all project locations
    $worldQuery = "SELECT id, name FROM world WHERE project_id='$currprojid';";
    $worldResult = mysqli_query($conn, $worldQuery);
	$locations = mysqli_fetch_all($worldResult, MYSQLI_ASSOC);

    //Get all project encyclopedia entries
    $encyQuery = "SELECT id, title, description FROM encyclopedia WHERE project_id='$currprojid';";
    $encyResult = mysqli_query($conn, $encyQuery);
	$articles = mysqli_fetch_all($encyResult, MYSQLI_ASSOC);

    //Sort alphabetically
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
        <div class="stars"> </div>
        
        <div class="nav-row">
            <a href="../scripts/auth/logoutuser.inc.php"> Logout </a>
            <a href="tutorial.php"> Tutorial </a>
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
            <button class="tabbutton tablinks" onclick="openTab(event, 'encyclopedia')" id="etab"> Encyclopedia </button>
        </div>


        <!-- PLOT TAB SUBMENU -->
        <div class="subtabmenu" id="plottab">
            <button class="addbutton" onclick="openModal('addBookModal')"> + </button>

            <?php
                foreach($books as $book) { 
                    $bookName = $book['title'];
                    $bookId = $book['id']; ?>
                    <button class="subtabbutton ptablinks" onclick="openSubTab(event, 'ptablinks', <?php echo $bookId ?>)">
                        <?php echo $bookName; ?>
                    </button>
                <?php }
            ?>
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
        <div class="subtabmenu" id="worldtab">
            <button class="addbutton" onclick="openModal('addLocationModal')"> + </button>

            <?php
                foreach($locations as $location) { 
                    $locName = $location['name'];
                    $locId = $location['id']; ?>
                    <button class="subtabbutton wtablinks" onclick="openSubTab(event, 'wtablinks', <?php echo $locId ?>)">
                        <?php echo $locName; ?>
                    </button>
                <?php }
            ?>
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
            <br> Welcome to your plot page! 
            <br> Select a book from the side menu, or click on the purple button to add a new one!
        </div>

        <div id="characters" class="tabcontent">
            <br> Welcome to your characters page! 
            <br> Select a character from the side menu, or click on the purple button to add a new one!
        </div>

        <div id="world" class="tabcontent">
            <br> Welcome to your world page! 
            <br> Select a location from the side menu, or click on the purple button to add a new one!
        </div>

        <div id="encyclopedia" class="tabcontent">
            <br> Welcome to your encyclopedia! 
            <br> Select an article from the side menu, or click on the purple button to add a new one!
        </div>


        <!-- PLOT TAB CONTENT -->
        <?php
            foreach($books as $book) { 
                $bookName = $book['title'];
                $bookId = $book['id']; ?>
                <div id=<?php echo $bookId;?> class='tabcontent'> 
                    <iframe src="plot.php"> </iframe>
                </div>
            <?php }
        ?>


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


        <!-- WORLD TAB CONTENT -->
        <?php
            foreach($locations as $location) { 
                $locName = $location['name'];
                $locId = $location['id']; ?>
                <div id=<?php echo $locId;?> class='tabcontent'> 
                    <iframe src="world.php"> </iframe>
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



        <!-- MODALS -->
        <div id="addBookModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('addBookModal')"> &times; </span>

                <h2> Add Book </h2>
                
                <form method="post">
                    <input id="bookName" placeholder="Book 1"/>
                    <button class="button-reg" type="button" onclick="addBook()"> Create </button>
                </form>
            </div>
        </div>


        <div id="addCharacterModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('addCharacterModal')"> &times; </span>
                
                <h2> Add Character </h2>

                <h4> Create New Character </h4>
                <form method="post">
                    <input id="charName" placeholder="Character Name"/>
                    <button class="button-reg" type="button" onclick="addCharacter()"> Create </button>
                </form>

                <br> <h4> Import Character </h4>
                <select id="imchar" class="modal-dropdown" onchange="importChar('dropdown1')">
                    <option value="none" selected disabled hidden> Choose Project </option>
                    <?php
                    foreach($userProjects as $project) { 
                        $dpname = $project['name'];
                        $dpid = $project['id']; ?>

                        <option value=<?php echo $dpid;?>> 
                            <?php echo $dpname ?>
                        </option>
                    <?php } ?>
                </select>

                <br>
                <?php
                    foreach($userProjects as $project) { 
                        $dpname = $project['name'];
                        $dpid = $project['id']; ?>

                        <select id=<?php echo "imchar".$dpid;?>  style="display: none;" 
                            class="hiddenCharDD modal-dropdown"
                            onchange="importChar('dropdown2')"
                        >
                            <option value="none" selected disabled hidden> Choose Character </option>
                        
                            <?php
                            $imChar = "SELECT id, name FROM characters WHERE project_id='$dpid';";
                            $imcharResult = mysqli_query($conn, $imChar);
                            $imcharacters = mysqli_fetch_all($imcharResult, MYSQLI_ASSOC);

                            foreach($imcharacters as $char) { 
                                $dcname = $char['name'];
                                $dcid = $char['id']; ?>

                                <option value=<?php echo $dcid;?>> <?php echo $dcname ?> </option>
                            <?php } ?>
                        </select>

                    <?php }
                ?>

                <button id="icb" class="button-reg" style="display: none;" type="button" onclick="importChar('import')"> Import </button>


            </div> <!-- end of modal-content -->
        </div> <!-- end of add character modal -->


        <div id="addLocationModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('addLocationModal')"> &times; </span>

                <h2> Add Location </h2>
                
                <form method="post">
                    <input id="locationName" placeholder="Location Name"/>
                    <button class="button-reg" type="button" onclick="addLocation()"> Create </button>
                </form>
            </div>
        </div>

        <div id="addEncyclopediaModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('addEncyclopediaModal')"> &times; </span>

                <h2> Add Encyclopedia Article </h2>
                
                <form method="post">
                    <input id="articleTitle" placeholder="Article Name"/>
                    <button class="button-reg" type="button" onclick="addArticle()"> Create </button>
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
