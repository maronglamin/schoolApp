<?php
// require the configuration setting where you define the contants 
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/config/config.php';

// connect to the database
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB);
if (mysqli_connect_errno()) {
  echo "fail to connect with the error: " . mysqli_connect_error();
  die();
}

/*
  load the resources of the application
    1. css 
    2. helper functions
    3. sql statements... 
*/

include(ROOT . DS . "core" . DS . "resource" . DS . "head.php");
require_once(ROOT . DS . "core" . DS . "helpers" . DS . "func.php");
require_once(ROOT . DS . "core" . DS . "helpers" . DS . "query.php");
require_once(ROOT . DS . "core" . DS . "helpers" . DS .  "db_rappers.php");

// start session of the application
session_start();


// register user session 
if (isset($_SESSION['ADMIN_USER_SESSIONS'])) {

  $admin_id = $_SESSION['ADMIN_USER_SESSIONS'];
  $query = $db->query("SELECT * FROM `users` WHERE `user_id` = '{$admin_id}'");
  $user_data = mysqli_fetch_assoc($query);
  $fn = explode(' ', $user_data['full_name']);
  $user_data['first'] = $fn[0];
} elseif (isset($_SESSION['TEACHR_USER_SESSIONS'])) {

  $user_id = $_SESSION['TEACHR_USER_SESSIONS'];
  $query = $db->query("SELECT * FROM `users` WHERE `user_id` = '{$user_id}'");
  $user_data = mysqli_fetch_assoc($query);
  $fn = explode(' ', $user_data['full_name']);
  $user_data['fname'] = $fn[0];
} elseif (isset($_SESSION['STUDENT_USER_SESSIONS'])) {

  $user_id = $_SESSION['STUDENT_USER_SESSIONS'];
  $query = $db->query("SELECT * FROM `users` WHERE `user_id` = '{$user_id}'");
  $user_data = mysqli_fetch_assoc($query);
  $fname = $user_data['full_name'];
}

// session messages
if (isset($_SESSION['success_mesg'])) {
  echo '<div class="alert alert-success alert-dismissible text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Message!</strong>' . ' ' . $_SESSION['success_mesg'] . '</div>';
  unset($_SESSION['success_mesg']);
}

if (isset($_SESSION['error_mesg'])) {
  echo '<div class="alert alert-danger alert-dismissible text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong>' . ' ' . $_SESSION['error_mesg'] . '</div>';
  unset($_SESSION['error_mesg']);
}

$open = $db->query("SELECT * FROM `start_enrollment` WHERE `opened` != '1'");
$open_record = mysqli_fetch_assoc($open);