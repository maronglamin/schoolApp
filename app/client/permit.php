<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "permission");
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
            <h1>Invitations</h1>
            <p>Lets copy the link and send it to our parents to access our transcript</p>
            <a href="home.php" class="btn btn-lg btn-primary">Home</a>
        </div>
    </div>
    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-8 col-md-offset-2 well">
    <h3><strong>Links generated</strong></h3>
    <hr>

    <?php while ($result = mysqli_fetch_assoc($sql)):
    $class_id = $result['class_id'];
          $trans = $db->query("SELECT DISTINCT sc.student_id, sc.teacher_id, sc.class_id FROM scores sc, enroll_student en, class_grade cg, subject_junior sj WHERE en.applied_id = '{$id}' AND sc.student_id = en.user_id AND sj.subj_no = sc.subject_id AND cg.class_id = '{$class_id}' AND sc.class_id = cg.class_id");

        ?>
        <div class="list-group">
            <?php while ($tran = mysqli_fetch_assoc($trans)):?>
            <li class="list-group-item active"><?=$result['grade_name']?></li>
            <li class="list-group-item">http://localhost<?=PROOT?>/app/transcript.php?term_one=1&identity=<?=$tran['student_id']?>&class=<?=$tran['class_id']?> <a class="btn btn-xs btn-primary pull-right" href="../transcript.php?term_one=1&identity=<?=$tran['student_id']?>&class=<?=$tran['class_id']?>">visit</a></li>
            <li class="list-group-item">http://localhost<?=PROOT?>/app/transcript.php?term_two=2&identity=<?=$tran['student_id']?>&class=<?=$tran['class_id']?> <a class="btn btn-xs btn-primary pull-right" href="../transcript.php?term_two=2&identity=<?=$tran['student_id']?>&class=<?=$tran['class_id']?>">visit</a></li>
            <li class="list-group-item">http://localhost<?=PROOT?>/app/transcript.php?term_three=3&identity=<?=$tran['student_id']?>&class=<?=$tran['class_id']?> <a class="btn btn-xs btn-primary pull-right" href="../transcript.php?term_three=3&identity=<?=$tran['student_id']?>&class=<?=$tran['class_id']?>">visit</a></li>
            <?php endwhile;?>
        </div>

    <?php endwhile;?>

</div>
</div>

<?php include(ROOT . DS . "app" . DS . "components" . DS . "stud_nav.php");
include(ROOT . DS . "core" . DS . "resource" . DS . "script.php");