<?php
require '../connect.php';
   if(isset($_GET['cid']))
         {
             $cid=($_GET['cid']);
            $check = mysqli_query($connect, "UPDATE order_mst SET o_status='Cancelled' WHERE ord_id='{$cid}'");
            if($check)
            {
                 echo "<script>alert('Order Cancelled !!!');
    window.location.href = 'my_order.php';
    </script>";
            }
         }
$oid = $_GET['oid'];
session_start();
$user_id = $_SESSION['id'];
if (!isset($_SESSION['id'])) {
    header("location:sign_in.php");
}
$check = mysqli_query($connect, "SELECT o_status FROM order_mst WHERE ord_id='{$oid}'");
$check1 = mysqli_fetch_array($check);
$status = $check1['o_status'];
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
    </head>

    <body>
        <?php include './pharmacy-page-part/header.php' ?>
        <div class="container" style="padding-top: 15px;padding-left: 0px;">
            <h3 class="" style="color: black;font-size: 25px;text-align: left;margin-bottom: 30px;">ORDER DETAILS
            </h3>
            <div class="checkout-right">
                <div class="table-responsive">
                    <table style="width:100%;border : 1px solid #cdcdcd" class="timetable_sub">
                        <thead style="background: #CACACA;font-size:20px;">
                            <tr id="agileinfo-nav_search">
                                 <?php
                            if ($status == "Delivered") {
                                ?>
                                <td class="invert"></td>
                                <?php
                            }
                            ?>
                                <td class="invert">Sr.no</td>
                                <td class="invert">Product Image</td>
                                <td class="invert">Product Name</td>
                                <td class="invert">Quantity</td>
                                <td class="invert">Price</td>
                                <td class="invert">Total</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $grandtotal = array();
                            $i = 0;
                            $query = mysqli_query($connect, "SELECT * FROM order_description WHERE order_id='{$oid}'");
                            while ($result = mysqli_fetch_array($query)) {
                                $pro_id1 = $result['pro_id'];
                                $i++;
                                ?>
                                <tr class="rem1">
                                     <?php
                            if ($status == "Delivered") {
                                ?>
                                <td class="invert"><a href="feedback.php?pid=<?php echo $pro_id1?>">Feedback</a></td>
                                <?php
                            }
                            ?>
                                    <td class="invert"><?php echo $i; ?></td>
                                    <?php
                                    $query1 = mysqli_query($connect, "SELECT * FROM img_mst WHERE pro_id='{$pro_id1}'");
                                    while ($result1 = mysqli_fetch_array($query1)) {
                                        ?>
                                        <td class="invert"><center><img src="<?php echo $result1['img_path'] ?>" data-imagezoom="true" class="img-responsive" alt="" style="width:60px;height:100px;padding-right: 0px"></center></td>
                                <?php
                            }
                            ?>	
                            <?php
                            $query2 = mysqli_query($connect, "SELECT * FROM product_mst WHERE pro_id='{$pro_id1}'");
                            while ($result2 = mysqli_fetch_array($query2)) {
                                ?>
                                <td class="invert"><?php echo $result2['pro_name'] ?></td>
                                <?php
                            }
                            ?>	
                            <td class="invert"><?php echo $result['qty'] ?></td>
                            <td class="invert">Rs <?php echo $result['price'] ?></td>
                            <?php
                            $total = $result['price'] * $result['qty'];
                            $grandtotal[] = $total;
                            ?>
                            <td class="invert">Rs <?php echo $total; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <?php $finalsum = array_sum($grandtotal); ?>    
                             <?php
                            if ($status == "Delivered") {
                                ?>
                                <td colspan="6"><span class='item_price'>Total</span></td>
                                <?php
                            }
 else {               ?>                  <td colspan="5"><span class='item_price'>Total</span></td>
         
 <?php }?>
                            
                            <td colspan="1"><?php echo "<span class='item_price'>Rs. $finalsum</span>" ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <?php
                if($status == "Cancelled")
                {?>
                      <h4 class="" style="color: red;font-size:25px;text-align:left;margin-bottom: 100px;margin-top: 50px;">Order Cancelled !!!
                               
                            </h4>
              <?php  }
 else {                  
                $query3 = mysqli_query($connect, "SELECT * FROM order_mst WHERE ord_id='{$oid}'");
                while ($result3 = mysqli_fetch_array($query3)) {
                    ?>
                    <h4 class="" style="color: black;font-size:18px;text-align:left;margin-bottom: 5px;margin-top: 100px;">Name : <?php echo $result3['shipname'] ?>
                        <h4 class="" style="color: black;font-size:18px;text-align:left;margin-bottom: 5px;">Number : <?php echo $result3['shipnumber'] ?>
                            <h4 class="" style="color: black;font-size:18px;text-align:left;margin-bottom: 5px;">Deliver Address : <?php echo $result3['address'] ?>
                                <h4 class="" style="color: black;font-size:18px;text-align:left;margin-bottom: 50px;">Payment Method : COD
                                <?php } ?>
                            </h4>
                                   <?php
                            if ($status == "Pending") {
                                ?>
                                <h4 class="" style="font-size:25px;text-align:left;margin-bottom: 50px;"><?php echo "<a style='color: red;' href='my_order_details.php?cid=$oid'>Order Cancel ??</a>"?>
                               
                            </h4>
                                <?php
                            }
                              }
                            ?>
                        </div>
                        </div>
                        <!-- //payment page -->
                        <?php include './pharmacy-page-part/footer.php' ?>
                        <!-- js-files -->
                        <!-- jquery -->
                        <script src="js/jquery-2.1.4.min.js"></script>
                        <!-- //jquery -->

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
                        <script>
            paypalm.minicartk.render(); //use only unique class names other than paypal1.minicart1.Also Replace same class name in css and minicart.min.js

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
                        </script>
                        <!-- //cart-js -->

                        <!-- easy-responsive-tabs -->
                        <link rel="stylesheet" type="text/css" href="css/easy-responsive-tabs.css " />
                        <script src="js/easyResponsiveTabs.js"></script>

                        <script>
            $(document).ready(function () {
                //Horizontal Tab
                $('#parentHorizontalTab').easyResponsiveTabs({
                    type: 'default', //Types: default, vertical, accordion
                    width: 'auto', //auto or any width like 600px
                    fit: true, // 100% fit in a container
                    tabidentify: 'hor_1', // The tab groups identifier
                    activate: function (event) { // Callback function if tab is switched
                        var $tab = $(this);
                        var $info = $('#nested-tabInfo');
                        var $name = $('span', $info);
                        $name.text($tab.text());
                        $info.show();
                    }
                });
            });
                        </script>
                        <!-- //easy-responsive-tabs -->

                        <!-- credit-card -->
                        <script src="js/creditly.js"></script>
                        <link rel="stylesheet" href="css/creditly.css" type="text/css" media="all" />

                        <script>
            $(function () {
                var creditly = Creditly.initialize(
                        '.creditly-wrapper .expiration-month-and-year',
                        '.creditly-wrapper .credit-card-number',
                        '.creditly-wrapper .security-code',
                        '.creditly-wrapper .card-type');

                $(".creditly-card-form .submit").click(function (e) {
                    e.preventDefault();
                    var output = creditly.validate();
                    if (output) {
                        // Your validated credit card output
                        console.log(output);
                    }
                });
            });
                        </script>
                        <!-- //credit-card -->

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
                        <script>
                            $(document).ready(function (c) {
                                $('.close1').on('click', function (c) {
                                    $('.rem1').fadeOut('slow', function (c) {
                                        $('.rem1').remove();
                                    });
                                });
                            });
                        </script>
                        <script>
                            $(document).ready(function (c) {
                                $('.close2').on('click', function (c) {
                                    $('.rem2').fadeOut('slow', function (c) {
                                        $('.rem2').remove();
                                    });
                                });
                            });
                        </script>
                        <script>
                            $(document).ready(function (c) {
                                $('.close3').on('click', function (c) {
                                    $('.rem3').fadeOut('slow', function (c) {
                                        $('.rem3').remove();
                                    });
                                });
                            });
                        </script>
                        <!--//quantity-->
                        </body>

                        </html>