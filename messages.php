<?php

header('Access-Control-Allow-Origin: *');
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

require_once('db.php');

$userId = getNumeric(@$_REQUEST['user_id']);

$result = mysqli_query($con, "SELECT m.*, u_from.name AS from_name, u_to.name AS to_name FROM messages m 
INNER JOIN users u_from ON u_from.id = m.user_from
INNER JOIN users u_to ON u_to.id = m.user_to 
WHERE user_from = $userId OR user_to = $userId ORDER BY sent_time DESC");


$data = [];
while($row = mysqli_fetch_assoc($result)) {
	$data[] = $row;
}

echo json_encode($data);
