<?php
$password = '123456'; // Replace with the password you want to hash
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
echo $hashedPassword;
?>