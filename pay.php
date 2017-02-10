<?php

  include('connect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Payment Options</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
	<?php $total = $_GET['total'];
	echo "<h1 class=\"text-center\"> Total: ".$total."</h1>"



	?>
	<div class="black">
		<form class="form-inline">
			<div class="form-group">
				<legend>Shipping Info:</legend>
				<br/><label>First Name:<input type='text' name='firstname' placeholder="First Name" class="form-control"></label>
				<label>Last Name:<input type='text' name='lastname' placeholder="Last Name" class="form-control"></label>
				<br/><label>Address:<input type='text' name='address' placeholder="Address" class="form-control"></label>
				<label>City:<input type='text' name='city' placeholder="City" class="form-control"></label>
				<br/><p><label>State:<input type='text' name='state' placeholder="State" class="form-control"></label></p>
				<label>Zip:<input type='number' name='zip' placeholder="Zip" class="form-control"></label>
			</div>
		</form>
		<form class="form-inline">
			<div class="form-group">
				<legend>Credit Card Info:</legend>
				<br/><p><label>First Name:<input type='text' name='firstname' placeholder="First Name" class="form-control"></label>
				<label>Last Name:<input type='text' name='lastname' placeholder="Last Name" class="form-control"></label>
				<br/><p><label>Card Number:<input type='number' name='credit' placeholder="Card Number" class="form-control"></label></p>
				<label>CVV:<input type='text' name='city' placeholder="cvv" class="form-control"></label>
				<br/><p><label>Zip:<input type='number' name='zip' placeholder="Zip" class="form-control"></label></p>
				<input type='submit' class='btn btn-success white' value='Submit Order'>
			</div>
		</form>
	<hr>
	<div id="copyright">&copy; Copyright Ryan's Skateshop <?php echo date("Y"); ?></div>
	
</div>

  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>