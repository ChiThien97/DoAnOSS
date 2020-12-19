<?php
//session_start();
include('includes/autoload.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
{ 
    header('location:index.php');
}
else
{
    //Kiểm tra có phải SuperAdmin không?
    $curAdmin = $_SESSION['login'];
    $roles=$db->fetchOne("tbl_admin"," AdminUserName = '".$curAdmin."' ");
    
    if($roles['Roles']!="Super Admin"){
        echo "<script>alert('bạn không phải Super Admin, hãy quay lại !!'); </script>";
        header('location:dashboard.php');
    }

    
    //Submit
    if($_GET['action']=='del' && $_GET['adid'])
    {
        $id=intval($_GET['adid']);
        $delQuery = $db->fetchsql("UPDATE tbl_admin SET trangThai = 0 WHERE idAdmin ='$id' ");
        $msg="Xóa Admin thành công !!!";
    }
    // Code for restore
    if($_GET['readid'])
    {
        $id=intval($_GET['readid']);
        $restoreQuery = $db->fetchsql("UPDATE tbl_admin SET trangThai = 1 WHERE idAdmin ='$id' ");
        $msg="Khôi phục Admin thành công !!!";
    }

    // Code for Forever deletionparmdel
    if($_GET['action']=='perdel' && $_GET['adid'])
    {
        $id=intval($_GET['adid']);
        $delQuery= $db->delete('tbl_admin','idAdmin',$id);
        $msg="Đã xóa vĩnh viễn Admin !!!!";
    }

    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <title> Báo Đây | Manage Admin</title>
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

                <!-- ========== Left Sidebar Start ========== -->
                <?php include('includes/leftsidebar.php');?>
                <!-- Left Sidebar End -->
                <!-- ============================================================== -->
                <!-- Start right Content here -->
                <!-- ============================================================== -->
                <div class="content-page">
                    <!-- Start content -->
                    <div class="content">
                        <div class="container">


                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="page-title-box">
                                        <h4 class="page-title">Manage Admin</h4>
                                        <ol class="breadcrumb p-0 m-0">
                                            <li>
                                                <a href="#">Admin</a>
                                            </li>
                                            <li>
                                                <a href="#">Admin </a>
                                            </li>
                                            <li class="active">
                                            Manage Admin
                                            </li>
                                        </ol>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->


                            <div class="row">
                                <div class="col-sm-6">  
                                
                                <?php if($msg){ ?>
                                <div class="alert alert-success" role="alert">
                                    <strong>Hoàn thành!</strong> <?php echo htmlentities($msg);?>
                                </div>
                                <?php } ?>

                                <?php if($err){ ?>
                                <div class="alert alert-danger" role="alert">
                                    <strong>Không hoàn thành!</strong> <?php echo htmlentities($err);?>
                                </div>
                                <?php } ?>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="demo-box m-t-20">
                                        <div class="m-b-30">
                                            <a href="add-admin.php">
                                                <button id="addToTable" class="btn btn-success waves-effect waves-light">Add <i class="fas fa-plus-circle"></i></button>
                                            </a>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table m-0 table-colored-bordered table-bordered-primary">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Admin</th>
                                                        <th>Email</th>
                                                        <th>Creation Date</th>
                                                        <th>Last Updation Date</th>
                                                        <th>Roles</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    //$query=mysqli_query($con,"Select id as adminid,tbladmin.AdminUserName as adusr,tbladmin.AdminEmailId as adml,tbladmin.CreationDate as adcredate,tbladmin.UpdationDate as adupdate,tbladmin.Roles as adrole from tbladmin where tbladmin.Is_Active=1");
                                                    $listAdmin = $db->fetchsql('SELECT * FROM tbl_admin WHERE trangThai = 1');

                                                    $cnt=1;
                                                    $rowcount=count($listAdmin);
                                                    if($rowcount==0)
                                                    {
                                                        ?>
                                                        <tr>
                                                            <td colspan="7" align="center"><h3 style="color:red">No record found</h3></td>
                                                        </tr>
                                                        <?php 
                                                    } 
                                                    else 
                                                    {
                                                        foreach($listAdmin as $values){
                                                            ?>
                                                            <tr>
                                                                <th scope="row"><?php echo htmlentities($cnt);?></th>
                                                                <td><?php echo htmlentities($values['AdminUserName']);?></td>
                                                                <td><?php echo htmlentities($values['AdminEmail']);?></td>
                                                                <td><?php echo htmlentities($values['ngayTao']);?></td>
                                                                <td><?php echo htmlentities($values['ngaySua']);?></td>
                                                                <td><?php echo htmlentities($values['Roles']);?></td>
                                                                <td><a href="edit-admin.php?adid=<?php echo htmlentities($values['idAdmin']);?>"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a> 
                                                                    &nbsp;<a href="manage-admin.php?adid=<?php echo htmlentities($values['idAdmin']);?>&&action=del" onclick="return confirm('Do you really want to delete ?')"> <button class="btn btn-danger"><i class="fas fa-trash"></i></button></a> 
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            $cnt++;
                                                    }} ?>
                                                </tbody>
                                                    
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--- end row -->
       
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="demo-box m-t-20">
                                        <div class="m-b-30">
                                            <h4><i class="fa fa-trash-o" ></i> Deleted Admin</h4>
                                        </div>

                                        <div class="table-responsive">
                                        <table class="table m-0 table-colored-bordered table-bordered-danger">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Admin</th>
                                                        <th>Email</th>
                                                        <th>Creation Date</th>
                                                        <th>Last Updation Date</th>
                                                        <th>Roles</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    //$query=mysqli_query($con,"Select id as adminid,tbladmin.AdminUserName as adusr,tbladmin.AdminEmailId as adml,tbladmin.CreationDate as adcredate,tbladmin.UpdationDate as adupdate,tbladmin.Roles as adrole from tbladmin where tbladmin.Is_Active=1");
                                                    $listAdmin = $db->fetchsql('SELECT * FROM tbl_admin WHERE trangThai = 0');
                                                    // echo "<pre>";
                                                    // print_r($listAdmin);
                                                    // exit();

                                                    $cnt=1;
                                                    $rowcount=count($listAdmin);
                                                    if($rowcount==0)
                                                    {
                                                        ?>
                                                        <tr>
                                                            <td colspan="7" align="center"><h3 style="color:red">No record found</h3></td>
                                                        </tr>
                                                        <?php 
                                                    } 
                                                    else 
                                                    {
                                                        foreach($listAdmin as $values){
                                                            ?>
                                                            <tr>
                                                                <th scope="row"><?php echo htmlentities($cnt);?></th>
                                                                <td><?php echo htmlentities($values['AdminUserName']);?></td>
                                                                <td><?php echo htmlentities($values['AdminEmail']);?></td>
                                                                <td><?php echo htmlentities($values['ngayTao']);?></td>
                                                                <td><?php echo htmlentities($values['ngaySua']);?></td>
                                                                <td><?php echo htmlentities($values['Roles']);?></td>
                                                            <td><a href="manage-admin.php?readid=<?php echo htmlentities($values['idAdmin']);?>"><button class="btn btn-primary" title="Restore Admin"><i class="fas fa-trash-restore"></i></button></a>
                                                            &nbsp;<a href="manage-admin.php?adid=<?php echo htmlentities($values['idAdmin']);?>&&action=perdel" onclick="return confirm('Do you really want to delete ?')"> <button class="btn btn-danger"><i class="fas fa-trash"></i></button></a> 
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            $cnt++;
                                                    }} ?>
                                                </tbody>
                                                    
                                            </table>
                                        
                                        </div>   
                                    </div>
                                </div>
                            </div>       
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