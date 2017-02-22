<?php 
session_start();
if($_SESSION['role'] != 'su' AND $_SESSION['role'] != 'manager' AND $_SESSION['role'] != 'employee')
{
header("Location:../index.php");
}
// Include header.php
include("../includes/header2.php");



?>
<script type="text/javascript">
$(document).ready(function() {
    $('#data_table').DataTable(
    {
        "order": [[ 1, "desc" ]],
        "pageLength": 50,
          dom: 'T<"clear">lfrtip',
        tableTools: {
            "aButtons": [ "csv", "xls", "pdf" ]
        }

	}
    );
} );

</script>



    <section id="customers" class="home-section text-center">
			<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<div class="section-heading">
					<h2>Revenue by Employee</h2>
					
					</div>
				</div>
			</div>
			</div>
			
			
			
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
<table id="data_table" class="display" cellspacing="0" width="100%">
  <thead>
            <tr>
                <th>Name</th>
                <th>Sales</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Sales</th>
            </tr>
        </tfoot>
 
        <tbody>
<?php
    require_once ('../includes/mysqli_connect.php'); // Connect to the db.
  	$query = "SELECT * FROM revenue_by_employee"; 
  	$result =  mysqli_query($dbc, $query); // Run the query.
	
  	while($row = mysqli_fetch_array($result))
  	{
  		echo "<tr>";
  		echo "<td>" . $row['first_name'] . " " .$row['last_name'] . "</td><td>$" . number_format($row['fees'],2) . "</td>";
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
