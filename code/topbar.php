<?php
	require 'db.php';
	?>
	
	
	
	<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	</head>	
		<body style="background-color:#5174ad">
			<div style="text-align:left" class="col-sm-9" style="margin:5px">
				<form action="" method="post" style="margin:5px">	
					<input type="submit" name="home" value="HOME" class="btn btn-info" style="width:120px"/>
				<?php	$sql = "SELECT * FROM categories ";
					$result = mysqli_query($mysqli,$sql)or die(mysqli_error());
						while($row = mysqli_fetch_array($result)):?>
							<input type="submit" name="navi" id="<?php echo $row['name']; ?>" value="<?php echo $row['name']; ?>" class="btn btn-info" style="width:120px"/>
						<?php 
						endwhile;
						
						if(isset($_POST['navi'])){
							$catg = $_POST['navi'];
						}
						
						?>
				</form>
			</div>
		</body>
	</html>