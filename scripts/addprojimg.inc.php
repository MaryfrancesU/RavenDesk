<?php

    //include '/home/mumeora/dbconfig.php';
    include './dbconfig.php';

    if (isset($_POST['submitImg'])){
        $file = $_FILES["projImg"];

        $fileName = $_FILES["projImg"]["name"];
        $fileTmpName = $_FILES["projImg"]["tmp_name"];
        $fileSize = $_FILES["projImg"]["size"];
        $fileError = $_FILES["projImg"]["error"];
        $fileType = $_FILES["projImg"]["type"];

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

                    //Get id of inserted img and associate it to blurb of current project
                    $currProjId = $_SESSION["projid"];
                    $insertedImgId = mysqli_insert_id($conn);
                    $query2 = "UPDATE projects SET img_id='$insertedImgId' WHERE id='$currProjId'";
                    mysqli_query($conn, $query2);

                    //Redirect
                    header("Location: ../pages/blurb.php");
                }
                else{
                    echo '<script>
                        window.confirm("Your file is too big.");
                        window.location = "../pages/blurb.php";        
                    </script>';
                }    
            }
            else{
                echo '<script>
                    window.confirm("There was an error uploading your file.");
                    window.location = "../pages/blurb.php";        
                </script>';
            }
        }
        else{
            echo '<script>
                window.confirm("You cannot upload files of this type.");
                window.location = "../pages/blurb.php";        
            </script>';
            
        }
    }
?>