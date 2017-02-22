<?php
/*
 * password_process.php
 * 
 * Copyright 2015 craig <craig@CUBE>
 * 
 * 
 * 
 */
include ('../includes/header2.php');

if (isset($_POST['submitted'])) {
	require_once ('../includes/mysqli_connect.php'); // Connect to the db.
	$errors = array(); // Initialize error array.
	// Check for an email address.
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}
	// Check for a password.
	if (empty($_POST['password'])) {
		$errors[] = 'You forgot to enter your password.';
	} else {
		$p = mysqli_real_escape_string($dbc, $_POST['password']);
	}
	
		// Check for a second password.
	if (empty($_POST['password2'])) {
		$errors[] = 'You forgot to confirm your password.';
	} else {
		$p2 = mysqli_real_escape_string($dbc, $_POST['password2']);
	}
	
	if ($p != $p2)
	{
		
		$errors[] = 'These passwords do not match.';
	}
	else
	{
		
	}
	$password = 
	
	
	if (empty($errors)) { // If everything's OK.
		/* Retrieve the user_id and first_name for 
		that email/password combination. */
		$query = "SELECT * FROM users WHERE email='$e' AND pass='$p'"; 
		$result =  mysqli_query($dbc, $query); // Run the query.
		$row = mysqli_fetch_array ($result, MYSQL_NUM);
		if ($row) { // A record was pulled from the database.
			//Set the session data:
			session_start(); 
			$_SESSION['user_id'] = $row[0];
			$_SESSION['first_name'] = $row[3];
			$_SESSION['last_name'] = $row[4];
			$_SESSION['email'] = $row[1]; 
			$_SESSION['role'] = $row[5]; 
			
			// Redirect:
			header("Location:index.php");
			exit(); // Quit the script.
			
			
		} else { // No record matched the query.
			$errors[] = 'The email address and password entered do not match those on file.'; // Public message.
		}
	} // End of if (empty($errors)) IF.
	mysqli_close($dbc); // Close the database connection.
} else { // Form has not been submitted.
	$errors = NULL;
} // End of the main Submit conditional.

// Begin the page now.

if (!empty($errors)) { // Print any error messages.
	echo '<div class="alert alert-danger"><strong>Error!</strong><br />
	The following error(s) occurred:<br />';
	foreach ($errors as $msg) { // Print each error.
		echo " - $msg<br />\n";
	}
	echo 'Please try again.</div>';

include ('../includes/footer.php');
?>
