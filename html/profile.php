<?php 

  require_once '../sql/data.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>profile</title>
	
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/css/all.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
    
	<?php 
       $data = new data();

     $information =   $data->get_information('signup');
    
     
	?>
<!--  start the navbar of the sit -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

	<div class="container">
	<ul class="list-unstyled"> 
		<li> <a href="/">gain exprience</a></li>
	</ul>	
     
      <div class="list">
      	<ul class="list-unstyled">

      		<li> 
      			<a href="projcts">projects</a>
      		</li>

      		<li> 
      			<a href="contact">contact us</a>
      		</li>

      		<li> 
      			<a href="../html/tasks.php">tasks</a>
      		</li>

      	</ul>
      </div>
	</div> <!-- End the container -->
  
</nav>
<!-- End the navbar of the site  -->

<!-- start of container  --> 
<div class="container">

<div class="image col-md-3">
	<div class="img">
		<img src="/internship_project/image/abanoub.jpg">
	</div>
	<h3>abanoub talaat</h3>
	<button type="button" class="btn btn-primary">edit</button>
</div>

<!-- Start content -->
<div class="content col-md-9">
	<div>
		<ul class="list-unstyled">
			<li> <a href="/internship_project/html/overview.php">overview</a> </li>
			<li> <a href="/internship_project/html/tasks.php">tasks</a> </li>
			<li> <a href="/internship_project/html/team.php">team</a> </li>
		</ul>
	</div>

   <!-- Start overview -->
	<div class="overview col-md-12">
     <div class="row">
     	 
     	 <div class="general">
			<div class="image">
				<div class="img">
					<img src="/internship_project/image/abanoub.jpg">
				</div>
			</div>
		</div>

		<div class="info_general">
			<h3>
				<span>

					<?php
					 echo $information[0]['first_name'] 
					 ." ".$information[0]['last_name']  
					 ?>
				</span>
                <a href="edit_profile.php"> <i class="fas fa-pencil-alt"></i> </a> 
		    </h3>
		    <hr>
			<h4>
				email : 
				<i class="fas fa-envelope-square"></i>
				<span>
					<?php echo $information[0]['email'] ?>
				</span>

				<a href="edit_profile.php"> <i class="fas fa-pencil-alt"></i> </a> 
			</h4>
			<hr>
			<h4>
				<span>
					 <i class="fas fa-edit"></i>	:change password 
				</span>
			  
				<a href="edit_profile.php"> <i class="fas fa-pencil-alt"></i> </a> 
			</h4>
			<hr>
			<h4>
				gender :
				<span> <?php echo $information[0]['gender'] ?> </span>
				<a href="edit_profile.php"> <i class="fas fa-pencil-alt"></i> </a> 
			</h4>

			<div class="skils">
				
			</div>
		</div> <!-- info_genral -->
		
     </div> <!-- row  -->

     <div class="row row_2">
     	<h4>
     	  <i class="fas fa-id-badge"> </i>
     	  More information help other people know more about you</h4>

     	  <hr>
     	  <div class="contact">
     	  	 <input type="text" name="number[]" placeholder="Enter Your Number" class="form-control col-md-6">
     	  	
     	  	 <input type="text" name="number[]" placeholder="Another  Number if exist " class="form-control col-md-6">
     	  </div>
     	  <hr>
     	  <div class="bio">
     	  	<textarea class="form-control">Write about your self</textarea>
     	  </div>


     </div>
		
		
	</div><!-- End overview -->
</div><!-- End content -->


</div><!-- End the container -->






</body>
</html>