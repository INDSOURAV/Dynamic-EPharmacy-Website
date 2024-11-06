<?php
require '../connect.php';
$msg = "";
session_start();
if (!isset($_SESSION['id'])) {
    include './pharmacy-page-part/header_home.php';
} else {
    include './pharmacy-page-part/header.php';
}
if (isset($_GET['catid'])) {
    $cat_id = $_GET['catid'];
    $cat = mysqli_query($connect, "SELECT cat_name FROM category_mst WHERE cat_id=$cat_id");
    $cat_name = mysqli_fetch_array($cat);
    $cat_name1 = $cat_name['cat_name'];
    $product = mysqli_query($connect, "SELECT * FROM product_mst WHERE cat_id=$cat_id");
    echo "<div class='services-breadcrumb'>
        <div class='agile_inner_breadcrumb'>
            <div class='container'>
                <ul class='w3_short'>
                    <li>
                        <a>Category</a>
                        <i>|</i>
                    </li>
                    <li>$cat_name1</li>
                </ul>
            </div>
        </div>
    </div>";
} else if (isset($_GET['Search'])) {
    $search = $_GET['Search'];
    $product = mysqli_query($connect, "SELECT * FROM product_mst WHERE pro_name LIKE '%$search%'");
    if (isset($_POST["price6"])) {
        $product = mysqli_query($connect, "SELECT * FROM product_mst WHERE pro_name LIKE '%$search%' AND price BETWEEN 10001 AND 100000");
    }
    if (isset($_POST["price5"])) {
        $product = mysqli_query($connect, "SELECT * FROM product_mst WHERE pro_name LIKE '%$search%' AND price BETWEEN 5001 AND 10001");
    }
    if (isset($_POST["price4"])) {
        $product = mysqli_query($connect, "SELECT * FROM product_mst WHERE pro_name LIKE '%$search%' AND price BETWEEN 1001 AND 5001");
    }
    if (isset($_POST["price3"])) {
        $product = mysqli_query($connect, "SELECT * FROM product_mst WHERE pro_name LIKE '%$search%' AND price BETWEEN 501 AND 1001");
    }
    if (isset($_POST["price22"])) {
        $product = mysqli_query($connect, "SELECT * FROM product_mst WHERE pro_name LIKE '%$search%' AND price BETWEEN 101 AND 501");
    }
    if (isset($_POST["price1"])) {
        $product = mysqli_query($connect, "SELECT * FROM product_mst WHERE pro_name LIKE '%$search%' AND price BETWEEN 1 AND 101");
    }
} else {
    $product = mysqli_query($connect, "SELECT * FROM product_mst order by rand() limit 12");
}
if (isset($_POST["price6"])) {
    $product = mysqli_query($connect, "SELECT * FROM product_mst WHERE price BETWEEN 10001 AND 100000");
}
if (isset($_POST["price5"])) {
    $product = mysqli_query($connect, "SELECT * FROM product_mst WHERE price BETWEEN 5001 AND 10001");
}
if (isset($_POST["price4"])) {
    $product = mysqli_query($connect, "SELECT * FROM product_mst WHERE price BETWEEN 1001 AND 5001");
}
if (isset($_POST["price3"])) {
    $product = mysqli_query($connect, "SELECT * FROM product_mst WHERE price BETWEEN 501 AND 1001");
}
if (isset($_POST["price2"])) {
    $product = mysqli_query($connect, "SELECT * FROM product_mst WHERE price BETWEEN 101 AND 501");
}
if (isset($_POST["price1"])) {
    $product = mysqli_query($connect, "SELECT * FROM product_mst WHERE price BETWEEN 1 AND 101");
}
?>
<!DOCTYPE html>
<html lang="zxx">
    <head>
        <title>E Pharmacy</title>
        <!--/tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Grocery Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
              Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
        <script>
            addEventListener("load", function () {
                setTimeout(hideURLbar, 0);
            }, false);

            function hideURLbar() {
                window.scrollTo(0, 1);
            }
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
        <script type="text/javascript">
            $(function () {
                $('.checkbox').on('change', function () {
                    $('#form').submit();
                });
            });
        </script>
        <!--//tags -->
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/font-awesome.css" rel="stylesheet">
        <!--pop-up-box-->
        <link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
        <!--//pop-up-box-->
        <!-- price range -->
        <link rel="stylesheet" type="text/css" href="css/jquery-ui1.css">
        <!-- fonts -->
        <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
        <style>
            button:hover {
                border-radius: 15px;
            }
        </style>
    <body>
        <div class="ads-grid"  style="padding-top: 15px;padding-left: 0px">
            <div class="container">
                <div class="ads-grid" style="padding-top: 0px; padding-bottom: 25px";>
                    <div class="container">
                        <?php
                        $count = mysqli_num_rows($product);
                        if ($count == 0) {
                            echo "<script>alert('No Product Found !!!');
    window.location.href = 'E-Pharmacy.php';</script>";
                        } else {
                            ?>
                            <div class="agileinfo-ads-display col-md-12 w3l-rightpro">
                                <div style=" box-shadow: 0px 0px 15px 0px white;background-color:#cbc9c770 ;padding-left:10px;padding-bottom:0px;padding-top:5px;padding-right:8px;margin-bottom:15px;margin-top:15px;width:100%;height: 15%; ">
                                    <div class="left-side" style="padding-top:0px;padding-bottom:0px;padding-left:0px">

                                        <ul>
                                            <li>

                                                <form id="form" method="post" action="">
                                                    <span class="span" style="color: #FF5722;font-size: 16px;" >Price range</span>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="checkbox" class="checkbox" name="price6" style="display:unset;margin-top:10px" <?= (isset($_POST['price']) ? ' checked' : '') ?>>
                                                    <span class="span" style="line-height:2.4" >10001 Or More </span>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <input type="checkbox" class="checkbox" name="price5" style="display:unset;margin-top:10px"  <?= (isset($_POST['price']) ? ' checked' : '') ?>>
                                                    <span class="span" style="line-height:2.4" >5001 - 10000 </span>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <input type="checkbox" class="checkbox" name="price4" style="display:unset;margin-top:10px"  <?= (isset($_POST['price']) ? ' checked' : '') ?>>
                                                    <span class="span" style="line-height:2.4" >1001 - 5000 </span>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <input type="checkbox" class="checkbox" name="price3" style="display:unset;margin-top:10px"  <?= (isset($_POST['price']) ? ' checked' : '') ?>>
                                                    <span class="span" style="line-height:2.4" >501 - 1000 </span>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <?php if (isset($_GET['Search'])) { ?>
                                                        <input type="checkbox" class="checkbox" name="price22" style="display:unset;margin-top:10px"  <?= (isset($_POST['price']) ? ' checked' : '') ?>>
                                                        <span class="span" style="line-height:2.4" >101 - 500 </span>
                                                        &nbsp;&nbsp;&nbsp;
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <input type="checkbox" class="checkbox" name="price2" style="display:unset;margin-top:10px"  <?= (isset($_POST['price']) ? ' checked' : '') ?>>
                                                        <span class="span" style="line-height:2.4" >101 - 500 </span>
                                                        &nbsp;&nbsp;&nbsp;
                                                    <?php } ?>
                                                    <input type="checkbox" class="checkbox" name="price1" style="display:unset;margin-top:10px"  <?= (isset($_POST['price']) ? ' checked' : '') ?>>
                                                    <span class="span" style="line-height:2.4" >1 - 100 </span><br>
                                                    <span class="span" style="color: #FF5722;font-size: 16px;" >Product type</span>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="checkbox" class="checkbox" name="type2" style="display:unset;margin-top:10px"  <?= (isset($_POST['price']) ? ' checked' : '') ?>>
                                                    <span class="span" style="line-height:2.4" >Cream </span>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="checkbox" class="checkbox" name="type3" style="display:unset;margin-top:10px"  <?= (isset($_POST['price']) ? ' checked' : '') ?>>
                                                    <span class="span" style="line-height:2.4" >Gel </span>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="checkbox" class="checkbox" name="type4" style="display:unset;margin-top:10px"  <?= (isset($_POST['price']) ? ' checked' : '') ?>>
                                                    <span class="span" style="line-height:2.4" >Liquid </span>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="checkbox" class="checkbox" name="type5" style="display:unset;margin-top:10px"  <?= (isset($_POST['price']) ? ' checked' : '') ?>>
                                                    <span class="span" style="line-height:2.4" >Powder </span>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="checkbox" class="checkbox" name="type6" style="display:unset;margin-top:10px"  <?= (isset($_POST['price']) ? ' checked' : '') ?>>
                                                    <span class="span" style="line-height:2.4" >Tablet </span>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="checkbox" class="checkbox" name="type7" style="display:unset;margin-top:10px"  <?= (isset($_POST['price']) ? ' checked' : '') ?>>
                                                    <span class="span" style="line-height:2.4" >Spray </span>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="checkout-left">

                                        <div class="clearfix"> </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="agileinfo-ads-display col-md-12 w3l-rightpro">
                                <div class="wrapper">
                                    <div class="product-sec1">
                                        <!-- //product left -->
                                        <?php
                                        if (isset($_POST["type2"])) {
                                            $c = 0;
                                            $q1 = mysqli_query($connect, "SELECT * FROM product_description WHERE pro_type='Cream'");
                                            $count1 = mysqli_num_rows($q1);
                                            if ($count1 == 0) {
                                                echo "<script>alert('No Product Found !!!');"
                                                . "window.location.href = 'E-Pharmacy.php'</script>";
                                            } else {
                                                require 'filter.php';
                                            }
                                        }
                                        ?>
                                        <?php
                                        if (isset($_POST["type3"])) {
                                            $c = 0;
                                            $q1 = mysqli_query($connect, "SELECT * FROM product_description WHERE pro_type='Gel'");
                                            $count1 = mysqli_num_rows($q1);
                                            if ($count1 == 0) {
                                                echo "<script>alert('No Product Found !!!');"
                                                . "window.location.href = 'E-Pharmacy.php'</script>";
                                            } else {
                                                require 'filter.php';
                                            }
                                        }
                                        ?>
                                        <?php
                                        if (isset($_POST["type4"])) {
                                            $c = 0;
                                            $q1 = mysqli_query($connect, "SELECT * FROM product_description WHERE pro_type='Liquid'");
                                            $count1 = mysqli_num_rows($q1);
                                            if ($count1 == 0) {
                                                echo "<script>alert('No Product Found !!!');"
                                                . "window.location.href = 'E-Pharmacy.php'</script>";
                                            } else {
                                                require 'filter.php';
                                            }
                                        }
                                        ?>
                                        <?php
                                        if (isset($_POST["type5"])) {
                                            $c = 0;
                                            $q1 = mysqli_query($connect, "SELECT * FROM product_description WHERE pro_type='Powder'");
                                            $count1 = mysqli_num_rows($q1);
                                            if ($count1 == 0) {
                                                echo "<script>alert('No Product Found !!!');"
                                                . "window.location.href = 'E-Pharmacy.php'</script>";
                                            } else {
                                                require 'filter.php';
                                            }
                                        }
                                        ?>
                                        <?php
                                        if (isset($_POST["type6"])) {
                                            $c = 0;
                                            $q1 = mysqli_query($connect, "SELECT * FROM product_description WHERE pro_type='Tablet'");
                                            $count1 = mysqli_num_rows($q1);
                                            if ($count1 == 0) {
                                                echo "<script>alert('No Product Found !!!');"
                                                . "window.location.href = 'E-Pharmacy.php'</script>";
                                            } else {
                                                require 'filter.php';
                                            }
                                        }
                                        ?>
                                        <?php
                                        if (isset($_POST["type7"])) {
                                            $c = 0;
                                            $q1 = mysqli_query($connect, "SELECT * FROM product_description WHERE pro_type='Spray'");
                                            $count1 = mysqli_num_rows($q1);
                                            if ($count1 == 0) {
                                                echo "<script>alert('No Product Found !!!');"
                                                . "window.location.href = 'E-Pharmacy.php'</script>";
                                            } else {
                                                require 'filter.php';
                                            }
                                        }
                                        ?>
                                        <?php while ($product1 = mysqli_fetch_array($product)) { ?>
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
?>
                                    <?php echo "<br><center>$msg</center>"; ?>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- //product right -->
                    </div>
                </div>
            </div>
        </div>
        <!-- //top products -->
        <!-- footer -->
<?php include './pharmacy-page-part/footer.php' ?>
        <!-- //footer -->
        <!-- js-files -->
        <!-- jquery -->
        <script src="js/jquery-2.1.4.min.js"></script>
        <!-- //jquery -->
        <!--quantity-->
        <script>
            $('.value-plus').on('click', function () {
                var divUpd = $(this).parent().find('.value'),
                        newVal = parseInt(divUpd.text(), 10) + 1;
                divUpd.text(newVal);
            });

            $('.value-minus').on('click', function () {
                var divUpd = $(this).parent().find('.value'),
                        newVal = parseInt(divUpd.text(), 10) - 1;
                if (newVal >= 1)
                    divUpd.text(newVal);
            });
        </script>
        <!--quantity-->
        <!-- popup modal (for signin & signup)-->
        <script src="js/jquery.magnific-popup.js"></script>
        <script>
            $(document).ready(function () {
                $('.popup-with-zoom-anim').magnificPopup({
                    type: 'inline',
                    fixedContentPos: false,
                    fixedBgPos: true,
                    overflowY: 'auto',
                    closeBtnInside: true,
                    preloader: false,
                    midClick: true,
                    removalDelay: 300,
                    mainClass: 'my-mfp-zoom-in'
                });

            });
        </script>
        <!-- Large modal -->
        <!-- <script>
                $('#').modal('show');
        </script> -->
        <!-- //popup modal (for signin & signup)-->

        <!-- cart-js -->
        <script src="js/minicart.js"></script>
<!--	<script>
                paypalm.minicartk.render(); //use only unique class names other than paypalm.minicartk.Also Replace same class name in css and minicart.min.js

                paypalm.minicartk.cart.on('checkout', function (evt) {
                        var items = this.items(),
                                len = items.length,
                                total = 0,
                                i;

                        // Count the number of each item in the cart
                        for (i = 0; i < len; i++) {
                                total += items[i].get('quantity');
                        }

                        if (total < 3) {
                                alert('The minimum order quantity is 3. Please add more to your shopping cart before checking out');
                                evt.preventDefault();
                        }
                });
        </script>-->
        <!-- //cart-js -->

        <!-- price range (top products) -->
        <script src="js/jquery-ui.js"></script>
        <script>
            //<![CDATA[ 
            $(window).load(function () {
                $("#slider-range").slider({
                    range: true,
                    min: 0,
                    max: 50000,
                    values: [50, 50000],
                    slide: function (event, ui) {
                        $("#amount").val("₹" + ui.values[0] + " - ₹" + ui.values[1]);
                    }
                });
                $("#amount").val("₹" + $("#slider-range").slider("values", 0) + " - ₹" + $("#slider-range").slider("values", 1));
            }); //]]>
        </script>
        <!-- //price range (top products) -->

        <!-- flexisel (for special offers) -->
        <script src="js/jquery.flexisel.js"></script>
        <script>
            $(window).load(function () {
                $("#flexiselDemo1").flexisel({
                    visibleItems: 3,
                    animationSpeed: 1000,
                    autoPlay: true,
                    autoPlaySpeed: 3000,
                    pauseOnHover: true,
                    enableResponsiveBreakpoints: true,
                    responsiveBreakpoints: {
                        portrait: {
                            changePoint: 480,
                            visibleItems: 1
                        },
                        landscape: {
                            changePoint: 640,
                            visibleItems: 2
                        },
                        tablet: {
                            changePoint: 768,
                            visibleItems: 2
                        }
                    }
                });

            });
        </script>
        <!-- //flexisel (for special offers) -->

        <!-- password-script -->
        <script>
            window.onload = function () {
                document.getElementById("password1").onchange = validatePassword;
                document.getElementById("password2").onchange = validatePassword;
            }

            function validatePassword() {
                var pass2 = document.getElementById("password2").value;
                var pass1 = document.getElementById("password1").value;
                if (pass1 != pass2)
                    document.getElementById("password2").setCustomValidity("Passwords Don't Match");
                else
                    document.getElementById("password2").setCustomValidity('');
                //empty string means no validation error
            }
        </script>
        <!-- //password-script -->

        <!-- smoothscroll -->
        <script src="js/SmoothScroll.min.js"></script>
        <!-- //smoothscroll -->

        <!-- start-smooth-scrolling -->
        <script src="js/move-top.js"></script>
        <script src="js/easing.js"></script>
        <script>
            jQuery(document).ready(function ($) {
                $(".scroll").click(function (event) {
                    event.preventDefault();

                    $('html,body').animate({
                        scrollTop: $(this.hash).offset().top
                    }, 1000);
                });
            });
        </script>
        <!-- //end-smooth-scrolling -->

        <!-- smooth-scrolling-of-move-up -->
        <script>
            $(document).ready(function () {
                /*
                 var defaults = {
                 containerID: 'toTop', // fading element id
                 containerHoverID: 'toTopHover', // fading element hover id
                 scrollSpeed: 1200,
                 easingType: 'linear' 
                 };
                 */
                $().UItoTop({
                    easingType: 'easeOutQuart'
                });

            });
        </script>
        <!-- //smooth-scrolling-of-move-up -->

        <!-- for bootstrap working -->
        <script src="js/bootstrap.js"></script>
        <!-- //for bootstrap working -->
        <!-- //js-files -->


    </body>

</html>