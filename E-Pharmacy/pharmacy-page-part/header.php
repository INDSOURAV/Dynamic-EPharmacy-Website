<?php
$msg="";
require '../connect.php';
?>
<div class="header-most-top">
    <p>For A Healthy Life</p>
</div>
<!-- //top-header -->
<!-- header-bot-->
<div class="header-bot">
    <div class="header-bot_inner_wthreeinfo_header_mid">
        <!-- header-bot-->
        <div class="col-md-4 logo_agile">
            <h1>
                <a href="E-Pharmacy.php">
                    <span>E</span> Pharmacy

                    <img src="images\logo.png" alt=" ">
                </a>
            </h1>
        </div>
        <!-- header-bot -->
        <div class="col-md-8 header">
            <!-- header lists -->
            <ul>
                <li style="margin-right:20px;">
                    <a href="header_contact.php">
                        <span class="fa fa-phone" aria-hidden="true"></span>Contact</a>
                </li>
                <li style="margin-right:15px;">
                    <a href="my_order.php">
                        <span class="fa fa-shopping-bag" aria-hidden="true"></span> My Orders &nbsp;&nbsp;&nbsp;&nbsp;</a>
                </li>
                </li>
                <li class="dropdown profile_details_drop" style="border-right: 0px;">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                            <span class="fa fa-user" aria-hidden="true"></span>Hi, <?php echo $_SESSION['f_name']?></a>
                                                        <ul class="dropdown-menu drp-mnu">
                                                            <li style="border-right: 0px"> <a href="my_account.php"><i class="fa fa-user"></i> My Account</a> </li> <br>
                                                                <li style="border-right: 0px"> <a href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
							</ul>
						</li>
                                                 
                     <li style="border-right: 0px;">
                       
                            <span></span>
                    </li>
            </ul>
            <!-- //header lists -->
            <!-- search -->
            <div class="agileits_search">
                   <form action="E-Pharmacy.php" method="get">
                    <input name="Search" type="search" placeholder="Search Product Here..." required="">
                    <button type="submit" value="search" class="btn btn-default" aria-label="Left Align">
                        <span class="fa fa-search" aria-hidden="true"> </span>
                    </button>
                </form>
            </div>
            <!-- //search -->
            <!-- cart details -->
            <div class="top_nav_right">
                <div class="wthreecartaits wthreecartaits2 cart cart box_1">
                    
                    <a href="my_cart.php">
                        <img src="images/shopping-cart.png" style="width: 40px;height: 40px"></a>
                </div>
            </div>
            <!-- //cart details -->
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- navigation -->
<div class="ban-top">
    <div class="container">
        <div class="agileits-navi_search">
                      <select id="agileinfo-nav_search" name="category_name" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
<?php
$query = mysqli_query($connect, "SELECT * FROM category_mst") or die(mysqli_error($connect));

echo "<option disabled selected>All Category</option>";
while ($data = mysqli_fetch_array($query)) {
    echo "<option value='E-Pharmacy.php?catid={$data['cat_id']}'>{$data['cat_name']}</option>"; 
}
?>
                    </select>
        </div>
        <div class="top_nav_left">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
                                aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav menu__list">
                            <li class="">
                                <a class="nav-stylehead" href="E-pharmacy.php">Home
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="nav-stylehead">&nbsp;</a>
                            </li>
                           <?php
                                     $query1 = mysqli_query($connect, "select * from category_mst order by rand() limit 3");
                while($row1=mysqli_fetch_array($query1))
                {
               echo "<li class=''>";
                                 echo "<a href='E-Pharmacy.php?catid={$row1['cat_id']}' class='nav-stylehead'>{$row1['cat_name']}</a>";
                           echo "</li>";
                }
             ?>
                            <li class="">
                                <a class="nav-stylehead">&nbsp;</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- //navigation -->
<!-- banner -->