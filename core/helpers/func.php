<?php
// write helper function of the app in this file 


// use for debugging or testing purposes
function dnd($data)
{
    echo '<pre class="bg-light">';
    var_dump($data);
    echo '</pre>';
    die("Test or debugging mode");
}

function display_errors($errors)
{
    $hasErrors = (!empty($errors)) ? ' has-errors' : '';
    $html = '<div class="form-errors"><ul class="bg-light' . $hasErrors . '">';
    foreach ($errors as $field => $error) {
        $html .= '<li class="text-danger">' . $error . '</li>';
    }
    $html .= '</ul></div>';
    return $html;
}

function sanitize($dirty)
{
    return htmlentities($dirty, ENT_QUOTES, "UTF-8");
}

function is_logged_in()
{
    if (isset($_SESSION['ADMIN_USER_SESSIONS']) && $_SESSION['ADMIN_USER_SESSIONS'] > 0) {
        return true;
    } elseif (isset($_SESSION['STUDENT_USER_SESSIONS']) && $_SESSION['STUDENT_USER_SESSIONS'] > 0) {
        return true;
    } elseif (isset($_SESSION['TEACHR_USER_SESSIONS']) && $_SESSION['TEACHR_USER_SESSIONS'] > 0) {
        return true;
    }
    return false;
}


function login_error_redirect($url, $pageName)
{
    if (!headers_sent()) {
        $_SESSION['error_mesg'] = 'You must be logged in to access the <strong>' .  $pageName . '</strong> page';
        header('Location: ' . $url);
        exit();
    }
}

function login_redirect($url)
{
    if (!headers_sent()) {
        $_SESSION['error_mesg'] = 'You have no permission to access the page';

        if (isset($_SESSION['ADMIN_USER_SESSIONS'])) {
            unset($_SESSION['ADMIN_USER_SESSIONS']);
            header('Location: ' . PROOT . "index.php");
        } else if (isset($_SESSION['TEACHR_USER_SESSIONS'])) {
            unset($_SESSION['TEACHR_USER_SESSIONS']);
            header('Location: ' . PROOT . "index.php");
        } else {
            unset($_SESSION['STUDENT_USER_SESSIONS']);
            $_SESSION['success_mesg'] = 'You are now logg out, have a nice day!';
        }
        header('Location: ' . $url);
        exit();
    }
}


function helper_login($user_id, $url)
{
    global $db;
    $date = date("Y-m-d H:i:s");
    $db->query("UPDATE `users` SET `last_login` = '$date' WHERE `user_id` = '$user_id'");
    header('Location: ' . $url);
    exit();
}

function login_teacher_staff($user_id)
{
    $_SESSION['TEACHR_USER_SESSIONS'] = $user_id;
    helper_login($user_id, PROOT . "app" . DS . "client" . DS . "dashboard.php");
}

function login_admin($admin_id)
{
    $_SESSION['ADMIN_USER_SESSIONS'] = $admin_id;
    helper_login($admin_id,  PROOT . "app" . DS . "admin" . DS . "dashboard.php");
}

function login_stud($user_id)
{
    $_SESSION['STUDENT_USER_SESSIONS'] = $user_id;
    helper_login($user_id, PROOT . "app" . DS . "client" . DS . "home.php");
}

function redirect($location)
{
    if (!headers_sent()) {
        header('Location: ' . $location);
        exit();
    } else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="' . $location . '";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=' . $location . '" />';
        echo '</noscript>';
        exit;
    }
}
function day_month($date)
{
    return date("d/m/Y", strtotime($date));
}

function time_format($date)
{
    return date("d M, Y", strtotime($date));
}

function tim_format($date)
{
    return date("H:i", strtotime($date));
}

function human_date($date)
{
    return date("d M, Y", strtotime($date));
}

function header_message($name, $sentence)
{
    $html = '<div class="col-xs-12 col-sm-12 col-md-12 well well-lg">';
    $html .= '<br><br>';
    $html .= '<h4 class="text-left">' . $name . '</h4>';
    $html .= '<div class="col-sm-8 col-sm-offset-2"><p class="text-primary">' . $sentence . '</p></div></div>';
    return $html;
}

function num_style($data)
{
    return 'GMD ' . number_format($data, 2, '.', ',');
}

function grade_num($data)
{
    return number_format($data, 2, '.', ',');
}

function cap($string) {
    return strtoupper($string);
}
