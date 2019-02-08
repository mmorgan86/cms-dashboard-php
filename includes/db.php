<?php

  $db['db_host'] = "lgg2gx1ha7yp2w0k.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
  $db['db_username'] = "ivancnf75wfzdbcs";
  $db['db_password'] = "in8l5tj2l4dqhmh2";
  $db['db_name'] = "ju6j8cr35erg1fts";

  foreach($db as $key => $value){
    define(strtoupper($key), $value);
  }

  $connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
?>