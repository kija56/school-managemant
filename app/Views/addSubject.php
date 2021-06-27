<?= $this->extend("layouts/app") ?>

<?= $this->section("body") ?>
<nav class="navbar navbar-default" style="background-color: #e3f2fd;">
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
                <?php $role = session()->get('role_name')  ?>
                <?php if ($role === "ADMINISTRATOR") : ?>
                    <li><a href="<?= site_url('/dashboard') ?>"> Home <span class="sr-only">(current)</span></a></li>
                    <li><a href="<?= site_url('/admin/moderator') ?>">Instructors</a></li>
                    <li><a href="<?= site_url('/admin/viewstudents') ?>">Students</a></li>
                    <li class="active"><a href="<?= site_url('admin/subjects') ?>">Subjects</a></li>
                    <li><a href="<?= site_url('/admin/viewcourses') ?>">Courses</a></li>
                    <li><a href="<?= site_url('/admin/courseresults') ?>">Results</a></li>
                <?php elseif ($role === "INSTRUCTOR") : ?>
                    <li><a href="<?= site_url('/dashboard') ?>"> Home <span class="sr-only">(current)</span></a></li>
                    <li><a href="<?= site_url('/admin/viewstudents') ?>">Students</a></li>
                    <li class="active"><a href="<?= site_url('admin/subjects') ?>">Subjects</a></li>
                    <li><a href="<?= site_url('/admin/courseresults') ?>"> Results</a></li>
                <?php else : ?>
                    <li><a href="<?= site_url('/dashboard') ?>"> Home <span class="sr-only">(current)</span></a></li>
                    <li class="active"><a href="<?= site_url('admin/subjects') ?>">My Subjects</a></li>
                    <li><a href="<?= site_url('/student/courseresults') ?>">My Results</a></li>
                <?php endif; ?>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= session()->get('first_name') . ' ' . session()->get('last_name') ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= site_url('profile') ?>">Profile</a></li>
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
            <div class="panel-heading">Add Subject</div>
            <div class="panel-body">
                <?php if (isset($validation)) : ?>
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <?= $validation->listErrors() ?>
                        </div>
                    </div>
                <?php endif; ?>
                <form class="" action="<?= base_url("admin/createSubject") ?>" method="post">
                    <div class="form-group">
                        <label for="name">Subject Name</label>
                        <input type="text" class="form-control" name="subject_name" id="subject_name">
                    </div>
                    <div class="form-group">
                        <label for="collegename" class="control-label">Course</label>
                        <select name="class_id" class="form-control">
                            <option value="">Select</option>
                            <?php if (count($courses)) : ?>
                                <?php foreach ($courses as $course) : ?>
                                    <option value=<?php echo $course['id'] ?>><?php echo $course['class_name'] ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="instructor" class="control-label">Instructor</label>
                        <select name="instructor" class="form-control">
                            <option value="">Select</option>
                            <?php if (count($instructors)) : ?>
                                <?php foreach ($instructors as $instructor) : ?>
                                    <option value=<?php echo $instructor['id'] ?>><?php echo $instructor['first_name'] . '' . $instructor['last_name'] ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="points">Subject Points(Weight)</label>
                        <input type="number" class="form-control" min='1' max="30" name="points" id="points">
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>