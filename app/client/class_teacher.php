<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "CLASS TEACHER");
}
if ($user_data['user_role'] != TEACHER_USER) {
    login_redirect(PROOT . "index.php");
}
$sql = $db->query("SELECT * FROM `class_teacher` WHERE `teacher_id` = '{$user_data['user_id']}'");
?>
<div class="container-fluid">
    <div class="row">
        <div class="jumbotron">
            <h1>CLASS TEACHER</h1>
            <p>Hello <strong><?=cap($user_data['full_name'])?>!</strong> Know which class BELONGS you for register marking</p>
            <a href="dashboard.php" class="btn btn-lg btn-primary">Dashboard</a>
        </div>
    </div>
    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-6 col-md-offset-3 well">
    <h5>Showing the scores of the Student: <strong><?=cap($user_data['full_name'])?></h5>
    <?php while($result = mysqli_fetch_assoc($sql)):
        $sql_class = $db->query("SELECT * FROM `class_grade` WHERE `class_id` = '{$result['class_id']}'");
        $class_name = mysqli_fetch_assoc($sql_class);
    ?>
    <div class="list-group">
            <div class="list-group-item col-md-9"><?=$class_name['grade_name']?></div>
            <div class="list-group-item col-md-3"><a href="my_class.php">check the list</a></div>   
    </div>
    <?php endwhile;?>
</div>