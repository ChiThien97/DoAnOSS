<?php
//session_start();
//include('includes/autoload.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
{ 
    header('location:index.php');
}
else{
    $admin = $_SESSION['login'];
    ?>
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <!-- <a href="dashboard.php" class="logo"><span>NEWS<span>PORTAL</span></span><i class="mdi mdi-layers"></i></a> -->
                    <!-- Image logo -->
                    <a href="dashboard.php" class="logo">
                        <span>
                            <img src="assets/images/logo.png" alt="" height="60">
                        </span>
                        <i>
                            <img src="assets/images/favicon.ico" alt="" height="28">
                        </i>
                    </a>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">

                        <!-- Navbar-left -->
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <button class="button-menu-mobile open-left waves-effect">
                                    <i class="fas fa-bars"></i>
                                </button>
                            </li>
                     
                    
                        </ul>

                        <!-- Right(Notification) -->
                        <ul class="nav navbar-nav navbar-right">

                            <li class="dropdown user-box">
                                <a href="" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown" aria-expanded="true">
                                    <!-- <img src="assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle user-img"> -->
                                        <div class="img-circle user-img" style="width: 35px; height: 35px; border: 4px solid;
                                                    font-size: 25px;font-weight: bold;display: flex;
                                                    justify-content: center;align-items: center;border-radius: 50%;
                                                    text-transform: uppercase;">
                                        <?php $str = $admin;
                                        $str = substr( $str, 0, 1 );
                                        echo $str;
                                        ?>
                                    </div>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                                    <li>
                                        <h5>Hi, <?php echo $admin ?> </h5>
                                    </li>
                              
                                    <li><a href="change-password.php"><i class="ti-settings m-r-5"></i> Change Password</a></li>
                           
                                    <li><a href="logout.php"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                                </ul>
                            </li>

                        </ul> <!-- end navbar-right -->

                    </div><!-- end container -->
                </div><!-- end navbar -->
            </div>
<?php } ?>