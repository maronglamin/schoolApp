<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Dashboard");
}
if ($user_data['user_role'] != ADMIN_USER) {
    login_redirect(PROOT . "index.php");
}
include(ROOT . DS . "app" . DS . "components" . DS . "admin_nav.php");
include(ROOT . DS . "app" . DS . "components" . DS . "dashboard_card.php");

require_once(ROOT . DS . "core" . DS . "resource" . DS . "script.php");
