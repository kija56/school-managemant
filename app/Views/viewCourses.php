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
                <li><a href="<?= site_url('/dashboard') ?>"> Home <span class="sr-only">(current)</span></a></li>
                <li><a href="<?= site_url('/admin/moderator') ?>">Instructors</a></li>
                <li><a href="<?= site_url('/admin/viewstudents') ?>">Students</a></li>
                <li><a href="<?= site_url('admin/viewsubjects') ?>">Subjects</a></li>
                <li class="active"><a href="#">Courses</a></li>
                
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

<div class="container">
    <div class="row">
        <?php echo anchor("admin/addcollege", 'New Course', ['class' => 'btn btn-primary btn-sm mx-1']); ?>
    </div>
    <hr>
    <div class="row">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Class Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($courses)) : ?>
                    <?php foreach ($courses as $course) : ?>
                        <tr>
                            <td><?php echo $course['id']; ?></td>
                            <td><?php echo $course['class_name']; ?></td>

                            <td>
                                <?php echo anchor("admin/viewCourse/{$course['id']}", 'View', ['class' => 'btn btn-success btn-sm mx-1']); ?>
                                <?php echo anchor("admin/editCourse/{$course['id']}", 'Edit', ['class' => 'btn btn-primary btn-sm mx-1']); ?>
                                <?php echo anchor("admin/deleteCourse/{$course['id']}", 'Delete', ['class' => 'btn btn-danger btn-sm mx-1']); ?>
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
</div>

<?= $this->endSection() ?>