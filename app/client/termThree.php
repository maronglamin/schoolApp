<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Term Records");
}
if ($user_data['user_role'] != STUDENT_USER) {
    login_redirect(PROOT . "index.php");
}

$stud_id = $user_data['user_id'];

$get_record = $db->query("SELECT sj.subj_name, sc.term_three_test_one, sc.term_three_test_two, sc.term_three_exams FROM scores sc, subject_junior sj, enroll_student en WHERE en.applied_id = '{$stud_id}' AND sc.student_id = en.user_id AND sj.subj_no = sc.subject_id");
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
    <h4>Term Three Result. <h3>Student Name: <strong><?=cap($user_data['full_name'])?></h3></h4>

       <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
            <th>SUBJECT</th>
            <th>TEST 1</th>
            <th>TEST 2</th>
            <th>TOTAL (25)</th>
            <th>EXAMS (50)</th>
            <th>TOTAL (100)</th>
        </thead>
        <tbody>
            <?php while($result = mysqli_fetch_assoc($get_record)):?>
            <tr>
                <td><?=cap($result['subj_name'])?></td>
                <td><?=$result['term_three_test_one']?></td>
                <td><?=$result['term_three_test_two']?></td>
                <td><strong><?=(int)$result['term_three_test_one'] + (int)$result['term_three_test_two']?></strong></td>
                <td><?=$result['term_three_exams']?></td>
                <td><strong><?=(int)$result['term_three_test_one'] + (int)$result['term_three_test_two'] + (int)$result['term_three_exams']?></strong></td>
            </tr>
            <?php endwhile;?>
        </tbody>
    </table>
    </div>
</div>

<?php include(ROOT . DS . "app" . DS . "components" . DS . "stud_nav.php");
include(ROOT . DS . "core" . DS . "resource" . DS . "script.php");
