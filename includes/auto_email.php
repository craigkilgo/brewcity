<?php 

echo ('
<input id="email" type="email" name="email" class="awesomplete" data-minchars="1" data-maxitems="100" placeholder="Enter customer email" list="emailList">
<datalist id="emailList">
');
  require_once ('../includes/mysqli_connect.php'); // Connect to the db.
  	$query_email = "SELECT * FROM customers"; 
  	$result_email =  mysqli_query($dbc, $query_email); // Run the query.
	
  	while($row = mysqli_fetch_array($result_email))
  	{	
	echo '<option>' . $row['email'] . '</option>';
	}

  //	mysqli_close($dbc);
	
	  
echo ('	  
 </datalist>
  ');
  ?>