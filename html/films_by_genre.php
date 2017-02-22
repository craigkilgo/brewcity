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


function showUser(str) {
    if (str == "") {
        document.getElementById("data").innerHTML = "";
        return;
    } else { 
            xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("data").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","get_genre.php?q="+str,true);
        xmlhttp.send();
    }
}

$(document).ready(function() {
    $('#data_table').DataTable(
    {
        "order": [[ 1, "desc" ]],
        "paging":         false,
        "ordering": false,
        "info":     false,
		"bFilter": false
	}
    );
} );


</script>



    <section id="customers" class="home-section text-center">
		
		
		
			<form class="form-horizontal" role="form">
				<div class="form-group">
					
					<label class="control-label col-sm-3 col-xs-2" for="genre">Genre</label>
								<div class="input-group">
								
				
<select name="genre" onchange="showUser(this.value)" class="selectpicker form-control" >
  <option value="all">All</option>
  <?php include("../includes/list_genres.php"); ?>
  </select>
  </div></div>
</form>


			<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<div class="section-heading">
					<h2>Films by Genre</h2>
					
					</div>
				</div>
			</div>
			</div>
			

			
<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
<table id="data_table" class="display" cellspacing="0" width="100%">
  <thead>
            <tr>
				<th></th>
                <th>Title</th>
                <th>Year</th>
                <th>Rotten Tomatoes Rating</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
				<th></th>
                <th>Title</th>
                <th>Year</th>
                <th>Rotten Tomatoes Rating</th>
            </tr>
        </tfoot>
 
        <tbody id="data">
<?php
    require_once ('../includes/mysqli_connect.php'); // Connect to the db.
  	$query = "SELECT thumb, title, year, rt_rating FROM catalog"; 
  	$result =  mysqli_query($dbc, $query); // Run the query.
	
  	while($row = mysqli_fetch_array($result))
  	{
  		echo "<tr>";
  		echo "<td><img style='height:55px;  width: auto;' src='" . $row['thumb'] . "'></td><td>" . $row['title'] . "</td><td>" . $row['year'] . "</td><td>" . $row['rt_rating'] . "</td>";
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
