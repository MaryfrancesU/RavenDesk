<?php

    include '/home/mumeora/dbconfig.php';
    //include './dbconfig.php';

    if (isset($_POST['submitImg'])){
        $file = $_FILES["encyImg"];

        $fileName = $_FILES["encyImg"]["name"];
        $fileTmpName = $_FILES["encyImg"]["tmp_name"];
        $fileSize = $_FILES["encyImg"]["size"];
        $fileError = $_FILES["encyImg"]["error"];
        $fileType = $_FILES["encyImg"]["type"];

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

                    //Get id of inserted img and associate it to current article
                    $currEncyId = $_SESSION["encyid"];
                    $insertedImgId = mysqli_insert_id($conn);
                    $query2 = "UPDATE encyclopedia SET img_id='$insertedImgId' WHERE id='$currEncyId'";
                    mysqli_query($conn, $query2);

                    //Redirect
                    header("Location: ../pages/encyclopedia.php");
                }
                else{
                    echo '<script>
                        window.confirm("Your file is too big.");
                        window.location = "../pages/encyclopedia.php";        
                    </script>';
                }    
            }
            else{
                echo '<script>
                    window.confirm("There was an error uploading your file.");
                    window.location = "../pages/encyclopedia.php";        
                </script>';
            }
        }
        else{
            echo '<script>
                window.confirm("You cannot upload files of this type.");
                window.location = "../pages/encyclopedia.php";        
            </script>';
            
        }
    }
?>