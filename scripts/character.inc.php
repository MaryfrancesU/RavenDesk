<?php

    //include '/home/mumeora/dbconfig.php';
    include './dbconfig.php';

    if (isset($_POST['request'])){

        //ADD CHARACTER
        if ($_POST['request'] === "add"){
            $name = $_POST['name'];
            $pid = $_SESSION['projid'];
            $sql = "INSERT INTO characters(project_id, name) VALUES(?,?);";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("location:../pages/dashboard.php?pid=$pid&error=inStmtFail");
                exit();
            }
    
            mysqli_stmt_bind_param($stmt, "ss", $pid, $name);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        else{
            echo "Something went wrong";
        }
    }
    else{
        $pid = $_SESSION["projid"];
        header("location:../pages/project.php?pid=$pid&error=charrequestnotmade");
    }

?>