<?php
require '../connect.php'; 
session_start();
$oid=0;
$qty=0;
$price1=0;
$user_id=$_SESSION['id'];
if(!isset($_SESSION['id']))
{
header("location:../E-Pharmacy/sign_in.php");
}
$oid = $_GET['oid'];
if (isset($_POST['reject'])) {
        $queryr = mysqli_query($connect, "UPDATE order_mst SET type='Rej',o_status='Rejected' WHERE ord_id='{$oid}' AND type='Req'") or die(mysqli_query($connect));
         if ($queryr) {
            echo "<script>alert('Request Cancelled succesfully');
    window.location.href = 'new_order_history.php';
    </script>";
    }
}
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
                         <h2 class="title1">Order</h2>
                        <div class="panel-body widget-shadow">
                            <h4>New Order Details</h4>
                            <form method="POST">
                            <table class="table">
                                <tbody>
                                    <?php
                                    $query = mysqli_query($connect, "select * from order_description where order_id=$oid");
                                    $row = mysqli_fetch_array($query);
                                    $query1 = mysqli_query($connect, "select * from order_mst where ord_id=$oid");
                                    $row1 = mysqli_fetch_array($query1);
                                    $supp_id=$row1['to_id'];
                                    $query2 = mysqli_query($connect, "select * from user_mst where user_id=$supp_id");
                                    $row2 = mysqli_fetch_array($query2);
                                    $qty=$row[2];
                                    echo "<tr>";
                                    echo "<th>ID</th>";
                                    echo "<td>{$row['order_id']}</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<th>Supplier Name</th>";
                                    echo "<td>{$row2['s_name']}</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<th>Mobile Number</th>";
                                    echo "<td>{$row2[6]}</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<th>Email Address</th>";
                                    echo "<td>{$row2[7]}</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<th>Product Name</th>";
                                    echo "<td>{$row[1]}</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<th>Quantity</th>";
                                        echo "<td>{$row[2]}</td>";
                                    echo "</tr>";
                                     echo "<th>Price</th>";
                                        $q2 = mysqli_query($connect,"SELECT * FROM order_description WHERE order_id = '{$oid}'");
                                         $result1 = mysqli_fetch_assoc($q2);
                                         $price=$result1['price'];
                                                 if($price==0)
                                                 { 
                                                      echo "<td>Pending</td>";
                                                }
                                                 else
                                                 {
                                                     echo "<td>$price</td>";
                                                  }
                                         
                                    echo "</tr>";
                                     echo "<th>Total</th>";
                                        $q3 = mysqli_query($connect,"SELECT * FROM order_description WHERE order_id = '{$oid}'");
                                         $result2 = mysqli_fetch_assoc($q3);
                                         $price1=$result2['price'];
                                         
                                         
                                                 if($price1==0)
                                                 { 
                                                      echo "<td>Pending</td>";
                                                }
                                                 else
                                                 {?>
                                                  <td> <?php echo $price1*$qty;?></td>
                                                <?php }
                                         
                                    echo "</tr>";
                                     echo "<th>Delivery Address</th>";
                                      echo "<td>E - Pharmacy WareHouse</td>";
                                        echo "<td> <input type='radio' checked> COD</td>";
                                    echo "</tr>";
                                    ?>
                                </tbody>
                            </table>
                            <br><div> 
                                <?php $q4 = mysqli_query($connect,"SELECT * FROM order_mst WHERE ord_id = '{$oid}'");
                                         $result3 = mysqli_fetch_assoc($q4);
                                         $type=$result3['o_status'];
                                         
                                         
                                                 if($type=="Rejected" OR $type=="Cancelled" OR  $price1==0)
                                                 { ?>
                                        
                                                <?php }
                                                else
                                                {?>
                                                       <button type="submit" class="btn btn-success" name="approved">Place Order</button>
                                            <button style="float:right" type="submit" class="btn btn-danger" name="reject">Cancel</button>  
                                                  <?php  }?>
                                                                                
                            </div> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
if (isset($_POST['approved'])) {
    $total=$price1*$qty;
        $queryr = mysqli_query($connect, "UPDATE order_mst SET type='Ord',total='$total',address='E-Pharmacy, Ahmedabad' WHERE ord_id='{$oid}' AND type='Req'") or die(mysqli_query($connect));
         if ($queryr) {
             $payment=mysqli_query($connect, "Insert into payment_mst(price,order_id,status,method,user_id) Values($total,$oid,'Pending','COD',6)") or die(mysqli_query($connect));
            echo "<script>alert('Order Send succesfully');
    window.location.href = 'admin_order_1.php';
    </script>";
    }
}
?>
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