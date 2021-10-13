<?php

    //include '/home/mumeora/dbconfig.php';
    include './dbconfig.php';

    if (isset($_POST['newblurb'])){
        $newblurb = $_POST['newblurb'];
        $currprojid = $_SESSION["projid"];
        
        $query = "UPDATE projects SET blurb=? WHERE id='$currprojid'";

        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $query);

        mysqli_stmt_bind_param($stmt, "s", $newblurb);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    else{
        header("location:../pages/dashboard.php?error=nosubmit");
    }
?>