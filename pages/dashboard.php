<?php
    //include '/home/mumeora/dbconfig.php';
    include '../scripts/dbconfig.php';

    if (!isset($_SESSION["userid"])){
        header("location:../index.php?error=notloggedin");
    }

    //get projects where user id = session's user
    $curruserid = $_SESSION["userid"];
    $query = "SELECT id, name FROM projects WHERE user_id='$curruserid';";
    $result = mysqli_query($conn, $query);
	$userProjects = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
			    foreach($userProjects as $project) {
                    $projlink = "./project.php?pid=".$project['id'];
                    ?>
                    
                    <div onclick="location.href='<?php echo $projlink;?>'">
                        <?php echo htmlspecialchars($project['name'])?>
                    </div>
                <?php }
		    ?>
        </div>


        <div id="addProjectModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('addProjectModal')"> &times; </span>
                
                <form method="post" action="../scripts/addproject.inc.php">
                    <input name="projectName" required placeholder="Project Name"/>
                    <button type="submit" name="submit"> </button>
                </form>
            </div>
        </div>
    
        
    </body>


</html>
