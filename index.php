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
   
	<style>
        .required {
            border: 2px solid red;
        }
        .visible{
           visibility: visible;
        }
    </style>
    
    <script>
    	var xhr = new XMLHttpRequest();
		
    	function authentificate(){
    		var username = document.getElementById("username").value;
			var password = document.getElementById("password").value;

			if(!validateAuthentification(username,password)){return;}
			
			$("#modalLogin").addClass('disabled');
			$("#modalLogin").html("<i class='fa fa-circle-o-notch fa-spin'></i> Loading")

			xhr.onreadystatechange = doAuthentification;

			xhr.open("post","authentificate.php",true);
			
			xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

			xhr.send("username="+username+"&password="+password);
        }

        function doAuthentification(){
            //alert(xhr.readyState + "-" + xhr.status);
			if(xhr.readyState==4 && xhr.status==200){
				
				result = xhr.responseText;
				if (result < 0){
					//alert(result);
					$("#credentialMessage").addClass('visible');
					document.getElementById("password").value = "";
				}
				else {
					//alert(result);
					$("#credentialMessage").removeClass('visible');
					$("#modalLogin").html("Login");
					$("#modalLogin").removeClass('disabled');
					$(".modal .close").click()
				}
				$("#modalLogin").html("Login");
				$("#modalLogin").removeClass('disabled');
			}
        }

        function validateAuthentification(username,password){
			flag = true;
			$("#username").removeClass('required');
			$("#password").removeClass('required');
			
        	if(username == ""){
				$("#username").addClass('required');
				flag = false;
			}

			if(password == ""){
				$("#password").addClass('required');
				flag = false;	
			}

			return flag;
        }
        
    </script>
    
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
							<input class="form-control" type="search" placeholder="Search">
							<span class="input-group-addon"><i class="fa fa-search"></i></span>
						</div>
					</li>
					<li class="nav-item"><a class="nav-link" data-toggle="modal" href="#loginModal"><span class="fa fa-sign-in"></span> Login</a></li>
      				<li class="nav-item"><a class="nav-link" href="singUp.php"><span class="fa fa-user-plus"></span> Sign Up</a></li>
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
        				<div class="form-group">
        					<label>Username:</label>
        					<input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
        				</div>
        				<div class="form-group">
        					<label>Password:</label>
        					<input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
        				</div>
      				</div>
					
					<div class="modal-footer">
						<div class="w-100 text-center">
							<p style="color: red; visibility: hidden;" id="credentialMessage">Invalid Credentials</p>
        					<button type="button" class="btn btn-primary" id="modalLogin" onclick="authentificate()">Login</button>
        				</div>
      				</div>
      				
				</div>
			</div>
		</div>
	</div>
	
	
</body>
</html>