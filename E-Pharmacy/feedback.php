<?php
require '../connect.php';
session_start();
 if(isset($_GET['fid']))
         {
             $fid = $_GET['fid'];
            $delete = mysqli_query($connect,"delete from feedback_mst where fid='{$fid}'");
            if ($delete) {
                                        echo "<script>alert('Feedback Deleted');
    window.location.href = 'my_order.php';
    </script>";  
                                        }
         }
$pid = $_GET['pid'];
$user_id = $_SESSION['id'];
if (!isset($_SESSION['id'])) {
header("location:sign_in.php");
}
$query = mysqli_query($connect, "SELECT pro_name FROM product_mst WHERE pro_id=$pid");
$pro_name = mysqli_fetch_array($query);
$pro_name1 = $pro_name['pro_name'];
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
        <?php include './pharmacy-page-part/header.php' ?>
        <!-- top Products -->
        <div class="ads-grid"  style="padding-top: 0px;padding-left: 0px">
            <div class="container">
                <div class="checkout-left">
                    <div class="address_form_agile">
                         <form method = "post" id = "form">
                        <div class = "creditly-wrapper wthree, w3_agileits_wrapper">
                        <div>
                        <?php
                        $query1 = mysqli_query($connect, "SELECT * FROM feedback_mst WHERE pro_id=$pid and user_id=$user_id");
                        $feedback = mysqli_fetch_array($query1);
                        $count = mysqli_num_rows($query1);
                        if($count)
                        {?>
                            
                             <a style="float:right;color:red" href="feedback.php?fid=<?php echo $feedback['fid']?>"><img src='images/remove.png' style='width:17px;'> Delete</a>
                            <div><label>Product Name</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input readonly="text" name="name" value="<?php echo $pro_name1 ?>" required  style="width: 30%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 20px;outline: none;border: none">
                            <br><label>Rating</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <select name="rating" style="width: 15%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 0px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);">
                                <option value="" disabled selected>Select Rating</option>
                                <option selected value="<?php{$feedback['rating']}?>"><?php echo "{$feedback['rating']}"?></option>
                              <option disabled></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <br><br>
                            <textarea name="details" placeholder="Enter Feedback" style='width:50%;height:100px;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom:0px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%); resize:none'><?php echo $feedback['details'] ?></textarea>
                            <br><button class="submit check_out" name="submit">Update</button>
                        </div>
                             <?php
                       if(isset($_POST['submit']))
                        {
                        $rating = $_POST["rating"];
                        $details = $_POST["details"];
                        $sql = "UPDATE feedback_mst SET rating='{$rating}',details='{$details}' WHERE user_id=$user_id and pro_id=$pid";
                        $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
                        if($result)
                        {
                        echo "<script>alert('Feedback Updated Successfully');"
                        . "window.location.href = 'my_order.php';</script>";
                        }
                        }
                        }
                          else
                          {?>
                            <div><label>Product Name</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input readonly="text" name="name" value="<?php echo $pro_name1 ?>" required  style="width: 30%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 20px;outline: none;border: none">
                            <br><label>Rating</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <select name="rating" style="width: 15%;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom: 0px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%);">
                                <option value="" disabled selected>Select Rating</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <br><br>
                            <textarea name="details" placeholder="Enter Feedback" style='width:50%;height:100px;font-size: 15px;letter-spacing: 1px;padding: 7px 10px;margin-bottom:0px;outline: none;border: none;box-shadow: 0px 0px 3px 0px rgb(0 0 0 / 31%); resize:none'></textarea>
                            <br> <button class="submit check_out" name="submit">Submit</button>
                        </div>
                       <?php
                       if(isset($_POST['submit']))
                        {
                        $rating = $_POST["rating"];
                        $details = $_POST["details"];
                        $sql = "INSERT INTO feedback_mst(rating,details,user_id,pro_id)VALUES('{$rating}','{$details}',$user_id,$pid)";
                        $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
                        if($result)
                        {
                        echo "<script>alert('Feedback Submitted Successfully');"
                        . "window.location.href = 'my_order.php';</script>";
                        }
                        }
                        }
                        ?>
                       
                        
                    </div>

                </div>
                </form>
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
<script>
            $("#form").validate({
                rules: {

                    rating: {
                        required: true,
                    }
                },
                messages: {

                    rating: {
                        required: "Please Select Rating",
                    }

                }
            });
</script>
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