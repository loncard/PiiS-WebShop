<?php
	require 'db.php';
	session_start();
	
	if (isset($_SESSION['use'])){
		header("Location: index.php");
	}
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
		<title>Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<body style="background-color:#5174ad"><br>
	<div class="container">
		<div class="col-sm-12"  style="text-align:center">
			<form name="login_form" action="" method="post">
				<label for=uname>E-mail:</label><br>
				<input type="text" name="uname" class="forme" style="width:300px" placeholder="E-mail..."><br><br>
				<label for=passw style="margin= 5px">Password:</label><br>
				<input type="password" name="passw" style="width:300px"  placeholder="Password..."><br><br>
				<input type="submit" name="log_in" class="btn btn-info btn-bg" style="width:150px" value="Log in">
				<a href="register.php" class="btn btn-info btn-bg" style="width:150px">Register !!!</a><br><br>
				<a href="index.php" class="btn btn-danger btn-md" style="width:100px">Go back</a>
			<form>
		</div>
	</div>
</body>
<?php

if(isset($_POST['uname'])){
$user=$_POST['uname'];
}
	
if(isset($_POST['passw'])){
$pass=$_POST['passw'];
}
	
if(isset($_POST["log_in"])){
	if($user!="admin"){
		$login_in = mysqli_query($mysqli,"SELECT email, password FROM users WHERE email='$user' AND password = '$pass'");
		if(mysqli_num_rows($login_in)>0){
					$_SESSION['use']=$user;
					header('Location:index.php');
				}
		else{
			echo '<script language="javascript">';
			echo 'alert(" Incorrect email or password please try again!")';
			echo '</script>';
		}
	}
	else{
		if($pass=="admin"){
			$_SESSION['use']=$user;
			header('Location:admin.php');
		}
		else{
			echo '<script language="javascript">';
			echo 'alert(" Incorrect email or password please try again!")';
			echo '</script>';
		}
	}
}
?>
</html>