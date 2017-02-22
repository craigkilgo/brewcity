<?php 
session_start();
if($_SESSION['role'] != 'su' AND $_SESSION['role'] != 'manager' AND $_SESSION['role'] != 'employee')
{
header("Location:index.php");
}


// Include header.php
include("../includes/header2.php");

//var_dump($_POST); debugging 
//echo $_POST['user_id'];

if ($_POST['user_id'] == '')
{
	header("Location:manage_catalog.php");
	}

  require_once ('../includes/mysqli_connect.php'); // Connect to the db.
 	$query = "SELECT * FROM catalog WHERE film_id = " . $_POST['film_id']; 
 	$result =  mysqli_query($dbc, $query); // Run the query.
	
	
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	//var_dump($row);


	?>



    <section class="home-section text-center">
			<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<div class="section-heading">
					<h2>Edit Film</h2>
					
					</div>
				</div>
			</div>
			</div>
		<div class="container">
			<div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
			<form class="form-horizontal" role="form" action="manage_catalog_execute.php" method="post">
				<div class="form-group">

				
								<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="title">Film Title</label>
								<div class="input-group">
							<input type="text" class="form-control" id="title" name="title" value="<?php echo $row['title'];?>">
							
												
								
							</div>
				</div>
				
				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="year">Release Year</label>

								<div class="input-group">
							<input type="text" class="form-control" id="year" name="year" value="<?php echo $row['year'];?>"></div>

				</div>	
				
        
        				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="quantity">Quantity</label>

								<div class="input-group">
							<input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo $row['quantity'];?>"></div>
				</div>
          
            				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="in_stock">In Stock</label>

								<div class="input-group">
							<input type="text" class="form-control" id="in_stock" name="in_stock" value="<?php echo $row['in_stock'];?>"></div>
				</div>
          
		  
		  
            				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="director1">Director 1</label>

								<div class="input-group">
							<input type="text" class="form-control" id="director1" name="director1" value="<?php echo $row['director1'];?>"></div>
				</div>
          

		  
		              				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="director2">Director 2</label>

								<div class="input-group">
							<input type="text" class="form-control" id="director2" name="director2" value="<?php echo $row['director2'];?>"></div>
				</div>
          

		  
		              				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="star1">Star 1</label>

								<div class="input-group">
							<input type="text" class="form-control" id="star1" name="star1" value="<?php echo $row['star1'];?>"></div>
				</div>
          

		              				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="star2">Star 2</label>

								<div class="input-group">
							<input type="text" class="form-control" id="star2" name="star2" value="<?php echo $row['star2'];?>"></div>
				</div>
          
		  
		  		              				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="genre1">Genre 1</label>

								<div class="input-group">
							<input type="text" class="form-control" id="genre1" name="genre1" value="<?php echo $row['genre1'];?>"></div>
				</div>
          

		  		              				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="genre2">Genre 2</label>

								<div class="input-group">
							<input type="text" class="form-control" id="genre2" name="genre2" value="<?php echo $row['genre2'];?>"></div>
				</div>
				
						  		              				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="genre3">Genre 3</label>

								<div class="input-group">
							<input type="text" class="form-control" id="genre3" name="genre3" value="<?php echo $row['genre3'];?>"></div>
				</div>
				
				
						  		              				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="genre4">Genre 4</label>

								<div class="input-group">
							<input type="text" class="form-control" id="genre4" name="genre4" value="<?php echo $row['genre4'];?>"></div>
				</div>


				
<label class="control-label col-sm-3 col-xs-2" for="category">Rental Category</label>
<div class="input-group">
<select id="category" name="category" class="selectpicker form-control">
	<option value="hit"<?php if ($row['category'] == 'hit'){echo ' selected="selected"';}?>>Current Hit</option>
	<option value="release"<?php if ($row['category'] == 'release'){echo ' selected="selected"';}?>>Current Release</option>
	<option value="popular"<?php if ($row['category'] == 'popular'){echo ' selected="selected"';}?>>Popular</option>
		<option value="regular"<?php if ($row['category'] == 'regular'){echo ' selected="selected"';}?>>Regular</option>
		</select>
</div>
</div>
				
				
				<div class="form-group">
					<label class="control-label col-sm-3 col-xs-2" for="del">Delete</label>

								<div class="input-group">
							<input type="text" size="60" class="form-control" id="delete" name="delete" placeholder="To delete this film, type 'DELETE' and Modify">
							
								</span>
								</div>
				</div>				
			

				<div class="form-group">
								<div class="input-group col-md-4 col-md-offset-4 col-xs-4 col-xs-offset-4">
							<input type="hidden" name="submitted" value="TRUE" />
							<input type="hidden" name="film_id" value="<?php echo $_POST['film_id']; ?>" />	
                        <button type="submit" class="btn btn-skin" id="submit">
                            Modify</button>
		
						</div>
					</div>	

				
			</form>
		</div>
		</div>
</section>





<?php
// Include footer.php
include("../includes/footer.php");
?>
