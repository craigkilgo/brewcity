<?

#
# Example PHP server-side script for generating
# responses suitable for use with jquery-tokeninput
#
/*
# Connect to the database
mysql_pconnect("host", "username", "password") or die("Could not connect");
mysql_select_db("database") or die("Could not select database");
*/
/*
# Perform the query

$arr = array();
$rs = mysql_query($query);
*/

  require_once ('../includes/mysqli_connect.php'); // Connect to the db.
	$query_cat = sprintf("SELECT film_id, title FROM catalog WHERE in_stock > 0 AND title LIKE '%%%s%%' ORDER BY popularity DESC LIMIT 10", mysql_real_escape_string($_GET["q"]));
  	$result_cat =  mysqli_query($dbc, $query_cat); // Run the query.


# Collect the results
while($obj = mysql_fetch_object($result_cat)) {
    $arr[] = $obj;
}

# JSON-encode the response
$json_response = json_encode($arr);
/*
# Optionally: Wrap the response in a callback function for JSONP cross-domain support
if($_GET["callback"]) {
    $json_response = $_GET["callback"] . "(" . $json_response . ")";
}
*/
# Return the response
echo $json_response;

?>
