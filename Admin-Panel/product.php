<?php
  require '../connect.php';
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
                        <h2 class="title1">Product <a class="fa fa-plus-circle" href="add_product.php"></a></h2>
                        <div class="panel-body widget-shadow">
                            <h4>Product Details</h4>
                            <table id="table2" class="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Product Name</th>
                                        <th>Product Image</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Category</th>
                                        <th>Supplier Name</th>
                                        <th>Expiry Date</th>
                                        <th>Action</th>                                   
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_GET['did'])) {
                                        $did = $_GET['did'];
                                        $delete2 = mysqli_query($connect, "delete from product_description where pro_id='{$did}'") or die("Server Problem !!!");
                                        $delete1 = mysqli_query($connect, "delete from product_mst where pro_id='{$did}'") or die("Server Problem !!!");
                                        if ($delete1 && $delete2) {
                                            echo "<script>alert('Product Deleted Successfully')</script>";
                                        }
                                    }
                                     $query = mysqli_query($connect, "select * from product_mst");                     
                while($row=mysqli_fetch_array($query))
                
                {
                echo "<tr>";
                echo "<td>{$row[0]}</td>";
                echo "<td>{$row[1]}</td>";
                $query1 = mysqli_query($connect, "select * from img_mst where pro_id=$row[0]");
                 while($row1=mysqli_fetch_array($query1))
                    {
                echo "<td><a href='{$row1[1]}'><img style='width:70px;height:70px' alt='not found' src='{$row1[1]}'></img></a></td>";
                    }
                echo "<td>{$row[6]}</td>";
                echo "<td>{$row[7]}</td>";
                $query2 = mysqli_query($connect, "select * from category_mst where cat_id=$row[3]");
                 while($row2=mysqli_fetch_array($query2))
                 {
                echo "<td>{$row2[1]}</td>";
                }
                $query3 = mysqli_query($connect, "select * from user_mst where user_id=$row[5]");
                 while($row3=mysqli_fetch_array($query3))
                 {
                echo "<td>{$row3[2]}</td>";
                 }
                echo "<td>{$row[8]}</td>";
                echo "<td><a href='edit_product.php?eid={$row[0]}'><img src='images/edit.png' style='width:21px;'> Edit</a> | 
                     <a href='product.php?did={$row[0]}'><img src='images/remove.png' style='width:17px;'> Delete</a>
                 </td>";
                echo "</tr>";
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