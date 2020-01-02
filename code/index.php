<?php
session_start();
require 'db.php';
include 'topbar.php';
$product_ids = array();

if(filter_input(INPUT_POST, 'add_to_cart')){
    if(isset($_SESSION['shopping_cart'])){
        
        $count = count($_SESSION['shopping_cart']);
        
        $product_ids = array_column($_SESSION['shopping_cart'], 'id');
        
        if (!in_array(filter_input(INPUT_GET, 'id'), $product_ids)){
        $_SESSION['shopping_cart'][$count] = array
            (
                'id' => filter_input(INPUT_GET, 'id'),
                'name' => filter_input(INPUT_POST, 'name'),
                'price' => filter_input(INPUT_POST, 'price'),
                'quantity' => filter_input(INPUT_POST, 'quantity')
            );   
        }
        else {
            for ($i = 0; $i < count($product_ids); $i++){
                if ($product_ids[$i] == filter_input(INPUT_GET, 'id')){
                    $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                }
            }
        }
        
    }
    else {
        $_SESSION['shopping_cart'][0] = array
        (
            'id' => filter_input(INPUT_GET, 'id'),
            'name' => filter_input(INPUT_POST, 'name'),
            'price' => filter_input(INPUT_POST, 'price'),
            'quantity' => filter_input(INPUT_POST, 'quantity')
        );
    }
}

if(filter_input(INPUT_GET, 'action') == 'delete'){
    foreach($_SESSION['shopping_cart'] as $key => $product){
        if ($product['id'] == filter_input(INPUT_GET, 'id')){
            unset($_SESSION['shopping_cart'][$key]);
        }
    }
    $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
}



function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>PiiS 2017/18</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <link rel="stylesheet" href="cart.css" />
    </head>
    <body style="background-color:#5174ad">
        <div style="background-color:#5174ad">
		
			<div style="text-align:right" class="col-sm-3">
				<?php
					if (!isset($_SESSION['use'])):
				?>
				<a href="login.php" class="btn btn-info" style="margin:5px">Log in</a>
				<?php endif; ?>
				
				<?php
					if (isset($_SESSION['use']) && $_SESSION['use']!="admin"):
					$milina=$_SESSION['use'];
				?>
				<form name="login_form" action="" method="post">
					<a href="payments.php?mail=<?php echo $milina;?>" class="btn btn-info" style="margin:5px" >Payments</a>
					<input type="submit" name="logout" style="margin: 10px;" class="btn btn-info" value="Log Out"/>
				</form>
				
				<?php
					endif;
					if (isset($_SESSION['use']) && $_SESSION['use']=="admin"):
					$milina=$_SESSION['use'];
				?>
				<form name="login_form" action="" method="post">
					<a href="admin.php" class="btn btn-info" style="margin:5px" >Admin mode</a>
					<input type="submit" name="logout" style="margin: 10px;" class="btn btn-info" value="Log Out"/>
				</form>
				<?php endif; 
					if( isset($_POST['logout'])){ 
						unset($_SESSION["use"]);
						unset($_SESSION["shopping_cart"]);
						header("Location: login.php");
					}
				?>
		</div><br><br><br><br>
		<?php
		
		
		
		if(!isset($catg) && !isset($add_to_cart)){
			$query = "SELECT * FROM products WHERE stocked='yes'";
		}
		
		else{
			$query = "SELECT * FROM products WHERE stocked='yes' AND category='$catg'";
		}
        
		$result = mysqli_query($mysqli, $query);

        if ($result):
            if(mysqli_num_rows($result)>0):
                while($product = mysqli_fetch_assoc($result)):
                ?>
                <div class="col-sm-4 col-md-3" >
                    <form method="post" action="index.php?action=add&id=<?php echo $product['id']; ?>">
                        <div class="products">
                            <img src="<?php echo $product['image']; ?>" class="img-responsive" />
                            <h4 class="text-info"><?php echo $product['name']; ?></h4>
                            <h4>$ <?php echo $product['price']; ?></h4>
                            <input type="text" name="quantity" class="form-control" value="1" />
                            <input type="hidden" name="name" value="<?php echo $product['name']; ?>" />
                            <input type="hidden" name="price" value="<?php echo $product['price']; ?>" />
                            <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-info"
                                   value="Add to Cart" />
                        </div>
                    </form>
                </div>
                <?php
                endwhile;
            endif;
        endif;   
        ?>
        <div style="clear:both"></div>  
        <br />  
        <div class="table-responsive">  
        <table class="table">  
            <tr><th colspan="5"><h3>Order Details</h3></th></tr>   
        <tr>  
             <th width="40%">Product Name</th>  
             <th width="10%">Quantity</th>  
             <th width="20%">Price</th>  
             <th width="15%">Total</th>  
             <th width="5%">Action</th>  
        </tr>  
        <?php   
        if(!empty($_SESSION['shopping_cart'])):  
            
             $total = 0;  
        
             foreach($_SESSION['shopping_cart'] as $key => $product): 
        ?>  
        <tr>  
           <td><?php echo $product['name']; ?></td>  
           <td><?php echo $product['quantity']; ?></td>  
           <td>$ <?php echo $product['price']; ?></td>  
           <td>$ <?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>  
           <td>
               <a href="index.php?action=delete&id=<?php echo $product['id']; ?>">
                    <div class="btn-danger">Remove</div>
               </a>
           </td>  
        </tr>  
        <?php  
                  $total = $total + ($product['quantity'] * $product['price']);  
             endforeach;  
        ?>  
        <tr>  
             <td colspan="3" align="right">Total</td>  
             <td align="right">$ <?php echo number_format($total, 2); ?></td>  
             <td></td>  
        </tr>  
        <tr>
            <td colspan="5">
             <?php 
                if (isset($_SESSION['shopping_cart'])):
                if (count($_SESSION['shopping_cart']) > 0):
				if (isset($_SESSION['use'])):
             ?>
				<form action="" method="post">
					<a class="button" href="checkout.php?price=<?php echo $total;?>&mail=<?php echo $milina;?>">Checkout</a>
				</form>
             <?php endif; endif; endif;
			 ?>
            </td>
        </tr>
        <?php  
        endif;
        ?>  
        </table>  
         </div>
        </div>
    </body>
</html>
