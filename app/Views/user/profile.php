<?= $this->extend("layouts/app") ?>

<?= $this->section("body") ?>
<nav class="navbar navbar-default" style="background-color: #e3f2fd;">
    <?php $role = session()->get('role_name')   ?>
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">SIMS</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php if ($role === "ADMINISTRATOR") : ?>
                    <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
                    <li><a href="<?= site_url('/admin/moderator') ?>">Instructors</a></li>
                    <li><a href="<?= site_url('/admin/viewstudents') ?>">Students</a></li>
                    <li><a href="<?= site_url('/admin/viewsubjects') ?>">Subjects</a></li>
                    <li><a href="<?= site_url('/admin/viewcourses') ?>">Courses</a></li>
                    <li><a href="<?= site_url('/admin/courseresults') ?>">Results</a></li>

                <?php elseif ($role === "INSTRUCTOR") : ?>
                    <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
                    <li><a href="<?= site_url('/admin/viewstudents') ?>">Students</a></li>
                    <li><a href="<?= site_url('/admin/viewsubjects') ?>">Subjects</a></li>
                    <li><a href="<?= site_url('/admin/courseresults') ?>">Results</a></li>
                <?php else : ?>
                    <li><a href="<?= site_url('/admin/viewsubjects') ?>">My Subjects</a></li>
                    <li><a href="<?= site_url('/admin/courseresults') ?>">My Results</a></li>
                <?php endif; ?>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <?php $user_id = session()->get('id') ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= session()->get('first_name') . ' ' . session()->get('last_name') ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= site_url("profile") ?>">Profile</a></li>
                        <li><a href="<?= site_url('logout') ?>">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="container" style="margin-top:20px;">
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">Profile</div>
            <div class="panel-body">
                <?php foreach ($user as $u) : ?>
                    <h3>Hi, <?= $u['first_name'] . ' ' . $u['last_name']  ?></h3>
                    <hr>
                    <p>Email: <?= $u['email'] ?></p>
                    <p>Role: <?= $u['role_name'] ?></p>
                    <p>Phone No: <?= $u['phone_number'] ?></p>
                    <?php if ($u['gender']) : ?>
                        <p>Gender: <?= $u['gender'] ?></p>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>