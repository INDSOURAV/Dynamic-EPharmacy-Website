<?php
require '../connect.php'; 
session_start();
$user_id=$_SESSION['id'];
if(!isset($_SESSION['id']))
{
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
            <!-- <script src="js/jquery.js"></script> -->
        <script src="js/jquery-3.1.1.js"></script>    
	<script src="js/jquery.validate.js"></script>
    <style>
        .error{
            color:red;
        }
    </style>
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
           <div class="ads-grid"  style="padding-top: 15px;padding-left: 0px">
            <div class="container">
                <h3 class="" style="color: black;font-size: 25px;text-align: center;margin-bottom: 30px;">MY ACCOUNT
                </h3>
                <div class="checkout-left">
                    <div class="address_form_agile">
                        <form action="E-Pharmacy.php" method="post" id="form">
                            <div class="creditly-wrapper wthree, w3_agileits_wrapper">
                                <div>
                                    <?php
                         $query = mysqli_query($connect, "select* from user_mst where user_id=$user_id") or die (mysqli_error($connect));
                            while($row=mysqli_fetch_array($query))
                            { ?>
                        
                                <div>
                                    <h4 style='font-size:22px;'>Personal Information<?php echo "<a href='my_account_edit.php?uid={$row[0]}'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Edit</a>";?></h4>
                                    <div><label>First Name</label>
                                        &nbsp;&nbsp;&nbsp;<input readonly="text" value=<?php echo "{$row[3]}" ?> style='width: 20%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 20px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);'>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Middle Name</label>
                                        &nbsp;&nbsp;&nbsp;<input readonly="text" style='width: 20%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 20px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);' value=<?php echo "{$row[4]}" ?>>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Last Name</label>
                                        &nbsp;&nbsp;&nbsp;<input readonly="text" value=<?php echo "{$row[5]}" ?> style='width: 20%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 20px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);'>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Gender</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input readonly="text" value=<?php echo "{$row[8]}" ?> style='width: 20%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 20px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);'>
                                    </div>
                                    <br><br><h4 style='font-size:22px;'>Contact Details</h4>
                                    <div><label>Mobile Number</label>
                                        &nbsp;&nbsp;&nbsp;<input readonly="text" value=<?php echo "{$row[6]}" ?> style='width: 29%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 20px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);'>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Email Address</label>
                                        &nbsp;&nbsp;&nbsp;<input readonly="text" value=<?php echo "{$row[7]}" ?> style='width: 40%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 20px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);'>
                                    </div>
                            </div>
                                    <?php
                                    if($row[9]=='')
                                    { ?>
                                       <div>
                                       <br><br><h4 style="font-size:22px;">Address Details</h4>
                                        <label>Pin code</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" name="pin" onkeyup="Validate(this)" placeholder="Enter your pin code"style="width: 50%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 20px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);"> 
                                        <br><label>Locality</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" name="loc" required placeholder="Enter your locality" onkeydown="return /[a-z]/i.test(event.key)" style="width: 50%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 20px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);"> 
                                         <br><label>Landmark</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="land" placeholder="optional" onkeydown="return /[a-z]/i.test(event.key)" style="width: 50%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 20px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);"> 
                                        <br><label>Area and Street</label>&nbsp;&nbsp;&nbsp;
                                        <input type="text" name="area" required onkeydown="return /[a-z]/i.test(event.key)" placeholder="Enter your Area and Street" style="width: 50%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 20px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);"> 
                                        <br><label>Town/City</label>&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="city" placeholder="Enter your town/city" required onkeydown="return /[a-z]/i.test(event.key)" style="width: 50%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 20px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);"> 
                                        <br><label>State</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="state" style="width: 50%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 50px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);">
                                            <option value="" disabled selected>Select State</option>
                                            <option>Andhra Pradesh/option>
                                            <option>Arunachal Pradesh</option>
                                            <option>Assam</option>
                                            <option>Bihar</option>
                                            <option>Chhattisgarh</option>
                                            <option>Goa</option>
                                            <option>Gujarat</option>
                                            <option>Haryana</option>
                                            <option>Himachal Pradesh</option>
                                            <option>Jharkhand</option>
                                            <option>Karnataka</option>
                                            <option>Kerala</option>  
                                             <option>Madhya Pradesh</option>
                                            <option>Maharashtra</option>
                                            <option>Manipur</option>
                                            <option>Meghalaya</option>
                                            <option>Mizoram</option>
                                            <option>Nagaland</option>
                                            <option>Punjab</option>
                                            <option>Rajasthan</option>
                                            <option>Sikkim</option>
                                            <option>Tamil Nadu</option>
                                            <option>Telangana</option>
                                            <option>Tripura</option> 
                                            <option>Uttar Pradesh</option>
                                            <option>Uttarakhand</option> 
                                            <option>West Bengal</option>
                                        </select>
                                    </div>
                                    <button class="submit check_out">Add Address</button>
                                    <?php }
                                   else
                                    {?>
                                    <br><br><br><h4 style='font-size:22px;'>Address</h4>
                                    <textarea readonly="text" style='width:500px;height:100px;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 20px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%); resize:none'><?php echo "{$row[9]}" ?></textarea>
                                   <?php   }?>
                                <?php  }?>
                                    
                                     
                                    <?php
                         $query1 = mysqli_query($connect, "select* from user_mst where user_id=$user_id") or die (mysqli_error($connect));
                            while($row=mysqli_fetch_array($query1))
                            { ?>
                            <div>
                                <br><br> <h4 style="font-size:22px;"><?php echo "<a href='change_pass.php?uid={$row[0]}'>Change Password</a>";?></h4>
                            </div>
                            <?php }?>
                     </div></div>
                        </form>
                   

                    
                    
                </div>
            </div>
           </div>
               </div>
            <?php include './pharmacy-page-part/footer.php' ?>
            <!-- //top products -->
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

            <!-- price range (top products) -->
            <script src="js/jquery-ui.js"></script>
            <script>
                //<![CDATA[ 
                $(window).load(function () {
                    $("#slider-range").slider({
                        range: true,
                        min: 0,
                        max: 9000,
                        values: [50, 6000],
                        slide: function (event, ui) {
                            $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                        }
                    });
                    $("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));

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