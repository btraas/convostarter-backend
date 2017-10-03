<?php

header('Access-Control-Allow-Origin: *');
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

require_once('db.php');

$userId = getNumeric(@$_REQUEST['user_id']);

$result = mysqli_query($con, "SELECT * FROM users
WHERE 
  id != $userId AND
  id NOT IN (SELECT user_from FROM messages where user_to = $userId) AND 
  id NOT IN (SELECT user_to FROM messages WHERE user_from = $userId)");


$data = [];
while($row = mysqli_fetch_assoc($result)) {
	$data[] = $row;
}

if(sizeof($data) == 0) die(json_encode([]));
$chosen = array_rand($data, 1);

echo json_encode($data[$chosen]);
