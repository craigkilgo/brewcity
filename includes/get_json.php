<?php
function get_json($id)
{
$url = 'http://api.rottentomatoes.com/api/public/v1.0/movies/' . $id . '.json?apikey=83nu3fqks6kmwwpzcv2egcq6';
$JSON = file_get_contents($url);

// echo the JSON (you can echo this to JavaScript to use it there)
//echo $JSON;

// You can decode it to process it in PHP
$data = json_decode($JSON, true);
//var_dump($data);

return $data;
}
?>