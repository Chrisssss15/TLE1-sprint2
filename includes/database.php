<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "TLE1-team5-2";

$db = mysqli_connect($host, $user, $password, $database)
or die("Error: " . mysqli_connect_error());
?>
