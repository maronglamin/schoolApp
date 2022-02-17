<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Transcript");
}
if ($user_data['user_role'] != STUDENT_USER) {
    login_redirect(PROOT . "index.php");
}
$id = $user_data['user_id'];
$sql = $db->query("SELECT * FROM `class_grade`");


?>

<div class="container-fluid">
    <div class="row">
        <div class="jumbotron">
            <h1>Transcript</h1>
            <p>Hello <strong><?=cap($user_data['full_name'])?>!</strong> Your transcript result</p>
            <a href="home.php" class="btn btn-lg btn-primary">Home</a>
        </div>
    </div>
    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-8 col-md-offset-2 well">
    <h5>Showing the scores of the Student: <strong><?=cap($user_data['full_name'])?></h5>
    <h3><strong>Transcript</strong></h3>

    <?php while ($result = mysqli_fetch_assoc($sql)):
        $class_id = $result['class_id'];
        $trans = $db->query("SELECT sj.subj_name, sc.term_one_test_one, sc.term_one_test_two, sc.term_one_exam, sc.term_two_test_one, sc.term_two_test_two, sc.term_two_exam, sc.term_three_test_one, sc.term_three_test_two, sc.term_three_exams, sc.class_id FROM scores sc, subject_junior sj, enroll_student en, class_grade cg WHERE en.applied_id = '{$id}'  AND sc.student_id = en.user_id AND sj.subj_no = sc.subject_id AND cg.class_id= '{$class_id}' AND sc.class_id = cg.class_id");
    ?>
        <div class="col-md-12 bg-primary">
            <h3 class="text-center"><?=$result['grade_name']?></h3>
        </div>
        <table class="table table-hover table-condensed table-striped table-bordered">
            <thead class="bg-primary">
                <th>Subject</th>
                <th>Term 1</th>
                <th>Term 2</th>
                <th>Term 3</th>
            </thead>
            <tbody>
            <?php while($tran = mysqli_fetch_assoc($trans)):?>
                <tr>
                    <td><?=$tran['subj_name']?></td>
                    <td><?=(int)$tran['term_one_test_one'] + (int)$tran['term_one_test_two'] + (int)$tran['term_one_exam']?></td>
                    <td><?=(int)$tran['term_two_test_one'] + (int)$tran['term_two_test_two'] + (int)$tran['term_two_exam']?></td>
                    <td><?=(int)$tran['term_three_test_one'] + (int)$tran['term_three_test_two'] + (int)$tran['term_three_exams']?></td>
                </tr>
                <?php endwhile;?>
            </tbody>
        </table>
    <?php endwhile;?>
</div>
</div>

    

<?php include(ROOT . DS . "app" . DS . "components" . DS . "stud_nav.php");
include(ROOT . DS . "core" . DS . "resource" . DS . "script.php");