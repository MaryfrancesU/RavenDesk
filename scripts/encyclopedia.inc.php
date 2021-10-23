<?php

    //include '/home/mumeora/dbconfig.php';
    include './dbconfig.php';

    if (isset($_POST['request'])){

        //ADD ARTICLE
        if ($_POST['request'] === "add"){
            $title = $_POST['title'];
            $pid = $_SESSION['projid'];
            $sql = "INSERT INTO encyclopedia(project_id, title) VALUES(?,?);";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("location:../pages/project.php?pid=$pid&error=inStmtFail");
                exit();
            }
    
            mysqli_stmt_bind_param($stmt, "ss", $pid, $title);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        else{
            echo "Something went wrong";
        }
    }
    else{
        $pid = $_SESSION["projid"];
        header("location:../pages/project.php?pid=$pid&error=norequest");
    }

?>