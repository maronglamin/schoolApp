<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Dashboard");
}
if ($user_data['user_role'] != ADMIN_USER) {
    login_redirect(PROOT . "index.php");
}
$errors = [];
include(ROOT . DS . "app" . DS . "components" . DS . "admin_nav.php");

$pay_record = $db->query("SELECT * FROM `payment_records`");
$st_pay_date = $db->query("SELECT * FROM `payment_records`");
$termname = ((isset($_POST['termName'])) ? sanitize($_POST['termName']) : '');
$date = ((isset($_POST['date'])) ? sanitize($_POST['date']) : '');
$student_id = ((isset($_POST['st_id'])) ? sanitize($_POST['st_id']) : '');
$pay_type = ((isset($_POST['pay_type'])) ? sanitize($_POST['pay_type']) : '');
$date_paid = ((isset($_POST['date_paid'])) ? sanitize($_POST['date_paid']) : '');
$amount = ((isset($_POST['amount'])) ? sanitize($_POST['amount']) : '');
$receipt = ((isset($_POST['receipt'])) ? sanitize($_POST['receipt']) : '');
$openRecord = ((isset($_POST['openRecord'])) ? sanitize($_POST['openRecord']) : '');
$comp = ((isset($_POST['comp'])) ? sanitize($_POST['comp']) : '');


$check_student = $db->query("SELECT * FROM `enroll_student` WHERE `user_id` = '{$student_id}'");
$stud_id = mysqli_num_rows($check_student);
$check_receipt = $db->query("SELECT * FROM `termly_paid_records` WHERE `receipt_no` = '{$receipt}'");
$receipt_number = mysqli_num_rows($check_receipt);

$record_paid = $db->query("SELECT * FROM termly_paid_records tr, users u, enroll_student es, payment_records pr WHERE tr.student_id = es.user_id AND es.applied_id = u.user_id");

?>
<div class="container-fluid">
    <div class="row">
        <div class="jumbotron">
            <h1>Financial records</h1>
            <p>Track Pupils' financial payments</p>
            <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#openPayment">Open payment</a>
            <a class="btn btn-default btn-sm" href="#" data-toggle="modal" data-target="#newPayment">New Payment</a>
            <a class="btn btn-warning btn-sm" href="#" role="button">Pandings</a>
        </div>
        <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-8 col-md-offset-2 well">
            <h2 class="text-center">Students' Fund Records</h2>
            <hr>
            <?php while ($pay_records = mysqli_fetch_assoc($pay_record)) :
            ?>
                <h3><strong>Payment For </strong><?= $pay_records['pay_type'] ?><strong> Dated: <?= time_format($pay_records['pay_date']) ?></strong></h3>
                <table class="table table-striped table-hover table-condensed table-bordered">
                    <thead>
                        <th>Student Name</th>
                        <th>Student ID</th>
                        <th>Receipt Number</th>
                        <th>Amount Paid</th>
                        <th>Balance</th>
                    </thead>
                    <tbody>
                        <?php while ($recorded = mysqli_fetch_assoc($record_paid)) : ?>
                            <?php if ($recorded['term_paid'] == $recorded['record_id']) : ?>
                                <tr>
                                    <td><?= $recorded['full_name'] ?></td>
                                    <td><?= $recorded['student_id'] ?></td>
                                    <td><?= $recorded['receipt_no'] ?></td>
                                    <td>
                                        <?= num_style($recorded['amount_paid']) ?>
                                    </td>
                                    <td>
                                        <?php if ($recorded['comp_status'] == '2') : ?>
                                            <a href="pending.php?pending=<?= $recorded['paid_id'] ?>" class="btn btn-xs btn-default">Add balance</a>
                                        <?php else : ?>
                                            <p>Completed</p>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php break;
                            endif; ?>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php endwhile; ?>
        </div>
    </div>
</div>


<!-- modal start here -->

<!-- open payment Modal -->
<div class="modal fade" id="openPayment" tabindex="-1" role="dialog" aria-labelledby="openPaymentCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Payment Record Name</h5>
                <?php
                if (isset($_POST['openRecord'])) {
                    $required = ['termName', 'date'];
                    foreach ($required as $fields) {
                        if ($_POST[$fields] == '') {
                            $errors[] = 'You must fill all fields';
                            break;
                        }
                    }
                    if (!empty($errors)) {
                        echo display_errors($errors);
                    } else {
                        $db->query("INSERT INTO `payment_records`(`pay_type`, `pay_date`) VALUES ('{$termname}','{$date}')");
                        redirect("funding.php");
                    }
                }
                ?>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="container-fluid">
                        <form action="funding.php" method="post">
                            <div class="form-group col-md-12">
                                <label for="termName">Term Name</label>
                                <input type="text" name="termName" id="termName" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="date">Date</label>
                                <input type="date" name="date" id="date" class="form-control">
                            </div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="openRecord" value="Save Cahnges" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--new payment Modal -->
<div class="modal fade" id="newPayment" tabindex="-1" role="dialog" aria-labelledby="newPaymentCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Enter Payment Record</h5>
                <?php
                if (isset($_POST['newRecord'])) {
                    $required = ['st_id', 'pay_type', 'date_paid', 'amount', 'receipt'];
                    foreach ($required as $fields) {
                        if ($_POST[$fields] == '') {
                            $errors[] = 'You must fill all fields';
                            break;
                        }
                    }
                    if ($stud_id == 0) {
                        $errors[] .= 'The student ID entered does not exist in the student records';
                    }
                    if ($receipt_number == 1) {
                        $errors[] .= 'Invalid receipt, the receipt number already exist the database';
                    }
                    if (!empty($errors)) {
                        echo display_errors($errors);
                    } else {
                        $db->query("INSERT INTO `termly_paid_records`(`student_id`, `receipt_no`, `amount_paid`, `date_paid`, `term_paid`, `comp_status`) VALUES ('{$student_id}','{$receipt}','{$amount}','{$date_paid}','{$pay_type}','{$comp}')");
                        redirect("funding.php");
                    }
                }
                ?>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="container-fluid">
                        <form action="funding.php" method="post">
                            <div class="form-group col-md-12">
                                <label for="st_id">Enter Student ID</label>
                                <input type="number" name="st_id" id="st_id" class="form-control">
                            </div>
                            <div class="from-group col-md-12">
                                <label for="pay_type">Select Term</label>
                                <select name="pay_type" id="pay_type" class="form-control">
                                    <option value="" <?= (isset($_POST['pay_type']) == '') ? 'selected' : '' ?>></option>
                                    <?php while ($term_date = mysqli_fetch_assoc($st_pay_date)) : ?>
                                        <option value="<?= $term_date['record_id'] ?>" <?= (isset($_POST['pay_type']) == $term_date['record_id']) ? 'selected' : '' ?>><?= $term_date['pay_type'] . " for " . time_format($term_date['pay_date']) ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="date_paid">Date</label>
                                <input type="date" name="date_paid" id="date_paid" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="amount">Amount paid</label>
                                <input type="number" name="amount" min="100" id="amount" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="receipt">Enter Receipt Number</label>
                                <input type="text" name="receipt" id="receipt" class="form-control">
                            </div>
                            <div class="from-group col-md-12">
                                <label for="comp">Payment Status</label>
                                <select name="comp" id="comp" class="form-control">
                                    <option value=""></option>
                                    <option value="1">Fully Paid</option>
                                    <option value="2">Incomplete</option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="newRecord" value="Save Cahnges" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once(ROOT . DS . "core" . DS . "resource" . DS . "script.php");
