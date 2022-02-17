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

$classes = $db->query("SELECT * FROM `class_grade` WHERE `deleted` != '1'");
$name = ((isset($_POST['name'])) ? sanitize($_POST['name']) : '');
$size = ((isset($_POST['size'])) ? sanitize($_POST['size']) : '');

if (isset($_GET['del'])) {
    $id = (int)sanitize($_GET['del']);

    $db->query("UPDATE `class_grade` SET `deleted` = '1' WHERE `class_id` = '{$id}'");
    redirect("addClass.php");
}


?>

<div class="container-fluid">
    <div class="row">
        <div class="jumbotron">
            <h1>Class Summary</h1>
            <p>text</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
        </div>
        <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-6 col-md-offset-3 well">
            <h2>Add Classes</h2>
            <?php if (isset($_POST['add'])) {
                $required = ['name', 'size'];
                foreach ($required as $fields) {
                    if ($_POST[$fields] == '') {
                        $errors[] = 'You must fill all fields';
                        break;
                    }
                }
                if (!empty($errors)) {
                    echo display_errors($errors);
                } else {
                    $db->query("INSERT INTO `class_grade`(`grade_name`, `class_size`) VALUES ('{$name}','{$size}')");
                    redirect("addClass.php");
                }
            } ?>
            <form action="#" method="post">
                <div class="form-group">
                    <label for="name">class Name*:</label>
                    <input type="text" name="name" id="name" placeholder="Type in CLASS NAME.. example, Grade 9 circle" class="form-control">
                </div>
                <div class="form-group">
                    <label for="size">class Name*:</label>
                    <input type="number" name="size" id="size" max="40" placeholder="This is the max amount of students to be in this class" class="form-control">
                    <small>The max is <strong>40 students</strong></small>
                </div>
                <input type="submit" name="add" id="add" class="btn btn-primary">
            </form>


            <hr>
            <table class="table table-striped table-hover table-condensed table-bordered">
                <thead>
                    <th>Class Name</th>
                    <th>Class Size</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php while ($className = mysqli_fetch_assoc($classes)) : ?>
                        <tr>
                            <td><?= $className['grade_name'] ?></td>
                            <td><?= $className['class_size'] ?></td>
                            <td>
                                <a href="addClass.php?del=<?= $className['class_id'] ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>

                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once(ROOT . DS . "core" . DS . "resource" . DS . "script.php");
