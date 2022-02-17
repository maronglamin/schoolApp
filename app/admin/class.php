<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Dashboard");
}
if ($user_data['user_role'] != ADMIN_USER) {
    login_redirect(PROOT . "index.php");
}
include(ROOT . DS . "app" . DS . "components" . DS . "admin_nav.php");

$student_detail = $db->query("SELECT
                                    u.full_name,
                                    cg.class_id,
                                    cg.grade_name,
                                    cg.class_size,
                                    es.user_id
                                FROM
                                    users u,
                                    class_grade cg,
                                    enroll_student es
                                WHERE
                                    u.user_id = es.applied_id
                                AND cg.class_id = es.class_id
                                AND cg.deleted != 1
                                ORDER BY class_id");


?>

<div class="container-fluid">
    <div class="row">
        <div class="jumbotron">
            <h1>student in the school</h1>
            <p>Enrolled students</p>
        </div>
        <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-8 col-md-offset-2 well">
            <h2>Class Details</h2>
            <form action="class.php" method="post">
                <div class="row">
                    <div class="form-group col-md-3">
                        <input type="text" name="seacrch" id="search" class="form-control" placeholder="Search user ID">
                    </div>
                    <div class="col-md-2 form-group">
                        <input type="submit" value="Search" class="form-control btn btn-primary">
                    </div>
                </div>
            </form>
            <hr>
            <table class="table table-striped table-hover table-condensed table-bordered">
                <thead>
                    <th>Student</th>
                    <th>Student ID</th>
                    <th>Class Teacher</th>
                    <th>Class Name</th>
                </thead>
                <tbody>
                    <?php while ($className = mysqli_fetch_assoc($student_detail)) :
                        $teacher_name = $db->query("SELECT u.full_name AS name FROM users u, class_teacher ct, enroll_student es WHERE u.user_id = ct.teacher_id AND ct.class_id = '{$className['class_id']}'");
                        $details = mysqli_fetch_assoc($teacher_name);

                    ?>
                        <tr>
                            <td><?= $className['full_name'] ?></td>
                            <td><?= $className['user_id'] ?></td>
                            <td><?= $details['name'] ?></td>
                            <td><?= $className['grade_name'] ?></td>

                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once(ROOT . DS . "core" . DS . "resource" . DS . "script.php");
