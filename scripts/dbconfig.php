<?php
    session_start();
    $servername = "localhost";
    $database = "raven_desk";
    $username = "maryf";
    $password = "temppass";
	$conn = mysqli_connect($servername, $username, $password, $database);

	if(!$conn){
		echo 'connection error: ' . mysqli_connect_error();
	}
?>