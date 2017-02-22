<?php

require_once ('../includes/mysqli_connect.php'); // Connect to the db.

$q = mysqli_real_escape_string($dbc, trim($_GET['q']));
//echo $q;


if ($q == "all")
{
	$query = "SELECT thumb, title, year, rt_rating, genre1 FROM catalog";
}
else
{
$query = 'SELECT thumb, title, year, rt_rating, genre1 FROM catalog WHERE genre1 = "' . $q . '" OR genre2 = "'.$q.'" OR genre3 = "'.$q.'" OR genre4 = "'.$q.'" ORDER BY rt_rating DESC'; 
}


  	$result =  mysqli_query($dbc, $query); // Run the query.
	
  	while($row = mysqli_fetch_array($result))
  	{
  		echo "<tr>";
  		echo "<td><img style='height:55px;  width: auto;' src='" . $row['thumb'] . "'></td><td>" . $row['title'] . "</td><td>" . $row['year'] . "</td><td>" . $row['rt_rating'] . "</td>";
		echo "</tr>";
  	}

  	mysqli_close($dbc);
?>
