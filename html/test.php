<?php
include("../includes/get_json.php");
include("../includes/find_movie.php");

$toystory = get_json('770672122');

 var_dump($toystory);
 echo('
 <br>
 <br>
 <br>');
 echo $toystory['genres'][1];
 echo $toystory['genres'][2];
 echo $toystory['genres'][3];
  echo $toystory['genres'][4];
  echo $toystory['id'];
   echo('
 <br>');
  echo $toystory['ratings']['critics_score'];
 echo('
 <br>
 <br>
 <br>');
 
 $findmatrix = find_movie('the matrix', '1999');
  
echo $findmatrix['movies'][0]['id'];
echo '<br>';
echo $findmatrix['movies'][0]['title'];
echo '<br>';
echo $findmatrix['movies'][0]['year'];
  ?>