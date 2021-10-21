<?php

    //include '/home/mumeora/dbconfig.php';
    include './dbconfig.php';

    if (isset($_POST['request'])){

        if ($_POST['request'] === "add"){
            addCharacter($_POST['name']);
        }
        else{
            echo "Something went wrong";
        }
    }
    else{
        $pid = $_SESSION["projid"];
        header("location:../pages/project.php?pid=$pid&error=charrequestnotmade");
    }


    function addCharacter($name){
        echo "Add from func".$name;
    }

?>