<?php
	session_start();
	require 'db.php';
	if (!isset($_SESSION['use'])){
		header("Location:login.php");
	}
	?>
		
<html>
	<head>
		<title>Payments</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<link rel="stylesheet" href="forms.css" />
	</head>	
		<body style="background-color:#5174ad">
			<div class="container">
				<div style="text-align:center">
					<table class="table table-hover">
						<thead style="font-weight: bold;"><tr><td>Datum<td><td>Cijena<td><td>Nacin placanja<td><tr></thead>
	<?php	
			$mail=$_GET['mail'];
			$logged = mysqli_query($mysqli,"SELECT * FROM users WHERE email='$mail'");
			$user = mysqli_fetch_array($logged);
			$id = $user['id'];



			$sql = "SELECT * FROM purchases WHERE user_id='$id'";
				$result = mysqli_query($mysqli,$sql)or die(mysqli_error());
					while($row = mysqli_fetch_array($result)):?>
							<tr><td><?php echo $row['date']; ?><td><td><?php echo $row['price']; ?> $<td><td><?php echo $row['nacin_placanja']; ?><td><tr>
					<?php endwhile;
					?>	
				</table><br><br><a href="index.php" class="btn btn-danger" style="width:100px">Go back</a>
			</div>
		</div>
	</body>
</html>