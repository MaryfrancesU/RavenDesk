<?php
    //include '/home/mumeora/dbconfig.php';
    include './dbconfig.php';


    if (isset($_POST['request'])){

        
        //REFRESH WITHOUT CHANGING TABS
        if ($_POST['request'] === "changeDefaultOpen"){
            $tabName = $_POST['tab'];

            switch($tabName){
                case "blurb":
                    $_SESSION["defaultOpen"] = "btab";
                    break;
                case "plot":
                    $_SESSION["defaultOpen"] = "ptab";
                    break;
                case "characters":
                    $_SESSION["defaultOpen"] = "ctab";
                    break;
                case "world":
                    $_SESSION["defaultOpen"] = "wtab";
                    break;
                case "encyclopedia":
                    $_SESSION["defaultOpen"] = "etab";
                    break;
            }
        }


        //SEND APPROPRIATE ID TO IFRAME
        else if ($_POST['request'] === "forIframe"){
            $group = $_POST['group'];
            $id = $_POST['id'];

            if ($group === "ctablinks"){
                $_SESSION["charid"] = $id;
                echo $id;
            }
            else if ($group === "wtablinks"){
                $_SESSION["locid"] = $id;
                echo $id;
            }
            else if ($group === "etablinks"){
                $_SESSION["encyid"] = $id;
                echo $id;
                // header("location:../pages/encyclopedia.php");
            }
        }


    }
    else{
        header("location:../pages/dashboard.php?error=norequest");
    }
?>