<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Grades");
}
if ($user_data['user_role'] != TEACHER_USER) {
    login_redirect(PROOT . "index.php");
}

$test_one = ((isset($_POST['test1']) ? sanitize($_POST['test1']): ''));
$test_two = ((isset($_POST['test2']) ? sanitize($_POST['test2']): ''));
$exam = ((isset($_POST['exam']) ? sanitize($_POST['exam']): ''));
$errors = [];

if (isset($_GET['editTermThreeRecords']) && $_GET['classId'] && $_GET['subjId'] && $_GET['teacherId']) {
    $user_id = (int)sanitize($_GET['editTermThreeRecords']);
    $class_id = (int)sanitize($_GET['classId']);
    $subj_id = (int)sanitize($_GET['subjId']);
    $teacher_id = (int)sanitize($_GET['teacherId']);

    $test_one = ((isset($_POST['test1']) ? sanitize($_POST['test1']): ''));
    $test_two = ((isset($_POST['test2']) ? sanitize($_POST['test2']): ''));
    $exam = ((isset($_POST['exam']) ? sanitize($_POST['exam']): ''));
    $errors = [];

    $records = $db->query("SELECT * FROM `scores` WHERE `teacher_id` = '{$teacher_id}' AND `subject_id` = '{$subj_id}' AND `student_id` = '{$user_id}' AND `class_id` = '{$class_id}'");
    $edit_records = mysqli_fetch_assoc($records);
    
?>

<div class="container-fluid">
    <div class="row">
        <div class="jumbotron">
            <h1>Score records</h1>
            <p>Edit the scores of a perticular student.</p>
        </div>
    </div>  
    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-8 col-md-offset-2 well">
        <h2>Edit Enetered Scores <strong>(term Three)</strong></h2>
        <div class="panel panel-primary">
        <?php
        if (isset($_POST['edit_term_three'])) {
            $required = ['test1', 'test2', 'exam'];
                foreach ($required as $fields) {
                    if ($_POST[$fields] == '') {
                        $errors[] = 'You must enter all scores together.';
                        break;
                    }
                }
                // display error if it occurs 
                if (!empty($errors)) {
                echo display_errors($errors);
            } else {
                $db->query("UPDATE `scores` SET `term_three_test_one` = '{$test_one}', `term_three_test_two`= '{$test_two}', `term_three_exams`= '{$exam}' WHERE `teacher_id`='{$teacher_id}' AND `subject_id`='{$subj_id}' AND `class_id`='{$class_id}' AND `student_id`='{$user_id}'");
                redirect("grades.php?id=" . $user_id . "&classId=" . $class_id ."&subjId=" .  $subj_id . "&teacherId=" . $teacher_id);
            }
        }
        ?>        
        <form action="grades.php?editTermThreeRecords=<?=$user_id?>&classId=<?=$class_id?>&subjId=<?=$subj_id?>&teacherId=<?=$teacher_id?>" method="post">
        <div class="form-group col-sm-4">
            <label for="test1">Test 1</label>
                <input type="number" min="0" max="25" name="test1" id="test1" value="<?=grade_num($edit_records['term_three_test_one'])?>" class="form-control">
            </div>
            <div class="form-group col-sm-4">
                <label for="test2">Test 2</label>
                    <input type="number" min="0" max="25" name="test2" id="test2" value="<?=grade_num($edit_records['term_three_test_two'])?>" class="form-control">
                </div>
            <div class="form-group col-sm-4">
                <label for="exam">Exams</label>
                <input type="number" min="0" max="50" name="exam" id="exam" value="<?=grade_num($edit_records['term_three_exams'])?>" class="form-control">
            </div>
            <div class="panel-footer">
            <input type="submit" value="Save" name="edit_term_three" class="btn btn-primary">
            <a href="grades.php?id=<?=$user_id?>&classId=<?=$class_id?>&subjId=<?=$subj_id?>&teacherId=<?=$teacher_id?>" class="btn btn-default">Cancel</a>
            </div>
          </form>
        </div>
    </div>
</div>
<?php 
}


if (isset($_GET['editTermTwoRecords']) && $_GET['classId'] && $_GET['subjId'] && $_GET['teacherId']) {
    $user_id = (int)sanitize($_GET['editTermTwoRecords']);
    $class_id = (int)sanitize($_GET['classId']);
    $subj_id = (int)sanitize($_GET['subjId']);
    $teacher_id = (int)sanitize($_GET['teacherId']);

    $test_one = ((isset($_POST['test1']) ? sanitize($_POST['test1']): ''));
    $test_two = ((isset($_POST['test2']) ? sanitize($_POST['test2']): ''));
    $exam = ((isset($_POST['exam']) ? sanitize($_POST['exam']): ''));
    $errors = [];

    $records = $db->query("SELECT * FROM `scores` WHERE `teacher_id` = '{$teacher_id}' AND `subject_id` = '{$subj_id}' AND `student_id` = '{$user_id}' AND `class_id` = '{$class_id}'");
    $edit_records = mysqli_fetch_assoc($records);
    
?>

<div class="container-fluid">
    <div class="row">
        <div class="jumbotron">
            <h1>Score records</h1>
            <p>Edit the scores of a perticular student.</p>
        </div>
    </div>  
    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-8 col-md-offset-2 well">
        <h2>Edit Enetered Scores <strong>(term two)</strong></h2>
        <div class="panel panel-primary">
        <?php
        if (isset($_POST['edit_term_two'])) {
            $required = ['test1', 'test2', 'exam'];
                foreach ($required as $fields) {
                    if ($_POST[$fields] == '') {
                        $errors[] = 'You must enter all scores together.';
                        break;
                    }
                }
                // display error if it occurs 
                if (!empty($errors)) {
                echo display_errors($errors);
            } else {
                $db->query("UPDATE `scores` SET `term_two_test_one` = '{$test_one}', `term_two_test_two`= '{$test_two}', `term_two_exam`= '{$exam}' WHERE `teacher_id`='{$teacher_id}' AND `subject_id`='{$subj_id}' AND `class_id`='{$class_id}' AND `student_id`='{$user_id}'");
                redirect("grades.php?id=" . $user_id . "&classId=" . $class_id ."&subjId=" .  $subj_id . "&teacherId=" . $teacher_id);
            }
        }
        ?>        
        <form action="grades.php?editTermTwoRecords=<?=$user_id?>&classId=<?=$class_id?>&subjId=<?=$subj_id?>&teacherId=<?=$teacher_id?>" method="post">
        <div class="form-group col-sm-4">
            <label for="test1">Test 1</label>
                <input type="number" min="0" max="25" name="test1" id="test1" value="<?=grade_num($edit_records['term_two_test_one'])?>" class="form-control">
            </div>
            <div class="form-group col-sm-4">
                <label for="test2">Test 2</label>
                    <input type="number" min="0" max="25" name="test2" id="test2" value="<?=grade_num($edit_records['term_two_test_two'])?>" class="form-control">
                </div>
            <div class="form-group col-sm-4">
                <label for="exam">Exams</label>
                <input type="number" min="0" max="50" name="exam" id="exam" value="<?=grade_num($edit_records['term_two_exam'])?>" class="form-control">
            </div>
            <div class="panel-footer">
            <input type="submit" value="Save" name="edit_term_two" class="btn btn-primary">
            <a href="grades.php?id=<?=$user_id?>&classId=<?=$class_id?>&subjId=<?=$subj_id?>&teacherId=<?=$teacher_id?>" class="btn btn-default">Cancel</a>
            </div>
          </form>
        </div>
    </div>
</div>
<?php 
}

if (isset($_GET['editTermOneRecords']) && $_GET['classId'] && $_GET['subjId'] && $_GET['teacherId']) {
    $user_id = (int)sanitize($_GET['editTermOneRecords']);
    $class_id = (int)sanitize($_GET['classId']);
    $subj_id = (int)sanitize($_GET['subjId']);
    $teacher_id = (int)sanitize($_GET['teacherId']);

    $test_one = ((isset($_POST['test1']) ? sanitize($_POST['test1']): ''));
    $test_two = ((isset($_POST['test2']) ? sanitize($_POST['test2']): ''));
    $exam = ((isset($_POST['exam']) ? sanitize($_POST['exam']): ''));
    $errors = [];

    $records = $db->query("SELECT * FROM `scores` WHERE `teacher_id` = '{$teacher_id}' AND `subject_id` = '{$subj_id}' AND `student_id` = '{$user_id}' AND `class_id` = '{$class_id}'");
    $edit_records = mysqli_fetch_assoc($records);
    
?>

<div class="container-fluid">
    <div class="row">
        <div class="jumbotron">
            <h1>Score records</h1>
            <p>Edit the scores of a perticular student.</p>
        </div>
    </div>  
    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-8 col-md-offset-2 well">
        <h2>Edit Enetered Scores <strong>(Term one)</strong></h2>
        <div class="panel panel-primary">
        <?php
        if (isset($_POST['edit_term_one'])) {
            $required = ['test1', 'test2', 'exam'];
                foreach ($required as $fields) {
                    if ($_POST[$fields] == '') {
                        $errors[] = 'You must enter all scores together.';
                        break;
                    }
                }
                // display error if it occurs 
                if (!empty($errors)) {
                echo display_errors($errors);
            } else {
                $db->query("UPDATE `scores` SET `term_one_test_one` = '{$test_one}', `term_one_test_two`= '{$test_two}', `term_one_exam`= '{$exam}' WHERE `teacher_id`='{$teacher_id}' AND `subject_id`='{$subj_id}' AND `class_id`='{$class_id}' AND `student_id`='{$user_id}'");
                redirect("grades.php?id=" . $user_id . "&classId=" . $class_id ."&subjId=" .  $subj_id . "&teacherId=" . $teacher_id);
            }
        }
        ?>        
        <form action="grades.php?editTermOneRecords=<?=$user_id?>&classId=<?=$class_id?>&subjId=<?=$subj_id?>&teacherId=<?=$teacher_id?>" method="post">
        <div class="form-group col-sm-4">
            <label for="test1">Test 1</label>
                <input type="number" min="0" max="25" name="test1" id="test1" value="<?=grade_num($edit_records['term_one_test_one'])?>" class="form-control">
            </div>
            <div class="form-group col-sm-4">
                <label for="test2">Test 2</label>
                    <input type="number" min="0" max="25" name="test2" id="test2" value="<?=grade_num($edit_records['term_one_test_two'])?>" class="form-control">
                </div>
            <div class="form-group col-sm-4">
                <label for="exam">Exams</label>
                <input type="number" min="0" max="50" name="exam" id="exam" value="<?=grade_num($edit_records['term_one_exam'])?>" class="form-control">
            </div>
            <div class="panel-footer">
            <input type="submit" value="Save" name="edit_term_one" class="btn btn-primary">
            <a href="grades.php?id=<?=$user_id?>&classId=<?=$class_id?>&subjId=<?=$subj_id?>&teacherId=<?=$teacher_id?>" class="btn btn-default">Cancel</a>
            </div>
          </form>
        </div>
    </div>
</div>
<?php 
}
if (isset($_GET['id']) && $_GET['classId'] && $_GET['subjId'] && $_GET['teacherId']) {
    $user_id = (int)sanitize($_GET['id']);
    $class_id = (int)sanitize($_GET['classId']);
    $subj_id = (int)sanitize($_GET['subjId']);
    $teacher_id = (int)sanitize($_GET['teacherId']);

    $check_entry = $db->query("SELECT * FROM `scores` WHERE `teacher_id` = '{$teacher_id}' AND `subject_id` = '{$subj_id}' AND `student_id` = '{$user_id}' AND `class_id` = '{$class_id}' AND `term_one_exam` != ''");
    $check_result = mysqli_num_rows($check_entry);
    $check_sec_entry = $db->query("SELECT * FROM `scores` WHERE `teacher_id` = '{$teacher_id}' AND `subject_id` = '{$subj_id}' AND `student_id` = '{$user_id}' AND `class_id` = '{$class_id}' AND `term_two_exam` != ''");
    $check_sec_result = mysqli_num_rows($check_sec_entry);
    $exist_entry_one = $db->query("SELECT * FROM `scores` WHERE `teacher_id` = '{$teacher_id}' AND `subject_id` = '{$subj_id}' AND `student_id` = '{$user_id}' AND `class_id` = '{$class_id}' AND `term_one_exam` != ''");
    $exist_result = mysqli_num_rows($exist_entry_one);
    $exist_data_result = mysqli_fetch_assoc($exist_entry_one);
    $exist_entry_two = $db->query("SELECT * FROM `scores` WHERE `teacher_id` = '{$teacher_id}' AND `subject_id` = '{$subj_id}' AND `student_id` = '{$user_id}' AND `class_id` = '{$class_id}' AND `term_two_exam` != ''");
    $exist_result_two = mysqli_num_rows($exist_entry_two);
    $exist_data_result_two = mysqli_fetch_assoc($exist_entry_two);
    $exist_entry_last = $db->query("SELECT * FROM `scores` WHERE `teacher_id` = '{$teacher_id}' AND `subject_id` = '{$subj_id}' AND `student_id` = '{$user_id}' AND `class_id` = '{$class_id}' AND `term_three_exams` != ''");
    $exist_result_last = mysqli_num_rows($exist_entry_last);
    $exist_data_result_last = mysqli_fetch_assoc($exist_entry_last);


?>

<div class="container-fluid">
    <div class="row">
        <div class="jumbotron">
            <h1>Score records</h1>
            <p>Students in your Subject list. Here, add and view the scores of a perticular student.</p>
            <a href="tsubject.php" class="btn btn-lg btn-primary">Back</a>
        </div>
    </div>
        <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-8 col-md-offset-2 well">
        <h2>Eneter Scores</h2>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <h3>First Term Entry</h3>
        <p class="text-danger"><strong>All entries must be filled at once</strong></p>
                <div class="panel panel-primary">
                <form action="grades.php?id=<?=$user_id?>&classId=<?=$class_id?>&subjId=<?=$subj_id?>&teacherId=<?=$teacher_id?>" method="post" >

                    <?php 
                        if (isset($_POST['term_one'])) {
                            $required = ['test1', 'test2', 'exam'];
                            foreach ($required as $fields) {
                                if ($_POST[$fields] == '') {
                                    $errors[] = 'You must enter all scores together.';
                                    break;
                                }
                            }
                            // display error if it occurs 
                            if (!empty($errors)) {
                            echo display_errors($errors);
                        } else {
                                $db->query("INSERT INTO `scores`(`teacher_id`, `subject_id`, `class_id`, `student_id`, `term_one_test_one`, `term_one_test_two`, `term_one_exam`) VALUES('{$teacher_id}','{$subj_id}','{$class_id}','{$user_id}','{$test_one}','{$test_two}','{$exam}')");
                                redirect("grades.php?id=" . $user_id . "&classId=" . $class_id ."&subjId=" .  $subj_id . "&teacherId=" . $teacher_id);
                        }
                    }
                    ?>
                    <?php if ($exist_result != 0):?>
                        <div class="form-group col-sm-4">
                            <label for="test1">test one Entered</label>
                            <input type="number" min="0" max="25" disabled name="test1" id="test1" value="<?=grade_num($exist_data_result['term_one_test_one'])?>" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="test2">Test 2</label>
                            <input type="number" min="0" max="25" disabled name="test2" id="test2" value="<?=grade_num($exist_data_result['term_one_test_two'])?>" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="exam">Exams</label>
                            <input type="number" min="0" max="50" disabled name="exam" id="exam" value="<?=grade_num($exist_data_result['term_one_exam'])?>" class="form-control">
                        </div>
                        <div class="panel-footer">
                        <a  href="grades.php?editTermOneRecords=<?=$user_id?>&classId=<?=$class_id?>&subjId=<?=$subj_id?>&teacherId=<?=$teacher_id?>" class="btn btn-default">Edit Records</a>
                        </div>
                    <?php else:?>
                        <div class="form-group col-sm-4">
                            <label for="test1">Test 1</label>
                            <input type="number" min="0" max="25" name="test1" id="test1" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="test2">Test 2</label>
                            <input type="number" min="0" max="25" name="test2" id="test2" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="exam">Exams</label>
                            <input type="number" min="0" max="50" name="exam" id="exam" class="form-control">
                        </div>
                        <div class="panel-footer">
                        <input type="submit" value="Save" name="term_one" class="btn btn-primary">
                        </div>
                        
                    <?php endif;?>
                    </form>
                    </div>
                <?php if ($check_result > 0):?>
                <h3>Second Term Entry</h3>
                <p class="text-danger"><strong>All entries must be filled at once</strong></p>
                <div class="panel panel-primary">
                <form action="grades.php?id=<?=$user_id?>&classId=<?=$class_id?>&subjId=<?=$subj_id?>&teacherId=<?=$teacher_id?>" method="post" >
                    <?php 
                        if (isset($_POST['term_two'])) {
                            $required = ['test1', 'test2', 'exam'];
                            foreach ($required as $fields) {
                                if ($_POST[$fields] == '') {
                                    $errors[] = 'You must fill the first test before SAVING a record.';
                                    break;
                                }
                            }
                            // display error if it occurs 
                            if (!empty($errors)) {
                            echo display_errors($errors);
                        } else {
                                $db->query("UPDATE `scores` SET `term_two_test_one` = '{$test_one}', `term_two_test_two`= '{$test_two}', `term_two_exam`= '{$exam}' WHERE `teacher_id`='{$teacher_id}' AND `subject_id`='{$subj_id}' AND `class_id`='{$class_id}' AND `student_id`='{$user_id}'");
                                redirect("grades.php?id=" . $user_id . "&classId=" . $class_id ."&subjId=" .  $subj_id . "&teacherId=" . $teacher_id);
                        }
                    }
                    ?>
                    <?php if ($exist_result_two > 0):?>
                        <div class="form-group col-sm-4">
                            <label for="test1">Test 1</label>
                            <input type="number" min="0" max="25" disabled name="test1" id="test1" value="<?=grade_num($exist_data_result_two['term_two_test_one'])?>" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="test2">Test 2</label>
                            <input type="number" min="0" max="25" disabled name="test2" id="test1" value="<?=grade_num($exist_data_result_two['term_two_test_two'])?>"  class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="exam">Exams</label>
                            <input type="number" min="0" max="50" disabled name="exam" id="exam" value="<?=grade_num($exist_data_result_two['term_two_exam'])?>"  class="form-control">
                        </div>
                        <div class="panel-footer">
                        <a  href="grades.php?editTermTwoRecords=<?=$user_id?>&classId=<?=$class_id?>&subjId=<?=$subj_id?>&teacherId=<?=$teacher_id?>" class="btn btn-default">Edit Records</a>
                        </div>
                    <?php else:?>
                        <div class="form-group col-sm-4">
                            <label for="test1">Test 1</label>
                            <input type="number" min="0" max="25" name="test1" id="test1" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="test2">Test 2</label>
                            <input type="number" min="0" max="25" name="test2" id="test1" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="exam">Exams</label>
                            <input type="number" min="0" max="50" name="exam" id="exam" class="form-control">
                        </div>
                        <div class="panel-footer">
                        <input type="submit" value="Save" name="term_two" class="btn btn-primary">
                        </div>
                        <?php endif;?>
                    </form>
                </div>
                <?php if ($check_sec_result > 0):?>
                <h3>Third Term Entry</h3>
                <p class="text-danger"><strong>All entries must be filled at once</strong></p>
                <div class="panel panel-primary">
                <form action="grades.php?id=<?=$user_id?>&classId=<?=$class_id?>&subjId=<?=$subj_id?>&teacherId=<?=$teacher_id?>" method="post" >
                    <?php 
                        if (isset($_POST['term_three'])) {
                            $required = ['test1', 'test2', 'exam'];
                            foreach ($required as $fields) {
                                if ($_POST[$fields] == '') {
                                    $errors[] = 'You must fill all records at once';
                                    break;
                                }
                            }
                            // display error if it occurs 
                            if (!empty($errors)) {
                            echo display_errors($errors);
                        } else {
                            $db->query("UPDATE `scores` SET `term_three_test_one` = '{$test_one}', `term_three_test_two`= '{$test_two}', `term_three_exams`= '{$exam}' WHERE `teacher_id`='{$teacher_id}' AND `subject_id`='{$subj_id}' AND `class_id`='{$class_id}' AND `student_id`='{$user_id}'");
                            redirect("grades.php?id=" . $user_id . "&classId=" . $class_id ."&subjId=" .  $subj_id . "&teacherId=" . $teacher_id);
                        }
                    }
                    ?>
                    <?php if($exist_result_last > 0):?>
                        <div class="form-group col-sm-4">
                            <label for="test1">Test 1</label>
                            <input type="number" disabled name="test1" id="test1" value="<?= grade_num($exist_data_result_last['term_three_test_one'])?>" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="test2">Test 2</label>
                            <input type="number" disabled name="test2" id="test2" value="<?= grade_num($exist_data_result_last['term_three_test_two'])?>" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="exam">Exams</label>
                            <input type="number" disabled name="exam" id="exam" value="<?= grade_num($exist_data_result_last['term_three_exams'])?>" class="form-control">
                        </div>
                        <div class="panel-footer">
                        <a  href="grades.php?editTermThreeRecords=<?=$user_id?>&classId=<?=$class_id?>&subjId=<?=$subj_id?>&teacherId=<?=$teacher_id?>" class="btn btn-default">Edit Records</a>
                        </div>
                    <?php else:?>
                        <div class="form-group col-sm-4">
                            <label for="test1">Test 1</label>
                            <input type="number" name="test1" id="test1" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="test2">Test 2</label>
                            <input type="number" name="test2" id="test2" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="exam">Exams</label>
                            <input type="number" name="exam" id="exam" class="form-control">
                        </div>
                        <div class="panel-footer">
                        <input type="submit" value="Save" name="term_three" class="btn btn-primary">
                        </div>
                    </form>
                    <?php endif;?>
                </div>
                <?php endif;?>
                <?php endif;?>
            </div>
        </div>
</div>


<?php }

include(ROOT . DS . "app" . DS . "components" . DS . "client_nav.php");
require_once(ROOT . DS . "core" . DS . "resource" . DS . "script.php");
