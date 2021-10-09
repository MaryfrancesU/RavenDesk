<?php
    //include '/home/mumeora/dbconfig.php';
    include '../scripts/dbconfig.php';

    if (!isset($_SESSION["userid"])){
        header("location:../index.php?error=notloggedin");
    }

    $titles = array(
        1 => "That One Time I Got Reincarnated As A Slime ",
        2 => "Harry Potter",
        3 => "Red Winter",
        4 => "The Wizard of Oz",
    );

?>


<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <title> The Raven Desk </title>
        <link rel="stylesheet" href="../style/main.css"/>
        <script src="../scripts/main.js"></script>
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
            <div id="item1"> <a onclick="addProject()">+</a> </div>
            <?php 
			    foreach($titles as $title) { ?>
                    <div>
                        <a> <?php echo htmlspecialchars($title)?> </a>
                    </div>
                <?php }
		    ?>
        </div>


        <div id="addProjectModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('addProjectModal')"> &times; </span>
                
                <form method="post" action="fantastic.inc.php">
                    <input placeholder="Project Name"/>
                    <button type="submit"> </button>
                </form>
            </div>
        </div>
    
        
    </body>


</html>
