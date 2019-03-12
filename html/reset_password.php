<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<div class="form_log_in">
			<form>
				  <div class="form-gruop">
				  	<h2>Reset Password</h2>
				  </div>
				  
				  <div class="form-group">
				    <label for="exampleInputPassword1">Your Code you have been recived on Your Email</label>
				    <input type="text" class="form-control" id="code" placeholder="Code">
				  </div>
				   <button type="submit" class="btn btn-primary" id='check_code'>Chek</button>

			</form>


			<form style="display: none;">

				  <div class="form-gruop">
				  	<h2>Reset Password</h2>
				  </div>
				  
				  <div class="form-group">
				    <label for="exampleInputPassword1">New Password</label>
				    <input type="text" class="form-control" id="code" placeholder="Code">
				  </div>
				    <div class="form-group">
				    <label for="exampleInputPassword1">Rewrite Password</label>
				    <input type="text" class="form-control" id="code" placeholder="Code">
				  </div>
				   <button type="submit" class="btn btn-primary" id='check_code'>submit</button>


			</form>
		</div> <!-- End the form-log_in  -->
	</div> <!-- End the container -->
	<script type="text/javascript" src="../js/reset_password.js"></script>
</body>
</html>