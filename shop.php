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
  <title>My Shop</title>
  <meta charset="utf-8">
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
    <div class="container background" id="height3">
   
  
                <?php
                    $getCat = null;
                     if(isset($_GET['cat'])){ 
                          $getCat = $_GET['cat'];
                        }
                      if($getCat != null){

                        $sql2 = "SELECT COUNT(sku) as count2 FROM inventory WHERE category = '".$getCat."'";
                      } else {
                        $sql2 = 'SELECT COUNT(sku) as count2 FROM inventory';
                      }
                          $countInv = $conn->prepare($sql2);
                          $countInv -> execute();
                          foreach($countInv as $key=>$count){
                            $count_inventory = $count['count2'];
                          }

                        $itemsPerPage = 5;
                        if (isset($_GET["pg"])) {
                          $current = $_GET["pg"];
                        }
                        if(empty($current)){
                          $current = 1;
                        }
                        $offset = ($current - 1) * $itemsPerPage;
                        $limit = '';
                        if($getCat != null){
                          $limit = 'cat='.$getCat.'&';
                        }
                        $next = $current + 1;
                        $previous = $current - 1;
                        $numPage = ceil($count_inventory / $itemsPerPage);
                          try{
                            if($getCat != null){
                                $stmt = $conn->prepare("SELECT * FROM inventory WHERE category = '$getCat' ORDER BY 'title' LIMIT 5 OFFSET $offset");
                              } else {
                                $stmt = $conn->prepare("SELECT * FROM inventory LIMIT 5 OFFSET $offset");
                              }
                              $stmt->execute();
                          }
                          catch(Exception $e) {
                              echo "bad query";
                          }
                            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
                            $results = $stmt->fetchAll();

                        if($current > $numPage){
                          header('location:shop.php?'.$limit.'pg='.$numPage);
                        }

                        if($current < 1){
                          header('location:shop.php?'.$limit.'pg=1');
                        }
                        if($getCat == 'skateboard'){
                          echo "<h3><a href='shop.php'>All</a> > Skateboards</h3>";
                        }
                        if($getCat == 'helmet'){
                          echo "<h3><a href='shop.php'>All</a> > Helmets</h3>";
                        }
                        if($getCat == 'trucks'){
                          echo "<h3><a href='shop.php'>All</a> > Trucks</h3>";
                        }
                        if($getCat == 'shoes'){
                          echo "<h3><a href='shop.php'>All</a> > Shoes</h3>";
                        }if($getCat == null){
                          echo "<h3>All</h3>";
                        }
                        echo "<br/><div class=\"row\">";
                        echo "<div class=\"col-md-6 col-sm-12\">";

                        if($current != 1){
                        echo "<a href=\"shop.php?".$limit."pg=$previous\"><< Previous</a>";
                        }
                        echo "</div>";
                        echo "<div class=\"col-md-6 col-sm-12\">";
                        if($current < $numPage){
                        echo "<a href=\"shop.php?".$limit."pg=$next\">Next >></a>";
                        }
                        echo "</div>";
                        echo "</div><br/>";
                        foreach($results as $key => $inventory){
                            $title = $inventory['title'];
                            $sku = $inventory['sku'];
                            $price = $inventory['unit_price'];
                            $quantity = $inventory['stock'];
                            $description = $inventory['description'];
                            $pic = $inventory['pic_url'];
                            if($getCat == null || strtolower($getCat) == strtolower($inventory['category'])){
                            echo "<div class='row'><hr><div class='col-sm-12 col-md-6'><a href='detail.php?sku=$sku&description=$description&price=$price&title=$title&quantity=$quantity&pic=$pic'><img src=".$pic." alt='Product Photo'></a></div>"; 
                            echo '<div class="col-sm-12 col-md-6"><strong>Title:</strong> '.ucfirst($title).'<br>';
                            echo '<strong>Price:</strong> $'.$price.'<br>';
                            echo '<strong>In Stock:</strong> '.$quantity.'</div></div>';
                            }
                    
                        }
            
                  ?>
                  <hr>
              <div id="copyright">&copy; Copyright Ryan's Skateshop <?php echo date("Y"); ?></div>
   </div>
    

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>