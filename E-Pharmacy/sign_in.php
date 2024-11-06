<?php
session_start();
include '../connect.php';
if(isset($_POST['submit']))
{
$email=$_POST["email"];
$pass=$_POST["password"];
$sql1="SELECT * FROM user_mst WHERE email='{$email}'";
$result1 = mysqli_query($connect, $sql1);
$count= mysqli_num_rows($result1);
$check= mysqli_fetch_array($result1);
if($count==0)
{
     echo "<script>alert('Entered Email id Not Registered')</script>"; 
}
else if($check['c_status']=='Inactive')
{
            echo "<script>alert('Your Account Is Blocked')</script>"; 
}
else {
$sql="SELECT * FROM user_mst WHERE email='{$email}' and password='{$pass}'";
$result = mysqli_query($connect, $sql);
$count= mysqli_num_rows($result);
$row= mysqli_fetch_array($result);
if($count>0)
{
    $_SESSION['id']=$row['user_id'];
    $_SESSION['f_name']=$row['f_name'];
    $_SESSION['s_name']=$row['s_name'];
    if($row['usertype_id']==1)
    {
      header("LOCATION:../Admin-Panel/Admin_page.php");
    }
    elseif($row['usertype_id']==2)
    {
        if($row['is_verified']=='No')
        {
             echo "<script>alert('You Are Not A Verified Supplier, Please Wait !!')</script>"; 
        }
        else if($row['is_verified']=='Rej')
        {
            echo "<script>alert('Your Request Has Been Rejected By Admin')</script>";
        }
        else
        {
    header("LOCATION:../Supplier/Supplier_Panel.php");
        }
    
        }
    elseif($row['usertype_id']==3)
            {
    header("LOCATION: ./E-Pharmacy.php");
    }
}
else
{
    echo "<script>alert('Email id And Password Not Matched')</script>";
}
}
}
?>
<!DOCTYPE html>
<html lang="zxx">
    <!--
    Author: W3layouts
    Author URL: http://w3layouts.com
    License: Creative Commons Attribution 3.0 Unported
    License URL: http://creativecommons.org/licenses/by/3.0/
    -->
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
            <script src="js/jquery-3.1.1.js"></script>    
<script src="js/jquery.validate.js"></script>
            <?php include './pharmacy-page-part/header_home.php' ?>
            <div class="modal-dialog">
                <div class="modal-body modal-body-sub_agile">
                    <div class="modal_body_left modal_body_left1">
                        <h3 class="agileinfo_sign">Sign IN</h3>
                        <p>
                            <b>Sign In now, Don't have an account?</b><a href="sign_up.php"> Sign Up Now</a>
                        </p>
                     
                        <form method="post" enctype="multipart/form-data" id="form">
                             <div class="styled-input agile-styled-input-top" >
                                 <input style="padding-left: 5px;color :black; margin-bottom: 0px;" type="email" placeholder="Email Address" name="email" >
                             </div><br>
                        <div class="styled-input">
                            <input style="padding-left: 5px;color :black; margin-bottom: 0px;" type="password" placeholder="Password" name="password" >
                        </div><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="forget_pass.php"> <font color="red">Forget Password?</a>
                        <br><input type="submit" name="submit" value="Sign In">
                         </form>
                        </div>
                        
                    
                </div>
            </div>
            <script>
         // validate signup form on keyup and submit
		$("#form").validate({
			rules: {
				
				password: {
					required: true,
					minlength: 6
                                    },
                email: {
                            required: true,
                            email : true
                        }
			},
			messages: {
                email: {
                            required: "Please Enter Email Address",
                        },
                      	password: {
					required: "Please Enter Password",
					minlength: "Your password must be at least 6 characters long"
				},
			}
		});


        function Validate(no) {
                   no.value = no.value.replace(/[^ 0-9\n\r]+/g, '');
               }
               
               function Validatestring(no) {
                   no.value = no.value.replace(/[^ a-z A-Z\n\r]+/g, '');
               }

              
      
     </script>
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