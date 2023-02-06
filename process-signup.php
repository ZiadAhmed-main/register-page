<?php

if (empty($_POST["name"])) {
    die("Name is Required!");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
die("Vaild email is required!");

if (strlen($_POST["pass"]) < 8 ) {
    die("Password must be atleast 8 charchters!");
}

if (! preg_match("/[a-z]/i" , $_POST["pass"])) {
    die("Password must contain atleast one letter");
}

if (! preg_match("/[0-9]/i" , $_POST["pass"])) {
    die("Password must contain atleast one Number");
}

if ($_POST["pass"] !== $_POST["pass-confirm"]) {
    die("Passwords Must Match!");
}

$password_hash = password_hash($_POST["pass"] , PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql_command = "INSERT INTO user (name, email , password_hash) VALUES (? , ? , ?)";

$stmt = $connect_sqli->stmt_init();

if (! $stmt->prepare($sql_command))  {
    die("SQL ERROR:" . $connect_sqli->error);
}

$stmt->bind_param("sss", $_POST["name"] , $_POST["email"] , $password_hash);

if ($stmt->execute())
{
    header("Location: signup-success.html");
}else {
    if ($connect_sqli->errno) {
        die("Email and Username Already Taken!");
    }   
}


    





