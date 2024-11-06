<?php
$gender1="";
include '../connect.php';
if(isset($_POST['submit']))
{
$fname=$_POST["fname"];
$mname=$_POST["mname"];
$lname=$_POST["lname"];
$number=$_POST["number"];
$gender = $_POST["gender"];
$email=$_POST["user_email"];
$password=$_POST["password"];
$sql1="SELECT * FROM user_mst";
$i = 1;
$result1 = mysqli_query($connect, $sql1)or die(mysqli_error($connect));
while($data=mysqli_fetch_array($result1))
{
$number1=$data['mobile_no'];
$email1=$data['email'];
if($number==$number1)
{
   $i = 0; 
}
elseif ( $email==$email1) {
$i = 2; 
}
}
if($i==0)
{
    echo "<script>alert('Entered Mobile Number Already Registered')</script>"; 
}
elseif ($i==2) {
  echo "<script>alert('Entered Email Id Already Registered')</script>"; 
}
 else {
  $sql="INSERT INTO user_mst(usertype_id,f_name,m_name,l_name,mobile_no,gender,email,password,c_status)VALUES(3,'{$fname}','{$mname}','{$lname}',{$number},'{$gender}','{$email}','{$password}','Active')"; 
$result = mysqli_query($connect, $sql)  or die(mysqli_error($connect));
if($result)
{
    echo "<script>alert('Registered Successfully, Now Go To Sign-in Page')</script>"; 
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
            <?php include './pharmacy-page-part/header_home.php' ?>
            <div class="modal-dialog">
                <div class="modal-body modal-body-sub_agile">
                    <div class="modal_body_left modal_body_left1">
                        <h3 class="agileinfo_sign">Sign Up</h3>
                        <p>
                            <b>Let's set up your Account</b> <a href="supplier_reg.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;As A Supplier?</a>
                        </p>
                        <form method="post" enctype="multipart/form-data" id="form">
                            <div class="styled-input agile-styled-input-top">
                                <input style="margin-bottom: 0px;padding-left: 5px;color :black;" type="text" placeholder="First Name" name="fname" onkeyup ="Validatestring(this)">
                            </div><br>
                            <div class="styled-input agile-styled-input-top">
                                <input style="margin-bottom: 0px;padding-left: 5px;color :black;" type="text" placeholder="Middle Name" name="mname" onkeyup ="Validatestring(this)">
                            </div><br>
                            <div class="styled-input">
                                <input style="margin-bottom: 0px;padding-left: 5px;color :black;" type="text" placeholder="Last Name" name="lname" onkeyup ="Validatestring(this)">
                            </div><br>
                            
                            <div style="margin-bottom: 0px; color :black; font-size: 14px;
                                 letter-spacing: 1px;padding: 9px 0;padding-left: 5px; background: lightgray" class="col-sm-12"> 
                                Gender&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="gender" value="male">&nbsp;&nbsp;Male&nbsp;&nbsp;
                                <input type="radio" name="gender" value="female">&nbsp;&nbsp;Female
                                 <input type="radio" name="gender" value="other">&nbsp;&nbsp;Other
                            </div><br><br><br>
                            <div class="styled-input">
                               <input style="margin-bottom: 0px;padding-left: 5px;color :black;" type="text" placeholder="Mobile Number" name="number" onkeyup="Validate(this)" >
                            </div><br>
                            <div class="styled-input">
                                <input style="margin-bottom: 0px;padding-left: 5px;color :black;" type="email" placeholder="E-mail Address" name="user_email" onkeyup="ismail(this)" >
                            </div><br>
                            <div class="styled-input">
                                <input style="margin-bottom: 0px;padding-left: 5px;color :black;" type="password" placeholder="Password" id="password1" name="password" required="">
                            </div><br>
                            <div class="styled-input">
                                <input style="margin-bottom: 0px;padding-left: 5px;color :black;" type="password" placeholder="Confirm Password" id="password2"  name="confirm_password" >
                            </div><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="sign_in.php">Already A User?</a>
                            <input style="background: #13af00;" type="submit" name="submit" value="Sign Up">
                            <p>
                                <a>By clicking register, I agree to your terms</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
            <script>

     
		$("#form").validate({
			rules: {
				
				fname: {
					required: true,
					minlength: 3
				},
                                lname: {
					required: true,
					minlength: 3
				},
                                password: {
                                        required: true,
					minlength: 6
				},
				confirm_password: {
					required: true,
					minlength: 6,
					equalTo: "#password1"
				},
				user_email: {
					required: true,
                                         email: true
				},
                                 number: {
                                             required: true,
                                             minlength: 10,
                                              maxlength: 10
                                        },
                                        gender: "required"
			},
                        messages: {
				
				fname: {
					required: "Please Enter First Name",
					minlength: "Your name must consist of at least 3 characters"
				},
                               lname: {
					required: "Please Enter Last Name",
					minlength: "Your name must consist of at least 3 characters"
				},
                number: {
                            required: "Please Enter Your Mobile no.",
                            minlength: "Enter Your 10 digit Mobile no. only",
                            maxlength: "Enter Your 10 digit Mobile no. only",
                        },
                       
                        
				password: {
					required: "Please Enter Password",
					minlength: "Your password must be at least 6 characters long"
				},
				confirm_password: {
					required: "Please Confirm Password",
					minlength: "Your password must be at least 6 characters long",
					equalTo: "Please enter the same password as above"
				},
                                
	       gender: "Please Select Gender",user_email: "Please enter a valid email address"
             
                
                
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