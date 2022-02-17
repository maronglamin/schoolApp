<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Dashboard");
}
$reg_name = ((isset($_POST['name'])) ? sanitize($_POST['name']) : '');
$reg_user_name = ((isset($_POST['user_name'])) ? sanitize($_POST['user_name']) : '');
$reg_email = ((isset($_POST['email'])) ? sanitize($_POST['email']) : '');
$reg_password = ((isset($_POST['new'])) ? sanitize($_POST['new']) : '');
$reg_password_confirm = ((isset($_POST['confirm'])) ? sanitize($_POST['confirm']) : '');

$reg_password = trim($reg_password);
$reg_password_confirm = trim($reg_password);

include(ROOT . DS . "app" . DS . "components" . DS . "admin_nav.php"); ?>


<br><br><br>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2 col-sm-6 col-md-6 col-md-offset-3 well">
            <h3 class="text-center">ADD ADMINISTRATORS</h3>
            <?php

            if ($_POST) {

                $emailQuery = $db->query("SELECT * FROM users WHERE email = '{$reg_email}' ");
                $emailCount = mysqli_num_rows($emailQuery);

                $userQuery = $db->query("SELECT * FROM users WHERE `user_name` = '{$reg_user_name}'");
                $userCount = mysqli_num_rows($userQuery);

                if ($emailCount != 0) {
                    $errors[] = 'That email exist in our database';
                }

                if ($userCount != 0) {
                    $errors[] = 'That user name exist in our database';
                }

                $required = array('name', 'email', 'user_name', 'new', 'confirm');
                foreach ($required as $fields) {
                    if ($_POST[$fields] == '') {
                        $errors[] = 'You must fill out all fields marked with star(*).';
                        break;
                    }
                }
                if (strlen($reg_password) < 6) {
                    $errors[] = 'The password must be at least 6 characters.';
                }
                if ($reg_password != $reg_password_confirm) {
                    $errors[] = 'Your password does not match the confirmation';
                }
                if (!empty($errors)) {
                    echo display_errors($errors);
                } else {
                    // add user
                    $hashed = password_hash($reg_password, PASSWORD_DEFAULT);
                    $db->query("INSERT INTO users (`full_name`, `email`, `user_name`, `password`, `user_role`) VALUES('$reg_name','$reg_email', '$reg_user_name', '$hashed', '1')");
                    $_SESSION['success_mesg'] = 'Registration successful.';
                    redirect(PROOT . 'index.php');
                }
            }
            ?>
            <hr>
            <form action="#" method="post">
                <div class="form-group">
                    <label for="name">Full Name*:</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">User Name*:</label>
                    <input type="text" name="user_name" id="user_name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email*:</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="new">New Password</label>
                    <input type="password" name="new" id="new" class="form-control">
                </div>
                <div class="form-group">
                    <label for="confirm">Confirm Password</label>
                    <input type="password" name="confirm" id="confirm" class="form-control">
                </div>
                <input type="submit" value="Add" class="btn btn-default">
            </form>
        </div>
    </div>
</div>


<?php require_once(ROOT . DS . "core" . DS . "resource" . DS . "script.php");
