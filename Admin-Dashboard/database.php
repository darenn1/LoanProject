<?php

header('Content-Type: application/json');

$servername = 'localhost';
$username = 'root';
$password = 'HelloWorld';
$dbname = 'LoanMe';

$conn = mysqli_connect($servername,$username,$password,$dbname);

if(!$conn){
    die('Connection Failed'.mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");



?>