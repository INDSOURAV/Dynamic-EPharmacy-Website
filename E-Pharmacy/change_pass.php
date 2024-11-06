<?php
require '../connect.php'; 
session_start();
$user_id=$_SESSION['id'];
if(!isset($_SESSION['id']))
{
header("location:sign_in.php");
}
$uid = $_GET['uid'];
if(isset($_POST['submit']))
{
$oldPass=$_POST["oldPass"];
$newPass=$_POST["newPass"];
if($oldPass==$newPass)
{
    echo "<script>alert('Old Password And New Password Should Not Be Same');
    </script>";
}
 else {
$query = "SELECT * FROM user_mst WHERE user_id='{$uid}' and password='{$oldPass}'";
$result = mysqli_query($connect,$query);
$count= mysqli_num_rows($result);
if($count==0)
{
     echo "<script>alert('Old Password Not Matched')</script>";
}
 else {
     $query1 = mysqli_query($connect, "UPDATE user_mst SET password = '{$newPass}' WHERE user_id='{$uid}'") or die(mysqli_error($connect));
     if($query1)
    {
        echo "<script>alert('Password Updated Succesfully');
    window.location.href = 'my_account.php';
    </script>";
    }
 }
 }
}
?>
<html lang="zxx">
    <!--
    Author: W3layouts
    Author URL: http://w3layouts.com
    License: Creative Commons Attribution 3.0 Unported
    License URL: http://creativecommons.org/licenses/by/3.0/
    -->
    <!DOCTYPE html>
    <html lang="zxx">

        <head>
            <title>E Pharmacy</title>
            <!--/tags -->
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="keywords" content="Grocery Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
                  Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
            <script>
                addEventListener("load", function () {
                    setTimeout(hideURLbar, 0);
                }, false);

                function hideURLbar() {
                    window.scrollTo(0, 1);
                }
            </script>
            <!--//tags -->
            <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
            <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
            <link href="css/font-awesome.css" rel="stylesheet">
            <!--pop-up-box-->
            <link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
            <!--//pop-up-box-->
            <!-- price range -->
            <link rel="stylesheet" type="text/css" href="css/jquery-ui1.css">
            <!-- fonts -->
            <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
            <script src="js/jquery-3.1.1.js"></script>    
	<script src="js/jquery.validate.js"></script>
    <style>
        .error{
            color:red;
        }
    </style>
        </head>

        <body>
            <script src="js/jquery-3.1.1.js"></script>    
<script src="js/jquery.validate.js"></script>
<br/><br/>
<div class="col-md-4 logo_agile">
            <h1>
                <a href="E-Pharmacy_home.php">
                    <span>E</span> Pharmacy

                    <img src="images\logo.png" alt=" ">
                </a>
            </h1>
        </div>
<br/><br/><br/><br/>
<div class="modal-dialog">
                <div class="modal-body modal-body-sub_agile">
                    <div class="modal_body_left modal_body_left1">
                        <h3 class="agileinfo_sign"  style="margin-bottom: 50px;">Change Your Password</h3>
                        <form method="post" enctype="multipart/form-data" id="form">
                             <div class="styled-input agile-styled-input-top" >
                                 <input style="padding-left: 5px;color :black; margin-bottom: 0px;" type="password" placeholder="Enter your Old Password" name="oldPass" id="p1">
                             </div><br>
                              <div class="styled-input agile-styled-input-top" >
                                 <input style="padding-left: 5px;color :black; margin-bottom: 0px;" type="password"  placeholder="Enter your New Password" name="newPass" id="p2">
                             </div><br>
                              <div class="styled-input agile-styled-input-top" >
                                 <input style="padding-left: 5px;color :black; margin-bottom: 0px;" type="password" placeholder="Confirm Password" name="conPass" id="p3">
                             </div><br>
                       <button class="submit check_out" name="submit">Update Password</button>
                        </form>
                    </div>
                </div>
            </div>
            <script>

     
		$("#form").validate({
			rules: {
				
                               oldPass: {
                                        required: true,
					minlength: 6
				},
				newPass: {
					required: true,
					minlength: 6,
				},
                                conPass: {
					required: true,
					minlength: 6,
					equalTo: "#p2"
				}
			},
                        messages: {
                           oldPass: {
					required: "Please Enter old Password",
					minlength: "Your password must be at least 6 characters long"
				},
				newPass: {
					required: "Please Enter new password",
					minlength: "Your password must be at least 6 characters long",
				},
                                conPass: {
					required: "Please confirm password",
					minlength: "Your password must be at least 6 characters long",
					equalTo: "Password mismatched, Enter same password as above"
				} 
	      
               }
		});
     </script> 
        </body>
    </html>

