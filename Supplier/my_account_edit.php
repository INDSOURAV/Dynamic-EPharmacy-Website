<?php
require '../connect.php'; 
session_start();
$user_id=$_SESSION['id'];
$uid = $_GET['uid'];
if(!isset($_SESSION['id']))
{
header("location:sign_in.php");
}
$sq="SELECT * FROM user_mst WHERE user_id=$uid";
$sq1 = mysqli_query($connect, $sq)or die(mysqli_error($connect));
$userdata=mysqli_fetch_array($sq1);
if(isset($_POST['submit']))
{
//    $sname = $_POST['sname'];
//    $mob = $_POST['mob'];
//    $email = $_POST['email'];
    $pin = $_POST['pin'];
    $loc = $_POST['loc'];
    $area = $_POST['area'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $add = "$loc $area , $city $pin , $state";
    $query = "UPDATE user_mst SET address='{$add}' WHERE user_id='{$uid}'";
    $result = mysqli_query($connect, $query);
    $error = mysqli_error($connect);
if($result)
{
    echo "<script>alert('Updated Successfully');
    window.location.href = 'my_account.php';
    </script>";
}
//    else
//{
//    echo "<script>alert('Entered Mobile Number OR Email ID Linked With Another Account');
//    </script>";
//}
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
            <?php include './supplier_part/header.php' ?>
           <div class="ads-grid"  style="padding-top: 15px;padding-left: 0px">
            <div class="container">
                <h3 class="" style="color: black;font-size: 25px;text-align: center;margin-bottom: 30px;">MY ACCOUNT
                </h3>
                <div class="checkout-left">
                    <div class="address_form_agile">
                        <form method="post" id="form">
                            <div class="creditly-wrapper wthree, w3_agileits_wrapper">
                                <div>
                                    <h4 style='font-size:22px;'>Business Information</h4>
                                   <label>Supplier Name</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input readonly type="text" name="sname" style='width: 40%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 20px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);' value="<?php echo $userdata['s_name'] ?>" onkeyup="Validatestring(this)">
                                        <br><label>GST Number</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input readonly type="text" name="lname" style='width: 40%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 20px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);' value="<?php echo $userdata['gstn'] ?>" onkeyup="Validatestring(this)">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                </div>
                                    </div>
                                    <br><br><h4 style='font-size:22px;'>Contact Details</h4>
                                    <div><label>Mobile Number</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input readonly type="text" name="mob" style='width: 40%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 20px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);' value="<?php echo $userdata['mobile_no'] ?>" onkeyup="Validate(this)">
                                        <br><label>Email Address</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input readonly type="text" name="email" style='width: 40%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 20px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);' value="<?php echo $userdata['email'] ?>">
                                    </div>
                           
                                <div>
                                       <div>
                                       <br><br><h4 style="font-size:22px;">Address Details</h4>
                                        <label>Pin code</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" name="pin" onkeyup="Validate(this)" placeholder="Pin Code"style="width: 50%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 20px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);"> 
                                        <br><label>Locality</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" name="loc" required placeholder="Shop Name/Company Name" style="width: 50%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 20px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);"> 
                                         <br><label>Area and Street</label>&nbsp;&nbsp;&nbsp;
                                        <input type="text" name="area" required placeholder="Area and Street" style="width: 50%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 20px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);"> 
                                        <br><label>Town/City</label>&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="city" placeholder="Town/City" required onkeyup="Validatestring(this)" style="width: 50%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 20px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);"> 
                                        <br><label>State</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="state" style="width: 50%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 50px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);">
                                            <option value="" disabled selected>Select State</option>
                                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                            <option value="Assam">Assam</option>
                                            <option value="Bihar">Bihar</option>
                                            <option value="Chhattisgarh">Chhattisgarh</option>
                                            <option value="Goa">Goa</option>
                                            <option value="Gujarat">Gujarat</option>
                                            <option value="Haryana">Haryana</option>
                                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                                            <option value="Jharkhand">Jharkhand</option>
                                            <option value="Karnataka">Karnataka</option>
                                            <option value="Kerala">Kerala</option>  
                                             <option value="Madhya Pradesh">Madhya Pradesh</option>
                                            <option value="Maharashtra">Maharashtra</option>
                                            <option value="Manipur">Manipur</option>
                                            <option value="Meghalaya">Meghalaya</option>
                                            <option value="Mizoram">Mizoram</option>
                                            <option value="Nagaland">Nagaland</option>
                                            <option value="Punjab">Punjab</option>
                                            <option value="Rajasthan">Rajasthan</option>
                                            <option value="Sikkim">Sikkim</option>
                                            <option value="Tamil Nadu">Tamil Nadu</option>
                                            <option value="Telangana">Telangana</option>
                                            <option value="Tripura">Tripura</option> 
                                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                                            <option value="Uttarakhand">Uttarakhand</option> 
                                            <option value="West Bengal">West Bengal</option>
                                        </select>
                                    </div>
                                    <button class="submit check_out" name="submit">Update Details</button>
                     </div>
                                     </div>
                        </form>
                   
</div>
                    
                    
                </div>
            </div>
           </div>
            <script>
         // validate signup form on keyup and submit
		$("#form").validate({
			rules: {
				sname: {
					required: true,
					minlength: 3
                                    },
                                     mob: {
                            required: true,
                             minlength: 10,
                                              maxlength: 10
                        },
                email: {
                            required: true,
                            email : true
                        },
                         pin: {
					required: true,
                                         minlength: 6,
                                              maxlength: 6
                                          },
                                       loc: {
					required: true,
                                         minlength: 3
                                    },
                                     area: {
					required: true,
                                         minlength: 3
                                    },
                                    city: {
					required: true,
                                         minlength: 3
                                    },
                                    state: {
					required: true,
                                    }
                                    
			},
                        
                                    
			messages: {
                email: {
                            required: "Please Enter Email Address",
                        },
                      	sname: {
					required: "Please Enter Supplier Name",
					minlength: "Your password must be at least 3 characters long"
				},
                                pin: {
					required: "Please Enter Pin Code",
					minlength: "Pin Code must be 6 Digit long",
                                        maxlength:"Pin Code must be 6 Digit long"
				},
                                 mob: {
                            required: "Please Enter Your Mobile no.",
                            minlength: "Enter Your 10 digit Mobile no. only",
                            maxlength: "Enter Your 10 digit Mobile no. only"
                        },
                        loc: {
					required: "Please Enter Locality",
					minlength: "Your Locality must be at least 3 characters long"
				},
                                 area: {
					required: "Please Enter Area",
					minlength: "Your Area must be at least 3 characters long"
				},
                                city: {
					required: "Please Enter City",
					minlength: "Your City must be at least 3 characters long"
				},
                                  state: {
					required: "Please Select Your State"
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
            <?php include './supplier_part/footer.php' ?>
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

