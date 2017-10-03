<?php

header('Access-Control-Allow-Origin: *'); 

require_once('db.php');


function check($s) {
	
	global $invalid;
	$s = strtolower($s);
	foreach($invalid AS $deny) {
		if(strpos($s, $deny) !== false) {
			echo "    contains $deny\n";
			return false;
		}
	}
	echo "    doesnt contain invalid strings\n";
	return true;
}


foreach($_REQUEST['data'] AS $data) {

	$check = strtolower(trim($data));
	echo "checking $data";
	if(!check($check)) continue;

	//echo "adding " . $data . "\n";

	$name = mysqli_escape_string($data);
	//mysqli_query($con, "INSERT INTO topics(name), VALUES('$name')");

	$st = mysqli_prepare($con, "INSERT INTO topics (name) VALUES(?)");
	mysqli_stmt_bind_param($st, 's', $data);
	mysqli_stmt_execute($st);



}


echo "selecting topics";
$result = mysqli_query($con, "SELECT * FROM topics");

while($row = mysqli_fetch_assoc($result)) {
	echo "$row[name]<br>";
}
