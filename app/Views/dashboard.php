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

<div class="container">

    <?php $username = session()->get('first_name') . ' ' . session()->get('last_name')  ?>

    <?php if ($role === "ADMINISTRATOR") : ?>
        <h5 class="pull-right">Welcome <?php echo "<b> <i>" . $username . "</i></b>"; ?></h5>

        <div class="row">
            <?php echo anchor("admin/addcollege", 'Add Course', ['class' => 'btn btn-primary btn-sm mx-1']); ?>
            <?php echo anchor("admin/addmoderator", 'Add Instructor', ['class' => 'btn btn-primary btn-sm mx-1']); ?>
            <?php echo anchor("admin/addstudent", 'Add Student', ['class' => 'btn btn-primary btn-sm mx-1']); ?>
            <?php echo anchor("admin/addsubject", 'Add Subject', ['class' => 'btn btn-primary btn-sm mx-1']); ?>
        </div>

        <hr>
        <div class="row">
            <h3>All Users</h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Role</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($collegeUsers)) : ?>
                        <?php foreach ($collegeUsers as $collegeUser) : ?>
                            <tr>
                                <td><?php echo $collegeUser['id']; ?></td>
                                <td><?php echo $collegeUser['email']; ?></td>
                                <td><?php echo $collegeUser['first_name']; ?></td>
                                <td><?php echo $collegeUser['last_name']; ?></td>
                                <td><?php echo $collegeUser['role_name']; ?></td>
                                <td><?php echo $collegeUser['phone_number']; ?></td>
                                <td><?php echo anchor("admin/viewUser/{$collegeUser['id']}", 'View', ['class' => 'btn btn-success btn-sm mx-1']); ?>
                                    <?php echo anchor("admin/editUser/{$collegeUser['id']}", 'Edit', ['class' => 'btn btn-primary btn-sm mx-1']); ?>
                                    <?php echo anchor("admin/deleteUser/{$collegeUser['id']}", 'Delete', ['class' => 'btn btn-danger btn-sm mx-1']); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td>
                                No Records Found!
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div>
            <h5 class="pull-right">Welcome <?php echo "<b> <i>" . $username . "</i></b>"; ?></h5>
        </div>
        <div class="row">
            <?php if ($role === "INSTRUCTOR") : ?>
                <h3>As an Instructor you can</h3>
                <ul>
                    <li>View your subjects</li>
                    <li>View your students</li>
                    <li>Publish your results</li>
                </ul>
            <?php elseif ($role === "STUDENT") : ?>
                <p>As a Student you can</p>
                <ul>
                    <li>View your subjects</li>
                    <li>View your results</li>
                </ul>
            <?php endif; ?>
        </div>
    <?php endif ?>

</div>

<?= $this->endSection() ?>