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
				<li><a href="<?= site_url('/admin/teachers') ?>">Instructors</a></li>
				<li><a href="<?= site_url('/admin/viewstudents') ?>">Students</a></li>
				<li><a href="<?= site_url('admin/subjects') ?>">Subjects</a></li>
				<li class="active"><a href="#">Courses</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Enrollment <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?= site_url('/logout') ?>">Logout</a></li>
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">Separated link</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">One more separated link</a></li>
					</ul>
				</li>
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
			<div class="panel-heading">Add Course</div>
			<div class="panel-body">
				<?php if (isset($validation)) : ?>
					<div class="col-12">
						<div class="alert alert-danger" role="alert">
							<?= $validation->listErrors() ?>
						</div>
					</div>
				<?php endif; ?>
				<form class="" action="<?= base_url("admin/createCourse") ?>" method="post">
					<div class="form-group">
						<label for="name">Course Name</label>
						<input type="text" class="form-control" name="class_name" id="class_name">
					</div>

					<button type="submit" class="btn btn-success">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>