<?php
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>Online Teaching</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
	
    
    <script src="Dependencies/jquery-3.2.1.min.js"></script>
    <script src="Dependencies/bootstrap-4.0.0/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="Dependencies/bootstrap-4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Dependencies/font-awesome-4.7.0/css/font-awesome.min.css">
    
</head>
<body>

<!-- Navbar -->

	<div>
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">
						<img src="Dependencies/Images/OnlineTeaching_Logo.svg" alt="OnlineTeaching_Logo"/>
						<span>Online Teaching</span>
					</a>
				</div>
				
				<ul class="nav navbar-nav navbar-right">
					<li class="nav-item">
						<div class="input-group">
							<input class="form-control" type="text" placeholder="Search">
							<span class="input-group-addon"><i class="fa fa-search"></i></span>
						</div>
					</li>
					<li class="nav-item"><a class="nav-link" data-toggle="modal" href="#loginModal"><span class="fa fa-sign-in"></span> Login</a></li>
      				<li class="nav-item"><a class="nav-link" data-toggle="modal" href="#singUpModal"><span class="fa fa-user-plus"></span> Sign Up</a></li>
    			</ul>		
			</div>
		</nav>
	</div>
	
<!-- Modal Login-->

	<div>
		<div class="modal fade" id="loginModal">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					
					<div class="modal-header">
						<h4 class="modal-title">Authentification</h4>	
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					
					<div class="modal-body">
        				Modal body..
      				</div>
					
					<div class="modal-footer">
        				<button type="button" class="btn btn-primary" data-dismiss="modal">Login</button>
      				</div>
      				
				</div>
			</div>
		</div>
	</div>
</body>
</html>