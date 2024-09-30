<?php


//register.php
if (empty($_POST['firstName'])) {
    $errorFirstname = 'Firstname cannot be empty';
}

if (empty($_POST['lastName'])) {
    $errorLastname = 'Lastname cannot be empty';
}


if (empty($_POST['email'])) {
    $errorEmail = 'Email cannot be empty';
}

if (empty($_POST['password'])) {
    $errorPassword = 'Password cannot be empty';
}
// Login.php

$errors['loginFailed'] = 'Incorrect login credentials.';
