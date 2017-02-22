<?php 

echo ('
 <script>
  $(function() {
    var availableEmail = [
');
  require_once ('../includes/mysqli_connect.php'); // Connect to the db.
  	$query_email = "SELECT * FROM customers"; 
  	$result_email =  mysqli_query($dbc, $query_email); // Run the query.
	
  	while($row = mysqli_fetch_array($result_email))
  	{	
	echo '"' . $row['email'] . '",';
	}

  	mysqli_close($dbc);
	
	  
echo ('	  
    ];
    $( "#email" ).autocomplete({
      source: availableEmail
    });
  });
  </script>
  ');
  ?>