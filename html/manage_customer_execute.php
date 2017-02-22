<?php 
session_start();
if($_SESSION['role'] != 'su' AND $_SESSION['role'] != 'manager' AND $_SESSION['role'] != 'employee')
{
header("Location:index.php");
}
// Include header.php
include("../includes/header2.php");



if (isset($_POST['submitted'])) {
	
	require_once ('../includes/mysqli_connect.php'); // Connect to the db.
	$errors = array(); // Initialize error array.
	
	//var_dump($_POST); debugging
	
	
		// Check for an email:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter an email.';
	} else {
		$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}

		// Check for a first name
	if (empty($_POST['f_name'])) {
		$errors[] = 'You forgot to enter a first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['f_name']));
	}

	// Check for a last name
	if (empty($_POST['l_name'])) {
		$errors[] = 'You forgot to enter a last name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['l_name']));
	}
	

	$phone = mysqli_real_escape_string($dbc, trim($_POST['phone']));
	$add1 = mysqli_real_escape_string($dbc, trim($_POST['address1']));
	$add2 = mysqli_real_escape_string($dbc, trim($_POST['address2']));
	$city = mysqli_real_escape_string($dbc, trim($_POST['city']));
	$state = mysqli_real_escape_string($dbc, trim($_POST['state']));
	$user_id = mysqli_real_escape_string($dbc, trim($_POST['user_id']));	
	
	
/*	echo "<br>";
	echo $user_id;
	echo $_POST['submitted'];
	echo "<br>";
	echo $_POST['user_id'];
		echo "<br>"; */
		
	if (empty($errors)) 
	{ // If everything's OK.
	
		// Make the query:
		if ($_POST['delete'] == 'DELETE')
		{
		$q = "DELETE FROM customers WHERE user_id ='" . $user_id  . "'";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		
			//logging
				$user = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
				$action = 'Customer deleted ' . $email . ' ' . $fn . ' ' . $ln;
				$qlog = "INSERT INTO logs (user_id, action, action_table, action_time) VALUES ('$user', '$action', 'customers', NOW())";		
				$rlog = @mysqli_query ($dbc, $qlog); // Run the query.
				
					echo ('<div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Success!</strong> Customer deleted:<br />');
	
		echo ($fn . ' '  . $ln . '<br />');
		echo ('Email address: ' . $email . '<br />');
		echo ('</div>');
		
			
		}
		else
		{
		$q = "UPDATE customers SET first_name = '" . $fn . "', last_name ='" . $ln . "', email ='" . $email  ."', phone='" . $phone . "', address1='" . $add1 . "', address2 = '" . $add2 . "', city = '" . $city . "', state= '" . $state . "' WHERE user_id ='" . $user_id  . "'";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
				
				//logging
				$user = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
				$action = 'Customer modified ' . $email . ' ' . $fn . ' ' . $ln;
				$qlog = "INSERT INTO logs (user_id, action, action_table, action_time) VALUES ('$user', '$action', 'customers', NOW())";		
				$rlog = @mysqli_query ($dbc, $qlog); // Run the query.
		
		echo ('<div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Success!</strong> Customer modified:<br />');
	
		echo ($fn . ' '  . $ln . '<br />');
		echo ('Email address: ' . $email . '<br />');
		echo ('</div>');
	}
	
	
	
	
	}
	else  //it didnt go ok, there are errors
	{
	
	
		echo '<div class="alert alert-error"><a href="#" class="close" data-dismiss="alert">&times;</a>
		<strong>Error!</strong>The following error(s) occurred:<br />';
		
		
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		
		echo ('Please try again.</div>');
		
				mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:

	
	
	
	}
	
	
	
	
	
	
	mysqli_close($dbc); // Close the database connection.
} // End of the main Submit conditional.


// Begin the page now.
if (!empty($errors)) { // Print any error messages.
	echo '<div class="alert alert-error">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Error!</strong> A problem has been occurred while submitting your data.<br />
	The following error(s) occurred:<br />
';
	foreach ($errors as $msg) { // Print each error.
		echo $msg . "<br />";
	}
	echo ('</div>');}

?>


			<div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
								<a href="index.php"><button class="btn btn-skin" id="index">
                            Home</button> </a> <a href="manage_customers.php"><button class="btn btn-skin" id="manage">
                            Manage Customers</button></a><br />
</div>



<?php
// Include footer.php
include("../includes/footer.php");
?>
