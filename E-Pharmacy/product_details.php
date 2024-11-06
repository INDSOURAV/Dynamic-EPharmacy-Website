<?php
$msg = "";
require '../connect.php';
$pro_id = $_GET['pid'];
session_start();
if (!isset($_SESSION['id'])) {
    include './pharmacy-page-part/header_home.php';
} else {
    include './pharmacy-page-part/header.php';
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
        <script src="js/jquery-3.1.1.js"></script>    
        <script src="js/jquery.validate.js"></script>
        <style>
            .error{
                color:red;
            }
        </style>
        <style>
            button:hover {
                border-radius: 15px;
            }
        </style>
    </head>
    <body>
        <?php
        $product = mysqli_query($connect, "SELECT * FROM product_mst WHERE pro_id=$pro_id");
        $product1 = mysqli_fetch_array($product);
        $cat_id = $product1['cat_id'];
        $image = mysqli_query($connect, "SELECT * FROM img_mst WHERE pro_id=$pro_id");
        $image1 = mysqli_fetch_array($image);
        $category = mysqli_query($connect, "SELECT * FROM category_mst WHERE cat_id=$cat_id");
        $category1 = mysqli_fetch_array($category);
        $pro_desc = mysqli_query($connect, "SELECT * FROM product_description WHERE pro_id=$pro_id");
        $pro_desc1 = mysqli_fetch_array($pro_desc);
        ?>
        <div style=" box-shadow: 0px 0px 15px 0px #D6D6D6;padding-left:100px;padding-bottom:400px;padding-top:80px;padding-right:80px;margin-bottom:15px;margin-top:15px;margin-left: 80px;margin-right: 200px;width:90%;height: 30%; ">
            <div class="col-md-5 single-right-left ">
                <div class="grid images_3_of_2">
                    <div class="flexslider">
                        <ul class="slides"  style="margin-left: 40px;" >
                            <i>
                                <div class="thumb-image" style="padding-top:10px">
                                    <a href='<?php echo "{$image1[1]}" ?>'><img style='width:280px;height:250px' src='<?php echo "{$image1[1]}" ?>'></img></a></div>
                            </i>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 single-right-left simpleCart_shelfItem">
                <h3> <?php echo "{$product1['pro_name']}"; ?></h3>
                <p>
                    <span class="item_price">Rs. <?php echo "{$product1['price']}"; ?></span>
                    <?php
                    $a = $product1['price'] / 10;
                    $oldprice = $product1['price'] + $a
                    ?>
                    <span class="item_price"><del>Rs. <?php echo "$oldprice"; ?></del></span>
                </p>
                <div class="product-single-w3l" style="border-top: 1px solid white;">
                    <p>
                    <table>
                        <tr>
                            <td><i class="fa fa-hand-o-right" aria-hidden="true"></i>Category : 
                                <label style="margin-right:93px"><?php echo "{$category1['cat_name']}"; ?></label>
                            </td>
                            <td>
                                <i class="fa fa-hand-o-right" aria-hidden="true"></i>Type : 
                                <label><?php echo "{$pro_desc1['pro_type']}"; ?></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;
                            </td>
                            <td>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-hand-o-right" aria-hidden="true"></i>Net Content : 
                                <label style="margin-right:100px"><?php echo "{$pro_desc1['net_content']}"; ?></label>
                            </td>
                            <td>
                                <i class="fa fa-hand-o-right" aria-hidden="true"></i>Composition : 
                                <label><?php echo "{$pro_desc1['composition']}"; ?></label>
                            </td>
                        </tr>
                    </table>
                    </p>
                </div>
                <form action='cartprocess.php' method=get" id='form'>
                    <fieldset><br>

                        <input type="hidden" name="pid" value="<?php echo "$pro_id"; ?>">
                        Quantity&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <select name="qty">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                        <br><br><br><button style="font-size: 13px;color: white;background: #1accfd;position: relative;border: none;width:100%;text-transform: uppercase;padding: 13px;letter-spacing: 1px;font-weight: 600;">Add to Cart</button>
                    </fieldset>
                </form>

            </div>
        </div>
        <div class="container">
            <h3 class="" style="color: black;font-size: 25px;text-align: left;margin-bottom: 15px;margin-top: 30px;">FEEDBACK
            </h3>
            <?php
            $query = mysqli_query($connect, "SELECT * FROM feedback_mst WHERE pro_id=$pro_id");
            $count= mysqli_fetch_array($query);
            if($count)
            {
            while ($details = mysqli_fetch_array($query)) {
                $user_id = $details['user_id'];
                $query1 = mysqli_query($connect, "SELECT * FROM user_mst WHERE user_id=$user_id");
                while ($details1 = mysqli_fetch_array($query1)) {
                    ?>
                    <input readonly value="<?php echo $details1['f_name'] ?> <?php echo $details1['l_name'] ?>" required  style="width: 30%;font-size: 15px;letter-spacing: 1px;padding: 0px 0px;margin-bottom: 0px;outline: none;border: none">
                <?php } ?>
                <br><textarea readonly name="details" placeholder="Enter Feedback" style='width:70%;height:80px;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%); resize:none'><?php echo $details['details'] ?></textarea>
                <br><input readonly name="name" value="Rating <?php echo $details['rating'] ?>    <?php echo $details['date_time'] ?>" required  style="text-align: right;width: 70%;font-size: 15px;letter-spacing: 1px;margin-top:1px;margin-bottom: 0px;outline: none;border: none">
                <hr>  
            <?php
            }} 
 else {  ?> 
                <center style="margin-top: 100px;margin-bottom: 100px"><?php   echo "No Feedback Found";?></center>
 <?php  }?>

        </div>
        <!-- //top products -->
        <!-- footer -->
        <?php include './pharmacy-page-part/footer.php' ?>
        <!-- //footer -->
        <script>


            $("#form").validate({
                rules: {
                    qty: "required"
                },
                messages: {
                    qty: "Please Select Quantity"
                }
            });

            function Validate(no) {
                no.value = no.value.replace(/[^ 0-9\n\r]+/g, '');
            }

            function Validatestring(no) {
                no.value = no.value.replace(/[^ a-z A-Z\n\r]+/g, '');
            }



        </script>
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