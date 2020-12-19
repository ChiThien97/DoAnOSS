<?php
//session_start();
include('includes/autoload.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
{ 
    header('location:index.php');
}
else{
    //Kiểm tra có phải SuperAdmin không?
    $curAdmin = $_SESSION['login'];
    $roles=$db->fetchOne("tbl_admin"," AdminUserName = '".$curAdmin."' ");
    
    if($roles['Roles']!="Super Admin"){
        echo "<script>alert('bạn không phải Super Admin, hãy quay lại !!'); </script>";
        header('location:dashboard.php');
    }


    if(isset($_POST['role']))
    {
        
        $adid=intval($_GET['adid']);    
        $data = [
            'idAdmin' => $adid,
            'AdminUserName' => postInput('adminname'),
            'AdminEmail' => postInput('adminemail'),
            'Roles' => postInput('role'),
        ];
        $condition = ['idAdmin' => $adid,];

        $editQuery = $db->update('tbl_admin',$data, $condition );

        if($editQuery)
        {
            $msg="Admin đã được sửa thành công !!!";
        }
        else
        {
            $error="Hãy thử lại !!!";    
        } 
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
        <head>

            <title>Báo Đây | Edit Admin</title>

            <!-- App css -->
            <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
            <script src="assets/js/modernizr.min.js"></script>

        </head>


        <body class="fixed-left">

            <!-- Begin page -->
            <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include('includes/topheader.php');?>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
                    <?php include('includes/leftsidebar.php');?>
            <!-- Left Sidebar End -->

                <div class="content-page">
                    <!-- Start content -->
                    <div class="content">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="page-title-box">
                                        <h4 class="page-title">Edit Admin</h4>
                                        <ol class="breadcrumb p-0 m-0">
                                            <li>
                                                <a href="#">Admin</a>
                                            </li>
                                            <li>
                                                <a href="manage-admin.php">Manage Admin </a>
                                            </li>
                                            <li class="active">
                                                Edit Admin
                                            </li>
                                        </ol>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <h4 class="m-t-0 header-title"><b>Edit Admin </b></h4>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-6">  
                                                <!---Success Message--->  
                                                <?php if($msg){ ?>
                                                <div class="alert alert-success" role="alert">
                                                    <strong>Hoàn thành!</strong> <?php echo htmlentities($msg);?>
                                                </div>
                                                <?php } ?>

                                                <!---Error Message--->
                                                <?php if($error){ ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>Không hoàn thành!</strong> <?php echo htmlentities($error);?>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <?php 
                                        //fetching Admin details
                                        $adid=intval($_GET['adid']);
                                        $SelAdmin = $db->fetchID("tbl_admin","idAdmin",$adid);

                                        ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form class="form-horizontal" name="editadmin" method="post">
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Admin Name</label>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control" value="<?php echo htmlentities($SelAdmin['AdminUserName']);?>" name="adminname" required>
                                                          
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Admin Email</label>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control"  value="<?php echo htmlentities($SelAdmin['AdminEmail']);?>"  name="adminemail"required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Roles</label>
                                                        <div class="col-md-10">
                                                            <select class="form-control" name="role" required>
                                                                <option value="<?php echo htmlentities($SelAdmin['Roles']);?>"><?php echo htmlentities($SelAdmin['Roles']);?></option>
                                                                <option value="Super Admin">Super Admin</option>
                                                                <option value="Writer Admin">Writer Admin</option>
                                                                <option value="Comment Admin">Comment Admin</option>
                                                            </select> 
                                                        </div>
                                                    </div>                                             

                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">&nbsp;</label>
                                                        <div class="col-md-10">
                                                            <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" name="submitadmin">
                                                                Update
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                        </div> <!-- container -->

                    </div> <!-- content -->

                    <?php include('includes/footer.php');?>

                </div>
            </div>
            <!-- END wrapper -->

            <script>
                var resizefunc = [];
            </script>

            <!-- jQuery  -->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>
            <script src="assets/js/detect.js"></script>
            <script src="assets/js/fastclick.js"></script>
            <script src="assets/js/jquery.blockUI.js"></script>
            <script src="assets/js/waves.js"></script>
            <script src="assets/js/jquery.slimscroll.js"></script>
            <script src="assets/js/jquery.scrollTo.min.js"></script>
            <script src="../plugins/switchery/switchery.min.js"></script>

            <!-- App js -->
            <script src="assets/js/jquery.core.js"></script>
            <script src="assets/js/jquery.app.js"></script>

        </body>
    </html>
<?php } ?>