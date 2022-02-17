<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Admiision details");
}
if (!$user_data['user_id']) {
    login_redirect(PROOT . "index.php");
}
include(ROOT . DS . "app" . DS . "components" . DS . "admin_nav.php");

$errors = [];

if (isset($_GET['detail'])) {
    $user_id = (int)sanitize($_GET['detail']);

    $enroll_get = $db->query("SELECT * FROM `users` WHERE `user_id` = '{$user_id}'");
    $applied = mysqli_fetch_assoc($enroll_get);

    $id = $db->query("SELECT max(user_id) AS id FROM enroll_student");
    $student_id = mysqli_fetch_assoc($id);
    $stud_id = (int)$student_id['id'];

    if ($stud_id == '') {
        $stud_id = 1100;
    } else {
        $stud_id  = $stud_id + 1;
    }

    $applied_id = ((isset($_POST['applied_id'])) ? sanitize($_POST['applied_id']) : '');
    $stud_num = ((isset($_POST['stud_num'])) ? sanitize($_POST['stud_num']) : '');
    $date_app = ((isset($_POST['date_touched'])) ? sanitize($_POST['date_touched']) : '');
    $status = ((isset($_POST['status'])) ? sanitize($_POST['status']) : '');
    $auth = ((isset($_POST['auth'])) ? sanitize($_POST['auth']) : '');


    if (isset($_POST['save_app'])) {
        $required = ['date_touched', 'status'];
        foreach ($required as $fields) {
            if ($_POST[$fields] == '') {
                $errors[] = 'You must fill out all required fields.';
                break;
            }
        }
        if (!empty($errors)) {
            echo display_errors($errors);
        } else {
            $id = $applied['user_id'];
            $db->query("INSERT INTO `enroll_student` (`user_id`, `applied_id`, `check_date`, `auth_by`, `app_status`) VALUES ('{$stud_num}', '{$applied_id}', '{$date_app}', '{$auth}', '{$status}')");
            $db->query("UPDATE `users` SET `status` = '1' WHERE `user_id` = '{$id}'");
            $_SESSION['success_mesg'] .= 'application checked';
            redirect("enrollment.php");
        }
    }
?>
    <br><br><br><b></b>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-10 col-md-offset-1 well">
                <div class="col-xs-12 col-md-12 col-md-offset-4">
                    <img style="width: 25%;height:25%;" src="<?= PROOT . "app" . $applied['file_2'] ?>" alt="">
                </div><br>
                <h1 class="text-center text-primary"><?= strtoupper($applied['full_name']) ?></h1>
                <p class="text-danger">Required fields</p>
                <hr>
                <div class="col-xs-6 col-md-6">
                    <label for="stud_name">Full names *</label>
                    <input type="text" name="stud_name" id="stud_name" class="form-control" disabled value="<?= $applied['full_name'] ?>">
                </div>
                <div class="col-xs-6 col-md-6">
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
            </div>
        </div>
    </div>
<?php }
require_once(ROOT . DS . "core" . DS . "resource" . DS . "script.php");
