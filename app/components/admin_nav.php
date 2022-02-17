<nav class="navbar navbar-fixed-top navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= PROOT ?>app/admin/dashboard.php">Dashboard</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <a class="navbar-brand" href="funding.php">Fundings</a>
            <a class="navbar-brand" href="view_grades.php">View Grades</a>


            <!-- <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admission <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="openAdmission.php">Open Enrollment</a></li>
                        <li><a href="enrollment.php">Enrollment</a></li>
                        <li><a href="enrolled.php">Enrolled</a></li>
                    </ul>
                </li>
            </ul> -->
            <!-- <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form> -->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admission <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="openAdmission.php">Open Enrollment</a></li>
                        <li><a href="enrollment.php">Enrollment</a></li>
                        <li><a href="enrolled.php">Enrolled</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Catalog <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../components/subject.php">Subject Catalog</a></li>
                        <li><a href="../admin/steacher.php">Subject Teachers</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Classes <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="class_teacher.php">Class Teachers</a></li>
                        <li><a href="class.php">Students in school</a></li>
                        <li><a href="../admin/addClass.php">Assign Classes</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle glyphicon glyphicon-user" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">View Profile</a></li>
                        <li><a href="users.php">System Users</a></li>
                        <li><a href="<?= PROOT ?>app/admin/adduser.php">Add Users</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="../components/change_password.php?change=<?= $user_data['user_id'] ?>">Change Password</a></li>
                        <li><a href="../components/logout.php">log out</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>