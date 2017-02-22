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
					<h2>Past Due Rentals</h2>
					
					</div>
				</div>
			</div>
			</div>
			
			
			
<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
<table id="data_table" class="display" cellspacing="0" width="100%">
  <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Film</th>
                <th>Due Date</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Film</th>
                <th>Due Date</th>
            </tr>
        </tfoot>
 
        <tbody>
<?php
    require_once ('../includes/mysqli_connect.php'); // Connect to the db.
    /*SELECT SUM( transactions.fees_paid ) AS  'rental_fees', SUM( transactions.late_fees_paid ) AS  'late_fees', SUM( transactions.fees_paid + transactions.late_fees_paid ) AS total, transactions.user_id AS user_id, customers.first_name, customers.last_name
FROM transactions
LEFT JOIN customers ON transactions.user_id = customers.user_id
GROUP BY user_id
ORDER BY rental_fees */
  	$query = "SELECT transactions.user_id, transactions.checked_in, customers.first_name AS first_name, customers.last_name AS last_name, customers.email AS email, customers.phone AS phone, catalog.title AS title, transactions.due_date AS due_date FROM transactions LEFT JOIN customers ON transactions.user_id = customers.user_id LEFT JOIN catalog ON transactions.film_id = catalog.film_id WHERE transactions.checked_in = '0' AND due_date < NOW() - INTERVAL 1 DAY"; 
  	$result =  mysqli_query($dbc, $query); // Run the query.
	
  	while($row = mysqli_fetch_array($result))
  	{
  		echo "<tr>";
  		echo "<td>"  . $row['last_name'] . ", ". $row['first_name'] . "</td><td>" . $row['phone'] . "</td><td>" . $row['email'] . "</td><td>" . $row['title'] . "</td><td>" . $row['due_date'] . "</td>";
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
