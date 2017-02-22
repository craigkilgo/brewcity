<?php
/*
 * get_film_id.php
 * 
 * Copyright 2015 craig <craig@CUBE>
 */
 
 
 
function get_film_id($title)
{

	require_once ('../includes/mysqli_connect.php'); // Connect to the db.
	$errors = array(); // Initialize error array.
	
	
	$qcatalog = "SELECT title, in_stock, category FROM catalog"; 
  	$rcatalog =  mysqli_query($dbc, $qcatalog); // Run the query.
	
	$arr_catalog = array();

while($r = mysqli_fetch_assoc($rcatalog)) 
{
    $arr_catalog[] = $r;
}
	
	
	



}
?>
