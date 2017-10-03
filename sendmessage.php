<?php

header('Access-Control-Allow-Origin: *'); 

require_once('db.php');

$fromId = getNumeric(@$_REQUEST['from_user']);
$toId = getNumeric(@$_REQUEST['to_user']);
$msg = mysqli_escape_string($con, @$_REQUEST['message']);


//$name = mysqli_escape_string($data);
//mysqli_query($con, "INSERT INTO topics(name), VALUES('$name')");

/*
$st = mysqli_prepare($con, "INSERT INTO messages (user_from, user_to, content) 
                                    VALUES(?,?,?)");
mysqli_stmt_bind_param($st, 'iis', $fromId, $toId, $msg);
mysqli_stmt_execute($st);
*/

if(empty($fromId) || empty($toId) || empty($msg)) {
    die('Invalid message');
}

$stmt = $con->prepare("INSERT INTO messages (user_from, user_to, content) 
                                    VALUES(?,?,?)");
$stmt->bind_param("iis", $fromId, $toId, $msg);
$stmt->execute();
