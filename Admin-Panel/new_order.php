<?php
include '../connect.php';
if (isset($_POST['order'])) {
    $pname = $_POST["pro_name"];
    $qty = $_POST["pro_qty"];
    $supp_id = $_POST["supp_name"];
    $details = $_POST["details"];
    $check=mysqli_query($connect, "Select * From order_mst where by_id=6 and to_id={$supp_id} and type='Req'");
    $row= mysqli_num_rows($check);
            if($row>0)
            {
                   echo "<script>alert('Already One Request Under Process') </script>";
            }
           else
           {
    $sql1 = "INSERT INTO order_mst(type,by_id,to_id,o_status,order_details) VALUES ('Req',6,{$supp_id},'Pending','{$details}')";
    $result1 = mysqli_query($connect, $sql1) or die(mysqli_error($connect));
    if ($result1) {
        $order_id = mysqli_insert_id($connect);
            $sql2 = "INSERT INTO order_description(order_id,pro_name,qty) VALUES ({$order_id},'{$pname}',{$qty})";
            $result2 = mysqli_query($connect, $sql2) or die(mysqli_error($connect));
        }
        if ($result2) 
           {
                echo "<script>alert('Order Request Send');
    window.location.href = 'new_order_history.php';
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
        <script src="js/jquery-3.1.1.js"></script>    
        <script src="js/jquery.validate.js"></script>
        <style>
            .error{
                color:red;
            }
        </style>
    </head> 
    <body class="cbp-spmenu-push">
        <script src="js/jquery-3.1.1.js"></script>    
        <script src="js/jquery.validate.js"></script>
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
                    <div class="forms" style="margin-bottom:32px">
                        <div class=" form-grids row form-grids-right">
                            <div class="widget-shadow " data-example-id="basic-forms"> 

                                <div class="form-body">
                                    <h2 class="title1">Product Order <a href="new_order_history.php" style="float:right;font-size: 22px">Pending Request</a></h2>
                                    <form class="form-horizontal" method="post" enctype="multipart/form-data" id="form"> 
                                        <div class="form-group"><br>
                                            <label style="margin-top: 10px" for="inputEmail3" class="col-sm-2 control-label">Supplier Name</label> 
                                            <div class="col-sm-9"> 
                                                <select style="margin-top: 10px" class="form-control" name="supp_name">
<?php
$query = mysqli_query($connect, "SELECT * FROM user_mst WHERE (usertype_id=2  and is_verified='yes' and c_status!='Inactive')") or die(mysqli_error($connect));

echo "<option disabled selected>Select Product Supplier</option>";
while ($data = mysqli_fetch_array($query)) {
    echo "<option value='{$data[user_id]}'>{$data[s_name]}</option>";
}
?>   
                                                </select>
                                            </div>
                                            <br><br><label style="margin-top: 10px" for="inputEmail3" class="col-sm-2 control-label">Product Name</label> 
                                            <div class="col-sm-9"> 
                                                <input style="margin-top: 10px" type="text" class="form-control" name="pro_name" placeholder="Enter Product Name"> 
                                            </div>
                                            <br><br> <label style="margin-top: 10px" for="inputEmail3" class="col-sm-2 control-label">Product Quantity</label> 
                                            <div class="col-sm-9"> 
                                                <input style="margin-top: 10px" type="text" class="form-control" name="pro_qty" placeholder="Enter Product Quantity" onkeyup="Validate(this)"> 
                                            </div> 
                                            <br><label style="margin-top: 30px" for="inputEmail3" class="col-sm-2 control-label">Add More Details</label> 
                                            <div class="col-sm-9"> <br>
                                                <textarea type="text" class="form-control" name="details" placeholder="Enter More Details About Product" style="resize:none"></textarea>
                                            </div>
                                            <div class="form-group"> 
                                                <div class="col-sm-offset-2 col-sm-10"> </div>
                                            </div> 
                                            <div class="form-group"> 
                                                <div class="col-sm-offset-2 col-sm-10"> </div>
                                            </div> 
                                            <div class="col-sm-offset-2"> &nbsp;&nbsp;
                                                <button type="submit" name="order" class="btn btn-success">Send Order Details</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <button type="reset" class="btn btn-danger">Reset</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <br><br></div> 
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>


                $("#form").validate({
                    rules: {

                        supp_name: {
                            required: true,
                        },
                        pro_name: {
                            required: true,
                            minlength: 3,
                            maxlength: 30
                        },
                        pro_qty: {
                            required: true,
                        },
                    },
                    messages: {

                        supp_name: {
                            required: "Please Enter Supplier Name"
                        },
                        pro_name: {
                            required: "Please Enter Product Name",
                            minlength: "Product name must consist of at least 3 characters"
                        },
                        pro_qty: {
                            required: "Please Enter Product Quantity",
                        },

                    }
                });

                function Validate(no) {
                    no.value = no.value.replace(/[^ 0-9\n\r]+/g, '');
                }

                function Validatestring(no) {
                    no.value = no.value.replace(/[^ a-z A-Z\n\r]+/g, '');
                }



            </script>

        </div>

        <!--footer-->
<?php
include './admin-page-part/footer.php'
?>
        <!--//footer-->


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
