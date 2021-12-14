<?php

require_once 'config.inc.php';

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = $MYSQLDBPW;
$dBName = "cookie_dough";
$port = $PORT;

$connection = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName, $port);

if (!$connection){
    die("Connection failed: " . mysqli_connect_error());
}
else{
    error_log("MySQLi connection established...");
}
  