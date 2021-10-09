<?php

	function emptyInputSignup($email, $password, $passwordConfirm){
		$result;
		if(empty($email) || empty($password) || empty($passwordConfirm)){
			$result = true;
		}
		else{
			$result = false;
		}
		return $result;
	}

	function emailTaken($conn, $email){
		$sql = "SELECT * FROM users where email = ?;";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt, $sql)){		//if there is an error with running this query
			header("location:../../index.php?error=etStmtFail");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "s", $email); //# of s corresponds to # of params
		mysqli_stmt_execute($stmt);

		$resultData = mysqli_stmt_get_result($stmt);
		if ($row = mysqli_fetch_assoc($resultData)) { //creating variable while checking
			return $row;
		}
		else{
			$result = false;
			return $result;
		}

		mysqli_stmt_close($stmt);

	}

	function passwordMatch($password, $passwordConfirm){
		$result;
		if ($password !== $passwordConfirm){
			$result = true;
		}
		else{
			$result = false;
		}
		return $result;
	}


	function createUser($conn, $email, $password){
		$sql = "INSERT INTO users(email, password) VALUES(?,?);";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("location:../../index.php?error=cuStmtFail");
			exit();
		}

		$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
		mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPwd);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		//loginUser($conn, $email, $password);
		header("location:../../index.php");
		exit();
	}


	function loginUser($conn, $email, $password){
		$emailExists = emailTaken($conn, $email);

		if ($emailExists === false){
			header("location:../../index.php?error=emailerr");
			exit();
		}

		$pwdHashed = $emailExists["password"];
		$checkPwd = password_verify($password, $pwdHashed);

		if ($checkPwd === false){
			header("location:../../index.php?error=passerr");
			exit();
		}
		else if($checkPwd === true){
			session_start();
			$_SESSION["userid"] = $emailExists["id"];
			header("location:../../index.php");
			exit();
		}
	}