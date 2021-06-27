<!DOCTYPE html>
<html>

<head>
	<title>Login</title>

	<!-- bootstrap css -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<!-- boostrap theme -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-theme.min.css') ?>">

	<!-- custom css -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('custom/css/custom.css') ?>">

	<!-- jquery -->
	<script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery.min.js') ?>"></script>
	<!-- boostrap js -->
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>

</head>

<body>


	<div class="col-md-6 col-md-offset-3 vertical-off-4">
		<div class="panel panel-default login-form">
			<div class="panel-body">
				<form method="post" action="<?php echo base_url('users/login') ?>" id="loginForm">
					<fieldset>
						<legend>
							Login
						</legend>

						<div id="message"></div>

						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" class="form-control" id="username" name="username" placeholder="Username" autofocus>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Password">
						</div>

						<button type="submit" class="col-md-12 btn btn-primary login-button">Submit</button>
					</fieldset>
				</form>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="<?php echo base_url('custom/js/login.js') ?>"></script>

</body>

</html>