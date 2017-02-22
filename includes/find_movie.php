<?php
function find_movie($title)
{
$title = str_replace(' ', '+', $title);

$url= 'http://api.rottentomatoes.com/api/public/v1.0/movies.json?q=' . $title . '&page_limit=10&page=1&apikey=83nu3fqks6kmwwpzcv2egcq6';
$JSON = file_get_contents($url);

$data = json_decode($JSON, true);


return ($data);


}
?>