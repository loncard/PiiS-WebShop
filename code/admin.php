<?php
	session_start();
	require 'db.php';
	if ($_SESSION['use']!="admin"){
		header("Location:login.php");
	}
	?>
		
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
		<title>Admin mode</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	</head>	
		<body style="background-color:#5174ad"><?php?>
			<div class="container" style="text-align:center">
				<div class="col-sm-12">
				<form action="" method="post">
					<h1>Odaberite dio podataka koji želite ažurirati</h1><br>
					<input type="submit" name="stock" value="Stanje" class="btn btn-info" style="width:200px"/>
					<input type="submit" name="items" value="Katalog" class="btn btn-info" style="width:200px"/>
					<input type="submit" name="categories" value="Kategorije" class="btn btn-info" style="width:200px"/>
				</form>
			</div>
			<?php
				if(isset($_POST['stock'])):
					$sql = "SELECT * FROM products";
						$result = mysqli_query($mysqli,$sql)or die(mysqli_error());
							while($row = mysqli_fetch_array($result)):
								if($row['stocked']=='yes'):?>
								<form action="" method="post">
									<input type="submit" name="stocker" id="<?php echo $row['name'];?>" class="btn btn-success" style="width:100%" value="<?php echo $row['name'];?>"/>
								</form>
					<?php endif;
								if($row['stocked']=='no'):?>
								<form action="" method="post">
									<input type="submit" name="stocker" id="<?php echo $row['name'];?>" class="btn btn-danger" style="width:100%" value="<?php echo $row['name'];?>"/>
								</form>	
					
					<?php endif; endwhile; endif;
						
						if(isset($_POST['stocker'])){
							$stocker = $_POST['stocker'];
								$sql = "SELECT * FROM products WHERE name='$stocker'";
									$result = mysqli_query($mysqli,$sql)or die(mysqli_error());
										while($row = mysqli_fetch_array($result)){
											if($row['stocked']=='no'){
												$imep=$row['name'];
												$sql_u = "UPDATE products SET stocked = 'yes' WHERE name='$imep'";
												mysqli_query($mysqli,$sql_u);
											}
											if($row['stocked']=='yes'){
												$imep=$row['name'];
												$sql_u = "UPDATE products SET stocked = 'no' WHERE name='$imep'";
												mysqli_query($mysqli,$sql_u);
											}
										}
									}
						
					
					
					?>	
				
				
				<?php
					if(isset($_POST['items'])):
						$sql = "SELECT * FROM products";
								$result = mysqli_query($mysqli,$sql)or die(mysqli_error());
									while($row = mysqli_fetch_array($result)):?>
										<form action="" method="post" >
											<a href="azuriraj.php?id=<?php echo $row['id'];?>" class="btn btn-info" style="width:60%" value=" <?php echo $row['name'];?>"><?php echo $row['name'];?></a>
										</form>
							<?php endwhile; ?> <form action="" method="post"><a href="dodaj_proizvod.php" class="btn btn-success" value="DODAJTE PROIZVOD">DODAJTE PROIZVOD</a></form>
							<?php endif; ?>
				
				<?php
					if(isset($_POST['categories'])):
						$sql = "SELECT * FROM categories";
								$result = mysqli_query($mysqli,$sql)or die(mysqli_error());
									while($row = mysqli_fetch_array($result)):?>
										<form action="" method="post" >
											<a href="azuriraj_kategoriju.php?id=<?php echo $row['id'];?>" class="btn btn-info" style="width:60%"><?php echo $row['name'];?></a>
										</form>
							<?php endwhile; ?> <form action="" method="post"><a href="dodaj_kategoriju.php" class="btn btn-success">DODAJTE KATEGORIJU</a></form>
							<?php endif; ?>
				
				<form action="" method="post">
					<a href="index.php" class="btn btn-info">GO TO STORE</a>
					<input type="submit" name="logout" style="margin: 10px;" class="btn btn-danger" value="Log Out"/>
				</form>
				<?php
					if( isset($_POST['logout'])){ 
						unset($_SESSION["use"]);
						header("Location: login.php");
					}
				?>
		</div>
	</body>
</html>