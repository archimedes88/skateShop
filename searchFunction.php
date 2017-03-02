<?php       include("connect.php");
                    $searchPar = $_GET['searchVal'];
                    if(!empty($searchPar)){
                        $sql = "SELECT * FROM inventory 
                                WHERE title 
                                LIKE '%$searchPar%' 
                                OR category 
                                LIKE '%$searchPar%'";
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