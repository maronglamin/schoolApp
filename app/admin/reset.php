<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Password Reset");
}
include(ROOT . DS . "app" . DS . "components" . DS . "admin_nav.php");
include(ROOT . DS . "app" . DS . "components" . DS . "password_reset.php");
require_once(ROOT . DS . "core" . DS . "resource" . DS . "script.php");
