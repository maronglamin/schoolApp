<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "HOME");
}

include(ROOT . DS . "app" . DS . "components" . DS . "stud_nav.php");

$user_id = $user_data['user_id'];

$enroll_get = $db->query("SELECT * FROM `users` WHERE `user_id` = '{$user_id}'");
$applied = mysqli_fetch_assoc($enroll_get); ?>

<div class="container-fluid">
    <div class="row">
        <div class="jumbotron">
            <h1>Look back onto your Data.</h1>
            <p>Hello <strong><?=cap($user_data['full_name'])?>!</strong> Here, let's preview our information</p>
            <a href="home.php" class="btn btn-lg btn-primary">Home</a>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-10 col-md-offset-1 well">
            <div class="col-xs-12 col-md-12 col-md-offset-3">
                <img style="width: 50%;height:50%;" src="<?= PROOT . "app" . $applied['file_2'] ?>" alt="">
            </div><br>
            <h1 class="text-center text-primary"><?= strtoupper($applied['full_name']) ?></h1>
            <p class="text-danger">Required fields</p>
            <hr>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="col-xs-6 col-md-4">
                    <label for="stud_num">Student number *</label>
                    <input type="text" name="stud_num" id="stud_num" disabled class="form-control" value="Your Student number will be auto generated">
                </div>
                <div class="col-xs-6 col-md-4">
                    <label for="stud_name">Full names *</label>
                    <input type="text" name="stud_name" id="stud_name" class="form-control" disabled value="<?= $applied['full_name'] ?>">
                </div>
                <div class="col-xs-6 col-md-4">
                    <label for="stud_email">Email Address *</label>
                    <input type="text" name="stud_email" id="stud_email" class="form-control" disabled value="<?= $applied['email'] ?>">
                </div>
                <div class="col-xs-6 col-md-4">
                    <label for="stud_gender">Student's Gender *</label>
                    <input type="text" name="stud_gender" id="stud_gender" class="form-control" disabled value="<?= $applied['gender'] == '1' ? 'Male' : 'Female' ?>">
                </div>
                <div class="col-xs-6 col-md-4">
                    <label for="stud_address">Address *</label>
                    <input type="text" name="stud_address" id="stud_address" class="form-control" disabled value="<?= $applied['address'] ?>">
                </div>
                <div class="col-xs-6 col-md-4">
                    <label for="stud_dob">Date of birth *</label>
                    <input type="text" name="stud_dob" id="stud_dob" class="form-control" disabled value="<?= time_format($applied['date_of_birth']) ?>">
                </div>
                <div class="col-xs-6 col-md-4">
                    <label for="stud_place">Place of birth *</label>
                    <input type="text" name="stud_place" id="stud_place" class="form-control" disabled value="<?= $applied['stud_place_birth'] ?>">
                </div>
                <div class="col-xs-6 col-md-4">
                    <label for="stud_pschol">School attended *</label>
                    <input type="text" name="stud_pschol" name="stud_pschol" class="form-control" disabled value="<?= $applied['pschool'] ?>">
                </div>
                <div class="col-xs-6 col-md-4">
                    <label for="stud_tel">Telephone *</label>
                    <input type="text" name="stud_tel" name="stud_tel" class="form-control" disabled value="<?= $applied['tele'] ?>">
                </div>
                <div class="col-xs-6 col-md-4">
                    <label for="stud_pname">Parent full name *</label>
                    <input type="text" name="stud_pname" name="stud_pname" class="form-control" disabled value="<?= $applied['stud_parent_name'] ?>">
                </div>
                <div class="col-xs-6 col-md-4">
                    <label for="stud_ptel">Parent telephone *</label>
                    <input type="text" name="stud_ptel" name="stud_ptel" class="form-control" disabled value="<?= $applied['mobile'] ?>">
                </div>
                <div class="col-xs-6 col-md-4">
                    <label for="stud_date_app">Date Student Applied</label>
                    <input type="text" name="stud_date_app" name="stud_date_app" class="form-control" disabled value="<?= human_date($applied['join_date']) ?>">
                </div>
                <input type="hidden" name="applied_id" value="<?= $applied['user_id'] ?>">
                <h3 class="text-center text-primary">Attachments</h3>
                <hr>
                <div class="col-xs-612 col-md-12">
                    <label for="stud_num">Primary school Result</label>
                    <img style="width: 100%;height:auto;" src="<?= PROOT . "app" . $applied['file_one'] ?>" alt="">
                </div>

                <?php include(ROOT . DS . "core" . DS . "resource" . DS . "script.php");
