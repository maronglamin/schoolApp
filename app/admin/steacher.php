<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Admission details");
}
include(ROOT . DS . "app" . DS . "components" . DS . "admin_nav.php");
$errors = [];

$subject = ((isset($_POST['subject'])) ? sanitize($_POST['subject']) : '');
$teacher = ((isset($_POST['teacher'])) ? sanitize($_POST['teacher']) : '');
$className = ((isset($_POST['class'])) ? sanitize($_POST['class']) : '');



$subj = $db->query("SELECT * FROM `subject_junior`");
$teach = $db->query("SELECT * FROM `users` WHERE `user_role` = '2'");
$class = $db->query("SELECT * FROM `class_grade` WHERE `deleted` != '1'");


$teacher_subject = $db->query("SELECT
                                    u.full_name,
                                    sj.subj_name,
                                    ts.table_id,
                                    ts.status_del,
                                    ts.class_id,
                                    cg.class_id,
                                    cg.grade_name
                                FROM
                                    users u,
                                    teacher_subject ts,
                                    subject_junior sj,
                                    class_grade cg
                                WHERE
                                u.user_id = ts.teacher_id AND sj.subj_no = ts.subject_id AND cg.class_id = ts.class_id AND ts.status_del != 1");
if (isset($_GET['del'])) {
    $del_id = (int)sanitize($_GET['del']);

    $db->query("UPDATE `teacher_subject` SET `status_del`= '1' WHERE `table_id` = '{$del_id}'");
    redirect("steacher.php");
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="jumbotron jumbotron-fluid">
            <h1>subject Teachers</h1>
            <p>Teachers and their corresponding subject</p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-10 col-md-offset-1 well">
            <h1 class="text-center text-primary">Subjects Teachers</h1>
            <hr>
            <?php if ($_POST) {
                $required = ['subject', 'teacher', 'class'];
                foreach ($required as $fields) {
                    if ($_POST[$fields] == '') {
                        $errors[] = 'You must the select all fields';
                        break;
                    }
                }
                if (!empty($errors)) {
                    echo display_errors($errors);
                } else {
                    $db->query("INSERT INTO `teacher_subject`(`teacher_id`, `subject_id`, `class_id`) VALUES ('{$teacher}', '{$subject}', '{$className}')");
                    redirect("steacher.php");
                }
            } ?>
            <div class="row">
                <div class="col-sm-6">
                    <form action="#" method="post">
                        <div class="form-group">
                            <label for="subject">Subject Name</label>
                            <select name="subject" id="subject" class="form-control">
                                <option value=""></option>
                                <?php while ($subject = mysqli_fetch_assoc($subj)) : ?>
                                    <option value="<?= $subject['subj_no'] ?>" <?= (isset($_POST['subject']) == $subject['subj_no']) ?  "selected" : '' ?>><?= $subject['subj_name'] ?></option>
                                <?php endwhile; ?>

                            </select>
                            <small>Select subject</small>
                        </div>
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
                            <th>Subject title</th>
                            <th>Class Name</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php while ($teacherSubject = mysqli_fetch_assoc($teacher_subject)) : ?>
                                <tr>
                                    <td><?= $teacherSubject['full_name'] ?></td>
                                    <td><?= $teacherSubject['subj_name'] ?></td>
                                    <td><?= $teacherSubject['grade_name'] ?></td>
                                    <td>
                                        <a href="steacher.php?del=<?= $teacherSubject['table_id'] ?>" class="btn btn-xs btn-danger glyphicon glyphicon-trash"> Delete</a>
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
