<?php

    //include '/home/mumeora/dbconfig.php';
    include './dbconfig.php';

    if (isset($_POST['request'])){

        //ADD BOOK
        if ($_POST['request'] === "add"){
            $title = $_POST['name'];
            $pid = $_SESSION['projid'];
            $sql = "INSERT INTO books(project_id, title) VALUES(?,?);";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("location:../pages/project.php?pid=$pid&error=inStmtFail");
                exit();
            }
    
            mysqli_stmt_bind_param($stmt, "ss", $pid, $title);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        //ADD PLOT POINT
        else if ($_POST['request'] === "addpp"){
            $content = $_POST['content'];
            $bid = $_SESSION['bookid'];
            $sql = "INSERT INTO plot_points(book_id, content) VALUES(?,?);";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("location:../pages/project.php?pid=$pid&error=inStmtFail");
                exit();
            }
    
            mysqli_stmt_bind_param($stmt, "ss", $bid, $content);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }


        //EDIT BOOK/PLOT POINTS
        else if ($_POST['request'] === "edit"){
            $id = $_POST['id'];
            $newvalue = $_POST['newvalue'];

            if ($_POST['field'] === "title"){
                $query = "UPDATE books SET title=? WHERE id='$id'";
            }
            else if ($_POST['field'] === "pp"){
                $query = "UPDATE plot_points SET content=? WHERE id='$id'";
            }

            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $query);

            mysqli_stmt_bind_param($stmt, "s", $newvalue);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            
        }

        //DELETE PLOT POINT
        else if ($_POST['request'] === "delete"){
            $id = $_POST['id'];

            $delPP = "DELETE FROM plot_points WHERE id='$id';";
            $result = mysqli_query($conn, $delPP);
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