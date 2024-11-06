<?php
$msg = "";
require '../connect.php';
$editid = $_GET['eid'];
if (!isset($_GET['eid']) || empty($_GET['eid'])) {
    header("location:category.php");
}
$query = mysqli_query($connect, "select * from category_mst where cat_id='{$editid}'") or die(mysqli_error($connect));
$categoryrow = mysqli_fetch_array($query);
$query1 = mysqli_query($connect, "select cat_name from category_mst") or die(mysqli_error($connect));
$categoryrow1 = mysqli_fetch_array($query1);
if ($_POST) {
        $cat_name = mysqli_real_escape_string($connect, $_POST['cat_name']);
if($cat_name==$categoryrow1['cat_name'])
{
    echo "<script>alert('Entered Category Already Added !!!')</script>";
}
else
{
    $query = mysqli_query($connect, "update category_mst set cat_name='{$cat_name}' where cat_id='{$editid}'") or die (mysqli_error($connect));
    if ($query) {
        $msg = '<div class="alert alert-success" role="alert">
                    Category Updated Successfully
                </div>';
    } else {
        $msg = (mysqli_error($connect));
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

            <!--left-fixed -navigation-->
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
                    <div class="forms">
                        <h2 class="title1">Category</h2>
                        <div class=" form-grids row form-grids-right">
                            <div class="widget-shadow " data-example-id="basic-forms"> 
                                <div class="form-title">
                                    <h4>Edit Category</h4>
                                </div>

                                <?php echo "$msg" ?>
                                <div class="form-body">
                                    <form class="form-horizontal" method="post" enctype="multipart/form-data"> 
                                        <div class="form-group"> 
                                            <label for="inputEmail3" class="col-sm-2 control-label">Category ID</label> 
                                            <div class="col-sm-9"> 
                                                <input readonly="text" class="form-control" id="inputEmail3" value="<?php echo $categoryrow['cat_id'] ?>" placeholder="Enter Category Name" required> 
                                            </div> 
                                            <br><br><label for="inputEmail3" class="col-sm-2 control-label">Category Name</label> 
                                            <div class="col-sm-9"> 
                                                <input type="text" class="form-control" id="inputEmail3" value="<?php echo $categoryrow['cat_name'] ?>" name="cat_name" placeholder="Enter Category Name" required> 
                                            </div> 
                                        </div> 

                                        <div class="form-group"> 
                                            <div class="col-sm-offset-2 col-sm-10"> </div>
                                        </div> 
                                        <div class="col-sm-offset-2"> 
                                            <button type="submit" class="btn btn-success">Edit</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button type="button" onclick="window.location = 'category.php'" class="btn btn-info">View</button>
                                        </div> 
                                    </form> 
                                </div>
                            </div>
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