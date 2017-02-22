<?php
/*
 * list_genres.php
 * 
 * Copyright 2015 craig <craig@CUBE>
 * 
 */
require_once ('../includes/mysqli_connect.php'); // Connect to the db.

$q='
SELECT DISTINCT genre
FROM (
SELECT genre1 AS genre
FROM catalog
UNION 
SELECT genre2
FROM catalog
    UNION
    SELECT genre3 FROM catalog
    UNION
    SELECT genre4 FROM catalog
) AS genre_table';
$result = mysqli_query($dbc, $q); // Run the query.

	$genre_list = array();

while($r = mysqli_fetch_assoc($result)) {
    $genre_list[] = $r;
}

	
		
	
	$c = 0;
	$end = count($genre_list);
	
while($c < $end)
{
	if($genre_list[$c]['genre'] != ''){
	echo "<option value='" . $genre_list[$c]['genre'] . "'>" .$genre_list[$c]['genre'] . "</option>";}
	
	
	$c++;
}
	
?>
