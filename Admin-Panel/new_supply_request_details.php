<?php
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
if (isset($_POST['reject'])) {
        $queryr = mysqli_query($connect, "UPDATE order_mst SET type='Rej',o_status='Rejected' WHERE ord_id='{$oid}' AND type='Req'") or die(mysqli_query($connect));
         if ($queryr) {
            echo "<script>alert('Request Rejected succesfully');
    window.location.href = 'new_supply_request.php';
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
                        <h2 class="title1">Supplier</h2>
                        <div class="panel-body widget-shadow">
                            <h4>Supplier Verification Details</h4>
                            <form method="POST">
                                <table class="table">
                                    <tbody>
<?php
$query = mysqli_query($connect, "select * from order_mst where ord_id=$oid");
$row = mysqli_fetch_array($query);
?>
                                        <tr>
                                            <th>ID</th>
                                            <td><?php echo "{$row[0]}"; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Supplier Name</th>
                                            <td>
<?php
$query1 = mysqli_query($connect, "select * from user_mst where user_id={$row[6]}");
while ($row1 = mysqli_fetch_array($query1)) {
    echo $row1[2];
}
?>
                                            </td>
                                        <tr>  
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
}
?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Product Image</th>
                                            <th>
<?php
$query4 = mysqli_query($connect, "select * from img_mst where ord_id={$row[0]}");
while ($row4 = mysqli_fetch_array($query4)) {
    echo "<a href='{$row4[1]}'><img style='width:100px;height:100px' src='{$row4[1]}'></img></a>";
}
?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>More Details</th>
                                            <td> <?php echo "{$row[10]}"; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br><div> 
                                    <b> <p style="float:right;font-size: 20px" > <?php echo "<a href='new_supply_request_process.php?oid={$oid}'>Continue </a>"?></p></b>
                                    <button style="float:left" type="submit" class="btn btn-danger" name="reject">Reject</button>                                      
                                </div> 
                            </form>
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