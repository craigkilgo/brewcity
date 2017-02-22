<?php 

// This page lets the user logout.
session_start(); 

// If no session variable exists, redirect the user.
if (!isset($_SESSION['email'])) {
	header("Location: index.php");
	exit(); // Quit the script.
} else { // Cancel the session.
	$_SESSION = array(); // Destroy the variables.
	session_destroy(); // Destroy the session itself.
}



// Print a customized message.
	header("Location: index.php");


?>
