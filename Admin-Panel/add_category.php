<?php
$gender1="";
include '../connect.php';
if(isset($_POST['submit']))
{
$cat_name=$_POST["cat_name"];
$sql1="SELECT * FROM category_mst";
$i = 1;
$result1 = mysqli_query($connect, $sql1)or die(mysqli_error($connect));
while($data=mysqli_fetch_array($result1))
{
$cat_name1=$data['cat_name'];
if($cat_name==$cat_name1)
{
   $i = 0; 
}
}
if($i==0)
{
    echo "<script>alert('Entered Category Already Added')</script>"; 
}
 else {
  $sql="INSERT INTO category_mst(cat_name)VALUES('{$cat_name}')"; 
$result = mysqli_query($connect, $sql)  or die(mysqli_error($connect));
if($result)
{
    echo "<script>alert('Category Added Successfully')</script>"; 
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
                                    <h4>Add Category</h4>
                                </div>
                                <div class="form-body" style="margin-bottom: 205px;">
                                    <form class="form-horizontal" method="post" enctype="multipart/form-data" id="form"> 
                                        <div class="form-group"> 
                                            <label for="inputEmail3" class="col-sm-2 control-label">Category Name</label> 
                                            <div class="col-sm-9"> 
                                                <input type="text" class="form-control" placeholder="Enter Category Name" name="cat_name" onkeyup ="Validatestring(this)">
                                            </div> 
                                        </div> 
                                        <div class="form-group"> 
                                            <div class="col-sm-offset-2 col-sm-10"> </div>
                                        </div> 
                                        <div class="col-sm-offset-2"> 
                                            <button type="submit" class="btn btn-success" name="submit">Add Category</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button type="reset" class="btn btn-danger">Reset</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
<script>
    $("#form").validate({
			rules: {
				
                               cat_name: {
                                        required: true,
					minlength: 3
				}
			},
                        messages: {
                           cat_name: {
					required: "Please Enter Category Name",
					minlength: "Category must be at least 3 characters long"
				},
               }
		});
                 function Validatestring(no) {
                   no.value = no.value.replace(/[^ a-z A-Z\n\r]+/g, '');
               }
     </script> 
     
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