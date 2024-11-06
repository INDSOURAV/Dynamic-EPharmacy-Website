<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
include '../connect.php';
$email = '';
$pass = '';
if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $sql1="SELECT * FROM user_mst WHERE email='{$email}'";
$result1 = mysqli_query($connect, $sql1);
$count= mysqli_num_rows($result1);
if($count==0)
{
     echo "<script>alert('Entered Email id Not Registered')</script>"; 
}
else {
    
    $query = "SELECT * FROM user_mst WHERE email = '{$email}'";
    $result = mysqli_query($connect,$query);
    if($result)
    {
        $row = mysqli_fetch_assoc($result);
        $email1 = $row['email'];
        $pass = $row['password'];
        //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';     //changed                //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'e.pharmacy.xica@gmail.com';                     //SMTP username
    $mail->Password   = 'tiwariinfotech';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('e.pharmacy.xica@gmail.com', 'E-pharmacy');
    $mail->addAddress("$email1", 'E-pharmacy');     //Add a recipient
 

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'E-Pharmacy';
    $mail->Body    = "<h3>Forget Password</h3><br>Your Password is <b>$pass<b>";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo "<script>alert('Email Sent');
    window.location.href = 'sign_in.php';
    </script>";
} catch (Exception $e) {
    echo "<script>alert('Email could not be sent. Error: {$mail->ErrorInfo}')</script>";
}
    }
}
}
?>
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
                <a href="#">
                    <span>E</span> Pharmacy

                    <img src="images\logo.png" alt=" ">
                </a>
            </h1>
        </div>
<br/><br/><br/><br/><br/><br/>
<div class="modal-dialog">
                <div class="modal-body modal-body-sub_agile">
                    <div class="modal_body_left modal_body_left1">
                        <h3 class="agileinfo_sign" style="margin-bottom: 50px;">Forget Password</h3>
                        <p>
                            <b>Please Enter your E-mail and submit to get your password.</b>
                        </p>
                     
                        <form method="post" enctype="multipart/form-data" id="form">
                             <div class="styled-input agile-styled-input-top" >
                                 <input style="padding-left: 5px;color :black; margin-bottom: 0px;" type="email" placeholder="Email Address" name="email" >
                             </div><br>
                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="sign_in.php"><font color="red">Return to Sign-in</font></a>
                        <input type="submit" name="submit" value="Submit">

                        </form>
                    </div>
                </div>
            </div>
            <script>

     
		$("#form").validate({
			rules: {
				email: {
					required: true,
                                        email: true
				}
			},
                        messages: {
                                required: "Please Enter Email Address",
             }
		});
     </script>
        </body>
    </html>