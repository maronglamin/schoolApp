<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (is_logged_in()) {?>
    <div class="container-fluid">
        <div class="row">
            <div class="jumbotron">
                <h1>Invitations</h1>
                <p>Lets copy the link and send it to our parents to access our transcript</p>
                <a href="client/home.php" class="btn btn-lg btn-primary">Home</a>
            </div>
    </div>
<?php }?>

<?php if (isset($_GET['term_one']) && $_GET['identity'] && $_GET['class']) {
    $id = (int)sanitize($_GET['identity']);
    $class_id = (int)sanitize($_GET['class']);

    $trans = $db->query("SELECT sj.subj_name, sc.term_one_test_one, sc.term_one_test_two, sc.term_one_exam FROM scores sc, subject_junior sj, enroll_student en, class_grade cg WHERE en.user_id = '{$id}'  AND sc.student_id = en.user_id AND sj.subj_no = sc.subject_id AND cg.class_id= '{$class_id}' AND sc.class_id = cg.class_id");


?>
    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-8 col-md-offset-2 well">
        <?php if (!is_logged_in()):?>
            <div class="col-md-12 bg-default">
            <h3 class="text-center"><strong>Showing your child's Academic Performance</strong></h3>
            <h3 class="text-center">Yalding Basic Cycle School</h3>
            <h4 class="text-center">Child's Name: </4>
            </div>
        <?php endif;?>
    <div class="col-md-12 bg-primary">
    <h3 class="text-center"><strong>Term One (1) Result</strong></h3>
        </div>
        <table class="table table-hover table-condensed table-striped table-bordered">
            <thead class="bg-primary">
                <th>Subject</th>
                <th>First Test</th>
                <th>Second Test</th>
                <th>Examination</th>
                <th>Scores</th>
                <th>Grade</th>
            </thead>
            <tbody>
            <?php while($tran = mysqli_fetch_assoc($trans)):
                $total = (int)$tran['term_one_test_one'] + (int)$tran['term_one_test_two'] + (int)$tran['term_one_exam'];  
            ?>
                <tr>
                    <td><?=$tran['subj_name']?></td>
                    <td><?=(int)$tran['term_one_test_one']?></td>
                    <td><?=(int)$tran['term_one_test_two']?></td>
                    <td><?=(int)$tran['term_one_exam']?></td>
                    <td><?=$total?></td>
                    <td><strong>
                        <?php
                            if ($total >= 80) {
                                echo 'A';
                            } else if ($total <= 79 && $total >= 70) {
                                echo 'B';
                            } else if ($total <= 69 && $total >= 60) {
                                echo 'c';
                            } else if ($total <= 59 && $total >= 50) {
                                echo 'D';
                            } else if ($total <= 49 && $total >= 40) {
                                echo 'E';
                            } else {
                                echo 'F';
                            }

                        ?>
                    </strong></td>
                </tr>
                <?php endwhile;?>
            </tbody>
        </table>
    </div>

<?php } ?>



<?php if (isset($_GET['term_two']) && $_GET['identity'] && $_GET['class']) {
    $id = (int)sanitize($_GET['identity']);
    $class_id = (int)sanitize($_GET['class']);

    $trans = $db->query("SELECT sj.subj_name, sc.term_two_test_one, sc.term_two_test_two, sc.term_two_exam FROM scores sc, subject_junior sj, enroll_student en, class_grade cg WHERE en.user_id = '{$id}'  AND sc.student_id = en.user_id AND sj.subj_no = sc.subject_id AND cg.class_id= '{$class_id}' AND sc.class_id = cg.class_id");
    

?>
    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-8 col-md-offset-2 well">
        <?php if (!is_logged_in()):?>
            <div class="col-md-12 bg-default">
            <h3 class="text-center"><strong>Showing your child's Academic Performance</strong></h3>
            <h3 class="text-center">Yalding Basic Cycle School</h3>
            <h4 class="text-center">Child's Name: </4>
            </div>
        <?php endif;?>
    <div class="col-md-12 bg-primary">
    <h3 class="text-center"><strong>Term Two (2) Result</strong></h3>
        </div>
        <table class="table table-hover table-condensed table-striped table-bordered">
            <thead class="bg-primary">
                <th>Subject</th>
                <th>First Test</th>
                <th>Second Test</th>
                <th>Examination</th>
                <th>Scores</th>
                <th>Grade</th>
            </thead>
            <tbody>
            <?php while($tran = mysqli_fetch_assoc($trans)):
                $total = (int)$tran['term_two_test_one'] + (int)$tran['term_two_test_two'] + (int)$tran['term_two_exam'];  
            ?>
                <tr>
                    <td><?=$tran['subj_name']?></td>
                    <td><?=(int)$tran['term_two_test_one']?></td>
                    <td><?=(int)$tran['term_two_test_two']?></td>
                    <td><?=(int)$tran['term_two_exam']?></td>
                    <td><?=$total?></td>
                    <td><strong>
                        <?php
                            if ($total >= 80) {
                                echo 'A';
                            } else if ($total <= 79 && $total >= 70) {
                                echo 'B';
                            } else if ($total <= 69 && $total >= 60) {
                                echo 'c';
                            } else if ($total <= 59 && $total >= 50) {
                                echo 'D';
                            } else if ($total <= 49 && $total >= 40) {
                                echo 'E';
                            } else {
                                echo 'F';
                            }

                        ?>
                    </strong></td>
                </tr>
                <?php endwhile;?>
            </tbody>
        </table>
    </div>

<?php } ?>

<?php if (isset($_GET['term_three']) && $_GET['identity'] && $_GET['class']) {
    $id = (int)sanitize($_GET['identity']);
    $class_id = (int)sanitize($_GET['class']);

    $trans = $db->query("SELECT sj.subj_name, sc.term_three_test_one, sc.term_three_test_two, sc.term_three_exams FROM scores sc, subject_junior sj, enroll_student en, class_grade cg WHERE en.user_id = '{$id}'  AND sc.student_id = en.user_id AND sj.subj_no = sc.subject_id AND cg.class_id= '{$class_id}' AND sc.class_id = cg.class_id");
    

?>
    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-8 col-md-offset-2 well">
        <?php if (!is_logged_in()):?>
            <div class="col-md-12 bg-default">
            <h3 class="text-center"><strong>Showing your child's Academic Performance</strong></h3>
            <h3 class="text-center">Yalding Basic Cycle School</h3>
            <h4 class="text-center">Child's Name: </4>
            </div>
        <?php endif;?>
    <div class="col-md-12 bg-primary">
    <h3 class="text-center"><strong>Term Three (3) Result</strong></h3>
        </div>
        <table class="table table-hover table-condensed table-striped table-bordered">
            <thead class="bg-primary">
                <th>Subject</th>
                <th>First Test</th>
                <th>Second Test</th>
                <th>Examination</th>
                <th>Scores</th>
                <th>Grade</th>
            </thead>
            <tbody>
            <?php while($tran = mysqli_fetch_assoc($trans)):
                $total = (int)$tran['term_three_test_one'] + (int)$tran['term_three_test_two'] + (int)$tran['term_three_exams'];  
            ?>
                <tr>
                    <td><?=$tran['subj_name']?></td>
                    <td><?=(int)$tran['term_three_test_one']?></td>
                    <td><?=(int)$tran['term_three_test_two']?></td>
                    <td><?=(int)$tran['term_three_exams']?></td>
                    <td><?=$total?></td>
                    <td><strong>
                        <?php
                            if ($total >= 80) {
                                echo 'A';
                            } else if ($total <= 79 && $total >= 70) {
                                echo 'B';
                            } else if ($total <= 69 && $total >= 60) {
                                echo 'c';
                            } else if ($total <= 59 && $total >= 50) {
                                echo 'D';
                            } else if ($total <= 49 && $total >= 40) {
                                echo 'E';
                            } else {
                                echo 'F';
                            }

                        ?>
                    </strong></td>
                </tr>
                <?php endwhile;?>
            </tbody>
        </table>
    </div>

<?php } ?>