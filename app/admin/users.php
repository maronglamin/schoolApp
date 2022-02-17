<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Dashboard");
}
if ($user_data['user_role'] != ADMIN_USER) {
    login_redirect(PROOT . "index.php");
}
include(ROOT . DS . "app" . DS . "components" . DS . "admin_nav.php");
$current_user = $user_data['user_id'];
$user_sql = $db->query("SELECT * FROM `users` WHERE `user_id` != '{$current_user}' ORDER BY `user_role`");

if (isset($_GET['dis'])) {
    $id = (int)sanitize($_GET['dis']);

    $db->query("UPDATE `users` SET `permission` = '0' WHERE `user_id` = '{$id}'");
    redirect("users.php");
}

if (isset($_GET['enb'])) {
    $id = (int)sanitize($_GET['enb']);

    $db->query("UPDATE `users` SET `permission` = '1' WHERE `user_id` = '{$id}'");
    redirect("users.php");
}

if (isset($_GET['del'])) {
    $id = (int)sanitize($_GET['del']);

    $db->query("UPDATE `users` SET `deleted` = '1' WHERE `user_id` = '{$id}'");
    redirect("users.php");
}
if (isset($_GET['act'])) {
    $id = (int)sanitize($_GET['act']);

    $db->query("UPDATE `users` SET `deleted` = '0' WHERE `user_id` = '{$id}'");
    redirect("users.php");
}

?>

<div class="container-fluid">
    <div class="row">
        <div class="jumbotron jumbotron-fluid">
            <h1>System Users</h1>
            <p>User of the system includes the administrators, Teachers and Students</p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2 well">
            <h3 class="text-center">User's Information</h3>
            <div class="col-md-4 col-xs-10 form-group">
                <input type="text" name="search" id="search" placeholder="search by full name or user name" class="form-control">
            </div>
            <div class="col-md-4 col-xs-2 form-group">
                <a href="#" class="btn btn-default">Search</a>
            </div>
            <hr>
            <table class="table table-striped table-hover table-condensed table-bordered">
                <thead>
                    <th>Full Name</th>
                    <th>User name</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php while ($users = mysqli_fetch_assoc($user_sql)) : ?>
                        <tr>
                            <td><?= $users['full_name'] ?></td>
                            <td><?= $users['user_name'] ?></td>
                            <td><?= $users['email'] ?></td>
                            <td>
                                <?php if ($users['user_role'] == ADMIN_USER) {
                                    echo "Administrator";
                                } elseif ($users['user_role'] == TEACHER_USER) {
                                    echo "Teacher";
                                } else {
                                    echo "Student";
                                }
                                ?>
                            </td>
                            <td>
                                <?php if ($users['permission'] == '1') : ?>
                                    <a href="users.php?dis=<?= $users['user_id'] ?>" class="btn btn-xs btn-info">DISABLE</a>
                                <?php else : ?>
                                    <a href="users.php?enb=<?= $users['user_id'] ?>" class="btn btn-xs btn-info">Enable</a>
                                <?php endif; ?>
                                <?php if ($users['deleted'] == '1') : ?>
                                    <a href="users.php?act=<?= $users['user_id'] ?>" class="btn btn-xs btn-warning">activate</a>
                                <?php else : ?>
                                    <a href="users.php?del=<?= $users['user_id'] ?>" class="btn btn-xs btn-danger">DELETE</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once(ROOT . DS . "core" . DS . "resource" . DS . "script.php");
