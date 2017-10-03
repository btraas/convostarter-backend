<?php

header('Access-Control-Allow-Origin: *');
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

require_once('db.php');

$userId = getNumeric(@$_REQUEST['user_id']);

$result = mysqli_query($con, "SELECT m.user_from, m.user_to, m.content, m.sent_time, 

CASE WHEN m.user_from = $userId  THEN (SELECT name FROM users WHERE id = m.user_to) ELSE (SELECT name FROM users WHERE id = m.user_from) END AS other_user,
(SELECT name FROM users where id = m.user_from) AS sender_name 
                                      FROM messages m WHERE user_from = $userId OR user_to = $userId 
                                      ORDER BY sent_time ASC");


$data = [];
while($row = mysqli_fetch_assoc($result)) { // make convos unique

    $other_id = $row['user_from'] == $userId ? $row['user_to'] : $row['user_from'];
    //$sender_name = $row['sender_name'];
    //$content = $row['content'];
	$data[$other_id] = $row;
}
uasort($data, "cmp");

function cmp($a, $b)
{
    return (strtotime($b['sent_time']) - (strtotime($a['sent_time'])));
}


echo json_encode(array_values($data));
