<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Home Page");
}

if ($user_data['user_role'] != STUDENT_USER) {
    login_redirect(PROOT . "index.php");
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="jumbotron">
            <h2> <strong><?=Cap("Yalding Basic Cycle School")?></strong></h2>
            <p>Let's get started with your school application.</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
        </div>
        <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-10 col-md-offset-1 well">
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-body text-center">
                        <h2>Preview Application</h2>
                    </div>
                    <div class="panel-footer"><a href="preview.php">View the data your inputted</a></div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-body text-center">
                        <h2>My Class</h2>
                    </div>
                    <div class="panel-footer"><a href="mclass.php">Student's class List</a></div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-body text-center">
                        <h2>Grades</h2>
                    </div>
                    <div class="panel-footer"><a href="stgrades.php">Grades uploaded</a></div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-body text-center">
                        <h2>Transcript</h2>
                    </div>
                    <div class="panel-footer"><a href="transcript.php">Class Teachers</a></div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-body text-center">
                        <h2>Link Parent</h2>
                    </div>
                    <div class="panel-footer"><a href="permit.php">Permit your Parent to view your scores</a></div>
                </div>
            </div>
        </div>
    </div>

<?php include(ROOT . DS . "app" . DS . "components" . DS . "stud_nav.php");
include(ROOT . DS . "core" . DS . "resource" . DS . "script.php");