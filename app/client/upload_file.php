<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "HOME");
}
$errors = [];
include(ROOT . DS . "app" . DS . "components" . DS . "stud_nav.php");

$auth = $user_data['user_id'];
$input = $db->query("SELECT `file_one`, `file_2` FROM `users` WHERE `user_id` = '{$auth}'");
$result = mysqli_fetch_assoc($input);

if (isset($_POST['delete_file_one'])) {
    $id = $user_data['user_id'];
    $path = ROOT . DS . "app" . $result['file_one'];
    unset($path);
    $db->query("UPDATE `users` SET `file_one` = '' WHERE `user_id` = '{$id}'");
    redirect("upload_file.php");
} else if (isset($_POST['delete_file_two'])) {
    $id = $user_data['user_id'];
    $path = PROOT . "app" . $result['file_2'];
    unset($path);
    $db->query("UPDATE `users` SET `file_2` = '' WHERE `user_id` = '{$id}'");
    redirect("upload_file.php");
}


?>
<br>
<div class="container-fluid">
    <div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3 well">
        <h3 class="text-center text-primary">Upload Files</h3>
        <p class="text-center">ONLY SCANNED PHOTO IS ALLOWED TO BE UPLOADED</p>
        <hr>
        <?php
        if (isset($_POST['finish'])) {
            if ($result['file_one'] == '' || $result['file_2'] == '') {
                $errors[] .= "One or both fields is not selected";
            }
            if (!empty($errors)) {
                echo display_errors($errors);
            } else {
                redirect(PROOT . "app" . DS . "client" . DS . "preview.php");
            }
        } else if (isset($_POST['result'])) {
            $filename1 =  date("Y-m-d m:i", time()) . "-" .  $_FILES['file_one']['name'];

            // get the file extension
            $extension = pathinfo($filename1, PATHINFO_EXTENSION);

            $destination = '..' . '/photos/' . $filename1;
            $size = $_FILES['file_one']['size'];

            // the physical file on a temporary uploads directory on the server
            $file = $_FILES['file_one']['tmp_name'];

            // allowed extensions
            if (!in_array($extension, ['jpg', 'png'])) {
                $errors[] .= 'Photo format isn\'t allowed';
            }
            // upload size 
            if ($_FILES['file_one']['size'] > 1000000) {
                $errors[] .= 'file shouldn\'t be larger than 1Megabyte';
            }
            // if no file is selected
            if ($filename1 == '') {
                $errors[] .= 'No scanned file photo selected';
            }
            // display error if it occurs 
            if (!empty($errors)) {
                echo display_errors($errors);
            } else {
                if (move_uploaded_file($file, $destination)) {
                    //save data from applicant
                    $destination = ltrim($destination, '..');
                    $id = $user_data['user_id'];
                    $db->query("UPDATE `users` SET `file_one` = '{$destination}' WHERE `user_id` = '{$id}'");
                    $_SESSION['success_mesg'] .= 'Saved';
                    redirect(PROOT . "app" . DS . "client" . DS . "upload_file.php");
                }
            }
        } else if (isset($_POST['photo'])) {
            $filename2 =  date("Y-m-d m:i", time()) . "-" . $_FILES['file_two']['name'];
            $extension2 = pathinfo($filename2, PATHINFO_EXTENSION);
            $destination2 = '..' . '/photos/' . $filename2;
            $size2 = $_FILES['file_two']['size'];
            $file2 = $_FILES['file_two']['tmp_name'];

            if (!in_array($extension2, ['jpg', 'png'])) {
                $errors[] .= 'Photo format isn\'t allowed';
            }
            if ($_FILES['file_two']['size'] > 1000000) {
                $errors[] .= 'file shouldn\'t be larger than 1Megabyte';
            }
            // if no file is selected
            if ($filename2 == '') {
                $errors[] .= 'No scanned file photo selected';
            }
            // display error if it occurs 
            if (!empty($errors)) {
                echo display_errors($errors);
            } else {
                if (move_uploaded_file($file2, $destination2)) {
                    //save data from applicant
                    $destination2 = ltrim($destination2, '..');
                    $user_id = $user_data['user_id'];
                    $db->query("UPDATE `users` SET `file_2` = '{$destination2}' WHERE `user_id` = '{$user_id}'");
                    $_SESSION['success_mesg'] .= 'All done! time to check';
                    redirect(PROOT . "app" . DS . "client" . DS . "upload_file.php");
                }
            }
        }
        ?>
        <p class="text-danger">Required fields *</p>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="form-group col-md-12">
                <?php if ($result['file_one'] == '') : ?>
                    <label for="file_one">Primary School result *</label>
                    <input type="file" name="file_one" id="file_one" class="form-control">
                    <input type="submit" value="UPLOAD" name="result" class="btn btn-default">
                <?php else : ?>
                    <img style="width: 100%;" src="<?= PROOT . "app" . $result['file_one'] ?>" alt="photo">
                    <hr>
                    <input type="submit" value="DELETE" name="delete_file_one" class="btn btn-danger">
                <?php endif; ?>

            </div>
            <div class="form-group col-md-12">
                <?php if ($result['file_2'] == '') : ?>
                    <label for="file_two">Student's passport photo *</label>
                    <input type="file" name="file_two" id="file_two" class="form-control">
                    <input type="submit" value="UPLOAD" name="photo" class="btn btn-default">
                <?php else : ?>
                    <img style="width: 100%;" src="<?= PROOT . "app" . $result['file_2'] ?>" alt="photo">
                    <hr>
                    <input type="submit" value="DELETE" name="delete_file_two" class="btn btn-danger">
                <?php endif; ?>
            </div>
            <input type="submit" value="FINISH" name="finish" class="btn btn-primary btn-block">
        </form>
    </div>
</div>

<?php include(ROOT . DS . "core" . DS . "resource" . DS . "script.php");
