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
    <div class="container background text-center">
        <br/>
        <form action="search.php" method="get" class="form-inline">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search" name="search" id="size"><input type="submit" value="Go!" class="btn btn-primary">
            </div>
        </form>
        <br/>
                <?php    
                    if(!empty($_GET)){
                        $searchPar = $_GET['search'];
                        $sql = "SELECT * FROM inventory WHERE title LIKE '%$searchPar%' OR category LIKE '%$searchPar%'";
                        $results = $conn->prepare($sql);
                        $results->execute();
                        $output = $results->setFetchMode(PDO::FETCH_ASSOC);
                        $output2 = $results->fetchAll();
                        $remind = "Searched for \"$searchPar\""; 
                        if(empty($output2)){
                            echo $remind."<br/><hr/>";
                            echo '<h4>No Results...</h4><br/>';
                        } else{
                            echo $remind;
                            foreach($output2 as $key => $inventory){
                                $title = $inventory['title'];
                                $sku = $inventory['sku'];
                                $price = $inventory['unit_price'];
                                $quantity = $inventory['stock'];
                                $description = $inventory['description'];
                                $pic = $inventory['pic_url'];
                                $category = $inventory['category'];
                                echo "<div class='row'><hr><div class='col-sm-12 col-md-6'><a href='detail.php?sku=$sku&description=$description&price=$price&title=$title&quantity=$quantity&pic=$pic'><img src=".$pic." alt='Product Photo'></a></div>"; 
                                echo '<div class="col-sm-12 col-md-6"><strong>Title:</strong> '.ucfirst($title).'<br/>';
                                echo '<strong>Price:</strong> $'.$price.'<br/>';
                                echo '<strong>In Stock:</strong> '.$quantity.'<br/>';
                                echo '<strong>Category:</strong> '.$category.'</div></div>';
                                } 
                            }
                    }
                ?>
            <hr>
            <div id="copyright">&copy; Copyright Ryan's Skateshop <?php echo date("Y"); ?></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
</body>
</html>