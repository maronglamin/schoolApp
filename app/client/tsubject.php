<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Grades");
}
if ($user_data['user_role'] != TEACHER_USER) {
    login_redirect(PROOT . "index.php");
}
include(ROOT . DS . "app" . DS . "components" . DS . "client_nav.php");
$teacher_id = $user_data['user_id'];
$student_detail = $db->query("SELECT * FROM `teacher_subject` WHERE `teacher_id` = '{$teacher_id}' AND `status_del` != '1'");



?>

<div class="container-fluid">
    <div class="row">
        <div class="jumbotron">
            <h1>Score records</h1>
            <p>Students in your Subject list. Here, add and view the scores of a perticular student.</p>
        </div>
    </div>
</div>
<div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-8 col-md-offset-2 well">
    <h2>Student records</h2>
    <?php while($teach_subj = mysqli_fetch_assoc($student_detail)):
        $class_id = $teach_subj['class_id'];
        $teacher_id = $teach_subj['teacher_id'];
        $student_subject = $db->query("SELECT DISTINCT u.full_name AS studname, u.stud_parent_name AS pname, es.user_id AS sid, es.class_id, ts.subject_id FROM users u, class_grade cg, enroll_student es, teacher_subject ts WHERE ts.class_id = '{$class_id}' AND ts.teacher_id = '{$teacher_id}' AND ts.class_id = es.class_id AND u.user_id = es.applied_id AND cg.deleted != '1' AND ts.status_del != '1' AND es.app_status != '0' AND es.app_status != '2' ORDER BY es.class_id");
    ?>
    <table class="table table-striped table-hover table-condensed table-bordered">
    <thead>
        <th>Name</th>
        <th>Student ID</th>
        <th>Grades</th>
        </thead>
        <tbody>
    </thead>
    </tbody>
        <?php while($stud_subject = mysqli_fetch_assoc($student_subject)):
            $subject_name = $stud_subject['subject_id'];
            $subjName = $db->query("SELECT * FROM `subject_junior` WHERE `subj_no` = '{$subject_name}' ORDER BY `subj_no`");
            $subj_full_name = mysqli_fetch_assoc($subjName);
        ?>
            <tr>
                <td><?=$stud_subject['studname']?></td>
                <td><?=$stud_subject['sid']?></td>
                
                <td>
                    <a href="grades.php?id=<?=$stud_subject['sid']?>&classId=<?=$stud_subject['class_id']?>&subjId=<?=$stud_subject['subject_id']?>&teacherId=<?=$teacher_id?>" class="btn btn-xs btn-primary">Enter Grades</a>
                    <?=$subj_full_name['subj_name']?>
                </td>
            </tr>
        <?php endwhile;?>
    </tbody>
    </table>
    <?php continue; endwhile;?>
</div>
<?php require_once(ROOT . DS . "core" . DS . "resource" . DS . "script.php");
