<?php
require '../connect.php';
session_start();
$user_id = $_SESSION['id'];
if (!isset($_SESSION['id'])) {
    header("location:sign_in.php");
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

    <body>
        <?php include './supplier_part/header.php' ?>
        <!-- top Products -->
      <div class="agileinfo-ads-display col-md-12 w3l-rightpro">
         <div style=" box-shadow: 0px 0px 15px 0px #D6D6D6;padding-left:80px;padding-bottom:15px;padding-top:50px;padding-right:80px;margin-bottom:15px;margin-top:15px;width:100%;height: 50%; ">
             <b><h3>Order From Your Request</h3></b><br> 
             <table class="timetable_sub" style="border : 1px solid #cdcdcd;">
                            <thead>
                                 <tr id="agileinfo-nav_search">
                                     <td class="invert">Sr. No.</td>
                                        <td class="invert">Date</td>
                                        <td class="invert">Payment</td>
                                        <td class="invert">Status</td>
                                        <td class="invert">More Details</td>
                                        <td class="invert"></td>
				</tr>
                            </thead>
                             <tbody>
            <tr>
                                     <td>1</td>
                                     <td>2022-04-06 13:58:25</td>
                                     <td>Success</td>
                                     <td>Delivered</td>
                                     <td>Send 500mg products</td>
                                     <td><a href="#">Details</a></td>
                                 </tr>
                                 <tr>
                                     <td>2</td>
                                     <td>2022-04-06 14:19:21</td>
                                     <td>Pending</td>
                                     <td>Pending</td>
                                     <td></td>
                                     <td><a href="#">Details</a></td>
                                 </tr>
                                 <tr>
                                     <td>3</td>
                                     <td>2022-04-06 14:53:50</td>
                                     <td>Success</td>
                                     <td>Delivered</td>
                                     <td></td>
                                     <td><a href="#">Details</a></td>
                                 </tr>
                                 <tr>
                                     <td>4</td>
                                     <td>2022-04-06 15:28:12</td>
                                     <td>Success</td>
                                     <td>Delivered</td>
                                     <td></td>
                                     <td><a href="#">Details</a></td>
                                 </tr>
                                 <tr>
                                     <td>5</td>
                                     <td>2022-04-07 15:50:17</td>
                                     <td>Pending</td>
                                     <td>Pending</td>
                                     <td>Send 100mg Products</td>
                                     <td><a href="#">Details</a></td>
                                 </tr>
                                 <tr>
                                     <td>6</td>
                                     <td>2022-04-07 16:20:25</td>
                                     <td>Success</td>
                                     <td>Delivered</td>
                                     <td>Send 100ml Syrup</td>
                                     <td><a href="#">Details</a></td>
                                 </tr>
                                 <tr>
                                     <td>7</td>
                                     <td>2022-04-07 17:27:10</td>
                                     <td>Pending</td>
                                     <td>Pending</td>
                                     <td></td>
                                     <td><a href="#">Details</a></td>
                                 </tr>
                                 <tr>
                                     <td>8</td>
                                     <td>2022-04-07 17:42:18</td>
                                     <td>Success</td>
                                     <td>Delivered</td>
                                     <td></td>
                                     <td><a href="#">Details</a></td>
                                 </tr>
                                
                                 </tbody>
                        </table>
                        <div class="checkout-left">

                            <div class="clearfix"> </div>
                        </div>
                    </div>
                </div> 
        <div class="clearfix"></div>
        
        <!-- //top products -->
        <!-- footer -->
        <?php include './supplier_part/footer.php' ?>
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