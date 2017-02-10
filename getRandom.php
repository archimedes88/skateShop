<?php

                include('connect.php');

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