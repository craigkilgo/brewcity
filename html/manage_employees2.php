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
	header("Location:manage_employees.php");
	}

  require_once ('../includes/mysqli_connect.php'); // Connect to the db.
 	$query = "SELECT * FROM employee WHERE user_id = " . $_POST['user_id']; 
 	$result =  mysqli_query($dbc, $query); // Run the query.
	
	
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	//var_dump($row);


	?>

    <section id="customers" class="home-section text-center">
			<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<div class="section-heading">
					<h2>Edit Employee</h2>
					
					</div>
				</div>
			</div>
			</div>
	
			

	
	
	

</section>
		<div class="container">
			<div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
			<form class="form-horizontal" role="form" action="manage_employee_execute.php" method="post">
			
			
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
					
					<label class="control-label col-sm-3 col-xs-2" for="role">Role</label>
<div class="input-group">
<select id="role" name="role" class="selectpicker form-control">
	<option value="employee"<?php if ($row['role'] == 'employee'){echo ' selected="selected"';}?>>Employee</option>
	<option value="manager"<?php if ($row['role'] == 'manager'){echo ' selected="selected"';}?>>Store Manager</option>
	<option value="su"<?php if ($row['role'] == 'su'){echo ' selected="selected"';}?>>Superuser</option>
		</select>
</div>

				</div>
        

			
<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="del">Delete</label>

								<div class="input-group">
							<input type="text" size="60" class="form-control" id="delete" name="delete" placeholder="To delete this employee, type DELETE and Modify">
							
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
