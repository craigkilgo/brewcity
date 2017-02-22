

<?php 
session_start();
if($_SESSION['role'] != 'su' AND $_SESSION['role'] != 'manager' AND $_SESSION['role'] != 'employee')
{
header("Location:index.php");
}
// Include header.php
include("../includes/header2.php");

//var_dump($_POST);echo '<br>';
//var_dump($_POST['rent_list']);echo '<br>';
//var_dump($_POST['rental_ids']);echo '<br>';

if (isset($_POST['submitted'])) {
	
	require_once ('../includes/mysqli_connect.php'); // Connect to the db.
	
	
	$errors = array(); // Initialize error array.
	include("../includes/get_films.php");

	include("../includes/get_emp.php");
	
		/*assign variables */
	$user_id = $_POST['cust_id'];
	$employee = $_POST['employee'];
	
	
	//get customer name
	include("../includes/get_cust.php");
	$cc = 0;
	$cust_end = count($arr_cust);
	
	
	while($cc < $cust_end)
	{
		if ($user_id == $arr_cust[$cc]['user_id'])
		{
			$cust_name = $arr_cust[$cc]['first_name'] . " " . $arr_cust[$cc]['last_name'];
			
		}
		$cc++;
	}
	


	
	
	//get current time to insert into database for all transaction records
	$t = time();
	//$t = 1429354920;  'staging data'
	
	
	
	//calculate due date
	$due = strtotime('+5 day', $t);

	//echo $due;
	//echo '<br>';

	$film = $_POST['rent_list'];
	$ids = $_POST['rental_ids'];
	
	
	if (empty($errors)) 
	{ // If everything's OK.
	
		// Make a loop for the query
		
		
		//while loop variables	
		$counter = 0;
		$end = count($film);
		
		
		$late_fees_paid = 0;  //initialize outside of loop
		$fees = $_POST['fees'];
		$fee_arr = $_POST['rental_fees'];
		
		while ($counter < $end)
		{
			
			//deal with late fees on first movie rental of a logical transaction
			if($counter == 0){
			if($_POST['late_fees'] == "on")
			{
				$late_fees_paid = $_POST['lf'];//assign late fees 
				
				//decrement late fees
				$lfq = "UPDATE customers SET late_fees = '0' WHERE user_id=".$user_id;
				$lfr = @mysqli_query ($dbc, $lfq);
			}}
			
			$total_fees = $fees + $late_fees_paid;
			//insert transactions table
	  	$q = "INSERT INTO transactions (user_id, film_id, processed_by, timestamp, due_date, fees_paid, late_fees_paid) VALUES ('$user_id', '".$ids[$counter]."', '$employee',FROM_UNIXTIME(".$t."), FROM_UNIXTIME(".$due."), '".$fee_arr[$counter]."','$late_fees_paid')";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		
		
			//decrement from catalog table
			$filmq = "UPDATE catalog SET in_stock = in_stock - 1 WHERE film_id =".$ids[$counter];
			$filmr = @mysqli_query ($dbc, $filmq);
			
		$counter++;
		}		
				
				
				
				//logging
				$user = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
				$action = 'Transaction processed for customer ' . $user_id;
				$qlog = "INSERT INTO logs (user_id, action, action_table, action_time) VALUES ('$user', '$action', 'customers', NOW())";		
				$rlog = @mysqli_query ($dbc, $qlog); // Run the query.
		
		echo ('<div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Success!</strong>');
		echo ('</div>');
	
	
	
	
	
	}
	else  //it didnt go ok, there are errors
	{
	
	
		echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>
		<strong>Error!</strong>The following error(s) occurred:<br />';
		
		
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		
		echo ('Please try again.</div>');
		
		
		
				mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:

	
	
	
	}
	
	
	
	
	
	
	mysqli_close($dbc); // Close the database connection.
} // End of the main Submit conditional.
else
{
header("Location:index.php");
}

?>
<section id="pos" class="home-section text-center">

			
<div class="container">
	<div class="row" style="text-align: left;">
<div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">	
<div class="row"><div class="col-lg-8 col-md-8 col-xs-10">	
<h2>Receipt</h2></div></div>


<div class="row" style="text-align: left;">
	<div class="col-lg-8 col-md-8 col-xs-10">	
<span id="customer_name"><?php echo $cust_name; ?></span><br />
Processed by <?php echo($_SESSION['first_name'] . ' ' . $_SESSION['last_name']); 
echo "<br>";
echo date("F j, Y, g:i a", $t);  
echo "<br>";
echo "Due: ";
echo date("m/d/y",$due);
?>

<br />
<br />
</div>
</div>
<div class="row" style="text-align: left;">
<div class="col-lg-8 col-md-8 col-xs-8">
<span id="rentals" style="font-weight:bold; font-size:1.1em;" >
<?php
	$c = 0;
	while ($c < $end)
		{
			
			echo $film[$c]."<br />";		
			
			
		$c++;	
		}

?>
</span><br />
</div>
</div>


<div class="row" style="text-align: left;">
<div class="col-lg-3 col-md-3 col-xs-3">



Fees:<br>
Late fees:<br>
Total:<br>
Total paid:<br>
Via <span id="rec_payment"><?php echo $_POST['payment']; ?></span>
</div>

<div class="col-lg-3 col-md-3 col-xs-3">
<span id="rec_fees"><?php  echo "$ ".number_format($fees, 2);?></span><br>
<span id="rec_late_fees"><?php  echo "$ ".number_format($late_fees_paid, 2);?></span><br>
<span id="rec_total"><?php  echo "$ ".number_format($total_fees, 2);?></span><br>
<span id="total"><?php  echo "$ ".number_format($total_fees, 2);?></span><br>


</div>
</div>	
		
</div>
</div>
</div>
					
					
					
			
</section>



<?php
// Include footer.php
include("../includes/footer.php");
?>
