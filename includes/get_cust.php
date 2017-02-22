<?php 
	require_once ('../includes/mysqli_connect.php'); // Connect to the db.
	$errors = array(); // Initialize error array.
	
	
	$qcust = "SELECT user_id, email, first_name, last_name, late_fees FROM customers"; 
  	$rcust =  mysqli_query($dbc, $qcust); // Run the query.
	
	$arr_cust = array();

while($r = mysqli_fetch_assoc($rcust)) {
    $arr_cust[] = $r;
}
	
	

?>
