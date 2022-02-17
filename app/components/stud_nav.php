<?php
$checks = $db->query("SELECT * FROM `start_enrollment`");
$result = mysqli_fetch_assoc($checks);


?>
<nav class="navbar navbar-fixed-top navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home.php">Home</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php if ($result['opened'] == "0") : ?>
                    <li><a href="#">Admissions Close</a></li>
                <?php elseif ($user_data['pschool'] == EMPTY_VALUE) : ?>
                    <li><a href="../client/admForm.php">Admissions Form</a></li>
                <?php elseif ($user_data['file_one'] == EMPTY_VALUE || $user_data['file_2'] == EMPTY_VALUE) : ?>
                    <li><a href="../client/upload_file.php">Upload Files</a></li>
                <?php else : ?>
                    <li><a href="../client/preview.php">Preview Inpus</a></li>
                <?php endif; ?>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">View Profile</a></li>
                        <li><a href="#">Change Password</a></li>
                        <li><a href="../components/logout.php">Log out</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a><span class="glyphicon glyphicon-user"></span> <?= $user_data['full_name'] ?></a></li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br><br>