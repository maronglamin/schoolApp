<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/schoolApp/core/connection/init.php';
if (!is_logged_in()) {
    login_error_redirect(PROOT . "index.php", "Grades");
}
if ($user_data['user_role'] != TEACHER_USER) {
    login_redirect(PROOT . "index.php");
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="jumbotron">
            <h1>Lesson Plans</h1>
            <p>Let get started with our lesson plans</p>
        </div>
    </div>  
    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-md-8 col-md-offset-2 well">
        <h3 class="text-center text-primary">Neatly prepare your lesson for your respective classes</h3>
        <form action="#" method="post">
            <div class="form-group col-md-6">
                <label for="subj">Select Subject</label>
                <select name="subj" id="subj" class="form-control">
                    <option value=""></option>
                    <option value="">value</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="subj">Select Subject</label>
                    <select name="subj" id="subj" class="form-control">
                        <option value=""></option>
                        <option value="">value</option>
                    </select>
            </div>
            <div class="form-group col-md-12">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label for="obj">Objectives</label>
                <textarea name="obj" id="obj" class="form-control"></textarea>
            </div>
            <div class="form-group col-md-12">
            <label for="obj">Objectives</label>
                <textarea name="obj" id="obj" class="form-control"></textarea>
            </div>
            <div class="form-group col-md-12"></div>
            <div class="form-group col-md-12"></div>
        </form>
    </div>
</div>

<?php 
include(ROOT . DS . "app" . DS . "components" . DS . "client_nav.php");
require_once(ROOT . DS . "core" . DS . "resource" . DS . "script.php");