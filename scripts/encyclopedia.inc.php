<?php

    //include '/home/mumeora/dbconfig.php';
    include './dbconfig.php';


    if (isset($_POST['request'])){

        //ADD ENCYCLOPEDIA ARTICLE
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

        else if ($_POST['request'] === "edit"){
            $id = $_POST['id'];
            $newvalue = $_POST['newvalue'];

            if ($_POST['field'] === "title"){
                $query = "UPDATE encyclopedia SET title=? WHERE id='$id'";
            }
            else if ($_POST['field'] === "desc"){
                $query = "UPDATE encyclopedia SET description=? WHERE id='$id'";
            }

            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $query);

            mysqli_stmt_bind_param($stmt, "s", $newvalue);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        else if ($_POST['request'] === "delete"){
            $id = $_POST['id'];

            $delEncy = "DELETE FROM encyclopedia WHERE id='$id';";
            $result = mysqli_query($conn, $delEncy);
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