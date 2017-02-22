<?php 

echo ('
<input type="text" class="awesomplete" id="film" data-minchars="1" data-maxitems="100" placeholder="Film Title" list="filmList">
<datalist id="filmList">
');
  require_once ('../includes/mysqli_connect.php'); // Connect to the db.
  	$query_cat = "SELECT * FROM catalog"; 
  	$result_cat =  mysqli_query($dbc, $query_cat); // Run the query.
	
  	while($row = mysqli_fetch_array($result_cat))
  	{	
	echo '<option>' . $row['title'] . '</option>';
	}

  //	mysqli_close($dbc);
	
	  
echo ('	  
 </datalist>
  ');
  ?>