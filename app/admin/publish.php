<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';

$sql = $db->query("SELECT * FROM `publish_grades`");

$term = ((isset($_POST['term']) ? sanitize($_POST['term']): ""));

if (isset($_GET['arch'])) {
    $id = (int)sanitize($_GET['arch']);

    $db->query("UPDATE `publish_grades` SET `published` = '2' WHERE `record_id` = '{$id}'");
    redirect('publish.php');
}

if (isset($_GET['pub'])) {
    $id = (int)sanitize($_GET['pub']);

    $db->query("UPDATE `publish_grades` SET `published` = '1' WHERE `record_id` = '{$id}'");
    redirect('publish.php');
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="jumbotron jumbotron-fluid">
            <h1>Grade Release stages</h1>
            <p>Change the state of the grades</p>
            <p><a class="btn btn-primary btn-lg" href="view_grades.php" role="button">Back</a></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2 well">
            <h2 class="text-center">Result Publication</h2><hr>
            <div class="col-md-8">
                <table class="table table-bordered table-striped table-hover table-condensed">
                    <thead>
                        <th>Term</th>
                        <th>Published status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php while($result = mysqli_fetch_assoc($sql)):?>
                        <tr>
                            <?php
                                if ($result['term_published'] == '1') {
                                    echo '<td>First Term</td>';
                                } else if ($result['term_published'] == '2'){
                                    echo '<td>Second Term</td>';
                                } else {
                                    echo '<td>Third Term</td>';
                                }
                            ?>
                            <?php
                                if ($result['published'] == '1') {
                                    echo '<td>Published</td>';
                                } else if ($result['published'] == '0'){
                                    echo '<td>Scores Pending</td>';
                                } else {
                                    echo '<td><strong>Archieved</strong></td>';
                                }
                            ?>
                            <td><?=human_date($result['date_published'])?></td>
                            <td>
                            <?php
                                if ($result['published'] == '1') {
                                    echo 'published <a href="publish.php?arch='.$result['record_id'].'" class="btn btn-xs btn-primary">Archieve</a>';
                                } else if ($result['published'] == '0'){
                                    echo 'Pending <a href="publish.php?pub='.$result['record_id'].'" class="btn btn-xs btn-default">Publish</a>';
                                } else {
                                    echo 'Records Archieved';
                                }
                            ?>
                            </td>
                        </tr>
                        <?php endwhile;?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <?php
                    if (isset($_POST['send'])) {
                        $required = ['term', 'dateOf'];
                        foreach ($required as $field) {
                            if ($field == '') {
                                $errors[] .= 'You must fill both fields';
                            }
                            break;
                        } 
                        if (!empty($errors)) {
                            display_errors($errors);
                        } else {
                            $db->query("INSERT INTO `publish_grades`(`term_published`) VALUES ('{$term}')");
                            redirect('publish.php');
                        }

                    }
                ?>
                <form action="publish.php" method="post">
                    <div class="form-group">
                        <label for="term">Term</label>
                        <select name="term" id="term" name="term" class="form-control">
                            <option value=""></option>
                            <option value="1">First Term</option>
                            <option value="2">Second Term</option>
                            <option value="3">Third Term</option>
                        </select>
                    </div>
                    <input type="submit" value="Submit" name="send" class="btn btn-primary">
                    </div>
                </form> 
            </div>
    </div>
</div>


<?php
include(ROOT . DS . "app" . DS . "components" . DS . "admin_nav.php"); 
require_once(ROOT . DS . "core" . DS . "resource" . DS . "script.php");