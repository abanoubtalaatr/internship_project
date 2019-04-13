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
				  	<h2>log in</h2>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputEmail1">Email address</label>
				    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Password</label>
				    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
				  </div>

				  <div class="form-check" style="margin-bottom: 15px;">
				    <input type="checkbox" class="form-check-input" id="exampleCheck1">
				    <label class="form-check-label" for="exampleCheck1">Member Me</label>
				  </div>
				  <button type="submit" class="btn btn-primary" id = 'login'>Submit</button>
				  <button type="submit" class="btn btn-danger" style="float: right;"><a href="html/forget_password.php" style="color: white;"> Forget password</a> </button> 
			</form>
		</div> <!-- End the form-log_in  -->
	</div> <!-- End the container -->
	<script type="text/javascript" src="../js/login.js"></script>
</body>
</html>