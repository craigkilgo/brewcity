<?php

require_once ('../includes/mysqli_connect.php'); // Connect to the db.

//$q = mysqli_real_escape_string($dbc, trim($_GET['q']));
//echo $q;


$query = "SELECT * FROM transactions"; 

$transactions = array();

  	$result =  mysqli_query($dbc, $query); // Run the query.
	
  	while($r = mysqli_fetch_array($result))
  	{
		$transactions[] = $r;
  	}
  	
  	
  	//mysqli_close($dbc);
  	
  	
?>
