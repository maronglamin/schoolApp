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

            <?php if($user_data['user_role'] == TEACHER_USER):?><a class="navbar-brand" href="dashboard.php">Dashboard</a><?php endif;?>
            <?php if($user_data['user_role'] == STUDENT_USER):?><a class="navbar-brand" href="home.php">Home</a><?php endif;?>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                <?php if($user_data['user_id'] == TEACHER_USER):?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manage <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="my_class.php">My Class</a></li>
                        <li><a href="tsubject.php">My Subjects</a></li>
                    </ul>
                <?php else:?>
                <?php endif;?>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $user_data['full_name'] ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../components/change_password.php?change=<?= $user_data['user_id'] ?>">Change Password</a></li>
                        <li><a href="../components/logout.php">Log out</a></li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>