<?php

header('Access-Control-Allow-Origin: *'); 

require_once('db.php');

$result = mysqli_query($con, "SELECT name, id FROM topics");

$data = [];
while($data[] = mysqli_fetch_assoc($result));

$chosen = array_rand($data, 1);

echo $data[$chosen]['name'];