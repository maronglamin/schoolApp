<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';

if (isset($_SESSION['ADMIN_USER_SESSIONS'])) {
    unset($_SESSION['ADMIN_USER_SESSIONS']);
    $_SESSION['success_mesg'] = 'You are now logg out, have a nice day!';
    header('Location: ' . PROOT . "index.php");
} else if (isset($_SESSION['TEACHR_USER_SESSIONS'])) {
    unset($_SESSION['TEACHR_USER_SESSIONS']);
    $_SESSION['success_mesg'] = 'You are now logg out, have a nice day!';
    header('Location: ' . PROOT . "index.php");
} else {
    unset($_SESSION['STUDENT_USER_SESSIONS']);
    $_SESSION['success_mesg'] = 'You are now logg out, have a nice day!';
    header('Location: ' . PROOT . "index.php");
}
