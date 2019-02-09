<?php


// CLEARDB CONNECTION
$hostname = 'us-cdbr-iron-east-03.cleardb.net';
$username = 'b4be560b7ec604';
$password = '8427d5ed';
$database = 'heroku_82764f0c48878ae';

// Create connection
$connection = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 

?>