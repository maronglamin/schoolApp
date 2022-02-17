<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';

if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "HOME");
}

// get the existing data about the user
$stud_id = $user_data['user_id'];
$exiting = $db->query("SELECT `full_name`, `email` FROM `users` WHERE `user_id` = $stud_id");
$result = mysqli_fetch_assoc($exiting);

$gender      = ((isset($_POST['gender'])) ? sanitize($_POST['gender']) : '');
$telephone   = ((isset($_POST['tel'])) ? sanitize($_POST['tel']) : '');
$mobile      = ((isset($_POST['mobile'])) ? sanitize($_POST['mobile']) : '');
$pname       = ((isset($_POST['pname'])) ? sanitize($_POST['pname']) : '');
$address     = ((isset($_POST['address'])) ? sanitize($_POST['address']) : '');
$eth         = ((isset($_POST['ethn'])) ? sanitize($_POST['ethn']) : '');
$dob         = ((isset($_POST['dob'])) ? sanitize($_POST['dob']) : '');
$placeOfBirth      = ((isset($_POST['placeOfBirth'])) ? sanitize($_POST['placeOfBirth']) : '');
$lastSchool      = ((isset($_POST['lschool'])) ? sanitize($_POST['lschool']) : '');
$errors = [];

// display the navigation
include(ROOT . DS . "app" . DS . "components" . DS . "stud_nav.php");

?>
<br>
<div class="container-fluid">
    <div class="col-xs-12 col-sm-6 col-md-8 col-md-offset-2 well">
        <h3 class="text-center text-primary">Registration Proccess</h3>
        <?php
        if ($_POST) {
            $required = [
                'gender', 'tel', 'mobile', 'pname', 'address', 'ethn', 'dob', 'placeOfBirth', 'lschool'
            ];

            foreach ($required as $fields) {
                if ($_POST[$fields] == '') {
                    $errors[] = 'You must fill out all required fields.';
                    break;
                }
            }
            // display error if it occurs 
            if (!empty($errors)) {
                echo display_errors($errors);
            } else {
                // send it to the databse
                $stud_id = $user_data['user_id'];

                $db->query("UPDATE `users` SET
                                            `gender` = '{$gender}', 
                                            `tele` = '{$telephone}', 
                                            `mobile` = '{$mobile}',
                                            `stud_parent_name` = '{$pname}',
                                            `address` = '{$address}',
                                            `eth` = '{$eth}',
                                            `date_of_birth` = '{$dob}',
                                            `stud_place_birth` = '{$placeOfBirth}',
                                            `pschool` = '{$lastSchool}'
                                WHERE `user_id` = '{$stud_id}'
                            ");
                $_SESSION['success_mesg'] .= 'Save! upload the necessary files as requred';
                redirect(PROOT . "app" . DS . "client" . DS . "upload_file.php");
            }
        }
        ?>
        <hr>
        <p class="text-danger">Required fields *</p>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="form-group col-sm-6">
                <label for="fname">First Name *</label>
                <input type="text" name="fname" id="fname" class="form-control" value="<?= $result['full_name']; ?>" disabled>
            </div>
            <div class="form-group col-sm-6">
                <label for="name">Email *</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= $result['email']; ?>" disabled>
            </div>
            <div class="form-group col-sm-4">
                <label for="gender">Gender *</label>
                <select name="gender" id="gender" class="form-control">
                    <option value=""></option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                </select>
            </div>
            <div class="form-group col-sm-4">
                <label for="name">Telephone *</label>
                <input type="tel" name="tel" id="tel" class="form-control">
            </div>
            <div class="form-group col-sm-4">
                <label for="name">Mobile Contact *</label>
                <input type="tel" name="mobile" id="mobile" class="form-control">
            </div>
            <div class="form-group col-sm-4">
                <label for="name">Parent/Guidian *</label>
                <input type="text" name="pname" id="pname" class="form-control">
            </div>
            <div class="form-group col-sm-8">
                <label for="name">Address *</label>
                <input type="address" name="address" id="address" class="form-control">
            </div>
            <div class="form-group col-sm-6">
                <label for="name">Place Birth</label>
                <input type="address" name="placeOfBirth" id="placeOfBirth" class="form-control">
            </div>
            <div class="form-group col-sm-6">
                <label for="name">Ethnicity</label>
                <input type="text" name="ethn" id="ethn" class="form-control">
            </div>
            <div class="form-group col-sm-4">
                <label for="name">Date of Birth</label>
                <input type="date" name="dob" id="dob" class="form-control">
            </div>
            <div class="form-group col-sm-8">
                <label for="name">Last Attended School *</label>
                <input type="text" name="lschool" id="lschool" class="form-control">
            </div>
            <input type="submit" value="Submit" class="btn btn-default">
        </form>
    </div>
</div>

<?php include(ROOT . DS . "core" . DS . "resource" . DS . "script.php");
