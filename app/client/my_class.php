<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "My class");
}
if ($user_data['user_role'] != TEACHER_USER) {
    login_redirect(PROOT . "index.php");
}
include(ROOT . DS . "app" . DS . "components" . DS . "client_nav.php");

$teacher_id = $user_data['user_id'];
$student_detail = $db->query("SELECT * FROM `class_teacher` WHERE `teacher_id` = '{$teacher_id}' AND `removed_status` != '1'");



?>

<div class="container-fluid">
    <div class="row">
        <div class="jumbotron">
            <h1>Manage your classes</h1>
            <p>The students in my class</p>
        </div>
        <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-8 col-md-offset-2 well">
            <h2>Class Details</h2>
            <hr>
            <?php while($teach_class = mysqli_fetch_assoc($student_detail)):
                $class_id = $teach_class['class_id'];
                $class_name = $teach_class['class_id'];
                $classNames = $db->query("SELECT * FROM `class_grade` WHERE `class_id` = '{$class_name}'");
                $className_val = mysqli_fetch_assoc($classNames);
                $teacher_id = $teach_class['teacher_id'];
                $class_list = $db->query("SELECT DISTINCT u.full_name, u.stud_parent_name AS pname, es.user_id AS sid FROM users u, class_grade cg, enroll_student es, class_teacher ct WHERE ct.class_id = '{$class_id}' AND ct.teacher_id = '{$teacher_id}' AND ct.class_id = es.class_id AND u.user_id = es.applied_id AND cg.deleted != '1' AND ct.removed_status != '1' AND es.app_status != '0' AND es.app_status != '2'");


                ?>
                    <h4 class="text-center"><strong><?=$className_val['grade_name']?></strong></h4>
                    <table class="table table-striped table-hover table-condensed table-bordered">
                        <thead>
                            <th>Name</th>
                            <th>Student ID</th>
                            <th>Parent</th>
                        </thead>
                        <tbody>
                        <?php while($list_student = mysqli_fetch_assoc($class_list)):?>
                            <tr>
                                <td><?=cap($list_student['full_name'])?></td>
                                <td><?=cap($list_student['sid'])?></td>
                                <td><?=cap($list_student['pname'])?></td>
                            </tr>
                            <?php endwhile;?>
                    </tbody>
                </table>
            <?php continue; endwhile;?>
        </div>
    </div>
</div>
<?php require_once(ROOT . DS . "core" . DS . "resource" . DS . "script.php");
