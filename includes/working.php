	// Check for a title:
	if (empty($_POST['title'])) {
		$errors[] = 'You forgot to enter a title.';
	} else {
		$title = mysqli_real_escape_string($dbc, trim($_POST['title']));
	}
	
	// Check for a release year
	if (empty($_POST['year'])) {
		$errors[] = 'You forgot to enter a release year.';
	} else {
		$year = mysqli_real_escape_string($dbc, trim($_POST['year']));
	}
	
	// Check for an email address
	if (empty($_POST['quantity'])) {
		$errors[] = 'You forgot to enter a quantity owned of the film.';
	} else {
		$quantity = mysqli_real_escape_string($dbc, trim($_POST['quantity']));
	}
	
		// Check for how many in stock
	if (empty($_POST['in_stock'])) {
		$errors[] = 'You forgot to enter how many are currently in stock.';
	} else {
		$in_stock = mysqli_real_escape_string($dbc, trim($_POST['in_stock']));
	}
	
	$category = mysqli_real_escape_string($dbc, trim($_POST['category']))
	
	 $find = find_movie($title);
	 
	 $i = 0;
	 $not_found = 0;
	 
	 while ($i < 6)
	 {
	 if($find['movies'][$i]['year'] == $year)
	 {
	 break;
	
	 }
	 else{$i++;}
	if($i == 6){$not_found = 1;}
	 }
	 
	 $genre1 = '';
	 $genre2 = '';
	 $genre3 = '';
	 $genre4 = '';
	$rt_rating = 0;
	$rt_id = 0;
	$director1 = '';
	$director2 = '';
	$star1 = '';
	$star2 = '';
	
	
	 
	 $if($not_found)
	 {echo('<div class="alert alert-error">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Error!</strong> Movie not found in Rotten Tomatoes.  Continuing without this data. <br />
	</div>
	');}
	else{
	
	$movie_json = get_json($find['movies'][$i]['id']);
	
	$genre1 = $movie_json['genres'][0];
	$genre2 = $movie_json['genres'][1];;
	$genre3 = $movie_json['genres'][2];;
	$genre4 = $movie_json['genres'][3];;
	$rt_rating = $movie_json['ratings']['critics_score'];
	$rt_id = $movie_json['id'];
	$director1 = $movie_json['abridged_directors'][0]['name'];
	$director2 = $movie_json['abridged_directors'][1]['name'];
	$star1 = $movie_json['abridged_cast'][0]['name'];
	$star2 = $movie_json['abridged_cast'][1]['name'];
	
	};
	
	
		if (empty($errors)) { // If everything's OK.
		
				// Make the query:
		$q = "INSERT INTO catalog (title, director1, director2, star1, star2, quantity, in_stock, category, rt_id, genre1, genre2, genre3, genre4) VALUES ('$title', '$director1', '$director2', '$star1', '$star2', '$quantity', '$in_stock', '$category', '$rt_id', '$genre1', '$genre2', '$genre3', '$genre4')";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
				//logging
				$user = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
				$action = "Catalog addition" . $title . $year . $quantity . $in_stock;
				$qlog = "INSERT INTO logs (user_id, action, action_table, action_time) VALUES ($user, '$action', 'catalog', NOW())";		
				$rlog = @mysqli_query ($dbc, $qlog); // Run the query.
				// Print a message:
				echo ('<div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Success!</strong> Your film has been successfully added.
</div>');
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<div class="alert alert-error">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Error!</strong> A problem has been occurred while submitting your data. <br />
'; 
			
			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p></div>';
						
		} // End of if ($r) IF.
		
		mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:
		exit();
		
	} else { // Report the errors.
	
		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
		
	} // End of if (empty($errors)) IF.
	
	mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.

// Begin the page now.
if (!empty($errors)) { // Print any error messages.
	echo '<div class="alert alert-error">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Error!</strong> A problem has been occurred while submitting your data.<br />
	The following error(s) occurred:<br />
';
	foreach ($errors as $msg) { // Print each error.
		echo "$msg<br />";
	}
	echo '</div>';}