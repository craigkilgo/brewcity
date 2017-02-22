<?php 
session_start();
if($_SESSION['role'] != 'su' AND $_SESSION['role'] != 'manager')
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
	
	
	if (empty($errors)) 
	{ // If everything's OK.
	
			// Make the query:
		$q = "INSERT INTO employee (first_name, last_name, email, pass, registration_date, role, phone) VALUES ('$fn', '$ln', '$email', SHA1('temporary12345bcr'), NOW(), 'employee', '$phone')";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
				
				//logging
				$user = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
				$action = 'Employee addition ' . $email . ' ' . $fn . ' ' . $ln;
				$qlog = "INSERT INTO logs (user_id, action, action_table, action_time) VALUES ('$user', '$action', 'employee', NOW())";		
				$rlog = @mysqli_query ($dbc, $qlog); // Run the query.

		echo ('<div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Success!</strong> Employee added:<br />');
	
		echo ($fn . ' '  . $ln . '<br />');
		echo ('Email address: ' . $email . '<br />');
		echo ('</div>');
	
	
	
	

	
	}
	else  //it didnt go ok, there are errors
	{
	
	
		echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>
		<strong>Error!</strong>The following error(s) occurred:<br />';
		
		
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		
		echo ('Please try again.</div>');
		
				mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:
		include("../includes/footer.php");
		exit();
	
	
	
	
	
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

    <section id="employees" class="home-section text-center">
			<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<div class="section-heading">
					<h2>Add Employee</h2>
					
					</div>
				</div>
			</div>
			</div>
		<div class="container">
			<div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
			<form class="form-horizontal" role="form" action="employees.php" method="post">
				<div class="form-group">
					
					<label class="control-label col-sm-3" for="email">Email</label>
								<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
							<input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required="required"></div>
				</div>
				
				<div class="form-group">
					
					<label class="control-label col-sm-3" for="email">First Name</label>

								<div class="input-group">
							<input type="text" class="form-control" id="f_name" name="f_name" placeholder="First Name" required="required"></div>

				</div>	
				
				<div class="form-group">
					
					<label class="control-label col-sm-3" for="email">Last Name</label>
								<div class="input-group">
							<input type="text" class="form-control" id="l_name" name="l_name" placeholder="Last Name" required="required"></div>
				</div>				
			
				<div class="form-group">
					
					<label class="control-label col-sm-3" for="email">Phone</label>

								<div class="input-group">
							<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required="required"></div>
				</div>
			
			
				<div class="form-group">
								<div class="input-group col-md-4 col-md-offset-4 col-xs-4 col-xs-offset-4">
								<button type="reset" class="btn btn-skin" id="reset">
                            Reset</button> 
                        <button type="submit" class="btn btn-skin" id="submit">
                            Submit</button>
							<input type="hidden" name="submitted" value="TRUE" />
						</div>
					</div>	

				
			</form>
		</div>
		</div>
</section>



<?php
// Include footer.php
include("../includes/footer.php");
?>
