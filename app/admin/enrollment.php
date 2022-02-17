<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Dashboard");
}
include(ROOT . DS . "app" . DS . "components" . DS . "admin_nav.php");

$errors = [];
$enroll_get = $db->query("SELECT * FROM `users` WHERE `user_role` = '3' AND `status` = '0' ORDER BY `user_id`");

?>

<div class="container-fluid">
    <div class="row">
        <div class="jumbotron">
            <h1>Enrollment</h1>
            <p>...</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
        </div>
        <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-10 col-md-offset-1 well">
            <h3 class="text-center">ENROLLMENT</h3>
            <hr>
            <table class="table table-striped table-hover table-condensed table-bordered">
                <thead>
                    <th>Full Name</th>
                    <th>User name</th>
                    <th>Email</th>
                    <th>Date Applied</th>
                    <th>Student's Details</th>
                </thead>
                <tbody>
                    <?php while ($applied = mysqli_fetch_assoc($enroll_get)) : ?>
                        <tr>
                            <td><?= $applied['full_name'] ?></td>
                            <td><?= $applied['user_name'] ?></td>
                            <td><?= $applied['email'] ?></td>
                            <td><?= human_date($applied['join_date']) ?></td>
                            <td>
                                <a href="view.php?info=<?= $applied['user_id'] ?>" class="btn btn-xs btn-info">View</a>
                                <a href="view.php?process=<?= $applied['user_id'] ?>" class="btn btn-xs btn-default">Process</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once(ROOT . DS . "core" . DS . "resource" . DS . "script.php");
