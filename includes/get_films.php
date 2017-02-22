<?php 
	require_once ('../includes/mysqli_connect.php'); // Connect to the db.
	$errors = array(); // Initialize error array.
	
	
	$qcatalog = "SELECT film_id, title, in_stock, quantity, category FROM catalog"; 
  	$rcatalog =  mysqli_query($dbc, $qcatalog); // Run the query.
	
	$arr_catalog = array();

while($r = mysqli_fetch_assoc($rcatalog)) 
{
    $arr_catalog[] = $r;
}
	
	

?>
