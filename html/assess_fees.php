<?php 

//var_dump($_GET);


	if($_GET['briefcase'] = '12345')
	{
	require_once ('../includes/mysqli_connect.php'); // Connect to the db.
	
		
	$query = "SELECT user_id, UNIX_TIMESTAMP(due_date) AS due FROM transactions WHERE checked_in = 0"; 
  	$result =  mysqli_query($dbc, $query); // Run the query.
	
	//$r = array();
	//$id = 0;
	$cur_time = time();
	
  	while($row = mysqli_fetch_array($result))
  	{
		
		echo $row['due'];
		echo '<br>';
		echo $cur_time;
		echo '<br>';
		
		if ($row['due'] < $cur_time)
		{
		$q2 = "UPDATE customers SET late_fees = late_fees + 1 WHERE user_id = " .  $row['user_id'];
		$r2 = mysqli_query($dbc, $q2); // Run the query.
	
	
		}
	}
	
	}
	

?>