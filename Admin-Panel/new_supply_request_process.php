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
            <div id="page-wrapper">
                <div class="main-page">
                    <div class="tables">
                        <h2 class="title1">Supplier</h2>
                        <div class="panel-body widget-shadow">
                            <h4>Enter Order Details</h4>
                            <form method="POST" id="form">
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
                                            <th>Available Quantity</th>
                                            <td>
<?php
$query3 = mysqli_query($connect, "select * from order_description where order_id={$row[0]}");
while ($row3 = mysqli_fetch_array($query3)) {
    echo $row3[2];
    $qty1=$row3[2];
}
?>
                                            </td>
                                             <th>More Details</th>
                                            <td> <?php echo "{$row[10]}"; ?></td>
                                        </tr>
                                         <tr>
                                            <td>Enter Quantity</td>
                                           
                                            <td>
                                                <input style="margin-top: 10px" type="text" class="form-control" name="qty" placeholder="Enter Product Net Contents" onkeyup="Validate(this)"> 
                                            </td>
                                             <td></td> <td></td>
                                        </tr>
                                        <tr>
                                            <td>Add More Details</td>
                                            <td>
                                                <textarea style="margin-top: 10px;resize:none" type="text" class="form-control" name="moredetails" placeholder="Enter Product Net Contents"></textarea>
                                            </td>
                                             <td></td> <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br><div> <button style="float:right" type="submit" class="btn btn-success" name="continue">Continue</button>                                      
                                </div> 
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
        $total=$qty*$price;
        $queryr = mysqli_query($connect, "UPDATE order_mst SET type='Ord',order_details='{$moredetails}',total=$total,address='E-Pharmacy, Ahmedabad',o_status='Pending' WHERE ord_id='{$oid}' AND type='Req'") or die(mysqli_query($connect));
         if ($queryr) {
             $queryu = mysqli_query($connect, "UPDATE order_description SET qty='{$qty}' WHERE order_id='{$oid}'") or die(mysqli_query($connect));
             $query1 = mysqli_query($connect, "INSERT INTO payment_mst(price,order_id,method,status,user_id) VALUES($total,'{$oid}','COD','Pending',6)") or die(mysqli_query($connect));
            echo "<script>window.location.href = 'new_supply_request_overview.php?oid=$oid';</script>";
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