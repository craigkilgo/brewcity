<?php # index.php
session_start();
//check session first
if (!isset($_SESSION['email'])){
include ('../includes/header2.php');
}else
{
include ('../includes/header2.php');
}
?>





<?php
// Send NOTHING to the Web browser prior to the session_start() line!
// Check if the form has been submitted.
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
		$p = $p . "bcr";
		$p = sha1($p);
	}
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
$page_title = 'Login';
if (!empty($errors)) { // Print any error messages.
	echo '<div class="alert alert-error"><strong>Error!</strong><br />
	The following error(s) occurred:<br />';
	foreach ($errors as $msg) { // Print each error.
		echo " - $msg<br />\n";
	}
	echo 'Please try again.</div>';
}

// Create the form.
?>


    <section id="login" class="home-section text-center">
		<div class="heading-contact">
			<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<div class="wow bounceInDown" data-wow-delay="0.4s">
					<div class="section-heading">
					<h2>Login</h2>
					
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
                <form id="contact-form" action="login.php" method="post">
                <div id="loginbox" class="row">
                   <!-- <div class="col-md-6"> -->
					<div class="centerbox">

                        <div class="form-group">
                            <label for="email">
                                Email Address</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required="required" /></div>
                        </div>
						
						<div class="form-group">
                            <label for="password">
                                Password</label>
								<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span>
                                </span>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required="required" /> </div>
                        </div>
						
						<div class="col-md-12">
                        <button type="submit" class="btn btn-skin pull-right" id="submit">
                            Submit</button>
							<input type="hidden" name="submitted" value="TRUE" />
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
