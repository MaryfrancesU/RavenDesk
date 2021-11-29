<?php

    include '/home/mumeora/dbconfig.php';
    //include './dbconfig.php';

    if (isset($_POST['submitImg'])){
        $file = $_FILES["charImg"];

        $fileName = $_FILES["charImg"]["name"];
        $fileTmpName = $_FILES["charImg"]["tmp_name"];
        $fileSize = $_FILES["charImg"]["size"];
        $fileError = $_FILES["charImg"]["error"];
        $fileType = $_FILES["charImg"]["type"];

        $fileNameSplit = explode('.', $fileName);
        $fileExt = strtolower(end($fileNameSplit));

        $allowed = array('jpg', 'jpeg', 'png');
        if (in_array($fileExt, $allowed)){
            if ($fileError === 0){
                if ($fileSize < 1000000){
                    $fileNameNew = uniqid('', true).".".$fileExt;
                    $fileDestination = "../uploads/".$fileNameNew;

                    //Move image to website's uploads folder
                    move_uploaded_file($fileTmpName, $fileDestination);

                    //Add image to database
                    $query = "INSERT INTO images(name) VALUES('$fileNameNew');";
                    mysqli_query($conn, $query);

                    //Get id of inserted img and associate it to current character
                    $currCharId = $_SESSION["charid"];
                    $insertedImgId = mysqli_insert_id($conn);
                    $query2 = "UPDATE characters SET img_id='$insertedImgId' WHERE id='$currCharId'";
                    mysqli_query($conn, $query2);

                    //Redirect
                    header("Location: ../pages/character.php");
                }
                else{
                    echo '<script>
                        window.confirm("Your file is too big.");
                        window.location = "../pages/character.php";        
                    </script>';
                }    
            }
            else{
                echo '<script>
                    window.confirm("There was an error uploading your file.");
                    window.location = "../pages/character.php";        
                </script>';
            }
        }
        else{
            echo '<script>
                window.confirm("You cannot upload files of this type.");
                window.location = "../pages/character.php";        
            </script>';
            
        }
    }
?>