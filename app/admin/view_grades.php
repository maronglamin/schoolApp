<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Dashboard");
}
if ($user_data['user_role'] != ADMIN_USER) {
    login_redirect(PROOT . "index.php");
}

$teacher_subject = $db->query("SELECT u.full_name, sj.subj_name, ts.table_id, ts.status_del, ts.class_id, sj.subj_no, cg.class_id, cg.grade_name, ts.teacher_id AS tid FROM users u, teacher_subject ts, subject_junior sj, class_grade cg
                                WHERE
                            u.user_id = ts.teacher_id AND sj.subj_no = ts.subject_id AND cg.class_id = ts.class_id AND ts.status_del != 1 ORDER BY cg.class_id DESC");

if (isset($_GET['view']) && isset($_GET['sub']) && isset($_GET['classid'])) {
    $teacherId = (int)sanitize($_GET['view']);
    $subj_id = (int)sanitize($_GET['sub']);
    $class_id = (int)sanitize($_GET['classid']);

    $teacher_marks = $db->query("SELECT
                                    sc.student_id,
                                    sc.term_one_test_one,
                                    sc.term_one_test_two,
                                    sc.term_one_exam,
                                    sc.term_two_test_one,
                                    sc.term_two_test_two,
                                    sc.term_two_exam,
                                    sc.term_three_test_one,
                                    sc.term_three_test_two,
                                    sc.term_three_exams     
                                FROM
                                    scores sc
                                WHERE
                                sc.teacher_id = '{$teacherId}' AND sc.subject_id = '{$subj_id}' AND sc.class_id = '{$class_id}'");
?>

<div class="container-fluid">
    <div class="row">
        <div class="jumbotron jumbotron-fluid">
            <h1>Teacher's name</h1>
            <p>Viewing the grade upload of the above </p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-8 col-md-offset-2 well">
            <a href="view_grades.php" class="btn btn-primary pull-right">Back</a>
            <h3>Scores</h3>
        <table class="table table-striped table-hover table-condensed table-bordered">
                        <thead>
                            <th>STUDENT NAME</th>
                            <th>TESTS</th>
                            <th>EXAMS</th>
                            <th>TOTAL</th>
                            <th>TESTS</th>
                            <th>EXAMS</th>
                            <th>TOTAL</th>
                            <th>FINAL EXAMS</th>
                            <th>Average Scores</th>
                        </thead>
                        <tbody>
                            <?php while ($marks = mysqli_fetch_assoc($teacher_marks)):
                                $stud_id = $marks['student_id'];
                                $sql = $db->query("SELECT full_name FROM enroll_student en, users u WHERE en.user_id = '{$stud_id}' AND u.user_id = en.applied_id");
                                $names = mysqli_fetch_assoc($sql);
                                ?>
                                <tr>
                                    <td><?=$names['full_name']?></td>
                                    <td><?=grade_num((int)$marks['term_one_test_one'] + (int)$marks['term_one_test_two'])?></td>
                                    <td><?=grade_num((int)$marks['term_one_exam'])?></td>
                                    <td><strong><?=grade_num((int)$marks['term_one_test_one'] + (int)$marks['term_one_test_two'] + (int)$marks['term_one_exam'])?></strong></td>
                                    <td><?=grade_num((int)$marks['term_two_test_one'] + (int)$marks['term_two_test_two'])?></td>
                                    <td><?=grade_num((int)$marks['term_two_exam'])?></td>
                                    <th><strong><?=grade_num((int)$marks['term_two_test_one'] + (int)$marks['term_two_test_two'] + (int)$marks['term_two_exam'])?></strong></th>
                                    <td><strong><?=grade_num((int)$marks['term_three_test_one'] + (int)$marks['term_three_test_two'] + (int)$marks['term_three_exams'])?></strong></th>
                                    <td><strong><?=grade_num(((int)$marks['term_one_test_one'] + (int)$marks['term_one_test_two'] + (int)$marks['term_one_exam'] + (int)$marks['term_two_test_one'] + (int)$marks['term_two_test_two'] + (int)$marks['term_two_exam'] + (int)$marks['term_three_test_one'] + (int)$marks['term_three_test_two'] + (int)$marks['term_three_exams']) / 3)?></strong></td>
                                </tr>
                                <?php endwhile;?>
                        </tbody>
        </div>

    </div>
<?php } else { ?>
<div class="container-fluid">
    <div class="row">
        <div class="jumbotron jumbotron-fluid">
            <h1>Grades by subject teachers</h1>
            <p>Teachers and their corresponding class grades</p>
            <p><a class="btn btn-primary btn-lg" href="publish.php" role="button">Publish Grades</a></p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-8 col-md-offset-2 well">
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
                                        <a href="view_grades.php?view=<?= $teacherSubject['tid'] ?>&sub=<?= $teacherSubject['subj_no'] ?>&classid=<?= $teacherSubject['class_id'] ?>" class="btn btn-xs btn-default"> View Grades</a>
                                        <!-- <a href="publish.php?pub=<?= $teacherSubject['tid'] ?>&sub=<?= $teacherSubject['subj_no'] ?>&classid=<?= $teacherSubject['class_id'] ?>"" class="btn btn-xs btn-info"> Publish Grades</a> -->

                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
        </div>
    </div>
</div>



<?php } 
include(ROOT . DS . "app" . DS . "components" . DS . "admin_nav.php"); 
require_once(ROOT . DS . "core" . DS . "resource" . DS . "script.php");
?>
