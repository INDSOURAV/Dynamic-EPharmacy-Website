 <?php
 require '../connect.php';
 while ($row = mysqli_fetch_array($q1)) {
                                                    $c = $c + 1;
                                                    $proid = $row['pro_id'];
                                                    $product = mysqli_query($connect, "SELECT * FROM product_mst WHERE pro_id=$proid");
                                                    while ($product1 = mysqli_fetch_array($product)) {
                                                        ?>
                                                        <div class="col-xs-3 product-men" style="margin-bottom: 27px">
                                                            <div class="men-pro-item simpleCart_shelfItem">
                                                                <div class="men-thumb-item">
                                                                    <?php
                                                                    $image = mysqli_query($connect, "select * from img_mst where pro_id=$product1[0]");
                                                                    while ($image1 = mysqli_fetch_array($image)) {
                                                                        echo "<a href='product_details.php?pid={$product1[0]}'><img style='width:150px;height:150px' alt='not found' src='{$image1[1]}'></img></a>";
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="item-info-product">
                                                                    <h4>
                    <?php echo "<a href='product_details.php?pid={$product1[0]}'>{$product1['pro_name']}</a>"; ?>
                                                                    </h4>
                                                                    <div class="info-product-price">
                                                                        <?php echo " <span class='item_price'>Rs. {$product1['price']}</span>"; ?>
                                                                        <?php
                                                                        $a = $product1['price'] / 10;
                                                                        $oldprice = $product1['price'] + $a
                                                                        ?>
                                                                        <span class="item_price"><del>Rs. <?php echo "$oldprice"; ?></del></span>
                                                                    </div>
                                                                    <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                                                                        <form action='<?php echo "product_details.php?pid={$product1[0]}'" ?>' method="post">
                                                                            <fieldset>                                                  
                                                                                <button style="font-size: 13px;color: white;background: #1accfd;position: relative;border: none;width: 100%;text-transform: uppercase;padding: 13px;letter-spacing: 1px;font-weight: 600;">More Details</button>
                                                                            </fieldset>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <?php
                                                    }
                                                }