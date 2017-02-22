<?php 
// Include header.php
include("../includes/header2.php");
// Check if the form has been submitted.
if (isset($_POST['submitted'])) {
	require_once ('../includes/mysqli_connect.php'); // Connect to the db.
	$errors = array(); // Initialize error array.

	// Check for a first name:
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}
	
	// Check for a last name:
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}
	
	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}
	
	// Check for a password and match against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your password did not match the confirmed password.';
		} else {
			$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}
	
	if (empty($errors)) { // If everything's OK.
	
		// Register the user in the database...
		
		// Make the query:
		$q = "INSERT INTO customers (first_name, last_name, email, pass, registration_date, role) VALUES ('$fn', '$ln', '$e', SHA1('$p'), NOW(), 'customer' )";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
				//logging
				$action = "Customer registration " . "$e";
				$qlog = "INSERT INTO logs (user_id, action, action_table, action_time) VALUES ('NA', '$action', 'customers', NOW())";		
				$rlog = @mysqli_query ($dbc, $qlog); // Run the query.
				// Print a message:
				header("Location:index.php");
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
			
			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
						
		} // End of if ($r) IF.
		
		mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:
		include ('../includes/footer.php'); 
		exit();
		
	} else { // Report the errors.
	
		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
		
	} // End of if (empty($errors)) IF.
	
	mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.

// Begin the page now.
if (!empty($errors)) { // Print any error messages.
	echo '<h1>Error!</h1>
	<p>The following error(s) occurred:<br />';
	foreach ($errors as $msg) { // Print each error.
		echo "$msg<br />";
	}
	echo '</p>';
	echo '<p>Please try again.</p>';
}

// Create the form.
?>
    <section id="register" class="home-section text-center">
		<div class="heading-contact">
			<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<div class="wow bounceInDown" data-wow-delay="0.4s">
					<div class="section-heading">
					<h2>Register</h2>
					
					</div>
					</div>
				</div>
			</div>
			</div>
		</div>
		<div class="container">
            <div id="loginbox" class="row">
			<div class="boxed-grey">
			<form id="contact-form" action="register.php" method="post">
			<div class="form-group">
				<label for="email">
                                Email Address</label>
				                <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required="required" /></div>
			</div>
			
								<div class="form-group col-xs-6">
                        <label for="first_name">
                                First Name</label>
								<div class="input-group">
								
                            <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" required="required" /> </div>
                        </div>
						
										<div class="form-group col-xs-6">
                        <label for="last_name">
                                Last Name</label>
								<div class="input-group">
								
                            <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" required="required" /> </div>
                        </div>
						
				<div class="form-group">
                        <label for="pass1">
                                Password</label>
								<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span>
                                </span>
                            <input type="password" name="pass1" class="form-control" id="pass1" placeholder="Password" required="required" /> </div>
                        </div>
						
						<div class="form-group">
                        <label for="pass2">
                                Confirm Password</label>
								<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span>
                                </span>
                            <input type="password" name="pass2" class="form-control" id="pass2" placeholder="Confirm Password" required="required" /> </div>
                        </div>
						
						<div class="form-group">
                        <button type="submit" class="btn btn-skin pull-right" id="submit">
                            Submit</button>
							<input type="hidden" name="submitted" value="TRUE" />
							</div>
						
			</form>

		</div>
		</div>
		</div>
		
		

<?php
// Include footer.php
include("../includes/footer.php");
?>
