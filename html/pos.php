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
?>
<script src="js/awesomplete.js"></script>
<script src="js/accounting.js"></script>  <!-- src:  http://openexchangerates.github.io/accounting.js/ -->
<script type="text/javascript">
	
//get array of customers, store in customer_array json	
var customer_array = JSON.parse('<?php echo json_encode($arr_cust); ?>');

//get array of films, store in film_array json	
var film_array = JSON.parse('<?php echo json_encode($arr_catalog); ?>');

		var lf = 0.0;
		var late_fees = 0.0;
		var total = 0.0;
		var fees = 0.0;

//console.log(customer_array[3]['email']);
console.log(customer_array[3]);
console.log(film_array[3]);

$(document).ready(function(){
	
	
//hide late fee checkbox initially
$("#hidLateFees").hide();

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
			//print customer name on the reciept below
			$("#customer_name").html(customer_array[i]['first_name'] + ' ' + customer_array[i]['last_name']);
			//display green customer confirmation text to the right
			$("#customer_found").html("Customer found. ");
			//put the form input in the form
			$("#hidCustomer").html("<input type='hidden' name='cust_id' value='" + customer_array[i]['user_id'] + "' />");
			
			
			//late fee handling
			if(customer_array[i]['late_fees'] > 0)
			{
				//display the late fees found
				$("#customer_found").append("<span style='color:red;'> Late fees!</span>");
				
				//store late fees
				lf = + customer_array[i]['late_fees'];
				
				//put late fee in the form input
				$('#lf').val(lf);
				
				
				if(customer_array[i]['late_fees'] > 10)
				{
					
				$('#lateFee_input').prop('checked', true);
				$("#rec_late_fees").html(accounting.formatMoney(customer_array[i]['late_fees']));
				late_fees = lf;
				total = +late_fees + +fees;
				$("#rec_total").html(accounting.formatMoney(total));
				
				}
				else
				{
						$("#hidLateFees").show();
					
				}
				
			}
			else
			{
				$("#customer_found").append(" No late fees.");
			}
			
		}
		else
		{

			
		}
		
		
		
		}
		if(!cust_bool)
		{
			$("#hidCustomer").html("");
			$("#customer_name").html("");
			$("#hidLateFees").hide();
			$('#lf').val(0);
			
		}
		
		
		
		
    });




   $('#payment').blur(function() {
			$("#rec_payment").html($('#payment').val());
    });


	
    $('#lateFee_input').change(function() {
        if($(this).is(":checked")) 
        {
				late_fees = lf;
				$("#rec_late_fees").html(accounting.formatMoney(late_fees));
				total = +late_fees + +fees;
				$("#rec_total").html(accounting.formatMoney(total));

        }
        else
        {
				late_fees = 0;
				$("#rec_late_fees").html(accounting.formatMoney(0));
				total = +fees;
				$("#rec_total").html(accounting.formatMoney(total));
			
			
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
			if(film_array[i]['in_stock'] > 0)
			{
				$("#rental_status").prepend("In stock. <br>");
				
	switch (film_array[i]['category']) {
    case 'regular':
        fees += .5;
        $("#hidFilms").prepend("<input type='hidden' name='rental_fees[]' value='0.5'/>");
        break;
    case 'release':
        fees += 1.5;
        $("#hidFilms").prepend("<input type='hidden' name='rental_fees[]' value='1.5'/>");
        break;
    case 'popular':
        fees += 1;
        $("#hidFilms").prepend("<input type='hidden' name='rental_fees[]' value='1.0'/>");
        break;
    case 'hit':
        fees += 2;
        $("#hidFilms").prepend("<input type='hidden' name='rental_fees[]' value='2.0'/>");
        break;
		}
		
		/* display new fees in fees for rental */
		$('#rec_fees').html(accounting.formatMoney(fees));
		
		

		
		/* add hidden input value for movie being added */
		$("#hidFilms").prepend("<input type='hidden' name='rent_list[]' value='"  + film_array[i]['title'] + "'/>");
		$("#hidFilms").prepend("<input type='hidden' name='rental_ids[]' value='"  + film_array[i]['film_id'] + "'/>");
		$("#rentals").prepend($('#film').val() + "<br>");
				
				
				
		/* add up total and display new total fees */
		total = +late_fees + +fees;
		$("#rec_total").html(accounting.formatMoney(total));
				
				
				
				
			}
			else
			{
				$("#alert_area").html("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a>    <strong>Error!</strong> Out of stock!</div>");

			}
		
}

}

		
		$('#film').val("");
		
		if(!film_bool)
		{
			$('#film').val("");
			$("#alert_area").html("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a>    <strong>Error!</strong> Film not found</div>");
			
			
		}
		
		
		$('#fees').val(fees);
		
    });

	
	$("#reset").click(function(){
	//clear fees
		late_fees = 0;
		$("#rec_late_fees").html(accounting.formatMoney(0));
		total = 0;
		fees = 0;
		$("#rec_total").html(accounting.formatMoney(0));
		$("#rec_fees").html(accounting.formatMoney(0));
		$('#lf').val(0);
		$('#fees').val(0);
		
		//clear all customer info
			$("#hidCustomer").html("");
			$("#customer_name").html("");
			$("#hidLateFees").hide();
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
					<h2>Rental Transaction</h2>
					
					</div>
				</div>
			</div>
	
		<div class="container">
			
			
			
			<div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
			<form class="form-horizontal" role="form" action="process_rental.php" method="post">
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
					<label class="control-label col-sm-3 col-xs-2" for="payment">Payment Method</label>
						<div class="input-group">
							<select id="payment" name="payment" class="selectpicker form-control">
								<option value="Credit Card">Credit Card</option>
								<option value="Cash">Cash</option>
								<option value="Check">Check</option>
			
							</select>
						</div>
					</div>		
					
					
<div class="form-group">			

    <label class="control-label col-sm-3 col-xs-2" for="print">
       Print Receipt
    </label>
	<div class="checkbox col-lg-1 col-sm-1 col-xs-1">
	<input type="checkbox" name="print">
  </div>
</div>


<div class="form-group">			
<div id="hidLateFees">
<label class="control-label col-sm-3 col-xs-2" for="lateFees">Pay Late Fees</label><div class="checkbox col-lg-1 col-sm-1 col-xs-1"><input type="checkbox" id="lateFee_input" name="late_fees"></div>
</div>

</div>			
				
				
				<div class="form-group">
								<div class="input-group col-md-4 col-md-offset-4 col-xs-4 col-xs-offset-4">
							<div id="hidInput">
							<input type="hidden" name="submitted" value="TRUE" />
							<input type="hidden" name="lf" id="lf" />
							<input type="hidden" name="fees" id="fees" />
							
							
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
<div class="row"><br>
</div>
<div class="row">
<span style="color:green;" id="rental_status"> </span>
</div>
</div>



</div>
</section>





<div class="container">
<div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">		
<h3>Receipt</h3>

<span id="customer_name"></span><br />
Processed by <?php echo($_SESSION['first_name'] . ' ' . $_SESSION['last_name']); ?>

<br />
<br />
<span id="rentals"></span><br />
<div class="col-lg-3 col-md-3 col-xs-3">
Fees:<br>
Late fees:<br>
Total:<br>
Total paid:<br>
Via <span id="rec_payment">Credit Card</span>
</div>

<div class="col-lg-3 col-md-3 col-xs-3">
<span id="rec_fees">$0.00</span><br>
<span id="rec_late_fees">$0.00</span><br>
<span id="rec_total">$0.00</span><br>
-<br>
</div>
		
		
</div>
</div>



<?php
// Include footer.php
include("../includes/footer.php");
?>
