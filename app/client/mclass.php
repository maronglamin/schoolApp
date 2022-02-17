<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Dashboard");
}
if ($user_data['user_role'] != STUDENT_USER) {
    login_redirect(PROOT . "index.php");
}

$stud_id = $user_data['user_id'];
$stud_class = $db->query("SELECT * FROM `enroll_student` WHERE `applied_id` = '{$stud_id}'");
$check_class = mysqli_fetch_assoc($stud_class);
$checkedclass = $check_class['class_id'];

$get_class_list = $db->query("SELECT u.full_name, en.user_id, cg.grade_name FROM users u, enroll_student en, class_grade cg WHERE en.class_id = '{$checkedclass}' AND cg.class_id = en.class_id AND u.user_id = en.applied_id ORDER BY en.user_id");
// $stud_data = mysqli_fetch_assoc($get_class);


?>


<div class="container-fluid">
    <div class="row">
        <div class="jumbotron">
            <h1>Score recorded</h1>
            <p>Hello <strong><?=cap($user_data['full_name'])?>!</strong> Here, let's explore our marks entered by our class teacher</p>
            <a href="home.php" class="btn btn-lg btn-primary">Home</a>
        </div>
    </div>
    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-6 col-md-offset-3 well">
      <h3>The current student: <strong><?=cap($user_data['full_name'])?></h3>
      <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
            <th>Student Name</th>
            <th>Student Number</th>
        </thead>
        <tbody>
            <?php while ($list = mysqli_fetch_assoc($get_class_list)):?>
            <tr>
                <td><?=$list['full_name']?></td>
                <td><?=$list['user_id']?></td>
            </tr>
            <?php endwhile;?>
        </tbody>
    </table>
    </div>
    
</div>




<?php include(ROOT . DS . "app" . DS . "components" . DS . "stud_nav.php");
include(ROOT . DS . "core" . DS . "resource" . DS . "script.php");