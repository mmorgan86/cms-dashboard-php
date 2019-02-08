<?php

$url = getenv('mysql://ivancnf75wfzdbcs:in8l5tj2l4dqhmh2@lgg2gx1ha7yp2w0k.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/ju6j8cr35erg1fts');

$hostname = 'lgg2gx1ha7yp2w0k.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
$username = 'ivancnf75wfzdbcs';
$password = 'in8l5tj2l4dqhmh2';
$database = 'ju6j8cr35erg1fts';

// Create connection
$connection = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
echo "Connection was successfully established!";



////// old connection to db /////////
  // $db['db_host'] = "lgg2gx1ha7yp2w0k.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
  // $db['db_username'] = "ivancnf75wfzdbcs";
  // $db['db_password'] = "in8l5tj2l4dqhmh2";
  // $db['db_name'] = "ju6j8cr35erg1fts";

  // foreach($db as $key => $value){
  //   define(strtoupper($key), $value);
  // }

  // $connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
?>