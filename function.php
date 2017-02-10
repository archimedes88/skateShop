<?php
function getShop($getCat = null, $offset = 0){
	include('connect.php');
	try{
		if($getCat != null){
	      $stmt = $conn->prepare("SELECT * FROM inventory WHERE category = '$getCat' LIMIT 5 OFFSET ".$offset);
	    } else {
	      $stmt = $conn->prepare("SELECT * FROM inventory LIMIT 5");
	    }
	    $stmt->execute();
	}
    catch(Exception $e) {
    	echo "bad query";
    }
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $results = $stmt->fetchAll();

    return $results;
}
// function myCount($getCat = null){
// 	include('connect.php');

//   $sql = "SELECT COUNT(sku) FROM inventory";
// 	try{
// 		if ($getCat = null){
// 		$db = $conn->prepare($sql);
// 		}else{
// 		$db = $conn->prepare($sql." WHERE category = '$getCat'");
// 		}
// 		$db2 = $db->execute();
// 		$count = $db->fetchColumn(0);
// 	}
// 	catch(Exception $e) {
//     	echo "bad query";
//     }
	

// 	return $count;
// }
 ?>
