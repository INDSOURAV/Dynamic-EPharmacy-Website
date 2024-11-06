<?php
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
            <ul>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <li>
                    <span class="fa fa-phone" aria-hidden="true"></span> XXXXXXXXXX
                </li>
                <li>
                    <a href="sign_in.php">
                        <span class="fa fa-unlock-alt" aria-hidden="true"></span> Sign In </a>
                </li>
                <li style="border-right: 0px">
                    <a href="sign_up.php">
                        <span class="fa fa-pencil-square-o" aria-hidden="true"></span> Sign Up </a>
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
                                <a class="nav-stylehead" href="E-pharmacy.php">Home</a>
                            </li>
                            <li class="">
                                <a class="nav-stylehead">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                            </li>
                            <li class="">
                                <a class="nav-stylehead" href="header_about.php">About Us</a>
                            </li>
                            <li class="">
                                <a class="nav-stylehead">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                            </li>
                            <li class="">
                                <a class="nav-stylehead" href="header_faqs.php">Faqs</a>
                            </li>
                            <li class="">
                                <a class="nav-stylehead">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                            </li>
                            <li class="">
                                <a class="nav-stylehead" href="header_contact_home.php">Contact</a>
                            </li>
                            <li class="">
                                <a class="nav-stylehead"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
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