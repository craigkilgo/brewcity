<?php 
	require_once ('../includes/mysqli_connect.php'); // Connect to the db.
	$errors = array(); // Initialize error array.
	
	
	$qemp = "SELECT user_id, email, first_name, last_name, late_fees FROM customers"; 
  	$remp =  mysqli_query($dbc, $qemp); // Run the query.
	
	$arr_emp = array();

while($r = mysqli_fetch_assoc($remp)) {
    $arr_emp[] = $r;
}
	
	

?>
