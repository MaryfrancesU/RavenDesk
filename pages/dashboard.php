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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>


    <body>
        <div class="stars"> </div>
        
        <div class="nav-row">
            <a href="../scripts/auth/logoutuser.inc.php"> Logout </a>
            <a href="tutorial.php"> Tutorial </a>
            <div class="header-row">
                <img id="logo" src="../style/img/logo.png" onclick="logo()">
                <h1> Projects </h1>
            </div>
        </div>
  

        <div class="projects-grid-container">
            <div id="item1"> <a onclick="addProject()">+</a> </div>
            <?php 
			    foreach($userProjects as $project) {
                    $projid = $project['id'];
                    $projlink = "./project.php?pid=".$projid; 
                    ?>
                    
                    <div class="item" onclick="location.href='<?php echo $projlink;?>'">
                        <div class="dropdown">
                            <span class="kebab"> &#8942; </span>
                            <div class="dropdown-content">
                                <?php echo "<button onclick='renameProj($projid)'>Rename</button>" ?> <br>
                                <?php echo "<button onclick='deleteProj($projid)'> Delete </button>"; ?>
                            </div>
                        </div>
                        
                        <div class="title">
                            <?php echo htmlspecialchars($project['name'])?>
                        </div>
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

        <div id="renameProjectModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('renameProjectModal')"> &times; </span>
                
                <form onsubmit="renameProj2()">
                    <input id="renamePid" style="display:none;"/>
                    <input id="newProjectName" required placeholder="New Project Name"/>
                    <button type="submit" name="submit"> </button>
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function(){
                $(".dropdown").mouseenter(function(){
                    $(this).children(".dropdown-content").css("display", "block");
                });
                $(".dropdown").mouseleave(function(){
                    $(".dropdown-content").css("display", "none");
                });
            });
        </script> 
    
        
    </body>


</html>
