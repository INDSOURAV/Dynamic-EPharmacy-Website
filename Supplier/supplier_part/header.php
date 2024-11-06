<div class="container"  style="background-color: #1accfd;width: 100%">
    <div class="header-bot">
        <div class="header-bot_inner_wthreeinfo_header_mid">
            <!-- header-bot-->
            <div class="col-md-4 logo_agile">
                <h1 style="padding-top:8px">
                    <a href="Supplier_Panel.php">
                        <span>E</span> Pharmacy <img src="images\logo.png">
                    </a>
                </h1>
            </div>
            <!-- header-bot -->
            <div class="col-md-8 header">
                <!-- header lists -->
                <ul>
                    <li>
                        <a href="Supplier_Panel.php">
                            <span class="fa fa-home"></span> Home </a>
                    </li>
                    <li>
                        <a href="header_contact.php">
                            <span class="fa fa-phone" aria-hidden="true"></span> Contact </a>
                    </li>
                     <li>
                        <a href="header_about.php">
                            <span class="fa fa-book" aria-hidden="true"></span> About Us </a>
                    </li>
                    <li class="dropdown profile_details_drop" style="border-right: 0px">
                        <a href="#" data-toggle="dropdown">
                            <span class="fa fa-user" aria-hidden="true"></span>Hi , <?php echo $_SESSION['s_name']?> </a>
                        <ul class="dropdown-menu drp-mnu">
                            <li style="border-right: 0px"> <a href="my_account.php"><i class="fa fa-user"></i> My Account</a> </li> <br>
                            <li style="border-right: 0px"> <a href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
                        </ul>
                    </li>
                     <li style="border-right: 0px;">
                            <span></span>
                    </li>
                     <li style="border-right: 0px; padding-top:20px">
                       
                            <span></span>
                    </li>
                   <li class="dropdown profile_details_drop">
                        <a href="#" data-toggle="dropdown">
                            <span class="fa fa-share-square" aria-hidden="true"></span> Order Requests &nbsp;</a>
                        <ul class="dropdown-menu drp-mnu">
                             <li style="border-right: 0px"> <a href="admin_request_details.php"><i class="fa fa-user"></i> From Admin </a> </li> <br>
                            <li style="border-right: 0px"> <a href="request_details.php"><i class="fa fa-info"></i> Request </a> </li> <br>
                            <li style="border-right: 0px"> <a href="new_request.php"><i class="fa fa-plus"></i> New Request </a> </li>
                        </ul>
                    </li>
                    <li class="dropdown profile_details_drop" style="border-right: 0px">
                        <a href="#" data-toggle="dropdown">
                            <span class="fa fa-shopping-bag" aria-hidden="true"></span> Orders &nbsp;</a>
                        <ul class="dropdown-menu drp-mnu">
                            <li style="border-right: 0px"> <a href="admin_order.php"><i class="fa fa-user"></i> From Admin </a> </li> <br>
                            <li style="border-right: 0px"> <a href="my_order.php"><i class="fa fa-info"></i> Orders (Supply Request) </a> </li>
                        </ul>
                    </li>
                </ul>
                <!-- //header lists -->
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>