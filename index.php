<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
require_once(ROOT . DS . "core" . DS . "resource" . DS . "user_inputs.php");
?>


<br><br><br>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2 col-sm-6 col-md-4 col-md-offset-4 well">
            <h3 class="text-center text-primary">WELCOME! PLEASE SIGN IN</h3><br>
            <?php
            if ($_POST) {
                //checking password's length
                if (strlen($password) < 6) {
                    $errors[] = 'Password must be at least 6 character.';
                }

                //check if the email exist in the database
                $query = $db->query("SELECT * FROM `users` WHERE `user_name` = '{$user_name}'");
                $user = mysqli_fetch_assoc($query);
                $userCount = mysqli_num_rows($query);

                if ($userCount < 1) {
                    $errors[] = 'That record doesn\' t exist in our record';
                }

                // check for correct password 
                if (!password_verify($password, $user['password'])) {
                    $errors[] = 'The password does not match our records. please try again.';
                }

                // check if user is deleted 
                $delquery = $db->query("SELECT * FROM `users` WHERE `user_name` = '{$user_name}' AND `deleted` != 0");
                $counter = mysqli_num_rows($delquery);


                if ($counter == 1) {
                    $errors[] = 'Access denied to the system, PLEASE contact us';
                }

                $permitQuery = $db->query("SELECT * FROM `users` WHERE `user_name` = '{$user_name}' AND `permission` = 0");
                $counterPermission = mysqli_num_rows($permitQuery);

                // check for permission  
                if ($counterPermission == 1) {
                    $errors[] = 'You are disable to login to the system. Please wait until you are unlock';
                }

                // display error if it occurs 
                if (!empty($errors)) {
                    echo display_errors($errors);
                } else {
                    //log user in
                    $query = $db->query("SELECT * FROM `users` WHERE `user_name` = '{$user_name}'");
                    $user_role = mysqli_fetch_assoc($query);

                    if ($user_role['user_role'] == ADMIN_USER) {
                        if ($user_role['change_password'] == CHANGE_PASSWORD) {
                            redirect(PROOT . "app" . DS . "components" . DS . "change_password.php?change=" . $user_role['user_id']);
                        }
                        $user_id = $user['user_id'];
                        login_admin($user_id);
                    } else if ($user_role['user_role'] == TEACHER_USER) {
                        if ($user_role['change_password'] == CHANGE_PASSWORD) {
                            redirect(PROOT . "app" . DS . "components" . DS . "change_password.php?change=" . $user_role['user_id']);
                        }
                        $user_id = $user['user_id'];
                        login_teacher_staff($user_id);
                    } else {
                        $user_id = $user['user_id'];
                        login_stud($user_id);
                    }
                }
            }
            ?>
            <form action="#" method="post">
                <div class="form-group">
                    <label for="email">User Name:</label>
                    <input type="text" name="user_name" id="user_name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Password:</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div>
                    <input type="submit" class="btn btn-primary btn-block" value="Sign in">
                    <br>
                    Don't have an account! <a href="<?= PROOT ?>app/components/register.php">Sign up</a>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
<?php require_once(ROOT . DS . "core" . DS . "resource" . DS . "script.php");




// SELECT DISTINCT sc.term_one_test_one, sc.term_one_test_two, sc.term_one_exam, sc.term_two_test_one, sc.term_two_test_two, sc.term_two_exam, sc.term_three_test_one, sc.term_three_test_two, sc.term_three_exams FROM users u, enroll_student es, subject_junior sj, scores sc WHERE es.applied_id = 8 AND sc.student_id = 1100 AND u.user_id = es.applied_id AND sc.subject_id = sj.subj_no;