<?php
require '../connect.php'; 
session_start();
$user_id=$_SESSION['id'];
if(!isset($_SESSION['id']))
{
header("location:../E-Pharmacy/sign_in.php");
}
$uid = $_GET['uid'];
if(isset($_POST['approved']))
{
  if($uid>0)
  {
      $querya = "UPDATE user_mst SET is_verified = 'Yes' WHERE user_id = '{$uid}'";
      $resulta = mysqli_query($connect, $querya);
      if($resulta)
      {
       echo "<script>alert('Approved succesfully');
    window.location.href = 'supplier_verifi.php';
    </script>";
      }
  }
}
if(isset($_POST['reject']))
{
    if($uid>0)
  {
      $query = "SELECT * FROM user_mst WHERE user_id = '{$uid}'";
      $result = mysqli_query($connect, $query);
      $queryr = "UPDATE user_mst SET is_verified = 'Rej' WHERE user_id = '{$uid}'";
      $resultr = mysqli_query($connect, $queryr);
      if($resultr)
      {
       echo "<script>alert('Rejected succesfully');
    window.location.href = 'supplier_verifi.php';
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
                                    $query = mysqli_query($connect, "select * from user_mst where user_id=$uid");
                                    $row = mysqli_fetch_array($query);
                                    echo "<tr>";
                                    echo "<th>ID</th>";
                                    echo "<th>{$row[0]}</th>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<th>Supplier Name</th>";
                                    echo "<th>{$row[2]}</th>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<th>Mobile Number</th>";
                                    echo "<th>{$row[6]}</th>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<th>Email Address</th>";
                                    echo "<th>{$row[7]}</th>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<th>Address</th>";
                                    echo "<th>{$row[9]}</th>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<th>GST Number</th>";
                                    echo "<th>{$row[10]}</th>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<th>Certificate</th>";
                                    echo "<td><a href='{$row[11]}'><img style='width:100px;height:100px' src='{$row[11]}'></img></a></td>";
                                    echo "</tr>";
                                    ?>
                                </tbody>
                            </table>
                            <br><div> 
                                            <button type="submit" class="btn btn-success" name="approved">Approved</button>
                                            <button style="float:right" type="submit" class="btn btn-danger" name="reject">Reject</button>                                      
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