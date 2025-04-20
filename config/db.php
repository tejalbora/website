<?php
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "mysql";
$dbName = "art_paradise";
$socket = '/tmp/mysql.sock'; 
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName,3306, $socket);
if (!$conn) {
    die("something went wrong");
}
?>