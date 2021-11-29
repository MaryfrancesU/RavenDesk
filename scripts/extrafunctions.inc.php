<?php
    include '/home/mumeora/dbconfig.php';
    //include './dbconfig.php';


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

            if ($group === "ptablinks"){
                $_SESSION["bookid"] = $id;
                echo $id;
            }
            else if ($group === "ctablinks"){
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


        //RENAME PROJECT
        else if ($_POST['request'] === "rename"){
            $projectId = $_POST['projectid'];
            $newName = $_POST['newname'];
            
            $query = "UPDATE projects SET name=? WHERE id='$projectId'";

            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $query);

            mysqli_stmt_bind_param($stmt, "s", $newName);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

        }


    }
    else{
        header("location:../pages/dashboard.php?error=norequest");
    }
?>