<?php # index.php
session_start();
//check session first
if (!isset($_SESSION['email'])){
include ('../includes/header2.php');
}else
{
include ('../includes/header2.php');
}

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
		$password = $p . "bcr";
		$password = sha1($password);
	}
	
	
	
	if (empty($errors)) { // If everything's OK.
		/* Retrieve the user_id and first_name for 
		that email/password combination. */
		$query = "UPDATE employee SET pass = '$password' WHERE email = '$e'";
		$result =  mysqli_query($dbc, $query); // Run the query.


			// Redirect:
			header("Location:index.php");
			exit(); // Quit the script.
			

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


}


?>





    <section id="login" class="home-section text-center">
		<div class="heading-contact">
			<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<div class="wow bounceInDown" data-wow-delay="0.4s">
					<div class="section-heading">
					<h2>Change Password</h2>
					
					</div>
					</div>
				</div>
			</div>
			</div>
		</div>
		<div class="container">

    <div class="row">
      <!--  <div class="col-lg-8"> -->
            <div class="boxed-grey">
                <form id="contact-form" action="change_password.php" method="post">
                <div id="loginbox" class="row">
                   <!-- <div class="col-md-6"> -->
					<div class="centerbox">

					
						
						<div class="form-group">
                            <label for="password">
                               New Password</label>
								<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span>
                                </span>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required="required" /> </div>
                        </div>
                        
                        
                        						<div class="form-group">
                            <label for="password">
                               Confirm Password</label>
								<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span>
                                </span>
                            <input type="password" name="password2" class="form-control" id="password" placeholder="Confirm Password" required="required" /> </div>
                        </div>
                        
                        
                        <div id="hidInput">
						<input type="hidden" name="submitted" value="TRUE" />
						<input type="hidden" name="email" value="<?php echo $_SESSION['email'];?>" />
						</div>
						
						<div class="col-md-12">
                        <button type="submit" class="btn btn-skin pull-right" id="submit">
                            Submit</button>
							
                    </div>
                </div>
				
				</div>
                </form>

				
                    </div>
					</div>
					
	
	

	</div>
	</section>

<?php
include ('../includes/footer.php');
?>
