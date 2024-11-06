<?php
  require '../connect.php'; 
 if (isset($_GET['bid'])) {
     $bid = $_GET['bid'];
     $check=mysqli_query($connect, "Select c_status From user_mst Where user_id=$bid");
     $resultcheck=mysqli_fetch_array($check);
     $c_status=$resultcheck['c_status'];
     if ($c_status=="Inactive")
     {
          echo "<script>alert('User Already Blocked')</script>";
     }
 else {
          $update = mysqli_query($connect, "update user_mst set c_status='Inactive' Where user_id=$bid") or die(mysqli_error($connect));
                                        if ($update) {
                                            echo "<script>alert('User Blocked')</script>";
     }    
                                    }
 }
                                  if (isset($_GET['uid'])) {
     $bid = $_GET['uid'];
     $check=mysqli_query($connect, "Select c_status From user_mst Where user_id=$bid");
     $resultcheck=mysqli_fetch_array($check);
     $c_status=$resultcheck['c_status'];
     if ($c_status=="Active")
     {
          echo "<script>alert('User Already UnBlock')</script>";
     }
 else {
          $update = mysqli_query($connect, "update user_mst set c_status='Active' Where user_id=$bid") or die(mysqli_error($connect));
                                        if ($update) {
                                            echo "<script>alert('User UnBlocked')</script>";
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
                        <h2 class="title1">Customer</h2>
                        <div class="panel-body widget-shadow">
                            <h4>Customer Details</h4>
                            <table id="table2" class="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>First Name</th>
                                        <th>Middle  Name</th>
                                        <th>Last Name</th>
                                        <th>Gender</th>
                                        <th>Contact</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Action</th>                              
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     $query = mysqli_query($connect, "select * from user_mst where usertype_id=3");
                while($row=mysqli_fetch_array($query))
                {
             ?>
            <tr>
                <td><?php echo $row[0];?></td>
                <td><?php echo $row[3];?></td>
                <td><?php echo $row[4];?></td>
                <td><?php echo $row[5];?></td>
                <td><?php echo $row[8];?></td>
                <?php echo "<td>{$row[6]}<br>{$row[7]}</td>";?>
                <td><?php echo $row[9];?></td>
                <td><?php echo $row[12];?></td>
                <td> <a href="customer.php?bid=<?php echo "{$row[0]}" ?>"><img src="images/block-user.png" style="width:21px;"> Block</a> | <a href="customer.php?uid=<?php echo "{$row[0]}" ?>"><img src="images/unlock.png" style="width:17px;"> Unblock</a></td>
            </tr>
            <?php
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