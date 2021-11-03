<?php

    //include '/home/mumeora/dbconfig.php';
    include './dbconfig.php';

    if (isset($_POST['request'])){

        //ADD LOCATION
        if ($_POST['request'] === "add"){
            $name = $_POST['name'];
            $pid = $_SESSION['projid'];
            $sql = "INSERT INTO world(project_id, name) VALUES(?,?);";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("location:../pages/project.php?pid=$pid&error=inStmtFail");
                exit();
            }
    
            mysqli_stmt_bind_param($stmt, "ss", $pid, $name);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }


        //EDIT LOCATION
        else if ($_POST['request'] === "edit"){
            $id = $_POST['id'];
            $newvalue = $_POST['newvalue'];

            if ($_POST['field'] === "name"){
                $query = "UPDATE world SET name=? WHERE id='$id'";
            }
            else if ($_POST['field'] === "type"){
                $query = "UPDATE world SET type=? WHERE id='$id'";
            }
            else if ($_POST['field'] === "description"){
                $query = "UPDATE world SET description=? WHERE id='$id'";
            }
            else if ($_POST['field'] === "location"){
                $query = "UPDATE world SET location=? WHERE id='$id'";
            }
            else if ($_POST['field'] === "other"){
                $query = "UPDATE world SET other=? WHERE id='$id'";
            }

            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $query);

            mysqli_stmt_bind_param($stmt, "s", $newvalue);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            
        }


        else{
            echo "Something went wrong";
        }
    }
    else{
        $pid = $_SESSION["projid"];
        header("location:../pages/project.php?pid=$pid&error=locrequestnotmade");
    }

?>