<?php
$password = 'ortiz';
$hashed_password = password_hash($password, PASSWORD_BCRYPT);
echo $hashed_password;
?>