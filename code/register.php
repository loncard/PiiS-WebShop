<?php
	session_start();
	require 'db.php';
	
?>
<!DOCTYPE html>
<html>
<style> 
input[type=text] {
    width: 100%;
    padding: 6px 10px;
    margin: 8px 0;
    box-sizing: border-box;
	border-radius: 10px;
    border: 3px solid #ccc;
    -webkit-transition: 0.5s;
    transition: 0.5s;
    outline: none;
}

input[type=text]:focus {
    border: 3px solid #555;
}

input[type=password] {
    width: 100%;
    padding: 6px 10px;
    margin: 8px 0;
    box-sizing: border-box;
	border-radius: 10px;
    border: 3px solid #ccc;
    -webkit-transition: 0.5s;
    transition: 0.5s;
    outline: none;
}

input[type=password]:focus {
    border: 3px solid #555;
}
</style>
<head>
		<title>Register</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<body style="background-color:#5174ad">
	<div class="container"><br>
		<div class="col-sm-12"  style="text-align:center">
			<form name="register_form" action="" method="post">

				<label for=name style="margin= 5px">Name:</label><br>
				<input type="text" name="name" style="width:300px" placeholder="Name..."><br><br>
				
				<label for=lname style="margin= 5px">Lastname:</label><br>
				<input type="text" name="lname" style="width:300px" placeholder="Lastname..."><br><br>
				
				<label for=adrs style="margin= 5px">Address:</label><br>
				<input type="text" name="adrs" style="width:300px" placeholder="Address..."><br><br>
				
				<label for=email style="margin= 5px">E-mail:</label><br>
				<input type="text" name="email" style="width:300px" placeholder="E-mail..."><br><br>
				
				<label for=passw style="margin= 5px">Password:</label><br>
				<input type="password" name="passw" style="width:300px" placeholder="Password..."><br><br>
			
			<input type="submit" name="Reg_submit" class="btn btn-info" style="width:150px" value="Register"><br><br>
			
			<a href="login.php" class="btn btn-danger" style="width:100px">Go back</a>
			</form>
		</div>
	</div>
</body>
<?php

if(isset($_POST['name'])){
$u_name=$mysqli->escape_string($_POST['name']);
}
if(isset($_POST['lname'])){
$u_lastname=$_POST['lname'];
}
if(isset($_POST['adrs'])){
$u_adrs=$_POST['adrs'];
}
if(isset($_POST['email'])){
$u_email=$_POST['email'];
}
if(isset($_POST['passw'])){
$u_passw=$_POST['passw'];
}


if(isset($_POST["Reg_submit"])){
		if($u_name==""||$u_lastname==""||$u_adrs==""||$u_email==""||$u_passw==""){
			echo '<script language="javascript">';
			echo 'alert("Information is not complete !!!")';
			echo '</script>';
		}
		else{
			$query = mysqli_query($mysqli,"SELECT * FROM users WHERE email='$u_email'");
			if(mysqli_num_rows($query)>0){
				echo '<script language="javascript">';
				echo 'alert("This email is already in use !!!")';
				echo '</script>';
			}
			
			else{
			$sql_u = "INSERT INTO users (name,lastname,address,email,password) VALUES ('$u_name','$u_lastname','$u_adrs','$u_email','$u_passw')";
			mysqli_query($mysqli,$sql_u);
			
			$message="Hi {$u_name},\nwelcome to our site!\nWe thank you for registering and\nhope you'll find all you're looking for in our shop.";
			$subject="Registration";
			mail($u_email,$subject,$message);
			
			header("Location:index.php");
			
			}
		}	
}
?>
</html>