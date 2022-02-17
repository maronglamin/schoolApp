<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Dashboard");
}
if ($user_data['user_role'] != STUDENT_USER) {
    login_redirect(PROOT . "index.php");
}

$stud_id = $user_data['user_id'];
$sql = $db->query("SELECT `applied_id`, `user_id` FROM enroll_student WHERE `applied_id` = '{$stud_id}'");
$result = mysqli_fetch_assoc($sql);
$id = $result['user_id'];

$get_class = $db->query("SELECT en.user_id, en.applied_id, sc.term_one_exam, sc.term_two_exam, sc.term_three_exams FROM enroll_student en, scores sc, users u WHERE en.user_id = sc.student_id AND en.applied_id = u.user_id AND en.user_id = '{$id}'");
$stud_data = mysqli_fetch_assoc($get_class);

$termOpen = $db->query("SELECT * FROM `publish_grades`");
$termcheck = mysqli_fetch_assoc($termOpen);
$check = mysqli_num_rows($termOpen);
$termcheck2 = mysqli_fetch_assoc($termOpen);
$check2 = mysqli_num_rows($termOpen);
$termcheck3 = mysqli_fetch_assoc($termOpen);
$check3 = mysqli_num_rows($termOpen);



// $student_subject = $db->query("SELECT DISTINCT u.full_name AS studname, es.user_id AS sid, es.class_id, ts.subject_id FROM users u, class_grade cg, enroll_student es, teacher_subject ts WHERE ts.class_id = '{$class_id}' AND ts.teacher_id = '{$teacher_id}' AND ts.class_id = es.class_id AND u.user_id = es.applied_id AND cg.deleted != '1' AND ts.status_del != '1' AND es.app_status != '0' AND es.app_status != '2'");

?>

<div class="container-fluid">
    <div class="row">
        <div class="jumbotron">
            <h1>Score recorded</h1>
            <p>Hello <strong><?=cap($user_data['full_name'])?>!</strong> Here, let's explore our marks entered by our class teacher</p>
            <a href="home.php" class="btn btn-lg btn-primary">Home</a>
        </div>
    </div>
    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-8 col-md-offset-2 well">
    <h5>Showing the scores of the Student: <strong><?=cap($user_data['full_name'])?></h5>
    <h3><strong>Grade</strong></h3>
    <?php if (!empty($check)):?>
    <?php if($termcheck['term_published'] == '1' && $termcheck['published'] == '1'):?>
            <div class="col-xs-12 col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-body text-center">
                        <h2>TERM 1</h2>
                    </div>
                    <div class="panel-footer"><a href="termOne.php">Check your term 1 results</a></div>
                </div>
            </div>
    <?php endif;?>
    <?php endif;?>
    <?php if (!empty($check2)):?>
    <?php if($termcheck2['term_published'] == '2' && $termcheck2['published'] == '1') :?>
            <div class="col-xs-12 col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-body text-center">
                        <h2>TERM 2</h2>
                    </div>
                    <div class="panel-footer"><a href="termTwo.php">Check your term 2 results</a></div>
                </div>
            </div>
    <?php endif;?>
    <?php endif;?>
    <?php if (!empty($check3)):?>
    <?php if($termcheck3['term_published'] === '3' && $termcheck3['published'] == '1') :?>
            <div class="col-xs-12 col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-body text-center">
                        <h2>TERM 3</h2>
                    </div>
                    <div class="panel-footer"><a href="termThree.php">Check your term 3 results</a></div>
                </div>
            </div>
            </div>
    <?php endif;?>
    <?php endif;?>
</div>
</div>



<?php include(ROOT . DS . "app" . DS . "components" . DS . "stud_nav.php");
include(ROOT . DS . "core" . DS . "resource" . DS . "script.php");
