<?php

    //include '/home/mumeora/dbconfig.php';
    include './dbconfig.php';

    if (isset($_POST['projectid'])){
        $projectId = $_POST['projectid'];

        $query = "DELETE FROM projects WHERE id='$projectId';";
        $result = mysqli_query($conn, $query);
    }
    else{
        header("location:../pages/dashboard.php?error=nosubmit");
    }
?>