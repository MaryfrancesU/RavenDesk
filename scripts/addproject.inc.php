<?php

	//include '/home/mumeora/dbconfig.php';
    include './dbconfig.php';


	if (isset($_POST['submit'])) {
		$projectName = $_POST["projectName"];

		
		//Prepare statement and insert into database
		$sql = "INSERT INTO projects(user_id, name) VALUES(?,?);";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("location:../pages/dashboard.php?error=inStmtFail");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "ss", $_SESSION["userid"], $projectName);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);


		//Grab project id and redirect
		$projid = mysqli_insert_id($conn);
		session_start();
		$_SESSION["projid"] = $projid;
		$_SESSION["projuser"] = $_SESSION["userid"];
		$_SESSION["projname"] = $projectName;

		header("location:../pages/project.php?pid=$projid");

        
    }
    else {
		header("location:../pages/dashboard.php?error=nosubmit?");
	}
?> 