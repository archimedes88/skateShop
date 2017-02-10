<?php
	include('connect.php');
	$sku = $_GET['sku'];
	$cartQty = $_GET['cart'];
	$stock = $_GET['stock'];
	$magic = $stock + $cartQty;
	$sql = "DELETE FROM cart WHERE sku = '$sku'";
	$sql2 = "UPDATE inventory SET stock= '$magic' WHERE sku = '$sku'";
	$conn->exec($sql);
	$conn->exec($sql2);
	$conn = NULL;
	header('Location: cart.php');

?>