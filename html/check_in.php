<?php 
session_start();
if($_SESSION['role'] != 'su' AND $_SESSION['role'] != 'manager' AND $_SESSION['role'] != 'employee')
{
header("Location:index.php");
}
// Include header.php
include("../includes/header2.php");



	include("../includes/get_cust.php");
	include("../includes/get_films.php");
	



if (isset($_POST['submitted'])) {
include("get_trans.php");


require_once ('../includes/mysqli_connect.php'); // Connect to the db.
$errors = array(); // Initialize error array.



$films = $_POST['rental_ids'];
$customer = $_POST['cust_id'];


//echo var_dump($_POST);

//echo '<br>'.$films;


//outer loop of films being checked in
$count = 0;
$end = sizeof($films);
while ($count < $end)
{
$trans_bool = 0;


//find transaction
foreach($transactions as $row)
{
	//echo '<br>'.$row['user_id'];
	
	if($row['user_id'] == $customer AND $row['film_id'] == $films[$count] AND $row['checked_in'] == 0)
		{
			$trans_bool = 1;
						
			//update transaction table
				$q = "UPDATE transactions SET checked_in = '1', returned = NOW() WHERE transaction_id = '".$row['transaction_id']."'";
				//echo $q.'<br>';
				$r = @mysqli_query ($dbc, $q);


			//update catalog
				$qc = "UPDATE catalog SET in_stock = (in_stock + 1) WHERE film_id = '".$films[$count]."'";
				$rc = @mysqli_query ($dbc, $qc);
				//echo $qc.'<br>';

				//logging
				$user = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
				$action = 'Rental returned processed for customer ' . $customer . ', ' . $_POST['rent_list'][$count] . ' returned.';
				$qlog = "INSERT INTO logs (user_id, action, action_table, action_time) VALUES ('$user', '$action', 'customers', NOW())";		
				$rlog = @mysqli_query ($dbc, $qlog); // Run the query.


			//echo success
		echo ('<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				<strong>Success!</strong>');
		echo $_POST['rent_list'][$count] . ' has been checked in.';		
		echo ('</div>');
			
			
		}
	
	
}

if(!$trans_bool)
{
	echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>
		<strong>Error!</strong>';
	echo $_POST['rent_list'][$count]. ' not checked in.  Transaction not found.</div>';
	
}



	
$count++;	
}

	
	mysqli_close($dbc);
}

?>

<script src="js/awesomplete.js"></script>

<script type="text/javascript">
	
//get array of customers, store in customer_array json	
var customer_array = JSON.parse('<?php echo json_encode($arr_cust); ?>');

//get array of films, store in film_array json	
var film_array = JSON.parse('<?php echo json_encode($arr_catalog); ?>');



//console.log(customer_array[3]['email']);
//console.log(customer_array[3]);
//console.log(film_array[3]);

$(document).ready(function(){
	


//customer handling function
    $('#email').blur(function() {

			var arrayLength = customer_array.length;//get length of customer array for loop
			$("#customer_found").html("");//ensure the customer found div is blank if it gets changed
			
			cust_bool = 0;
			
			//loop through the customer array, trying to find email from input value
	for (var i = 0; i < arrayLength; i++) {
		if(customer_array[i]['email'] == $('#email').val())
		{
			cust_bool = 1;
			//display green customer confirmation text to the right
			$("#customer_found").html("Customer found. ");
			//put the form input in the form
			$("#hidCustomer").html("<input type='hidden' name='cust_id' value='" + customer_array[i]['user_id'] + "' />");
		}
		else
		{
		}
		
		}
	

		if(!cust_bool)
		{
			$("#hidCustomer").html("");
			$("#customer_name").html("");
			
		}
		
		
		
		
    });




//add movie function
	
    $("#btnAdd").click(function(){
        
		film_bool = 0;	
	
		
		var arrayLength2 = film_array.length;
		
		for (var i = 0; i < arrayLength2; i++) {
		
		
		
		if(film_array[i]['title'] == $('#film').val())
		{
			film_bool = 1;
			
			
			if(film_array[i]['in_stock'] < film_array[i]['quantity'])
			{
		
		

		
		/* add hidden input value for movie being added */
		$("#hidFilms").prepend("<input type='hidden' name='rent_list[]' value='"  + film_array[i]['title'] + "'/>");
		$("#hidFilms").prepend("<input type='hidden' name='rental_ids[]' value='"  + film_array[i]['film_id'] + "'/>");
		$("#rentals").prepend("<span class='label label-success'>" + $('#film').val() + "</span><br>");
				
				
				
			}
			else
			{
				$("#alert_area").html("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a>    <strong>Error!</strong>This film is not checked out.</div>");

			}
		
}

}

		
		$('#film').val("");
		
		if(!film_bool)
		{
			$('#film').val("");
			$("#alert_area").html("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a>    <strong>Error!</strong> Film not found</div>");
			
			
		}
		
		
		
		
    });

	
	$("#reset").click(function(){

		
		//clear all customer info
			$("#hidCustomer").html("");
			$("#customer_name").html("");
			$("#customer_found").html("");
			
		//clear all film info
			$("#rental_status").html("");
			$("#rentals").html("");
			$("#hidFilms").html("");
			
	});


});



</script>


  <section id="pos" class="home-section text-center">

			
		<div class="container">
					<div class="col-lg-8 col-lg-offset-2">
					<div class="section-heading">
					<h2>Check-In</h2>
					
					</div>
				</div>
			</div>
	
		<div class="container">
			
			
			
			<div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
			<form class="form-horizontal" role="form" action="check_in.php" method="post">
				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="email">Customer Email</label>
								<div class="input-group">
							<?php include("../includes/auto_email.php"); ?>	
													</div>
				</div>

				
				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="film">Film</label>
								<div class="input-group">
							
								<?php include("../includes/auto_film.php"); ?>
								
                                <button id="btnAdd" class="btn btn-default" style="margin-left:15px; margin-bottom:3px;" type="button">Add</button>
													
								
							</div>
				</div>

				
				
	
				
				
				<div class="form-group">
								<div class="input-group col-md-4 col-md-offset-4 col-xs-4 col-xs-offset-4">
							<div id="hidInput">
							<input type="hidden" name="submitted" value="TRUE" />
							
							
							<?php
							echo ("<input type='hidden' name='employee' value='");
							
							echo $_SESSION['user_id'];
							
							echo("' />");
							
							?>
							
							
							
							
							</div>
							
								<div id="hidCustomer">
								</div>
								<div id="hidFilms">
								</div>

								
								<button type="reset" class="btn btn-skin" id="reset">
                            Reset</button> 
                        <button type="submit" class="btn btn-skin" id="submit">
                            Submit</button>
							
						</div>
					</div>					



		
</form>
</div>

<div class="col-lg-4 col-md-4 col-sm-2 col-xs-4">
<div class="row">
<span style="color:green;" id="customer_found"> </span>
</div>

<div class="row"><br>
</div>
<div id="alert_area"></div>


</div>



</div>
</section>





<div class="container">
<div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">		
<h3>Check-in Films:</h3>
<h4><div id="rentals">


</div></h4><br />
		
</div>
</div>



<?php
// Include footer.php
include("../includes/footer.php");
?>
