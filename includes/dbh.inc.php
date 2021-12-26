<?php

require_once 'config.inc.php';

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = $MYSQLDBPW;
$dBName = "cookie_dough";
$port = $PORT;

$connection = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName, $port);

// //Get Heroku ClearDB connection information
// $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
// $cleardb_server = $cleardb_url["host"];
// $cleardb_username = $cleardb_url["user"];
// $cleardb_password = $cleardb_url["pass"];
// $cleardb_db = substr($cleardb_url["path"],1);
// $active_group = 'default';
// $query_builder = TRUE;
// // Connect to DB
// $connection = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

if (!$connection){
    die("Connection failed: " . mysqli_connect_error());
}
else{
    error_log("MySQLi connection established...");
}
  