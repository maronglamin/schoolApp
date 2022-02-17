<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Admiision details");
}
include(ROOT . DS . "app" . DS . "components" . DS . "admin_nav.php");

$subj = $db->query("SELECT * FROM `subject_junior`");
$subject = ((isset($_POST['subject'])) ? sanitize($_POST['subject']) : '');

if (isset($_GET['del'])) {
    $id = (int)sanitize($_GET['del']);

    $db->query("DELETE FROM `subject_junior` WHERE `subj_no` = '{$id}'");
    redirect("subject.php");
}

if ($_POST) {
    $required = ['subject'];
    foreach ($required as $fields) {
        if ($_POST[$fields] == '') {
            $errors[] = 'You must fill out the fields.';
            break;
        }
    }
    if (!empty($errors)) {
        echo display_errors($errors);
    } else {
        $db->query("INSERT INTO `subject_junior`(`subj_name`) VALUES ('{$subject}')");
        redirect("subject.php");
    }
}
?>

<br><br><br><b></b>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-10 col-md-offset-1 well">
            <h1 class="text-center text-primary">Subjects</h1>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <form action="#" method="post">
                        <div class="form-group">
                            <label for="subject">Subject Title</label>
                            <input type="text" name="subject" id="subject" class="form-control">
                            <small>Add subject title</small>
                        </div>
                        <input type="submit" value="Send" class="btn btn-primary">
                </div>
                </form>
                <div class="col-sm-6">
                    <table class="table table-striped table-hover table-condensed table-bordered">
                        <thead>
                            <th>Subject code</th>
                            <th>Subject title</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php while ($subj_list = mysqli_fetch_assoc($subj)) : ?>
                                <tr>
                                    <td><?= $subj_list['subj_no'] ?></td>
                                    <td><?= $subj_list['subj_name'] ?></td>
                                    <td>
                                        <a href="subject.php?del=<?= $subj_list['subj_no'] ?>" class="btn btn-xs btn-danger glyphicon glyphicon-trash"> Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once(ROOT . DS . "core" . DS . "resource" . DS . "script.php");
