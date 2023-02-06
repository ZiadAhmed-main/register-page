<?php

$host = "localhost";
$dbname = "login_db";
$username = "root";
$password = "";

$connect_sqli = mysqli_connect(hostname:$host , database: $dbname , username: $username , password: $password);

if ($connect_sqli->connect_errno) {
    die("Connection Error! :" . $connect_sqli  ->connect_error);
}

return $connect_sqli;
