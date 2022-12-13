<?php

	//include '/home/mumeora/dbconfig.php';
    include '../dbconfig.php';


	//VALIDATION
	if (isset($_POST['submitLogin'])) {
		$email = $_POST["emailLogin"];
		$password = $_POST["passLogin"];

		require_once 'authfunctions.inc.php';

		loginUser($conn, $email, $password);

	}
	else {
		header("location:../../index.php?error=nosubmit?");
	}