<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<div class="form_forget_password">
			<form>
				  <div class="form-gruop">
				  	<h2>Forget Password ?</h2>
				  </div>
				  <div class="form-group">
				    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
				  </div>

				   <div class="alert alert-danger" role="alert" style="padding: 4px;
                         text-transform: capitalize;display: none;">check your Email
                    <span class="bg-primary">  And you will Redirect now to Reset Your Password</span> 
                 </div>


				   <div class="form-group" style="overflow: hidden;">
				  	<button type="button" class="btn btn-danger" id="forget_password">Reset Password</button>
				  	<button type="submit" class="btn btn-primary">Back</button>
				  </div>
				  
			</form>
		</div> <!-- End the form-log_in  -->
	</div> <!-- End the container -->
	<script type="text/javascript" src="../js/forget_password.js"></script>
</body>
</html>
