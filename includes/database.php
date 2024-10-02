<?php

$host = "stud.hosted.hr.nl";
$user = "prj_2024_2025_tle1_exp_t5";
$password = "ovohquei";
$database = "prj_2024_2025_tle1_exp_t5";

$db = mysqli_connect($host, $user, $password, $database)
or die("Error: " . mysqli_connect_error());
?>
