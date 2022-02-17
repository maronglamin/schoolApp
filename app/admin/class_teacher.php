<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Admission details");
}
include(ROOT . DS . "app" . DS . "components" . DS . "admin_nav.php");
$errors = [];

$teacher = ((isset($_POST['teacher'])) ? sanitize($_POST['teacher']) : '');
$className = ((isset($_POST['class'])) ? sanitize($_POST['class']) : '');


$teach = $db->query("SELECT * FROM `users` WHERE `user_role` = '2'");
$class = $db->query("SELECT * FROM `class_grade` WHERE `deleted` != '1'");


$teacher_subject = $db->query("SELECT
                                    u.full_name,
                                    ct.teacher_id,
                                    ct.class_id,
                                    cg.class_id,
                                    cg.grade_name,
                                    ct.table_id,
                                    ct.removed_status
                                FROM
                                    users u,
                                    class_teacher ct,
                                    class_grade cg
                                WHERE
                                    u.user_id = ct.teacher_id AND cg.class_id = ct.class_id");
if (isset($_GET['del'])) {
    $del_id = (int)sanitize($_GET['del']);

    $db->query("UPDATE `class_teacher` SET `removed_status`= '1' WHERE `table_id` = '{$del_id}'");
    redirect("class_teacher.php");
}
if (isset($_GET['res'])) {
    $del_id = (int)sanitize($_GET['res']);

    $db->query("UPDATE `class_teacher` SET `removed_status`= '0' WHERE `table_id` = '{$del_id}'");
    redirect("class_teacher.php");
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="jumbotron jumbotron-fluid">
            <h1>Class room Teachers</h1>
            <p>Class Teachers</p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-10 col-md-offset-1 well">
            <h1 class="text-center text-primary">Assign class teachers</h1>
            <hr>
            <?php if ($_POST) {
                $required = ['teacher', 'class'];
                foreach ($required as $fields) {
                    if ($_POST[$fields] == '') {
                        $errors[] = 'You must the select all fields';
                        break;
                    }
                }
                if (!empty($errors)) {
                    echo display_errors($errors);
                } else {
                    $db->query("INSERT INTO `class_teacher`(`teacher_id`, `class_id`) VALUES ('{$teacher}', '{$className}')");
                    redirect("class_teacher.php");
                }
            } ?>
            <div class="row">
                <div class="col-sm-6">
                    <form action="#" method="post">
                        <div class="form-group">
                            <label for="teacher">Teacher</label>
                            <select name="teacher" id="teacher" class="form-control">
                                <option value=""></option>
                                <?php while ($teacher = mysqli_fetch_assoc($teach)) : ?>
                                    <option value="<?= $teacher['user_id'] ?>" <?= (isset($_POST['teacher']) == $teacher['user_id']) ?  "selected" : '' ?>><?= $teacher['full_name'] ?></option>
                                <?php endwhile; ?>

                            </select>
                            <small>Get the teacher for the subject selected</small>
                        </div>
                        <div class="form-group">
                            <label for="class">Class</label>
                            <select name="class" id="class" class="form-control">
                                <option value=""></option>
                                <?php while ($classes = mysqli_fetch_assoc($class)) : ?>
                                    <option value="<?= $classes['class_id'] ?>" <?= (isset($_POST['class']) == $classes['class_id']) ?  "selected" : '' ?>><?= $classes['grade_name'] ?></option>
                                <?php endwhile; ?>

                            </select>
                        </div>
                        <input type="submit" value="Send" class="btn btn-primary">
                </div>
                </form>
                <div class="col-sm-6">
                    <table class="table table-striped table-hover table-condensed table-bordered">
                        <thead>
                            <th>Teacher</th>
                            <th>Class Name</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php while ($teacherSubject = mysqli_fetch_assoc($teacher_subject)) : ?>
                                <tr>
                                    <td><?= $teacherSubject['full_name'] ?></td>
                                    <td><?= $teacherSubject['grade_name'] ?></td>
                                    <td>
                                        <?php if ($teacherSubject['removed_status'] != '1') : ?>
                                            <a href="class_teacher.php?del=<?= $teacherSubject['table_id'] ?>" class="btn btn-xs btn-danger glyphicon glyphicon-trash"> Delete</a>
                                        <?php else : ?>
                                            <a href="class_teacher.php?res=<?= $teacherSubject['table_id'] ?>" class="btn btn-xs btn-default"> Reactivate</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once(ROOT . DS . "core" . DS . "resource" . DS . "script.php");
