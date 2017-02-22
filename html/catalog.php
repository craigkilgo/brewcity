<?php 
session_start();
if($_SESSION['role'] != 'su' AND $_SESSION['role'] != 'manager' AND $_SESSION['role'] != 'employee')
{
header("Location:index.php");
}


// Include header.php
include("../includes/header2.php");
include("../includes/get_json.php");
include("../includes/find_movie.php");

if (isset($_POST['submitted'])) {

	//debugging var_dump($_POST);

	require_once ('../includes/mysqli_connect.php'); // Connect to the db.
	$errors = array(); // Initialize error array.
	
	
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
	
	$category = mysqli_real_escape_string($dbc, trim($_POST['category']));
	
	 $find = find_movie($title);

	 $i = 0;
	 $not_found = 0;
	 
	 while ($i < 9)
	 {
	 if($find['movies'][$i]['year'] == $year)
	 {
	 break;
	
	 }
	 else{$i++;}
	if($i == 9){$not_found = 1;}
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
	 
	 
	 if($not_found)
	 {
		 echo('<div class="alert alert-info">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Error!</strong> Movie not found in Rotten Tomatoes.  Continuing without this data. <br />
	</div>
	');
	}
	else{
	$movie_json = get_json($find['movies'][$i]['id']);
	
	$title = $movie_json['title'];
	include("../includes/get_films.php");
	
	//var_dump($arr_catalog);
	
	$c = 0;
	$end = sizeof($arr_catalog);
	
	while ($c < $end)
	{
		if ($title == $arr_catalog[$c]['title'])
		{
			$errors[] = 'This film is already in the database.  Manage Catalog in order to increase quantity.';
		}
			$c++;
	}
	
	
	
	$genre1 = $movie_json['genres'][0];
	$genre1 = str_replace("&","and",$genre1);
	
	$genre2 = $movie_json['genres'][1];;
	$genre2 = str_replace("&","and",$genre2);
	
	$genre3 = $movie_json['genres'][2];;
	$genre3 = str_replace("&","and",$genre3);
	
	$genre4 = $movie_json['genres'][3];;
	$genre4 = str_replace("&","and",$genre4);
	
	$rt_rating = $movie_json['ratings']['critics_score'];
	
	//echo $rt_rating;
	//echo "<br />";
	//echo $movie_json['ratings']['critics_score'];
	//echo "<br />";
	
	$rt_id = $movie_json['id'];
	$director1 = $movie_json['abridged_directors'][0]['name'];
	$director2 = $movie_json['abridged_directors'][1]['name'];
	$star1 = $movie_json['abridged_cast'][0]['name'];
	$star2 = $movie_json['abridged_cast'][1]['name'];
	
	$thumb = $movie_json['posters']['original'];
	
	}
	
	
	if (empty($errors)) { // If everything's OK.
		
				// Make the query:
		$q = "INSERT INTO catalog (title, director1, director2, star1, star2, quantity, in_stock, category, rt_id, rt_rating, genre1, genre2, genre3, genre4, year, thumb) VALUES ('$title', '$director1', '$director2', '$star1', '$star2', '$quantity', '$in_stock', '$category', '$rt_id', '$rt_rating', '$genre1', '$genre2', '$genre3', '$genre4', '$year', '$thumb')";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
				//logging
				$user = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
				$action = "Catalog addition " . $title . ' ' . $year . ' ' . $quantity . ' ' . $in_stock;
				$qlog = "INSERT INTO logs (user_id, action, action_table, action_time) VALUES ('$user', '$action', 'catalog', NOW())";		
				$rlog = @mysqli_query ($dbc, $qlog); // Run the query.

		echo ('<div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Success!</strong> Your film has been successfully added.<br />');
		echo ($title . ' '  . $year . '<br />');
		echo ('Directed by ' . $director1 . '<br />');
		echo ('Starring ' . $star1 . '<br />');
		echo ('</div>');
		}
	 else { // If it did not run OK.
			
	
		echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>
		<strong>Error!</strong>The following error(s) occurred:<br />';
		
		
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		
		echo ('Please try again.</div>');
		
				mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:
		include("../includes/footer.php");
		exit();
		
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
		echo $msg . "<br />";
	}
	echo ('</div>');}


	
?>

    <section id="catalog" class="home-section text-center">
			<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<div class="section-heading">
					<h2>Add Film</h2>
					</div>
				</div>
			</div>
			</div>
		<div class="container">
			<div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
			<form class="form-horizontal" role="form" action="catalog.php" method="post">
				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="title">Film Title</label>
								<div class="input-group">
							<input type="text" class="form-control" id="title" name="title" placeholder="Title" required="required"></div>
				</div>
				
				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="year">Release Year</label>

								<div class="input-group">
							<input type="text" class="form-control" id="year" name="year" placeholder="Release Year" required="required"></div>

				</div>	
				
        
        				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="quantity">Quantity</label>

								<div class="input-group">
							<input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity Owned" required="required"></div>
				</div>
          
            				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="in_stock">In Stock</label>

								<div class="input-group">
							<input type="text" class="form-control" id="in_stock" name="in_stock" placeholder="Currently in Stock" required="required"></div>
				</div>

				<div class="form-group">
				
<label class="control-label col-sm-3 col-xs-2" for="category">Rental Category</label>
<div class="input-group">
<select id="category" name="category" class="selectpicker form-control" required="required">
	<option value="hit">Current Hit</option>
	<option value="release">Current Release</option>
	<option value="popular">Popular</option>
		<option value="regular">Regular</option>
		</select>
</div>
</div>
				
              

								<div class="input-group col-md-4 col-md-offset-4 col-xs-4 col-xs-offset-4">
								<button type="reset" class="btn btn-skin" id="reset">
                            Reset</button> 
                        <button type="submit" class="btn btn-skin" id="submit">
                            Submit</button>
							<input type="hidden" name="submitted" value="TRUE" />
						</div>

				
			</form>
		</div>
		</div>
</section>



<?php
// Include footer.php
include("../includes/footer.php");
?>
