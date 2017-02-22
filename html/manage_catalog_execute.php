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
	
//	var_dump($_POST); 
	
	
		// Check for title
	if (empty($_POST['title'])) {
		$errors[] = 'Title not found.';
	} else {
		$title = mysqli_real_escape_string($dbc, trim($_POST['title']));
	}

		// Check for a film id
	if (empty($_POST['film_id'])) {
		$errors[] = 'Film ID not found.';
	} else {
		$film_id = mysqli_real_escape_string($dbc, trim($_POST['film_id']));
	}


	$year = mysqli_real_escape_string($dbc, trim($_POST['year']));
	$quantity = mysqli_real_escape_string($dbc, trim($_POST['quantity']));
	$in_stock = mysqli_real_escape_string($dbc, trim($_POST['in_stock']));
	$director1 = mysqli_real_escape_string($dbc, trim($_POST['director1']));
	$director2 = mysqli_real_escape_string($dbc, trim($_POST['director2']));
	$star1 = mysqli_real_escape_string($dbc, trim($_POST['star1']));	
	$star2 = mysqli_real_escape_string($dbc, trim($_POST['star2']));
	$genre1 = mysqli_real_escape_string($dbc, trim($_POST['genre1']));
	$genre2 = mysqli_real_escape_string($dbc, trim($_POST['genre2']));
	$genre3 = mysqli_real_escape_string($dbc, trim($_POST['genre3']));
	$genre4 = mysqli_real_escape_string($dbc, trim($_POST['genre4']));
	$category = mysqli_real_escape_string($dbc, trim($_POST['category']));
	
	
	
	
	
	if (empty($errors)) 
	{ // If everything's OK.
	
		// Make the query:
		if ($_POST['delete'] == 'DELETE')  //delete request
		{
		$q = "DELETE FROM catalog WHERE film_id ='" . $film_id  . "'";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		
			//logging
				$user = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
				$action = 'Film deleted ' . $title;
				$qlog = "INSERT INTO logs (user_id, action, action_table, action_time) VALUES ('$user', '$action', 'customers', NOW())";		
				$rlog = @mysqli_query ($dbc, $qlog); // Run the query.
				
					echo ('<div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Success!</strong> Film deleted:<br />');
	
		echo ($title . '<br />');
		echo ('Release Year: ' . $year . '<br />');
		echo ('</div>');
		
			
		}
		else  //modify request
		{
		$q = "UPDATE catalog SET title = '" . $title . "', year ='" . $year . "', quantity ='" . $quantity  ."', in_stock='" . $in_stock . "', director1 ='" . $director1 . "', director2 = '" . $director2 . "', star1 = '" . $star1 . "', star2 = '" . $star2 . "', genre1 = '" . $genre1 . "', genre2 = '" . $genre2 ."', genre3 = '" . $genre3 ."', genre4 = '" . $genre4 . "', category = '" . $category . "' WHERE film_id ='" . $film_id  . "'";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
				
				//logging
				$user = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
				$action = 'Film modified: ' . $title;
				$qlog = "INSERT INTO logs (user_id, action, action_table, action_time) VALUES ('$user', '$action', 'customers', NOW())";		
				$rlog = @mysqli_query ($dbc, $qlog); // Run the query.
		
		echo ('<div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Success!</strong> Film modified:<br />');
	
		echo ($title . '<br />');
		echo ('Release Year: ' . $year . '<br />');
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
                            Home</button> </a> <a href="manage_catalog.php"><button class="btn btn-skin" id="manage">
                            Manage Catalog</button></a><br />
</div>



<?php
// Include footer.php
include("../includes/footer.php");
?>
