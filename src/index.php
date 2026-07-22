<?php
 
var_dump("Hi, you're on ".getenv('WEBAPP_URL'));
 
$dbhost = getenv('DB_HOST');
$dbport = (int) (getenv('DB_PORT') ?: 3306);
$dbuser = getenv('DB_USER');
$dbpass = getenv('DB_PASS');
$dbname = getenv('DB_NAME');
 
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport);
if (!$conn) {
   var_dump("Connection failed: ".mysqli_connect_error());
   exit('bye');
}
 
var_dump("Successful database connection!");
