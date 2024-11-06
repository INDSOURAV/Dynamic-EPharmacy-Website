<?php
$msg="";
require '../connect.php';
$editid=$_GET['eid'];
if(!isset($_GET['eid']) || empty($_GET['eid']))
{
header("location:product.php");
}
$query=mysqli_query($connect, "select * from product_mst where pro_id='{$editid}'") or die(mysqli_error($connect));
$productrow=mysqli_fetch_array($query);
$img=mysqli_query($connect, "select * from img_mst where pro_id='{$editid}'") or die(mysqli_error($connect));
$img1=mysqli_fetch_array($img);
$cat_name=mysqli_query($connect, "select * from category_mst where cat_id='$productrow[cat_id]'") or die(mysqli_error($connect));
$cat_name1=$product=mysqli_fetch_array($cat_name);
$supp_name=mysqli_query($connect, "select * from user_mst where user_id='$productrow[supplier_id]'") or die(mysqli_error($connect));
$supp_name1=$product=mysqli_fetch_array($supp_name);
$query1=mysqli_query($connect, "select * from product_description where pro_id='{$editid}'") or die(mysqli_error($connect));
$product=mysqli_fetch_array($query1);
if (isset($_POST["submit"])) {
    $pro_name = $_POST["pro_name"];
    $pro_price = $_POST["pro_price"];
    $pro_qty = $_POST["pro_qty"];
    $pro_type = $_POST["pro_type"];
//    $pro_img = "../upload/" . $_FILES['image']['name'];
    $pro_cat = $_POST["pro_cat"];
    $pro_supplier = $_POST["supplier"];
    $pro_exp_date = $_POST["pro_exp_date"];
    $pro_net = $_POST["pro_net"];
    $pro_comp = $_POST["pro_comp"];
//    $sql = "SELECT * FROM product_mst WHERE pro_name='$pro_name' and supplier_id=$pro_supplier and exp_date='$pro_exp_date'";
//    $result = mysqli_query($connect, $sql)or die(mysqli_error($connect));
//    $count = mysqli_num_rows($result);
//    if ($count) {
//        echo "<script>alert('Duplicate Entry With Same Supplier')</script>";
//    } else {
        $sql1 = "UPDATE product_mst SET pro_name='{$pro_name}', price={$pro_price}, qty={$pro_qty}, supplier_id={$pro_supplier}, cat_id={$pro_cat}, exp_date='$pro_exp_date' WHERE pro_id='{$editid}'";
//        $sql2 = "UPDATE img_mst SET img_path='{$pro_img}' WHERE pro_id='{$editid}'";
        $sql3 = "UPDATE product_description SET net_content='{$pro_net}' ,composition='{$pro_comp}' ,pro_type='{$pro_type}' WHERE pro_id='{$editid}'";
        $result1 = (mysqli_query($connect, $sql1) and mysqli_query($connect, $sql3)) or die(mysqli_error($connect));
//        $fileprocess = move_uploaded_file($_FILES['image']['tmp_name'], $pro_img);
        if ($result1) {
                echo "<script>alert('Product Updated Successfully')</script>";
            } else {
                echo "<script>alert('ERROR !!!')</script>";
            }
//    }
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
					<h2 class="title1">Product</h2>
					<div class=" form-grids row form-grids-right">
						<div class="widget-shadow " data-example-id="basic-forms"> 
							<div class="form-title">
								<h4>Edit Product</h4>
							</div>
							<div class="form-body">
                                                            <form class="form-horizontal" method="post" enctype="multipart/form-data" id="form"> 
                                                                    <div class="form-group"> 
                                                                        <label for="inputEmail3" class="col-sm-2 control-label">Product ID</label> 
                                                                        <div class="col-sm-9"> 
                                                                            <input readonly="text" class="form-control" value="<?php echo $productrow['pro_id'] ?>" required> 
                                                                        </div> 
                                                                        <br><br><label for="inputEmail3" style="margin-top: 15px" class="col-sm-2 control-label">Product Name</label> 
                                                                        <div class="col-sm-9"> 
                                                                            <input type="text" style="margin-top: 15px" class="form-control" name="pro_name" value="<?php echo $productrow['pro_name'] ?>" placeholder="Enter Product Name" required> 
                                                                        </div>
                                                                        <br><br><br><label class="col-sm-2 control-label">Image</label> 
                                                                        <div class="col-sm-9"> 
                                                                            <input type="text" class="form-control"  name="pro_img" value="<?php echo $img1['img_path'] ?>" placeholder="Enter Image Id" required readonly><br>
<!--                                                                              <input style="margin-bottom: 20px" type="file" class="form-control" name="image" accept="image/*"> -->
                                                                        </div>
                                                                        <br><br><label class="col-sm-2 control-label">Category Name</label> 
                                                                        <div class="col-sm-9"> 
                                                                           <select name='pro_cat' class='form-control'  required>
                                                                            <?php
                                                                                    $select1 = mysqli_query($connect, "select * from category_mst") or die(mysqli_error($connect));
                                                                                    echo "<option selected value='{$cat_name1['cat_id']}'>{$cat_name1['cat_name']}</option>";
                                                                                    echo "<option disabled></option>";
                                                                                    while($row = mysqli_fetch_array($select1))
                                                                                    {
                                                                                        echo "<option value='{$row['cat_id']}'>{$row['cat_name']}</option>";
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                                    <br>
                                                                        </div>
                                                                       <br><br><label class="col-sm-2 control-label">Product Type</label> 
                                                                        <div class="col-sm-9"> 
                                                                           <?php
                                                                                echo "<select class='form-control' name='pro_type' required>";
                                                                            echo "<option selected value='{$product['pro_type']}'>{$product['pro_type']}</option>";
                                                                                 echo "<option disabled></option>";
                                                                                   echo "<option value='Capsule'>Capsule</option>";
                                                 echo   "<option value='Capsule'>Cream</option>";
                                                  echo   "  <option value='Gel'>Gel</option>";
                                                   echo   " <option value='Liquid'>Liquid</option>";
                                                    echo   "<option value='Powder'>Powder</option>";
                                                    echo   "<option value='Tablet'>Tablet</option> ";
                                                    echo   "<option value='Spray'>Spray</option> ";
                                                    echo   "<option value='Others'>Others</option>";
                                                                         echo "</select>";
                                                                                     echo "<br>";
                                                                                    ?>
                                                                        </div>
                                                                       <br><br><label class="col-sm-2 control-label">Supplier Name</label> 
                                                                        <div class="col-sm-9"> 
                                                                            <?php
                                                                                echo "<select class='form-control' name='supplier' required>";
                                                                                 echo "<option selected value='{$supp_name1['user_id']}'>{$supp_name1['s_name']}</option>";
                                                                                 echo "<option disabled></option>";
                                                                                 $select = mysqli_query($connect, "select * from user_mst where usertype_id=2") or die(mysqli_error($connect));
                                                                                    while($row = mysqli_fetch_array($select))
                                                                                    {
                                                                                        echo "<option value='{$row['user_id']}'>{$row['s_name']}</option>";
                                                                                    }
                                                                                    echo "</select>";
                                                                                     echo "<br>";
                                                                                    ?>
                                                                        </div>
                                                                       
                                                                       
                                                                       <br><br><label for="inputEmail3" class="col-sm-2 control-label">Product Price</label> 
                                                                        <div class="col-sm-9"> 
                                                                            <input type="text" class="form-control" name="pro_price" value="<?php echo $productrow['price'] ?>" placeholder="Enter Product Price"  onkeyup="Validate(this)"> <br>
                                                                        </div> 
                                                                       <br><br><label for="inputEmail3" class="col-sm-2 control-label">Product Quantity</label> 
                                                                        <div class="col-sm-9"> 
                                                                            <input type="text" class="form-control" name="pro_qty" value="<?php echo $productrow['qty'] ?>" placeholder="Enter Product Quantity"  onkeyup="Validate(this)"> <br>
                                                                        </div>
                                                                        <br><br> <label for="inputEmail3" class="col-sm-2 control-label">Product Expiry Date</label> 
                                            <div class="col-sm-9"> 
                                                <input type="date" class="form-control" value="<?php echo $productrow['exp_date'] ?>" name="pro_exp_date" placeholder="Enter Product Expiry Date"> 
                                            </div> 
                                                                        <br><br><label for="inputEmail3" style="margin-top: 20px" class="col-sm-2 control-label">Net Content</label> 
                                                                        <div class="col-sm-9"> 
                                                                            <input type="text" style="margin-top: 20px" class="form-control" name="pro_net" value="<?php echo $product['net_content'] ?>" placeholder="Enter Net Content"> <br>
                                                                        </div> 
                                                                        <label for="inputEmail3" class="col-sm-2 control-label">Composition</label> 
                                                                        <div class="col-sm-9"> 
                                                                            <input type="text" class="form-control" name="pro_comp" value="<?php echo $product['composition'] ?>" placeholder="Enter composition"> <br>
                                                                        </div> 
                                                                    </div> 
                           
                                                                    <div class="form-group"> 
                                                                        <div class="col-sm-offset-2 col-sm-10"> </div>
                                                                    </div> 
                                                                    <div class="col-sm-offset-2"> 
                                                                                <button type="submit" class="btn btn-success" name="submit">Edit</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                        pro_price: "required",
                        pro_qty: "required",
                    },
                    messages: {

                        pro_name: {
                            required: "Please Enter Product Name",
                            minlength: "Product name must consist of at least 3 characters"
                        },
                        pro_price: "Please enter price",
                        pro_qty: "Please enter qauntity ",
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
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			
			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<!-- //Classie --><!-- //for toggle left push menu script -->
	
	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	
	<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.js"> </script>
   
</body>
</html>