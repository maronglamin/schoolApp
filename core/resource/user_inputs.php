<?php
$user_name = ((isset($_POST['user_name'])) ? sanitize($_POST['user_name']) : '');
$password = ((isset($_POST['password'])) ? sanitize($_POST['password']) : '');
$user_name = trim($user_name);
$password = trim($password);
$errors = array();



// trim extra space before and after the inputs
$user_name = trim($user_name);
$password = trim($password);
