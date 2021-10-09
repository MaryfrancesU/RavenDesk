<?php

	//include '/home/mumeora/dbconfig.php';
    include '../dbconfig.php';


	if (isset($_POST['submitSignup'])) {
		$email = $_POST["emailSignup"];
		$password = $_POST["passSignup"];
		$passwordConfirm = $_POST["confSignup"];

		require_once 'authfunctions.inc.php';


		if (emptyInputSignup($email, $password, $passwordConfirm) !== false){
			header("location:../../index.php?error=emptyinput");
			exit();
		}

		if (emailTaken($conn, $email) !== false){
			header("location:../../index.php?error=emailtaken");
			exit();
		}

		if (passwordMatch($password, $passwordConfirm) !== false){
			header("location:../../index.php?error=passwordmismatch");
			exit();
		}

        
		createUser($conn, $email, $password);

	}
	else {
		header("location:../../index.php?error=nosubmit?");
	}