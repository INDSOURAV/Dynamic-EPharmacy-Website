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
        <script src="js/jquery-3.1.1.js"></script>    
        <script src="js/jquery.validate.js"></script>
        <style>
            .error{
                color:red;
            }
        </style>
    </head>
    <body>
        <?php
        $query = mysqli_query($connect, "select* from user_mst where user_id=$user_id") or die(mysqli_error($connect));
        $row = mysqli_fetch_array($query)
        ?>
        <?php include './pharmacy-page-part/header.php' ?>
        <div class="ads-grid"  style="padding-top: 15px;padding-left: 0px">
            <div class="container">
                <h3 class="" style="color: black;font-size: 25px;text-align: left;margin-bottom: 30px;">Order Summary</h3>
                <div class="checkout-right">
                    <div class="table-responsive">
                        <table style="width:100%;border : 1px solid #cdcdcd" class="timetable_sub">
                            <thead style="background: #CACACA;font-size:20px;">
                                <tr id="agileinfo-nav_search">
                                    <td class="invert">SL No.</td>
                                    <td class="invert">Product Name</td>
                                    <td class="invert">Price</td>
                                    <td class="invert">Quantity</td>
                                    <td class="invert">Total</td>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;

                                $grandtotal = array();
                                foreach ($_SESSION['productcart'] as $key => $value) {
                                    $query = mysqli_query($connect, "SELECT * FROM product_mst WHERE pro_id = '{$value}'");
                                    $product = mysqli_fetch_assoc($query);
                                    ?>
                                    <?php
                                    $i++;
                                    $qty = $_SESSION['qtycart'][$key];
                                    ?>
                                    <tr class="rem1">

                                        <td class="invert"><?php echo $i ?></td>
                                        <td class="invert"><?php echo " <span>{$product['pro_name']}</span>"; ?></td>
                                        <td class="invert"><?php echo "Rs. {$product['price']}"; ?></td>
                                        <td class="invert"><?php echo $qty; ?></td>
                                        <?php $subtotal = $product['price'] * $qty;
                                        ?>
                                        <td class="invert"><?php echo "$subtotal"; ?></td>

                                    </tr>
                                    <?php
                                    $grandtotal[] = $subtotal;
                                    $qty1[] = $qty;
                                }
                                ?>  
                                <tr>
                                    <?php
                                    $finalsum = array_sum($grandtotal);
                                    $qty2 = array_sum($qty1);
                                    ?>          
                                    <td colspan="3"></td>
                                    <td colspan="1"><?php echo "<span class='item_price'>$qty2</span>" ?></td>
                                    <td colspan="1"><?php echo "<span class='item_price'>Rs. $finalsum</span>" ?></td>
                                </tr>
                                <?php
                                if (isset($_POST['order'])) {
                                    $name = $_POST["name"];
                                    $number = $_POST["number"];
                                    $address = $_POST["address"];
                                    $sql1 = "INSERT INTO order_mst(shipname,shipnumber,address,total,o_status,type,by_id,to_id) VALUES ('{$name}',{$number},'{$address}',{$finalsum},'Pending','Ord',{$user_id},6)";
                                    $result1 = mysqli_query($connect, $sql1) or die(mysqli_error($connect));
                                    if ($result1) {
                                        $order_id = mysqli_insert_id($connect);
                                        foreach ($_SESSION['productcart'] as $key => $value) {
                                            $query = mysqli_query($connect, "SELECT * FROM product_mst WHERE pro_id = '{$value}'");
                                            $product = mysqli_fetch_assoc($query);
                                            $qty = $_SESSION['qtycart'][$key];
                                            $sql2 = "INSERT INTO order_description(order_id,pro_id,qty,price) VALUES ({$order_id},{$value},{$qty},{$product['price']})";
                                            $result2 = mysqli_query($connect, $sql2) or die(mysqli_error($connect));
                                           }
                                            if($result2)
                                            {
                                                $sql3 = "INSERT INTO payment_mst(order_id,price,method,status,user_id) VALUES ({$order_id},{$finalsum},'COD','Pending',{$user_id})";
                                            $result3 = mysqli_query($connect, $sql3) or die(mysqli_error($connect));
                                            if($result3)
                                            {
                                                 echo "<script>alert('Order Placed Successfully, HAPPY SHOPPING !!!!!');
    window.location.href = 'my_order.php';
    </script>";
                                            }
                                            }
                                    }
 else { 
        echo "<script>alert('Order Failed !!!');
    window.location.href = 'delivery_details.php';
    </script>";
 }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br><br> 
                <h3 class="" style="color: black;font-size: 25px;text-align: left;margin-bottom: 30px;">Delivery Details
                </h3>
                <form method="post" id="form">
                    <div>
                        <label>Name</label>
                        <br><input type="text" name="name" onkeyup="Validatestring(this)" placeholder="Mobile Number"style="width: 30%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 20px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);" value="<?php echo "{$row[3]} {$row[5]}" ?>"> 
                        <br><label>Mobile Number</label>
                        <br><input type="text" name="number" onkeyup="Validate(this)" placeholder="Mobile Number"style="width: 30%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 20px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);" value="<?php echo "{$row[6]}" ?>"> 
                        <br><label>Address</label><br>
                        <textarea name="address" placeholder="Home No./Flat No./Apartment Name, Area and Street, City, Pincode, State" style='width:100%;height:100px;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom:0px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%); resize:none'><?php echo "{$row[9]}" ?></textarea>
                        <br><br><input type="radio" checked>
                        <label>COD</label>
                    </div>
                    <input type="submit" name="order" style="float:right;padding: 12px 25px;letter-spacing: 1px;background: #FF5722;font-size: 16px;color: #fff;border: none;" value="Place Order">
                </form>
            </div>
        </div>
        <!-- //payment page -->
<?php include './pharmacy-page-part/footer.php' ?>
        <!-- js-files -->
        <script>
            // validate signup form on keyup and submit
            $("#form").validate({
                rules: {

                    name: {
                        required: true,
                        minlength: 6
                    },
                    number: {
                        required: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    address: {
                        required: true,
                        minlength: 15,
                    }
                },
                messages: {
                    name: {
                        required: "Please Enter Full Name",
                        minlength: "Your name must consist of at least 6 characters"
                    },
                    number: {
                        required: "Please Enter Your Mobile no.",
                        minlength: "Enter Your 10 digit Mobile no. only",
                        maxlength: "Enter Your 10 digit Mobile no. only",
                    },
                    address: {
                        required: "Please Enter Your Address",
                        minlength: "Your Address must consist of at least 15 characters",
                    }
                }
            });


            function Validate(no) {
                no.value = no.value.replace(/[^ 0-9\n\r]+/g, '');
            }

            function Validatestring(no) {
                no.value = no.value.replace(/[^ a-z A-Z\n\r]+/g, '');
            }



        </script>
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