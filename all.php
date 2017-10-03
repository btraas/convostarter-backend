<?php

header('Access-Control-Allow-Origin: *');
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

require_once('db.php');

$result = mysqli_query($con, "SELECT * FROM topics");

echo "<table>";
while($row = mysqli_fetch_assoc($result)) {
	echo "<tr><td>$row[id]</td><td>$row[name]</td></tr>\n";
}
echo "</table>";
