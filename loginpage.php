<!DOCTYPE html> 
<html> 
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title> Login Page </title>
		<style> 
			body {
			  font-family: Calibri, Helvetica, sans-serif;
			  background-color: white;
			}
			button { 
				   background-color: #4CAF50; 
				   width: 100%;
					color: white; 
					padding: 15px; 
					margin: 10px 0px; 
					border: none; 
					cursor: pointer; 
					 } 
			 form { 
					border: 3px solid #f1f1f1; 
				} 
			 input[type=text], input[type=password] { 
					width: 100%; 
					margin: 8px 0;
					padding: 12px 20px; 
					display: inline-block; 
					border: 2px solid green; 
					box-sizing: border-box; 
				}
			 button:hover { 
					opacity: 0.7; 
				}          
			 .container { 
					padding: 25px; 
					background-color: lightblue;
				} 
		</style> 
	</head> 
	
	<body>  
		<?php
			include "db_connect.php";

			if(isset($_GET['username']) && isset($_GET['password']))
			{
				$adminUser = $_GET['username'];
				$adminPass = $_GET['password'];
				$sql = "SELECT * FROM administrator WHERE username='" . $adminUser . "' AND password='" . $adminPass . "'";
				$result = $mysqli->query($sql);

				if($result->num_rows)
				{
					header("location: adminOps.php");
					exit();
				}
				else
				{
					echo "<script>alert(\"Sorry, we don't seem to have an administrator by that name stored here.\");</script>";
				}
			}
		?>
		<center><h1> Student Login Form </h1></center> 
		<form id="form1" method="GET">
			<div class="container"> 
				<label>Username : </label> 
				<input type="text" placeholder="Enter Username" name="username" required>
				<label>Password : </label> 
				<input type="password" placeholder="Enter Password" name="password" required>
				<button type="submit">Login</button> 
				<input name="remember" type="checkbox" checked="checked"> Remember me 
			</div> 
		</form>   
	</body>   
</html>
