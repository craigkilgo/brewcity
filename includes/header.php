<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>
<?php


switch ($_SERVER["PHP_SELF"]) {
    case "/past_due.php":
        echo "Overdue Rentals";
        break;
    case "/revenue_by_employee_report.php":
        echo "Revenue by Employee";
        break;
		
	case "/currently_rented.php":
		echo "Films Currently Rented";
		break;
    default:
        echo "Brew City Rentals IS";
}
?>
</title>
    
	
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/dataTables.tableTools.css" rel="stylesheet" type="text/css">
	
    <!-- Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/animate.css" rel="stylesheet" />
    <!-- Squad theme CSS -->
    <link href="css/style.css" rel="stylesheet">
	<link href="color/default.css" rel="stylesheet">

	  
	<link href="https://cdn.datatables.net/1.10.5/css/jquery.dataTables.css" rel="stylesheet" type="text/css">
 

 <!-- Core JavaScript Files -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>	
	<script src="js/jquery.scrollTo.js"></script>
	<script src="js/wow.min.js"></script>
	
	<?php if($_SERVER["PHP_SELF"] == '/pos.php' OR $_SERVER["PHP_SELF"] == '/check_in.php') {echo('
	<!-- Autocomplete JS and CSS -->
<link rel="stylesheet" href="css/awesomplete.css" />');} ?>


	
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.js"></script>
	
	<!-- DataTables Form Helpers -->
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/plug-ins/1.10.6/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	<script src="js/dataTables.tableTools.js"></script>



</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
	<!-- Preloader -->
	<div id="preloader">
	  <div id="load"></div>
	</div>

    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.php">
                    <h1>Brew City Rentals</h1></a>
		<?php
if (isset($_SESSION['email'])){
if ($_SESSION['role'] == 'customer'){echo('<h6>' . $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] . '</h6>');}
else
{
echo ('
<h6>' . $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] . ' - ' . $_SESSION['role'] . '</h6>');}
} ?>	
					
                
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
      <ul class="nav navbar-nav">

		
		<?php 
if (!isset($_SESSION['email'])){
	echo ("<li");if($_SERVER["PHP_SELF"] == '/login.php') {echo(' class="active"');}
	echo ("><a href='login.php'>Login</a></li>");
	echo ("<li");if($_SERVER["PHP_SELF"] == '/register.php') {echo(' class="active"');}
	echo ("><a href='register.php'>Register</a></li>");	
 
} 

else 

{
	if ($_SESSION['role'] == 'customer')
	{
	echo ("<li");if($_SERVER["PHP_SELF"] == '/rent.php') {echo(' class="active"');}
	echo ("><a href='#'>Rent a DVD</a></li>");
	echo ("<li");if($_SERVER["PHP_SELF"] == '/account.php') {echo(' class="active"');}
	echo ("><a href='#'>Account Settings</a></li>"); 
	}
	else
	{
	echo ("<li");if($_SERVER["PHP_SELF"] == '/pos.php') {echo(' class="active"');}
	echo ("><a href='pos.php'>POS</a></li>");
	
		echo ("<li");if($_SERVER["PHP_SELF"] == '/customers.php') {echo(' class="active"');}if($_SERVER["PHP_SELF"] == '/manage_customers.php') {echo(' class="active"');}
	echo (" class='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown'>Customers <b class='caret'></b></a>
	<ul class='dropdown-menu'>
	        <li><a href='customers.php'>Add Customer</a></li>
            <li><a href='manage_customers.php'>Manage Customers</a></li></ul>
	</li>");
	
		
	echo ("<li");if($_SERVER["PHP_SELF"] == '/catalog.php') {echo(' class="active"');}if($_SERVER["PHP_SELF"] == '/manage_catalog.php') {echo(' class="active"');}if($_SERVER["PHP_SELF"] == '/manage_catalog2.php') {echo(' class="active"');}
	echo (" class='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown'>Catalog<b class='caret'></b></a>
		<ul class='dropdown-menu'>");

	
	
	echo ("<li><a href='catalog.php'>Add Film</a></li>");
	echo ("<li><a href='manage_catalog.php'>Manage Catalog</a></li>");
	echo ("<li><a href='check_in.php'>Check-in Rental</a></li></ul>");
	echo "</li>";
	
	
	if ($_SESSION['role'] == 'manager' OR $_SESSION['role'] == 'su')
	{
	
	echo ("<li");
	if($_SERVER["PHP_SELF"] == '/employees.php') {echo(' class="active"');}if($_SERVER["PHP_SELF"] == '/manage_employees.php') {echo(' class="active"');}if($_SERVER["PHP_SELF"] == '/manage_employees2.php') {echo(' class="active"');}
	echo (" class='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown'>Employees<b class='caret'></b></a>
	<ul class='dropdown-menu'>
	        <li><a href='employees.php'>Add Employee</a></li>
            <li><a href='manage_employees.php'>Manage Employees</a></li></ul>
	</li>");
	
	
	

	
	

	
	}
	$rep_list = array("/films_by_genre.php", "/revenue_report.php", "/revenue_by_date.php", "/revenue_by_employee_report.php", "/revenue_by_customer_report.php", "/currently_rented.php", "/past_due.php", "/custom.php");
	
	echo ('

		
        <li ');
          
          if(in_array($_SERVER["PHP_SELF"], $rep_list)){
			  
			  echo ("class='active' ");
		  }
		  
          echo ('class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="revenue_report.php">Revenue by Film</a></li>
            <li><a href="revenue_by_date.php">Revenue by Date</a></li>
			<li><a href="revenue_by_employee_report.php">Revenue by Employee</a></li>
			<li><a href="revenue_by_customer_report.php">Revenue by Customer</a></li>
			<li><a href="currently_rented.php">Currently Rented</a></li>
			<li><a href="past_due.php">Past Due Rentals</a></li>
			<li><a href="films_by_genre.php">Films by Genre</a></li>
			<li><a href="custom.php">Custom</a></li>
			</ul>
        </li>
		');
	
	
	
		
} 
echo ("<li><a href='logout.php'><span class='glyphicon glyphicon-off'></span></a></li>"); 
}
?>

          
		
      </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>




