<?php 
session_start();
if($_SESSION['role'] != 'su' AND $_SESSION['role'] != 'manager' AND $_SESSION['role'] != 'employee')
{
header("Location:index.php");
}


// Include header.php

include("../includes/get_json.php");
include("../includes/find_movie.php");


	require_once ('../includes/mysqli_connect.php'); // Connect to the db.
	$errors = array(); // Initialize error array.
	
	
	$query = "SELECT * FROM catalog"; 
  	$result =  mysqli_query($dbc, $query); // Run the query.
	
  	while($row = mysqli_fetch_array($result))
  	{
	
	if($row['rt_id'] != 0)
	{
	$movie_json = get_json($row['rt_id']);
	
	$query_loop = "UPDATE catalog SET thumb = '" . $movie_json['posters']['original'] . "' WHERE film_id = '" . $row['film_id'] ."'"; 
  	$result_loop =  mysqli_query($dbc, $query_loop); // Run the query.
	

	}
	
	
	}
	


	
	
	

	
	

		
	 
	
	
	
	
	
	
	
	
	
	mysqli_close($dbc); // Close the database connection.
// End of the main Submit conditional.


?>




