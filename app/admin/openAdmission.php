<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Open enrollment");
}
include(ROOT . DS . "app" . DS . "components" . DS . "admin_nav.php");

$errors = [];
$enroll_get = $db->query("SELECT * FROM `start_enrollment`");
$date = ((isset($_POST['date'])) ? sanitize($_POST['date']) : '');

if (isset($_GET['close'])) {
    $id = (int)sanitize($_GET['close']);

    $db->query("UPDATE `start_enrollment` SET `opened` = '0' WHERE `id` = '{$id}'");
    redirect("openAdmission.php");
}

if (isset($_GET['reopen'])) {
    $id = (int)sanitize($_GET['reopen']);

    $db->query("UPDATE `start_enrollment` SET `opened` = '1' WHERE `id` = '{$id}'");
    redirect("openAdmission.php");
}
if ($_POST) {
    $required = ['date'];
    foreach ($required as $fields) {
        if ($_POST[$fields] == '') {
            $errors[] = 'You must fill out the fields.';
            break;
        }
    }
    if (!empty($errors)) {
        echo display_errors($errors);
    } else {
        $db->query("INSERT INTO `start_enrollment`(`date_open`) VALUES ('{$date}')");
        redirect("openAdmission.php");
    }
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="jumbotron">
            <h1>Open Admission</h1>
            <p>Open Admission with the presize the date of opening the admission.</p>
        </div>
        <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-10 col-md-offset-1 well">
            <h1 class="text-center text-primary">Open Registration</h1>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <form action="#" method="post">
                        <div class="form-group">
                            <label for="subject">Open Date</label>
                            <input type="date" name="date" id="date" class="form-control">
                            <small>Specify the date to which admission open for</small>
                        </div>
                        <input type="submit" value="Send" class="btn btn-primary">
                </div>
                </form>
                <div class="col-sm-6">
                    <table class="table table-striped table-hover table-condensed table-bordered">
                        <thead>
                            <th>Open ID</th>
                            <th>Date Opened</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            <?php while ($open_list = mysqli_fetch_assoc($enroll_get)) : ?>
                                <tr>
                                    <td><?= $open_list['id'] ?></td>
                                    <td><?= human_date($open_list['date_open']) ?></td>
                                    <td>
                                        <?= ($open_list['opened'] == "0") ? "Closed" : "Opened" ?>
                                        <?php if ($open_list['opened'] == "1") : ?>
                                            <a href="openAdmission.php?close=<?= $open_list['id'] ?>" class="btn btn-xs btn-danger"> close</a>
                                        <?php else : ?>
                                            <a href="openAdmission.php?reopen=<?= $open_list['id'] ?>" class="btn btn-xs btn-default">Reopen</a>
                                        <?php endif; ?>
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
