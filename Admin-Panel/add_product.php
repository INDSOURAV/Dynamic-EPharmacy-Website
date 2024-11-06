<?php
include '../connect.php';
if (isset($_POST['submit'])) {
    $pro_name = $_POST["pro_name"];
    $pro_price = $_POST["pro_price"];
    $pro_qty = $_POST["pro_qty"];
    $pro_type = $_POST["pro_type"];
    $pro_img = "../upload/" . $_FILES['image']['name'];
    $pro_cat = $_POST["pro_cat"];
    $pro_supplier = $_POST["supplier"];
    $pro_exp_date = $_POST["pro_exp_date"];
    $pro_net = $_POST["pro_net"];
    $pro_comp = $_POST["pro_comp"];
    $sql = "SELECT * FROM product_mst WHERE pro_name='$pro_name' and supplier_id=$pro_supplier and exp_date='$pro_exp_date'";
    $result = mysqli_query($connect, $sql)or die(mysqli_error($connect));
    $count = mysqli_num_rows($result);
    if ($count) {
        echo "<script>alert('Duplicate Entry With Same Supplier')</script>";
    } else {
        $sql1 = "INSERT INTO product_mst(pro_name,price,qty,supplier_id,cat_id,exp_date)VALUES('{$pro_name}',{$pro_price},{$pro_qty},{$pro_supplier},{$pro_cat},'$pro_exp_date')";
        $result = (mysqli_query($connect, $sql1)) or die(mysqli_error($connect));
        if($result)
        {
        $product_id = mysqli_insert_id($connect);
        $sql2 = "INSERT INTO img_mst(img_path,pro_id)VALUES('{$pro_img}',{$product_id})";
        $sql3 = "INSERT INTO product_description(net_content,composition,pro_type,pro_id)VALUES('{$pro_net}','{$pro_comp}','{$pro_type}',{$product_id})";
        $result1 = (mysqli_query($connect, $sql2) and mysqli_query($connect, $sql3)) or die(mysqli_error($connect));
        if ($result1) {
            $fileprocess = move_uploaded_file($_FILES['image']['tmp_name'], $pro_img);
            if ($fileprocess) {
                echo "<script>alert('Product Added Successfully')</script>";
            }
        }
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
                    <div class="forms">
                        <h2 class="title1">Product</h2>
                        <div class=" form-grids row form-grids-right">
                            <div class="widget-shadow " data-example-id="basic-forms"> 
                                <div class="form-title">
                                    <h4>Add Product</h4>
                                </div>
<?php //echo "$msg"  ?>
                                <div class="form-body">
                                    <form class="form-horizontal" method="post" enctype="multipart/form-data" id="form"> 
                                        <div class="form-group"> 
                                            <label style="margin-top: 10px" class="col-sm-2 control-label">Product Name</label> 
                                            <div class="col-sm-9"> 
                                                <input style="margin-top: 10px" type="text" class="form-control" name="pro_name" placeholder="Enter Product Name"> 
                                            </div> 
                                            <br><br><label style="margin-top: 10px" class="col-sm-2 control-label">Product Price</label> 
                                            <div class="col-sm-9"> 
                                                <input style="margin-top: 10px" type="text" class="form-control" name="pro_price"  placeholder="Enter Product Price" onkeyup="Validate(this)"> 
                                            </div> 
                                            <br><br><label style="margin-top: 10px" for="inputEmail3" class="col-sm-2 control-label">Product Quantity</label> 
                                            <div class="col-sm-9"> 
                                                <input style="margin-top: 10px" type="text" class="form-control" name="pro_qty" placeholder="Enter Product Quantity" onkeyup="Validate(this)"> 
                                            </div>
                                            <br><br><label style="margin-top: 10px" for="inputEmail3" class="col-sm-2 control-label">Product Type</label> 
                                            <div class="col-sm-9"> 
                                                <select style="margin-top: 10px" class="form-control" name="pro_type" required>
                                                    <option disabled selected>Select Product Type</option>
                                                    <option value="Capsule">Capsule</option>
                                                    <option value="Capsule">Cream</option>
                                                    <option value="Gel">Gel</option>
                                                    <option value="Liquid">Liquid</option>
                                                    <option value="Powder">Powder</option>
                                                    <option value="Tablet">Tablet</option> 
                                                    <option value="Spray">Spray</option> 
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>
                                            <br><br> <label style="margin-top: 10px" for="inputEmail3" class="col-sm-2 control-label">Product Image</label> 
                                            <div class="col-sm-9"> 
                                                <input style="margin-top: 10px" type="file" class="form-control" name="image" accept="image/*"> 
                                            </div> 
                                            <br><br> <label style="margin-top: 10px" for="inputEmail3" class="col-sm-2 control-label">Product Category</label> 
                                            <div class="col-sm-9"> 
                                                <select style="margin-top: 10px" class="form-control" name="pro_cat">
<?php
$query = mysqli_query($connect, "SELECT * FROM category_mst") or die(mysqli_error($connect));

echo "<option disabled selected>Select Product Category</option>";
while ($data = mysqli_fetch_array($query)) {
    echo "<option value='{$data[cat_id]}'>{$data['cat_name']}</option>";
}
?>
                                                </select>
                                            </div>
                                            <br><br> <label style="margin-top: 10px" for="inputEmail3" class="col-sm-2 control-label">Product Supplier</label> 
                                            <div class="col-sm-9"> 
                                                <select style="margin-top: 10px" class="form-control" name="supplier" required>
                                                    <?php
                                                    $query = mysqli_query($connect, "SELECT * FROM user_mst WHERE usertype_id=2  and is_verified='yes'") or die(mysqli_error($connect));

                                                    echo "<option disabled selected>Select Product Supplier</option>";
                                                    while ($data = mysqli_fetch_array($query)) {
                                                        echo "<option value='{$data[user_id]}'>{$data[s_name]}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div> 
                                            <br><br> <label style="margin-top: 10px" for="inputEmail3" class="col-sm-2 control-label">Product Expiry Date</label> 
                                            <div class="col-sm-9"> 
                                                <input style="margin-top: 10px" type="date" class="form-control" name="pro_exp_date" placeholder="Enter Product Expiry Date"> 
                                            </div> 
                                            <br><br> <label style="margin-top: 10px" for="inputEmail3" class="col-sm-2 control-label">Net Contents</label> 
                                            <div class="col-sm-9"> 
                                                <input style="margin-top: 10px" type="text" class="form-control" name="pro_net" placeholder="Enter Product Net Contents"> 
                                            </div> 
                                            <br><br> <label style="margin-top: 10px" for="inputEmail3" class="col-sm-2 control-label">Product Composition</label> 
                                            <div class="col-sm-9"> 
                                                <input style="margin-top: 10px" type="text" class="form-control" name="pro_comp" placeholder="Enter Product Composition"> 
                                            </div>
                                        </div> 

                                        <div class="form-group"> 
                                            <div class="col-sm-offset-2 col-sm-10"> </div>
                                        </div> 
                                        <div class="col-sm-offset-2"> 
                                            <button type="submit" name="submit" class="btn btn-success">Add Product</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button type="reset" class="btn btn-danger">Reset</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button type="button" onclick="window.location = 'product.php'" class="btn btn-info">View</button>
                                        </div> 
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

                        pro_name: {
                            required: true,
                            minlength: 3
                        },
                        pro_type: "required",
                        pro_price: "required",
                        pro_qty: "required",
                        image: "required",
                        pro_cat: "required",
                        supplier: "required",
                    },
                    messages: {

                        pro_name: {
                            required: "Please Enter Product Name",
                            minlength: "Product name must consist of at least 3 characters"
                        },
                        pro_type: "Please Select the Type",
                        pro_price: "Please enter price",
                        pro_qty: "Please enter qauntity ",
                        image: "Please select at least one image",
                        pro_cat: "Please select the category",
                        supplier: "Please select the supplier",
                        pro_desc: "Please enter the product description",
                        pro_comp: "Please enter the product composition"
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
