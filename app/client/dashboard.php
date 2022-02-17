<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Dashboard");
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="jumbotron">
            <h1>Dashboard</h1>
            <p>Manage and view all task at your DASHBOARD.</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
        </div>
        <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-10 col-md-offset-1 well">
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-body text-center">
                        <h2>Class List</h2>
                    </div>
                    <div class="panel-footer"><a href="my_class.php">Check your Class list</a></div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-body text-center">
                        <h2>Enter Grades</h2>
                    </div>
                    <div class="panel-footer"><a href="tsubject.php">View students in your subject</a></div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-body text-center">
                        <h2>Class teacher</h2>
                    </div>
                    <div class="panel-footer"><a href="class_teacher.php">Get to know the class you manage</a></div>
                </div>
            </div>
        </div>
    </div>

<?php 
include(ROOT . DS . "app" . DS . "components" . DS . "client_nav.php");
include(ROOT . DS . "core" . DS . "resource" . DS . "script.php");
