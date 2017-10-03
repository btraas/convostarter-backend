<?php

session_start();
$con = mysqli_connect('localhost', 'conversationstarters', 'startAconvo', 'conversationstarters');

// Check connection
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}


mysqli_query($con, "CREATE TABLE IF NOT EXISTS topics (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(60) NOT NULL UNIQUE ); ");

mysqli_query($con, "CREATE TABLE IF NOT EXISTS users (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(60) NOT NULL)");

mysqli_query($con, "CREATE TABLE IF NOT EXISTS messages (user_from INT REFERENCES users(id), user_to INT REFERENCES users(id), content TEXT NOT NULL, sent_time TIMESTAMP NOT NULL DEFAULT NOW())");

function getNumeric($str) {
    return preg_replace("/[^0-9,.]/", "", $str);
}