<?php
/**
 * Created by PhpStorm.
 * User: Brayd
 * Date: 4/10/2017
 * Time: 7:07 PM
 */

header('Access-Control-Allow-Origin: *');

require_once('db.php');

$result = mysqli_query($con, "SELECT * FROM topics");

while($row = mysqli_fetch_assoc($result)) {
    if (stripos($row['name'], 'r/') !== false) {
        mysqli_query($con, "DELETE FROM topics WHERE id = $row[id]");
    } else {
        mysqli_query($con, "UPDATE topics SET name =  '" . mysqli_escape_string($con, removeSerious($row['name'])) . "' where id = $row[id]");

    }
}




$invalid = [ 'redd', 'breaking new', 'girls', 'guys', 'men', 'megathread' ];

function removeSerious($orig) {
    //$orig = str_ireplace("(Serious)", "", $orig);

    //echo "comparing $orig with [Serious]<br>";
    $orig = str_ireplace("[Serious]", "", $orig);
    //echo "comparing $orig with [Serious]<br>";
    //echo "now $orig<br>";

    return ucfirst(trim($orig));
}

include('all.php');




