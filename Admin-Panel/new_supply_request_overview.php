<?php
$qty1=0;
$price=0;
require '../connect.php';
session_start();
$user_id = $_SESSION['id'];
if (!isset($_SESSION['id'])) {
    header("location:../E-Pharmacy/sign_in.php");
}
$oid = $_GET['oid'];
$by=mysqli_query($connect, "SELECT * FROM order_mst WHERE ord_id=$oid");
$byid= mysqli_fetch_array($by);
$by_id=$byid['by_id'];
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>E Pharmacy</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
              SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

        <!-- Custom CSS -->
        <link href="css/style.css" rel='stylesheet' type='text/css' />

        <!-- font-awesome icons CSS -->
        <link href="css/font-awesome.css" rel="stylesheet"> 
        <!-- //font-awesome icons CSS -->

        <!-- side nav css file -->
        <link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
        <!-- side nav css file -->

        <!-- js-->
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/modernizr.custom.js"></script>

        <!--webfonts-->
        <link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
        <!--//webfonts--> 

        <!-- Metis Menu -->
        <script src="js/metisMenu.min.js"></script>
        <script src="js/custom.js"></script>
        <link href="css/custom.css" rel="stylesheet">
        <!--//Metis Menu -->
           <script src="js/jquery-3.1.1.js"></script>    
	<script src="js/jquery.validate.js"></script>
    <style>
        .error{
            color:red;
        }
    </style>
    </head> 
    <body class="cbp-spmenu-push">
        <div class="main-content">
            <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                <!--left-fixed -navigation-->

            </div>
            <!--left-fixed -navigation-->

            <!-- header-starts -->
<?php
include './admin-page-part/side-bar.php'
?>

            <!-- header-starts -->
<?php
include './admin-page-part/header.php'
?>
            <!-- //header-ends -->
            <!-- main content start-->
            <div id="page-wrapper" style="margin-bottom:30px">
                <div class="main-page">
                    <div class="tables">
                        <h2 class="title1">Supplier</h2>
                        <div class="panel-body widget-shadow" style="margin-bottom: 40px">
                            <h4>Order Details</h4>
                            <form method="POST" id="form" action="">
                                <table class="table">
                                    <tbody>
<?php
$query = mysqli_query($connect, "select * from order_mst where ord_id=$oid");
$row = mysqli_fetch_array($query);
?>  
                                        <tr>
                                            <th>Product Name</th>
                                            <td>
<?php
$query2 = mysqli_query($connect, "select * from order_description where order_id={$row[0]}");
while ($row2 = mysqli_fetch_array($query2)) {
    echo $row2[1];
}
?>
                                            </td>
                                        </tr>
                                        <tr>
                                             <th>Price</th>
                                            <td>
<?php
$query3 = mysqli_query($connect, "select * from order_description where order_id={$row[0]}");
while ($row3 = mysqli_fetch_array($query3)) {
    echo $row3[4];
    $price=$row3[4];
}
?>
                                            </td>
                                        </tr>
                                        <tr>
                                             <th>Quantity</th>
                                            <td>
<?php
$query3 = mysqli_query($connect, "select * from order_description where order_id={$row[0]}");
while ($row3 = mysqli_fetch_array($query3)) {
    echo $row3[2];
    $qty1=$row3[2];
}
?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td><?php echo $qty1*$price ?></td>
                                        </tr>
                                           
                                    </tbody>
                                    
                                </table>
                                <p style="float:right;font-size: 20px"> <?php echo "<a href='admin_order.php'>Order Details</a>"?></p><br>
                                <br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if (isset($_POST['continue'])) {  
    $qty=$_POST["qty"];
    $moredetails=$_POST["moredetails"];
    if ($qty1<$qty)
    {
         echo "<script>alert('Entered Quantity Should Not Be More Than Available Quantity')</script>"; 
    }
    else
    {
        $queryr = mysqli_query($connect, "UPDATE order_mst SET type='Ord',order_details='{$moredetails}' WHERE ord_id='{$oid}' AND type='Req'") or die(mysqli_query($connect));
         if ($queryr) {
             $queryu = mysqli_query($connect, "UPDATE order_description SET qty='{$qty}' WHERE order_id='{$oid}'") or die(mysqli_query($connect));
         }
    }
}
            ?>
<script>
         // validate signup form on keyup and submit
		$("#form").validate({
			rules: {
				qty: {
					required: true
				}
			},
			messages: {
				
				qty: {
					required: "Please Enter Quantity",
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
            <!--footer-->
<?php
include './admin-page-part/footer.php'
?>
            <!--//footer-->
        </div>

        <!-- side nav js -->
        <script src='js/SidebarNav.min.js' type='text/javascript'></script>
        <script>
            $('.sidebar-menu').SidebarNav()
        </script>
        <!-- //side nav js -->

        <!-- Classie --><!-- for toggle left push menu script -->
        <script src="js/classie.js"></script>
        <script>
            var menuLeft = document.getElementById('cbp-spmenu-s1'),
                    showLeftPush = document.getElementById('showLeftPush'),
                    body = document.body;

            showLeftPush.onclick = function () {
                classie.toggle(this, 'active');
                classie.toggle(body, 'cbp-spmenu-push-toright');
                classie.toggle(menuLeft, 'cbp-spmenu-open');
                disableOther('showLeftPush');
            };

            function disableOther(button) {
                if (button !== 'showLeftPush') {
                    classie.toggle(showLeftPush, 'disabled');
                }
            }
        </script>
        <!-- //Classie --><!-- //for toggle left push menu script -->

        <!--scrolling js-->
        <script src="js/jquery.nicescroll.js"></script>
        <script src="js/scripts.js"></script>
        <!--//scrolling js-->

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.js"></script>

    </body>
</html>