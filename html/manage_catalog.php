<?php 
session_start();
if($_SESSION['role'] != 'su' AND $_SESSION['role'] != 'manager' AND $_SESSION['role'] != 'employee')
{
header("Location:index.php");
}
// Include header.php
include("../includes/header2.php");



?>
<script type="text/javascript">
$(document).ready(function() {
    $('#data_table').dataTable();
} );

</script>



    <section id="catlog" class="home-section text-center">
			<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<div class="section-heading">
					<h2>Manage Catalog</h2>
					
					</div>
				</div>
			</div>
			</div>
			
			
			
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
<table id="data_table" class="display" cellspacing="0" width="100%">
  <thead>
            <tr>
				<th></th>
                <th>Title</th>
				<th>Year</th>
                <th>Director 1</th>
                <th>Director 2</th>
                <th>Star 1</th>
                <th>Star 2</th>
                <th>Quantity</th>
				<th>In Stock</th>
				<th>Rotten Tomatoes Rating</th>
				<th>Rental Category</th>
				<th>Genre 1</th>
				<th>Genre 2</th>
				<th>Genre 3</th>
				<th>Genre 4</th>
				<th>Edit</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
				<th></th>
                <th>Title</th>
				<th>Year</th>
                <th>Director 1</th>
                <th>Director 2</th>
                <th>Star 1</th>
                <th>Star 2</th>
                <th>Quantity</th>
				<th>In Stock</th>
				<th>Rotten Tomatoes Rating</th>
				<th>Rental Category</th>
				<th>Genre 1</th>
				<th>Genre 2</th>
				<th>Genre 3</th>
				<th>Genre 4</th>
				<th>Edit</th>
            </tr>
        </tfoot>
 
        <tbody>
<?php
    require_once ('../includes/mysqli_connect.php'); // Connect to the db.
  	$query = "SELECT * FROM catalog"; 
  	$result =  mysqli_query($dbc, $query); // Run the query.
	
  	while($row = mysqli_fetch_array($result))
  	{
  		echo "<tr>";
  		echo "<td><img src='" . $row['thumb'] . "'></td><td>" . $row['title'] . "</td><td>" . $row['year'] . "</td><td>" . $row['director1'] . "</td><td>" . $row['director2'] . "</td><td>" . $row['star1'] . "</td><td>" . $row['star2'] . "</td><td>" . $row['quantity'] . "</td><td>" . $row['in_stock'] . "</td><td>" . $row['rt_rating'] . "</td><td>" . $row['category'] . "</td><td>" . $row['genre1'] . "</td><td>" . $row['genre2'] . "</td><td>" . $row['genre3'] . "</td><td>" . $row['genre4'] . "</td>";
        echo "<td>";
		
	  	echo "<form action='manage_catalog2.php' method='post'><input type='hidden' name='film_id' value='";
		echo $row['film_id'];
	  	echo "'><button type='submit'><span class='glyphicon glyphicon-pencil'></span></button></form>"; 
 		
		echo "</td>";
		echo "</tr>";
  	}

  	mysqli_close($dbc);
	
?>
        </tbody>
    </table>
</div>			



</section>


<?php
// Include footer.php
include("../includes/footer.php");
?>
