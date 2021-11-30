<?php

    include '/home/mumeora/dbconfig.php';
    //include './dbconfig.php';

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


        //IMPORT CHARACTER
        else if ($_POST['request'] === "import"){
            $pid = $_SESSION['projid'];
            $projid = $_POST['projid'];
            $charid = $_POST['charid'];

            $charQuery = "SELECT name, img_id FROM characters WHERE id='$charid';";
            $infoQuery = "SELECT alias, age, description, personality, backstory FROM char_basic_info WHERE id='$charid';";
            $looksQuery = "SELECT eyes, hair, body, clothing, other FROM char_appearance WHERE id='$charid';";

            $result1 = mysqli_query($conn, $charQuery);
            $result2 = mysqli_query($conn, $infoQuery);
            $result3 = mysqli_query($conn, $looksQuery);
            $character = mysqli_fetch_all($result1, MYSQLI_ASSOC)[0];
            $basicinfo = mysqli_fetch_all($result2, MYSQLI_ASSOC)[0];
            $appearance = mysqli_fetch_all($result3, MYSQLI_ASSOC)[0];

            $name = $character['name'];
            $image = $character['img_id'];
            $personality = $basicinfo['personality'];
            $backstory = $basicinfo['backstory'];
            $alias = $basicinfo['alias'];
            $age = $basicinfo['age'];
            $description = $basicinfo['description'];
            $eyes = $appearance['eyes'];
            $hair = $appearance['hair'];
            $body = $appearance['body'];
            $clothing = $appearance['clothing'];
            $other = $appearance['other'];
           
            //Create new character under current project
            if ($image !== NULL){
                $importQuery = "INSERT INTO characters(project_id, name, img_id) VALUES('$pid', '$name', '$image');";
            }
            else{
                $importQuery = "INSERT INTO characters(project_id, name) VALUES('$pid', '$name');";
            }
            mysqli_query($conn, $importQuery);

            //add basic info and appearance id field to characters table
            $insertedCharId = mysqli_insert_id($conn);
            $query1 = "UPDATE characters SET basic_info_id='$insertedCharId', appearance_id='$insertedCharId' WHERE id='$insertedCharId';";
            mysqli_query($conn, $query1);

            //Create basicinfo and appearance entries
            $query2 = "INSERT INTO char_basic_info(id) VALUES('$insertedCharId');";
            $query3 = "INSERT INTO char_appearance(id) VALUES('$insertedCharId');";
            mysqli_query($conn, $query2);
            mysqli_query($conn, $query3);

            //now add all info
            $importInfoQuery = "UPDATE char_basic_info SET alias='$alias', age='$age', description='$description', personality='$personality', backstory='$backstory' WHERE id='$insertedCharId';";
            $importLooksQuery = "UPDATE char_appearance SET eyes='$eyes', hair='$hair', body='$body', clothing='$clothing', other='$other' WHERE id='$insertedCharId';";
            mysqli_query($conn, $importInfoQuery);
            mysqli_query($conn, $importLooksQuery);
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

        //DELETE CHARACTER
        else if ($_POST['request'] === "delete"){
            $id = $_POST['id'];

            $delApp = "DELETE FROM char_appearance WHERE id='$id';";
            $delInfo = "DELETE FROM char_basic_info WHERE id='$id';";
            $delChar = "DELETE FROM characters WHERE id='$id';";
            $result = mysqli_query($conn, $delApp);
            $result = mysqli_query($conn, $delInfo);
            $result = mysqli_query($conn, $delChar);
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
