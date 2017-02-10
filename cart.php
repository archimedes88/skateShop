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
	<title>View Cart</title>
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

<div class="background container">
	<table class="table">
	<tr>
		<th>Product:</th>
		<th>Sku:</th>
		<th>Quantity:</th>
		<th>Price:</th>
		<th>&nbsp;</th>
	</tr>
	<?php
		$stmt = $conn->prepare("SELECT *, SUM(cart_quantity) as count FROM cart INNER JOIN inventory ON cart.sku=inventory.sku GROUP BY cart.sku"); 
	                        $stmt->execute();
	                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
	                        $results = $stmt->fetchAll();
	                        $cartTotal = 0;
	                    if(empty($results)){

	                        	echo '<div id="center"><h3>You have nothing in the cart...</h3></center>';
	                        }
	                    else {
	                        foreach($results as $key => $cart){
	                        	$title = $cart['title'];
	                        	$price = $cart['unit_price'];
	                        	$sku = $cart['sku'];
	                        	$cartQty = $cart['count'];
	                        	$stock = $cart['stock'];
	                        	$pic = $cart['pic_url'];
	                        	$price_sum = $cartQty * $price;
	                        	$cartTotal += $price_sum;
	                        	echo '<tr>'.'<td><img src="'.$pic.'" class="img-responsive" alt="Product Image"><br/>'.ucfirst($title).'</td>'.'<td>'.$sku.'</td>'.'<td>'.$cartQty.'</td>'.'<td>$'.number_format($price_sum, 2).'</td><td><a href="delete.php?sku='.$sku.'&cart='.$cartQty.'&stock='.$stock.'"><span class="glyphicon glyphicon-trash"></span>&nbsp;Remove</a></td></tr>';
	                        	
	                        }

	                    }
	                    	$flStateTax = $cartTotal * .06;
	                    	$total = $flStateTax + $cartTotal;
	                    	if($results != null){
	                        echo '<tr><td colspan = "4"><strong>Subtotal:</strong></td><td><strong>$'.number_format($cartTotal, 2).'</strong></td></tr>';
	                        echo '<tr><td colspan = "4"><strong>Tax:</strong></td><td><strong>$'.number_format($flStateTax, 2).'</strong></td></tr>';
	                        echo '<tr><td colspan = "4"><strong>Total:</strong></td><td><strong>$'.number_format($total, 2).'</strong></td></tr>';
	                        echo '<tr><td colspan = "5"><a href="pay.php?total='.number_format($total, 2).'"><button class="btn btn-success">Submit</button></a></td></tr>';
	                    	}

	?>
	
	</table>
	<div class="text-center">
	<a href="shop.php" class="btn btn-primary">Continue Shopping</a>
	</div>
	<hr>
	<div id="copyright">&copy; Copyright Ryan's Skateshop <?php echo date("Y"); ?></div>
	
</div>

  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>