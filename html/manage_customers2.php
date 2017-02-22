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
	header("Location:manage_customers.php");
	}

  require_once ('../includes/mysqli_connect.php'); // Connect to the db.
 	$query = "SELECT * FROM customers WHERE user_id = " . $_POST['user_id']; 
 	$result =  mysqli_query($dbc, $query); // Run the query.
	
	
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	//var_dump($row);


	?>

    <section id="customers" class="home-section text-center">
			<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<div class="section-heading">
					<h2>Edit Customer</h2>
					
					</div>
				</div>
			</div>
			</div>
	
			

	
	
	

</section>
		<div class="container">
			<div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
			<form class="form-horizontal" role="form" action="manage_customer_execute.php" method="post">
			
			
				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="email">Email</label>
								<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
							<input type="email" class="form-control" id="email" name="email" required="required" value="<?php echo $row['email']; ?>"></div>
				</div>

				
				
				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="f_name">First Name</label>

								<div class="input-group">
							<input type="text" class="form-control" id="f_name" name="f_name" placeholder="First Name" value="<?php echo $row['first_name']; ?>">
								
							</div>

				</div>	
				
				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="f_name">Last Name</label>
								<div class="input-group">
							<input type="text" class="form-control" id="l_name" name="l_name" placeholder="Last Name" value="<?php echo $row['last_name']; ?>">
							
							
        </div>
				</div>				
			
				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="phone">Phone</label>

								<div class="input-group">
							<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?php echo $row['phone']; ?>">
						
								</div>
				</div>

				
        				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="address1">Address</label>

								<div class="input-group">
							<input type="text" class="form-control" id="address1"  name="address1" placeholder="Line 1" value="<?php echo $row['address1']; ?>"></div>
				</div>
        
        				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="address2">Address</label>

								<div class="input-group">
							<input type="text" class="form-control" id="address2" name="address2" placeholder="Line 2" value="<?php echo $row['address2']; ?>"></div>
				</div>
          
            				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="city">City</label>

								<div class="input-group">
							<input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo $row['city']; ?>"></div>
				</div>
        



<div class="form-group">
<label class="control-label col-sm-3 col-xs-2" for="state">State</label>
<div class="input-group">
<select id="state" name="state" class="selectpicker form-control">
	<option value="AL" <?php if($row['state'] == "AL"){echo ('selected="selected"');} ?>>Alabama</option>
	<option value="AK" <?php if($row['state'] == "AK"){echo ('selected="selected"');} ?>>Alaska</option>
	<option value="AZ" <?php if($row['state'] == "AZ"){echo ('selected="selected"');} ?>>Arizona</option>
	<option value="AR" <?php if($row['state'] == "AR"){echo ('selected="selected"');} ?>>Arkansas</option>
	<option value="CA" <?php if($row['state'] == "CA"){echo ('selected="selected"');} ?>>California</option>
	<option value="CO" <?php if($row['state'] == "CO"){echo ('selected="selected"');} ?>>Colorado</option>
	<option value="CT" <?php if($row['state'] == "CT"){echo ('selected="selected"');} ?>>Connecticut</option>
	<option value="DE" <?php if($row['state'] == "DE"){echo ('selected="selected"');} ?>>Delaware</option>
	<option value="DC" <?php if($row['state'] == "DC"){echo ('selected="selected"');} ?>>District Of Columbia</option>
	<option value="FL" <?php if($row['state'] == "FL"){echo ('selected="selected"');} ?>>Florida</option>
	<option value="GA" <?php if($row['state'] == "GA"){echo ('selected="selected"');} ?>>Georgia</option>
	<option value="HI" <?php if($row['state'] == "HI"){echo ('selected="selected"');} ?>>Hawaii</option>
	<option value="ID" <?php if($row['state'] == "ID"){echo ('selected="selected"');} ?>>Idaho</option>
	<option value="IL" <?php if($row['state'] == "IL"){echo ('selected="selected"');} ?>>Illinois</option>
	<option value="IN" <?php if($row['state'] == "IN"){echo ('selected="selected"');} ?>>Indiana</option>
	<option value="IA" <?php if($row['state'] == "IA"){echo ('selected="selected"');} ?>>Iowa</option>
	<option value="KS" <?php if($row['state'] == "KS"){echo ('selected="selected"');} ?>>Kansas</option>
	<option value="KY" <?php if($row['state'] == "KY"){echo ('selected="selected"');} ?>>Kentucky</option>
	<option value="LA" <?php if($row['state'] == "LA"){echo ('selected="selected"');} ?>>Louisiana</option>
	<option value="ME" <?php if($row['state'] == "ME"){echo ('selected="selected"');} ?>>Maine</option>
	<option value="MD" <?php if($row['state'] == "MD"){echo ('selected="selected"');} ?>>Maryland</option>
	<option value="MA" <?php if($row['state'] == "MA"){echo ('selected="selected"');} ?>>Massachusetts</option>
	<option value="MI" <?php if($row['state'] == "MI"){echo ('selected="selected"');} ?>>Michigan</option>
	<option value="MN" <?php if($row['state'] == "MN"){echo ('selected="selected"');} ?>>Minnesota</option>
	<option value="MS" <?php if($row['state'] == "MS"){echo ('selected="selected"');} ?>>Mississippi</option>
	<option value="MO" <?php if($row['state'] == "MO"){echo ('selected="selected"');} ?>>Missouri</option>
	<option value="MT" <?php if($row['state'] == "MT"){echo ('selected="selected"');} ?>>Montana</option>
	<option value="NE" <?php if($row['state'] == "NE"){echo ('selected="selected"');} ?>>Nebraska</option>
	<option value="NV" <?php if($row['state'] == "NV"){echo ('selected="selected"');} ?>>Nevada</option>
	<option value="NH" <?php if($row['state'] == "NH"){echo ('selected="selected"');} ?>>New Hampshire</option>
	<option value="NJ" <?php if($row['state'] == "NJ"){echo ('selected="selected"');} ?>>New Jersey</option>
	<option value="NM" <?php if($row['state'] == "NM"){echo ('selected="selected"');} ?>>New Mexico</option>
	<option value="NY" <?php if($row['state'] == "NY"){echo ('selected="selected"');} ?>>New York</option>
	<option value="NC" <?php if($row['state'] == "NC"){echo ('selected="selected"');} ?>>North Carolina</option>
	<option value="ND" <?php if($row['state'] == "ND"){echo ('selected="selected"');} ?>>North Dakota</option>
	<option value="OH" <?php if($row['state'] == "OH"){echo ('selected="selected"');} ?>>Ohio</option>
	<option value="OK" <?php if($row['state'] == "OK"){echo ('selected="selected"');} ?>>Oklahoma</option>
	<option value="OR" <?php if($row['state'] == "OR"){echo ('selected="selected"');} ?>>Oregon</option>
	<option value="PA" <?php if($row['state'] == "PA"){echo ('selected="selected"');} ?>>Pennsylvania</option>
	<option value="RI" <?php if($row['state'] == "RI"){echo ('selected="selected"');} ?>>Rhode Island</option>
	<option value="SC" <?php if($row['state'] == "SC"){echo ('selected="selected"');} ?>>South Carolina</option>
	<option value="SD" <?php if($row['state'] == "SD"){echo ('selected="selected"');} ?>>South Dakota</option>
	<option value="TN" <?php if($row['state'] == "TN"){echo ('selected="selected"');} ?>>Tennessee</option>
	<option value="TX" <?php if($row['state'] == "TX"){echo ('selected="selected"');} ?>>Texas</option>
	<option value="UT" <?php if($row['state'] == "UT"){echo ('selected="selected"');} ?>>Utah</option>
	<option value="VT" <?php if($row['state'] == "VT"){echo ('selected="selected"');} ?>>Vermont</option>
	<option value="VA" <?php if($row['state'] == "VA"){echo ('selected="selected"');} ?>>Virginia</option>
	<option value="WA" <?php if($row['state'] == "WA"){echo ('selected="selected"');} ?>>Washington</option>
	<option value="WV" <?php if($row['state'] == "WV"){echo ('selected="selected"');} ?>>West Virginia</option>
	<option value="WI" <?php if($row['state'] == "WI"){echo ('selected="selected"');} ?>>Wisconsin</option>
	<option value="WY" <?php if($row['state'] == "WY"){echo ('selected="selected"');} ?>>Wyoming</option>	
	</select>
</div>
</div>
			
<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="del">Delete</label>

								<div class="input-group">
							<input type="text" size="60" class="form-control" id="delete" name="delete" placeholder="To delete this customer, type DELETE and Modify">
							
								</span>
								</div>
				</div>				



				<div class="form-group">
								<div class="input-group col-md-4 col-md-offset-4 col-xs-4 col-xs-offset-4">
							<input type="hidden" name="submitted" value="TRUE" />
							<input type="hidden" name="user_id" value="<?php echo $_POST['user_id']; ?>" />	
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
