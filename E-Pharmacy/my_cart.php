<?php
$msg="";
require '../connect.php';
session_start();
if (!isset($_SESSION['id'])) {
    include './pharmacy-page-part/header_home.php';
} else {
    include './pharmacy-page-part/header.php';
}
?> 
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
     <div class="container" style="padding-top: 15px;padding-left: 0px;padding-bottom: 150px">
                <h3 class="" style="color: black;font-size: 25px;text-align: center;margin-bottom: 30px;">MY CART
                </h3>
        
         <?php 
         if(isset($_GET['id']))
         {
             $id=($_GET['id']);
             unset($_SESSION['productcart'][$id]);
         }
       
         if(isset($_SESSION['productcart']) && !empty($_SESSION['productcart']))
{?>
             
                <div class="checkout-right">
                    <div class="table-responsive">
                        <table style="width:100%;border : 1px solid #cdcdcd" class="timetable_sub">
                            <thead style="background: #CACACA;font-size:20px;">
                                <tr id="agileinfo-nav_search">
                                    <td class="invert"></td>
                                     <td class="invert">SL No.</td>
                                        <td class="invert">Product Image</td>
                                        <td class="invert">Product Name</td>
                                        <td class="invert">Price</td>
                                        <td class="invert">Quantity</td>
                                        <td class="invert">Total</td>
                                       
							</tr>
						</thead>
						<tbody>
                                                    <?php
                                                    $i=0;
                                                    
                                  $grandtotal=array();
foreach ($_SESSION['productcart'] as $key => $value) {
      $query = mysqli_query($connect,"SELECT * FROM product_mst WHERE pro_id = '{$value}'");
      $product = mysqli_fetch_assoc($query);
?>
                                                     <?php
                                  $i++;
                                   $qty=$_SESSION['qtycart'][$key];
                                    ?>
							<tr class="rem1">
                                                             <?php echo "<td> <a href='?id=$key'>Remove</a></td>"?>
								<td class="invert"><?php echo $i?></td>
								<td class="invert-image">
                                                                    <?php $image = mysqli_query($connect, "select * from img_mst where pro_id='{$value}'");
                                            while ($image1 = mysqli_fetch_array($image)) {
                                                echo "<a href='{$image1[1]}'><img width='10px' height='100px' alt='not found' src='{$image1[1]}'></img></a>";
                                            }
                                           
                                            ?>
                                                                </td>
                                                                <td class="invert"><?php echo " <span>{$product['pro_name']}</span>";?></td>
                                                                <td class="invert"><?php echo "Rs. {$product['price']}";?></td>
								<td class="invert"><?php echo $qty;?></td>
                                                              <?php  $subtotal = $product['price'] * $qty;
                                                              
                                                               ?>
								<td class="invert"><?php echo "$subtotal"; ?></td>
                                                              
							</tr>
                                                       <?php  $grandtotal[] = $subtotal;
                                                       $qty1[] = $qty;
                  
                
                                                       
               
                                                            } ?>  
                                                         <tr>
                                                  <?php
                                   $finalsum = array_sum($grandtotal);
                                   $qty2 = array_sum($qty1);?>          
                                                            <td colspan="5"></td>
                                                            <td colspan="1"><?php echo "<span class='item_price'>$qty2</span>"?></td>
                                                                <td colspan="1"><?php echo "<span class='item_price'>Rs. $finalsum</span>"?></td>
                                                        </tr>
                  </tbody>
					</table>
                       <br>
                         <button class="submit check_out" style="float:right" onclick="window.location='delivery_details.php'">Continue</button>
                         <button class="submit check_out" style="float:left" onclick="window.location='E-Pharmacy.php'">Add More Products</button>
				</div>
                   </div>
<?php
                
       }
       else{
                    $msg = '<br><br><div class="alert alert-danger" role="alert">
                    Cart is Empty !!!
                    </div>';?>
         <br><br><a href="E-Pharmacy.php" style="float:right">Buy Products</a>
    <?php   }
                    ?>
  <?php echo $msg; ?>
                </div>
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
			if (newVal >= 1) divUpd.text(newVal);
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