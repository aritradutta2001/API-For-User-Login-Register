<?php
include('./library/Authentication.php');

// fetch the values from post
$email = $_POST['email'];
$password = $_POST['password'];


$auth = new Authentication();
$auth->login($email, $password);

