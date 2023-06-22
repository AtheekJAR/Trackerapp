<?php


// Connect to the database
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "income_expense";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Database Connection failed: " . mysqli_connect_error());
}


?>