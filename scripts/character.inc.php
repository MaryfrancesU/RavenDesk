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
                header("location:../pages/project.php?pid=$pid&error=inStmtFail");
                exit();
            }
    
            mysqli_stmt_bind_param($stmt, "ss", $pid, $name);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            //Get id of inserted character and set basicinfo and appearance ids
            $insertedCharId = mysqli_insert_id($conn);
            $query2 = "UPDATE characters SET basic_info_id='$insertedCharId' WHERE id='$insertedCharId'";
            $query3 = "UPDATE characters SET appearance_id='$insertedCharId' WHERE id='$insertedCharId'";
            mysqli_query($conn, $query2);
            mysqli_query($conn, $query3);

            //Create basicinfo and appearance entries
            $query4 = "INSERT INTO char_basic_info(id) VALUES('$insertedCharId');";
            $query5 = "INSERT INTO char_appearance(id) VALUES('$insertedCharId');";
            mysqli_query($conn, $query4);
            mysqli_query($conn, $query5);
        }


        //EDIT CHARACTER
        else if ($_POST['request'] === "edit"){
            $id = $_POST['id'];
            $newvalue = $_POST['newvalue'];

            if ($_POST['field'] === "name"){
                $query = "UPDATE characters SET name=? WHERE id='$id'";
            }
            else if ($_POST['field'] === "alias"){
                $query = "UPDATE char_basic_info SET alias=? WHERE id='$id'";
            }
            else if ($_POST['field'] === "age"){
                $query = "UPDATE char_basic_info SET age=? WHERE id='$id'";
            }
            else if ($_POST['field'] === "description"){
                $query = "UPDATE char_basic_info SET description=? WHERE id='$id'";
            }
            else if ($_POST['field'] === "eyes"){
                $query = "UPDATE char_appearance SET eyes=? WHERE id='$id'";
            }
            else if ($_POST['field'] === "hair"){
                $query = "UPDATE char_appearance SET hair=? WHERE id='$id'";
            }
            else if ($_POST['field'] === "body"){
                $query = "UPDATE char_appearance SET body=? WHERE id='$id'";
            }
            else if ($_POST['field'] === "clothing"){
                $query = "UPDATE char_appearance SET clothing=? WHERE id='$id'";
            }
            else if ($_POST['field'] === "other"){
                $query = "UPDATE char_appearance SET other=? WHERE id='$id'";
            }
            else if ($_POST['field'] === "personality"){
                $query = "UPDATE char_basic_info SET personality=? WHERE id='$id'";
            }
            else if ($_POST['field'] === "backstory"){
                $query = "UPDATE char_basic_info SET backstory=? WHERE id='$id'";
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
        header("location:../pages/project.php?pid=$pid&error=charrequestnotmade");
    }

?>