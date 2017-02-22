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
    $('#data_table').DataTable();
} );

</script>



    <section id="customers" class="home-section text-center">
			<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<div class="section-heading">
					<h2>Manage Customers</h2>
					
					</div>
				</div>
			</div>
			</div>
			
			
			
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
<table id="data_table" class="display" cellspacing="0" width="100%">
  <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Address 1</th>
                <th>Address 2</th>
                <th>City</th>
				<th>State</th>
				<th>Phone</th>
				<th>Edit</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Address 1</th>
                <th>Address 2</th>
                <th>City</th>
				<th>State</th>
				<th>Phone</th>
				<th>Edit</th>
            </tr>
        </tfoot>
 
        <tbody>
<?php
    require_once ('../includes/mysqli_connect.php'); // Connect to the db.
  	$query = "SELECT * FROM customers"; 
  	$result =  mysqli_query($dbc, $query); // Run the query.
	
  	while($row = mysqli_fetch_array($result))
  	{
  		echo "<tr>";
  		echo "<td>" . $row['first_name'] . "</td><td>" . $row['last_name'] . "</td><td>" . $row['email'] . "</td><td>" . $row['address1'] . "</td><td>" . $row['address2'] . "</td><td>" . $row['city'] . "</td><td>" . $row['state'] . "</td><td>" . $row['phone'] . "</td>";
        echo "<td>";
		
	  	echo "<form action='manage_customers2.php' method='post'><input type='hidden' name='user_id' value='";
		echo $row['user_id'];
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
