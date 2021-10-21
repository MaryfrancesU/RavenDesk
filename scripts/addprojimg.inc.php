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
                    move_uploaded_file($fileTmpName, $fileDestination);
                    header("Location: ../pages/blurb.php");
                }
                else{
                    echo "Your file is too big.";
                }    
            }
            else{
                echo "There was an error uploading your file";
            }
        }
        else{
            echo "You cannot upload files of this type";
        }
    }
?>