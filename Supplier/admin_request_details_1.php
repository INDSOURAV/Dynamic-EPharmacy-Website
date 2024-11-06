<?php
require '../connect.php';
session_start();
$oid = $_GET['oid'];
$user_id = $_SESSION['id'];
if (!isset($_SESSION['id'])) {
    header("location:sign_in.php");
}
 if(isset($_GET['cid']))
         {
             $cid=($_GET['cid']);
            $check = mysqli_query($connect, "UPDATE order_mst SET type='Rej',o_status='Cancelled' WHERE ord_id='{$cid}'");
            if($check)
            {
                 echo "<script>alert('Request Cancelled !!!');
    window.location.href = 'admin_request_details.php';
    </script>";
            }
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
         <div style=" box-shadow: 0px 0px 15px 0px #D6D6D6;padding-left:80px;padding-bottom:160px;padding-top:160px;padding-right:80px;margin-bottom:15px;margin-top:15px;width:100%;height: 50%; ">
                        <table class="timetable_sub" style="border : 1px solid #cdcdcd;">
                        <thead style="background: #CACACA;font-size:20px;">
                            <tr id="agileinfo-nav_search">
                                <td class="invert">Sr.no</td>
                                <td class="invert">Product Name</td>
                                <td class="invert">Quantity</td>
                                <td class="invert">More Details</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <?php
                            $i = 0;
                            $query = mysqli_query($connect, "SELECT * FROM order_description WHERE order_id='{$oid}'");
                            while ($result = mysqli_fetch_array($query)) {
                                $i++;
                                ?>
                                    <td class="invert"><?php echo $i; ?></td>
                                    <?php
                                    $query1 = mysqli_query($connect, "SELECT * FROM img_mst WHERE ord_id='{$oid}'");
                                    while ($result1 = mysqli_fetch_array($query1)) {
                                        ?>
                                        <td class="invert"><center><img src="<?php echo $result1['img_path'] ?>" data-imagezoom="true" class="img-responsive" alt="" style="width:60px;height:100px;padding-right: 0px"></center></td>
                                <?php
                            }
                            ?>	
                         <td class="invert"><?php echo $result['pro_name'] ?></td>
                            <td class="invert"><?php echo $result['qty'] ?></td>
                           <?php  $check=mysqli_query($connect, "SELECT * FROM order_mst WHERE ord_id='{$oid}'");
             while($q1=mysqli_fetch_array($check))
             {?>
                 <td class="invert"><?php echo $q1['order_details'] ?></td>
            <?php }?>
                            </tr>
                            <?php
                            }
                            
                        ?>
                        </tbody>
                        </table>
             <?php
             $check=mysqli_query($connect, "SELECT * FROM order_description WHERE order_id='{$oid}'");
             $check1= mysqli_fetch_array($check);
             $price=$check1['price'];            
             if ($price==0)
             {?>
                 <br><br><h4 class="" style="font-size:20px;text-align:left;margin-bottom: 50px;"><?php echo "<a style='color: red;' href='admin_request_details_1.php?cid=$oid'>Request Cancel ??</a>"?>
                               
                            </h4>
              <h4 class="" style="font-size:20px;text-align:left;margin-bottom: 50px;float:right"><?php echo "<a style='color: blue;' href='admin_request_process.php?cnid=$oid'>Continue...</a>"?>
                               
                            </h4>
            <?php }
 else { ?>   
     <p>Price Information Already Send !!!</p>
 <?php } ?>
                 
             
             
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