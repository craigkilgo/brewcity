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
					<h2>Revenue by Date</h2>
					
					</div>
				</div>
			</div>
			</div>
			
			
			
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
<table id="data_table" class="display" cellspacing="0" width="100%">
  <thead>
            <tr>
                <th>Date</th>
                <th>Rental Fees</th>
                <th>Late Fees</th>
                <th>Total Fees</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>Date</th>
                <th>Rental Fees</th>
                <th>Late Fees</th>
                <th>Total Fees</th>
            </tr>
        </tfoot>
 
        <tbody>
<?php
    require_once ('../includes/mysqli_connect.php'); // Connect to the db.
    
    //SELECT SUM(fees_paid) as 'rental_fees', SUM(late_fees_paid) as 'late_fees', SUM(fees_paid + late_fees_paid) as total, DATE(timestamp) as date FROM transactions GROUP BY date ORDER BY date
    
  	$query = "SELECT * FROM revenue_by_date"; 
  	$result =  mysqli_query($dbc, $query); // Run the query.
	
  	while($row = mysqli_fetch_array($result))
  	{
  		echo "<tr>";
  		echo "<td>" . $row['date'] . "</td><td>$" . number_format($row['rental_fees'],2) . "</td><td>$" . number_format($row['late_fees'],2) . "</td><td>$" . number_format($row['total'],2) . "</td>";
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
