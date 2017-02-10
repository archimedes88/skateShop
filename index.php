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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah" rel="stylesheet">
	<title>Ryan's Skate Shop</title>
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

	<div class="container background" id="height2">
	    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	        <!-- Indicators -->
	        <ol class="carousel-indicators">
	            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
	            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
	            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
	            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
	        </ol>

	        <!-- Wrapper for slides -->
	        <div class="carousel-inner">
	            <div class="item active">
	                <div class="fill" style="background-image:url('img/pic1.jpg');"></div>
	            </div>
	            <div class="item">
	                <div class="fill" style="background-image:url('img/pic2.jpg');"></div>
	            </div>
	            <div class="item">
	                <div class="fill" style="background-image:url('img/pic3.jpg');"></div>
	            </div>
	            <div class="item">
	                <div class="fill" style="background-image:url('img/pic4.jpg');"></div>
	            </div>
	        </div>
	    </div>
	    <h1 class="welcome">Welcome! To Ryan's Skateshop</h1>
	    <p class="welcome">Lorem ipsum dolor sit amet, vix ut torquatos democritum, has doctus dissentias eu. Eum ad populo mediocrem, in qui possim detracto signiferumque. Erat percipit honestatis pro ex. Ei tollit vituperata suscipiantur est.</p>
	    <div id="spacer">
	    <div id="random">
		    <?php

		    		$stmt = $conn->prepare("SELECT * FROM inventory"); 
	                        $stmt->execute();
	                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
	                        $results = $stmt->fetchAll();
	                        $random = array_rand($results, 3);
	                        	echo '<div class="row">';	                    		
	                        foreach($random as $val){
	                        	$sku = $results[$val]['sku'];
	                        	$pic = $results[$val]['pic_url'];
	                         	$title = $results[$val]['title'];
	                         	$description = $results[$val]['description'];
	                         	$price = $results[$val]['unit_price'];
	                         	$quantity = $results[$val]['stock'];


	                        	echo '<div class="col-md-4">
	                        			<a href="detail.php?sku='.$sku.'&description='.$description.'&price='.$price.'&title='.$title.'&quantity='.$quantity.'&pic='.$pic.'" class="linked">
			    						<div class="thumbnail">
			    							<img src="'.$pic.'" class="img-responsive" alt ="product image" />
			    							<div class="caption text-center">
			    								<h3>'.ucfirst($title).'</h3>
			    							</div>
			    						</div>
			    						</a>
									</div>';

	                        }

		     ?>
	    </div>
	    </div>
	    </div>
	    <h3 class="welcome">Check out our <a href="shop.php" class="linked">Shop!</a></h3>
	    <hr>
	    <div id="copyright">&copy; Copyright Ryan's Skateshop <?php echo date("Y"); ?></div>

    </div>
    <script
  src="https://code.jquery.com/jquery-3.1.1.js"
  integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
  crossorigin="anonymous"></script>	
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
        $('.carousel').carousel({
            interval: 3500
        });



        	function updateInventory() {
			    
        		$.get("getRandom.php", function(data){
			        
			        $('#random').fadeTo(2000, 0.01).queue(function(){$('#random').html(data).fadeTo(2000, 1).dequeue();});

			    });
			}

			setInterval(updateInventory, 15000); 



    </script>
</body>
</html>