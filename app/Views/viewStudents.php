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
			<?php $role = session()->get('role_name')   ?>
			<ul class="nav navbar-nav">
				<?php if ($role === "ADMINISTRATOR") : ?>
					<li><a href="<?= site_url('/dashboard') ?>"> Home <span class="sr-only">(current)</span></a></li>
					<li><a href="<?= site_url('/admin/moderator') ?>">Instructors</a></li>
					<li class="active"><a href="<?= site_url('/admin/viewstudents') ?>">Students</a></li>
					<li><a href="<?= site_url('admin/viewsubjects') ?>">Subjects</a></li>
					<li><a href="<?= site_url('/admin/viewcourses') ?>">Courses</a></li>
					<li><a href="<?= site_url('/admin/courseresults') ?>">Results</a></li>
				<?php elseif ($role === "INSTRUCTOR") : ?>
					<li><a href="<?= site_url('/dashboard') ?>"> Home <span class="sr-only">(current)</span></a></li>
					<li class="active"><a href="<?= site_url('/admin/viewstudents') ?>">Students</a></li>
					<li><a href="<?= site_url('admin/viewsubjects') ?>">Subjects</a></li>
					<li><a href="<?= site_url('/admin/courseresults') ?>">Results</a></li>
				<?php else : ?>
					<li><a href="<?= site_url('/dashboard') ?>"> Home <span class="sr-only">(current)</span></a></li>
					<li><a href="<?= site_url('admin/viewsubjects') ?>">Subjects</a></li>
					<li><a href="<?= site_url('/admin/courseresults') ?>">Results</a></li>
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
<div class="container">
<?php if ($role !== "STUDENT") : ?>
	<div class="row">
		<?php echo anchor("admin/addstudent", 'New Student', ['class' => 'btn btn-primary btn-sm mx-1']); ?>
	</div>
<?php endif ?>
	<hr>
	<div class="row">
		<h5>All students</h5>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>S.No.</th>
					<th>Student Name</th>
					<th>Course</th>
					<th>Gender</th>
					<th>Email</th>
					<th>Phone Number</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php if (count($students)) : ?>
					<?php $i = 1; ?>

					<?php foreach ($students as $student) : ?>
						<tr>
							<td><?php echo $student['id']; ?></td>
							<td><?php echo $student['first_name'] . ' ' . $student['last_name'];; ?></td>
							<td><?php echo $student['class_name']; ?></td>
							<td><?php echo $student['gender']; ?></td>
							<td><?php echo $student['email']; ?></td>
							<td><?php echo $student['phone_number']; ?></td>
							<td><?php echo anchor("admin/viewstudents/{$student['id']}", 'View', ['class' => 'btn btn-primary btn-sm mx-1']); ?></td>
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