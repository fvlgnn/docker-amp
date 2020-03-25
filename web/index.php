<?php
 
echo "Hi, you're on ".getenv('APP_URL').PHP_EOL;
 
$dbhost = getenv('MYSQL_HOST');
$dbuser = getenv('MYSQL_USER');
$dbpass = getenv('MYSQL_PASS');
 
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
if (!$conn) {
   exit('Connection failed: '.mysqli_connect_error().PHP_EOL);
}
 
echo 'Successful database connection!'.PHP_EOL;