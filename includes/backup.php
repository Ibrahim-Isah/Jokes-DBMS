<?php

$email = "isahibn08@gmail.com";
$password = 12345;
$hashpass = password_hash($password , PASSWORD_DEFAULT);
$_SESSION['password'] = $hashpass;
$_SESSION['email'] = $email;

if(!empty($email)){
	echo 'email checked';
} else {
	echo 'email not found';
}

if(!empty($email) && password_verify($password , $hashpass)){
	echo 'verified and logged in';
} else {
	echo 'make sure you are verified';
}
