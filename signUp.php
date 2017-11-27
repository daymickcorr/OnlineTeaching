<?php include "navbar.php"; ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>Sign up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
<script>
	var nonunique=0;
	
	function memberType(obj){
		$("#selection").text(obj.innerHTML);
		$("#create").val(obj.value);
		$("#student").removeClass('required');
		$("#teacher").removeClass('required');
	}

	function uniqueUsername(){
		var username = document.getElementById("createUsername").value;

		xhr.onreadystatechange = doUniqueUsername;
		
		xhr.open("get","uniqueUsername.php?username="+username,true);

		xhr.send(null);
	}

	function doUniqueUsername(){
		//alert(xhr.readyState + "-" + xhr.status);
		if (xhr.readyState == 4 && xhr.status == 200){
			result = xhr.responseText;
			if (result == "1"){
				$("#errorCreation").html("Username Exists");
				$("#createUsername").addClass("required");
				nonunique=1;
			}
			else {
				$("#errorCreation").html("");
				$("#createUsername").removeClass("required");
				nonunique=0;
			}
		}
	}

	function validateCreation(){
		$("#errorCreation").html("");
		
		if($("#create").val() == ""){
			$("#student").addClass('required');
			$("#teacher").addClass('required');
			//$(".btn-group").addClass('required');
			$("#student").focus();
			return false;
		}

		if($("#createPassword").val() != $("#passwordConfirmation").val()){
			$("#errorCreation").html("Disparate Passwords");
			$("#passwordConfirmation").val("");
			$("#passwordConfirmation").focus();
			return false;
		}

		if(nonunique != 0){
			return false;
		}

	}

	
</script>

</head>
<body>
<form action="createMember.php" method="post">
	<div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 text-center">
					<div>
						<h2>Sign Up</h2>
					</div>
					<br/>
					<div>
						<h6>Create new account as</h6>
						<span id="selection" ></span>
					</div>
					<div class="btn-group">
						<button type="button" id="student" class="btn btn-basic" onclick="memberType(this)" value="2">Student</button>
  						<button type="button" id="teacher" class="btn btn-basic" onclick="memberType(this)" value="1">Teacher</button>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<br/>
						<label>Firstname:</label>
        				<input type="text" class="form-control" id="firstname" placeholder="Enter firstname" name="firstname" required="required">
					</div>
					<div class="form-group">
						<label>Lastname:</label>
        				<input type="text" class="form-control" id="lastname" placeholder="Enter lastname" name="lastname" required="required">
					</div>
					<div class="form-group">
						<label>Email:</label>
        				<input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required="required">
					</div>
					<div class="form-group">
						<label>Username:</label>
        				<input type="text" class="form-control" id="createUsername" placeholder="Enter username" name="username" required="required" onchange="uniqueUsername()">
					</div>
					<div class="form-group">
						<label>Password:</label>
        				<input type="password" class="form-control" id="createPassword" placeholder="Enter password" name="password" required="required">
					</div>
					<div class="form-group">
						<label>Password Confirmation:</label>
        				<input type="password" class="form-control" id="passwordConfirmation" placeholder="Enter password confirmation" required="required">
					</div>
					<div class="text-center">
						<span id="errorCreation" style="color: red;"></span>
						<br/>
						<button type="submit" class="btn btn-primary" id="create" name="submit" value="" onclick="return validateCreation()">Create</button>
					</div>
				</div>
				<div class="col-sm-4">
				</div>		
			</div>
		</div>
	</div>
</form>
</body>
</html>
