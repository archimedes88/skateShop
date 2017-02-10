<?php 
include('connect.php');
$sql = 'SELECT SUM(cart_quantity) as cartCount FROM cart';
$count = $conn-> prepare($sql);
$count -> execute();
foreach($count as $key=>$count){
  $cartCount = $count['cartCount'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Item Details</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah" rel="stylesheet">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><div class="img"><img src="img/logo.png" class="logo" alt="Logo" /></div></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                	<li class="dropdown">
			          <a href="shop.php" id="shop" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-tag"></span> Shop <span class="caret"></span></a>
			          <ul class="dropdown-menu" id="change">
			          	<li><a href="shop.php">All</a></li>
			            <li><a href="shop.php?cat=skateboard">Skateboards</a></li>
			            <li><a href="shop.php?cat=trucks">Trucks</a></li>
			            <li><a href="shop.php?cat=helmet">Helmets</a></li>
			            <li><a href="shop.php?cat=shoes">Shoes</a></li>
			          </ul>
			        </li>
                	<li><a href="#" id="forum"><span class="glyphicon glyphicon-education"></span>&nbsp;Forum</a></li>
                    <li><a href="cart.php" id="cart"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Cart</a></li>
                    <li><div class="count"><?php 
                    if($cartCount != 0) {
                    	echo $cartCount;
                    	} 
                    	?></div></li>
                        
                    <li><a href="search.php"><span class="glyphicon glyphicon-search"></span>&nbsp;Search</a></li> 
                </ul>
            </div>
        </div>
    </nav>

	<div class='container background'>
		<div class='row'>
			<div class="col-sm-12 col-md-5">
				<?php 
				include('connect.php');	
					$title = $_GET['title'];
					$sku = $_GET['sku'];
					$description = $_GET['description'];
					$price = $_GET['price'];
					$quantity = $_GET['quantity'];
					$pic = $_GET['pic'];

					echo '<img class="img-responsive" src="'.$pic.'" alt="Product Picture">';



				?>
			</div>
			<div class='col-sm-12 col-md-4'>
				<h3>Product Details</h3>
					<?php										
						echo '<strong>Title:</strong> '.ucfirst($title).'<br>';
						echo '<strong>Sku:</strong> '.$sku.'<br>';
						echo '<strong>Description:</strong> '.$description.'<br>';
						echo '<strong>Price:</strong> $'.$price.'<br>';
						echo '<strong>In Stock:</strong> '.$quantity.'<br>';
						?>
						<br/><a href="shop.php" class="btn btn-primary">Continue Shopping</a>						
			</div>
			<div class='col-sm-12 col-md-3'>
				<form method='post'>
					<br/><p><label>Order Amount:<br/><input type='number' name='orderAmount' value="1" id="form"></label></p>
					<input type='submit' class='btn btn-success' value='ADD TO CART'>
				</form>
				<br/>
				<?php
					if(!empty($_POST)){
						$qty = $_POST['orderAmount'];
						$newqty = ($quantity - $qty);
						echo 'You ordered '.$qty;
						if($quantity>=$qty){
							$sql = "UPDATE inventory SET stock='$newqty' WHERE title='$title'";
							$sql2 = "INSERT INTO cart (sku, cart_quantity) VALUES('$sku', '$qty')";
							$conn->exec($sql);
							$conn->exec($sql2);
	    					$conn=NULL;
	    					
    					}
					}
				?>
			</div>
		</div>
		<hr>
	    <div id="copyright">&copy; Copyright Ryan's Skateshop <?php echo date("Y"); ?></div>
	</div>

  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>