<?php
require '../connect.php'; 
session_start();
if(!isset($_SESSION['id']))
{
header("location:../E-Pharmacy/sign_in.php");
}
 if(isset($_GET['id']))
         {
            $id=($_GET['id']);
            $status = mysqli_query($connect, "SELECT * From order_mst WHERE ord_id='{$id}'") or die(mysqli_error($connect));
            $status1= mysqli_fetch_array($status);
            $o_status=$status1['o_status'];
            if ($o_status=='Pending')
            {
                 $check = mysqli_query($connect, "UPDATE order_mst SET o_status='Delivered' WHERE ord_id='{$id}'");
            if($check)
            {
                 echo "<script>alert('Order Delivered !!!');
    </script>";
            }
            }
 else {   $check = mysqli_query($connect, "UPDATE order_mst SET o_status='Pending' WHERE ord_id='{$id}'");
            if($check)
            {
                 echo "<script>alert('Order Pending !!!');
    </script>";
            }
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
        <script type="text/javascript" src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
        <script>
            $(document).ready(function () {
                $('#table2').DataTable();
            });
        </script>

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

            <!--left-fixed -navigation-->
            <?php
            include './admin-page-part/side-bar.php'
            ?>

            <!-- header-starts -->
            <?php
            include './admin-page-part/header.php'
            ?>
            <!-- //header-ends -->
            <!-- main content start-->     <!--left-fixed -navigation-->
            <div id="page-wrapper">
                <div class="main-page">
                    <div class="tables">
                        <h2 class="title1">Order</h2>
                        <div class="panel-body widget-shadow">
                            <h4>Admin Order</h4>
                            <table id="table2" class="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Supplier Name</th>
                                        <th>Order Date</th>
                                        <th>Amount</th>
                                        <th>Delivery Details</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $supplier=mysqli_query($connect,"SELECT * FROM user_mst WHERE usertype_id=1");
                                    while($supp= mysqli_fetch_array($supplier))
                                    {
                                        $supp_id=$supp['user_id'];
                                     $query = mysqli_query($connect,"SELECT * FROM order_mst WHERE by_id = $supp_id AND type='Ord'");
                                     while($row = mysqli_fetch_assoc($query))
                                     {
                                         $q2 = mysqli_query($connect,"SELECT * FROM user_mst WHERE user_id = '{$row['to_id']}'");
                                         while($result = mysqli_fetch_assoc($q2))
                                         {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['ord_id'] ; ?></td>
                                        <td><?php echo $result['s_name'];?></td>
                                        <td><?php echo $row['order_date_time']; ?></td>
                                        <td><?php echo $row['total']; ?></td>
                                        <td><?php echo $row['address']  ; ?></td>
                                        <td><select name="o_status" style='outline:none' onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
<?php

echo "<option disabled selected>{$row['o_status']}</option>";
if ($row['o_status']=='Delivered')
{
     echo "<option value='admin_order_1.php?id={$row['ord_id']}'>Pending</option>"; 
}
 else {
     echo "<option value='admin_order_1.php?id={$row['ord_id']}'>Delivered</option>"; 
}
   
    
?>
                    </select>
                                         </td>
                                    </tr>
                                    <?php
                                     }
                                     }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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