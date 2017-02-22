<?php 
session_start();
if($_SESSION['role'] != 'su' AND $_SESSION['role'] != 'manager')
{
header("Location:index.php");
}
// Include header.php
include("../includes/header2.php");


	
?>
<script type="text/javascript">
$(document).ready(function(){

	//table select dropdown
   $('#table').change(function() {
			
			
	$('#table_label').html($('#table').val() + " Table");
			
			switch ($('#table').val()) {
    case 'Transactions':
		//change the other select dropdowns
        $("#main_item").html('<option value="Transactions">Transactions</option><option value="Rental Fees">Rental Fees</option><option value="Late Fees">Late Fees</option><option value="Total Fees">Total Fees</option><option value="Due Date">Due Date</option><option value="Rental Date">Rental Date</option><option value="Employee Name">Employee Name</option><option value="Customer Name">Customer Name</option><option value="Film Title">Film Title</option><option value="Checked In">Checked In</option>');
         $("#additional").html('<option value="">Select:  </option><option value="Transactions">Transactions</option><option value="Rental Fees">Rental Fees</option><option value="Late Fees">Late Fees</option><option value="Total Fees">Total Fees</option><option value="Due Date">Due Date</option><option value="Rental Date">Rental Date</option><option value="Employee Name">Employee Name</option><option value="Customer Name">Customer Name</option><option value="Film Title">Film Title</option><option value="Checked In">Checked In</option><option value="Director">Director</option><option value="Genre">Genre</option><option value="In Stock">In Stock</option><option value="Rotten Tomatoes Rating">Rotten Tomatoes Rating</option><option value="Starring">Starring</option><option value="Release Year">Release Year</option><option value="Customer Address">Customer Address</option><option value="Customer Phone">Customer Phone</option><option value="Customer Late Fees">Customer Late Fees</option><option value="Customer Registration Date">Customer Registration Date</option><option value="Customer Email">Customer Email</option><option value="Employee Email">Employee Email</option><option value="Employee Phone">Employee Phone</option>');
        $('#main_label').html($('#main_item').val() + " Main Element");
        
        ("#addins").html('');
        
        break;
    case 'Customers':
        $("#main_item").html('<option value="Customers">Customers</option>');
        $('#main_label').html($('#main_item').val() + " Main Element");
        $("#additional").html('<option value="">Select:  </option><option value="Customers">Customer Name</option>	<option value="Customer Address">Customer Address</option><option value="Customer Phone">Customer Phone</option><option value="Customer Late Fees">Customer Late Fees</option><option value="Customer Registration Date">Customer Registration Date</option><option value="Customer Email">Customer Email</option>');
        
        
        $("#addins").html('');
        break;
        
        
    case 'Employees':
        $("#main_item").html('<option value="Employees">Employees</option>');
        $('#main_label').html($('#main_item').val() + " Main Element");
        $("#additional").html('<option value="">Select:  </option><option value="Employee Name">Employee Name</option><option value="Employee Email">Employee Email</option><option value="Employee Phone">Employee Phone</option>');
        
        $("#addins").html('');
        break;
    case 'Catalog':
        $("#main_item").html('<option value="Films">Films</option>');
        $('#main_label').html($('#main_item').val() + " Main Element");
        $("#additional").html('<option value="">Select:  </option><option value="Film Title">Film Title</option>	<option value="Director">Director</option><option value="Genre">Genre</option><option value="In Stock">In Stock</option><option value="Rotten Tomatoes Rating">Rotten Tomatoes Rating</option><option value="Starring">Starring</option><option value="Release Year">Release Year</option>');
        
        
        $("#addins").html('');
        break;
		}
		
		
		
    });


//main item select dropdown
   $('#main_item').change(function() {

	$('#main_label').html($('#main_item').val() + " Main Element");


  });
  
  
//add button function
$("#btnAdd").click(function(){

if ($('#additional').val() == '')
{}
else
{
	$("#addins").prepend("<span class='label label-success'>" + $('#additional').val() + "</span> ");
	
	
	
	
	
}



});



//reset button click
$("#reset").click(function(){
	
	$("#addins").html('');
});


});
</script>
	
<!-- end Javascript -->	
	
	
    <section id="employees" class="home-section text-center">
			<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<div class="section-heading">
					<h2>Custom Report</h2>
					
					</div>
				</div>
			</div>
			</div>
		<div class="container">
			<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
			<form class="form-horizontal" role="form">
			
			<div class="form-group">
				
<label class="control-label col-sm-3 col-xs-2" for="category">Table</label>
<div class="input-group" style="width:65%">
<select id="table" name="category" class="selectpicker form-control" required="required">
	<option value="Transactions">Transactions</option>
	<option value="Customers">Customers</option>
	<option value="Employees">Employees</option>
		<option value="Catalog">Catalog</option>
		</select>
</div>
</div>


<div class="form-group">					
<label class="control-label col-sm-3 col-xs-2" for="category">Main Item</label>
<div class="input-group"  style="width:65%">
<select id="main_item" name="main_item" class="selectpicker form-control" required="required">
	<option value="Transactions">Transactions</option>
	<option value="Rental Fees">Rental Fees</option>
	<option value="Late Fees">Late Fees</option>
		<option value="Total Fees">Total Fees</option>
			<option value="Due Date">Due Date</option>
		<option value="Rental Date">Rental Date</option>
			<option value="Employee Name">Employee Name</option>
	<option value="Customer Name">Customer Name</option>
				<option value="Film Title">Film Title</option>
	<option value="Checked In">Checked In</option>
		</select>
</div>
</div>


<div class="form-group">
<label class="control-label col-sm-3 col-xs-2" for="category">Add-in</label>
<div class="input-group">
<select id="additional" name="additional" class="selectpicker form-control">
	<option value="">Select:  </option>
	<option value="Transactions">Transactions</option>
	<option value="Rental Fees">Rental Fees</option>
	<option value="Late Fees">Late Fees</option>
		<option value="Total Fees">Total Fees</option>
			<option value="Due Date">Due Date</option>
		<option value="Rental Date">Rental Date</option>
			<option value="Employee Name">Employee Name</option>
	<option value="Customer Name">Customer Name</option>
				<option value="Film Title">Film Title</option>
	<option value="Checked In">Checked In</option>
	<option value="Director">Director</option>
	<option value="Genre">Genre</option>
	<option value="In Stock">In Stock</option>
	<option value="Rotten Tomatoes Rating">Rotten Tomatoes Rating</option>
	<option value="Starring">Starring</option>
	<option value="Release Year">Release Year</option>
	<option value="Customer Address">Customer Address</option>
	<option value="Customer Phone">Customer Phone</option>
	<option value="Customer Late Fees">Customer Late Fees</option>
	<option value="Customer Registration Date">Customer Registration Date</option>
	<option value="Customer Email">Customer Email</option>
	<option value="Employee Email">Employee Email</option>
	<option value="Employee Phone">Employee Phone</option>
		</select>
	<span class="input-group-btn">
        <button class="btn btn-default" id="btnAdd" type="button">Add</button>
      </span>	
</div>

</div>
				<div class="row" style=" align-items: left;">
					<h4>
				<span class="label label-primary" id="table_label">Transactions Table</span>
				<span class="label label-primary" id="main_label">Transactions Main Element</span></h4>
				<h4><div id="addins"></div></h4>
				</div>
			
				<div class="form-group">
								<div class="input-group col-md-4 col-md-offset-4 col-xs-4 col-xs-offset-4">
								<button type="reset" class="btn btn-skin" id="reset">
                            Reset</button> 
                        <button type="submit" class="btn btn-skin" id="submit">
                            Submit</button>
							<input type="hidden" name="submitted" value="TRUE" />
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
