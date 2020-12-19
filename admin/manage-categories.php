<?php
//session_start();
include('includes/autoload.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
{ 
    header('location:index.php');
}
else{
if($_GET['action']=='del' && $_GET['rid'])
{
	$id=intval($_GET['rid']);
    $delQuery = $db->fetchsql("UPDATE tbl_danhmuc SET trangThai = 0 WHERE idCate ='$id' ");
    $msg="Xóa danh mục thành công !!!";
}
// Code for restore
if($_GET['resid'])
{
	$id=intval($_GET['resid']);
    $restoreQuery = $db->fetchsql("UPDATE tbl_danhmuc SET trangThai = 1 WHERE idCate ='$id' ");
    $msg="Khôi phục danh mục thành công !!!";
}

// Code for Forever deletionparmdel
if($_GET['action']=='parmdel' && $_GET['rid'])
{
	$id=intval($_GET['rid']);
    $delQuery= $db->delete('tbl_danhmuc','idCate',$id);
    if($delQuery==-1){
        $delmsg = "Không thành công!!!";
    }else{
        $msg="Đã xóa vĩnh viễn danh mục !!!!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Báo đây | Manage Categories</title>
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
                                    <h4 class="page-title">Manage Categories</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Admin</a>
                                        </li>
                                        <li>
                                            <a href="#">Category </a>
                                        </li>
                                        <li class="active">
                                           Manage Categories
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

                                <?php if($delmsg){ ?>
                                <div class="alert alert-danger" role="alert">
                                    <strong>Không hoàn thành!</strong> <?php echo htmlentities($delmsg);?>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="row">
								<div class="col-md-12">
									<div class="demo-box m-t-20">
                                        <div class="m-b-30">
                                            <a href="add-category.php">
                                            <button id="addToTable" class="btn btn-success waves-effect waves-light">Add Category<i class="mdi mdi-plus-circle-outline" ></i></button>
                                            </a>
                                        </div>
										<div class="table-responsive">
                                            <table class="table m-0 table-colored-bordered table-bordered-primary" > 
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Category</th>
                                                        <th>Description</th>
                                                        <th>Posting Date</th>
                                                        <th>Last updation Date</th>
                                                        <th>Admin</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>                
                                                <tbody>
                                                    <?php 
                                                    $querySel = "AdminUserName, idCate, tenCate, moTaCate, tbl_danhmuc.ngayTao ngTao, tbl_danhmuc.ngaySua ngSua";
                                                    $listCategory = $db->fetchsql("SELECT {$querySel} FROM tbl_danhmuc JOIN tbl_admin ON tbl_admin.idAdmin = tbl_danhmuc.idAdmin WHERE tbl_danhmuc.trangThai = 1");
                                                    $cnt=1;
                                                    $rowcount = count($listCategory);
                                                    if($rowcount==0){
                                                        ?>
                                                        <tr>
                                                            <td colspan="7" align="center"><h3 style="color:red">No record found</h3></td>
                                                        </tr>
                                                        <?php 
                                                    }else{
                                                        foreach($listCategory as $values){
                                                            ?>
                                                            <tr>
                                                                <th scope="row"><?php echo htmlentities($cnt);?></th>
                                                                <td><?php echo htmlentities($values['tenCate']);?></td>
                                                                <td><?php echo htmlentities($values['moTaCate']);?></td>
                                                                <td><?php echo htmlentities($values['ngTao']);?></td>
                                                                <td><?php echo htmlentities($values['ngSua']);?></td>
                                                                <td><?php echo htmlentities($values['AdminUserName']); ?></td>
                                                                <td>
                                                                <a href="edit-category.php?cid=<?php echo htmlentities($values['idCate']);?>"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a> 
                                                                &nbsp;<a href="manage-categories.php?rid=<?php echo htmlentities($values['idCate']);?>&&action=del" onclick="return confirm('Do you really want to delete ?')"> <button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            $cnt++;
                                                    }}?>
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
                                            <h4><i class="fa fa-trash-o" ></i> Deleted Categories</h4>
                                        </div>

                                        <div class="table-responsive">
                                        <table class="table m-0 table-colored-bordered table-bordered-danger">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Category</th>
                                                    <th>Description</th>
                                                    <th>Posting Date</th>
                                                    <th>Last updation Date</th>
                                                    <th>Admin</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php 

                                                    $listCategory = $db->fetchsql("SELECT {$querySel} FROM tbl_danhmuc JOIN tbl_admin ON tbl_admin.idAdmin = tbl_danhmuc.idAdmin WHERE tbl_danhmuc.trangThai = 0");

                                                    $cnt=1;
                                                    $rowcount = count($listCategory);
                                                    if($rowcount==0){
                                                        ?>
                                                        <tr>
                                                            <td colspan="7" align="center"><h3 style="color:red">Không có danh mục nào bị xóa !!!</h3></td>
                                                        </tr>
                                                        <?php 
                                                    }else{
                                                        foreach($listCategory as $values){
                                                            ?>
                                                            <tr>
                                                                <th scope="row"><?php echo htmlentities($cnt);?></th>
                                                                <td><?php echo htmlentities($values['tenCate']);?></td>
                                                                <td><?php echo htmlentities($values['moTaCate']);?></td>
                                                                <td><?php echo htmlentities($values['ngTao']);?></td>
                                                                <td><?php echo htmlentities($values['ngSua']);?></td>
                                                                <td><?php echo htmlentities($values['AdminUserName']); ?></td>
                                                                <td>
                                                                <a href="manage-categories.php?resid=<?php echo htmlentities($values['idCate']);?>"><button class="btn btn-primary"><i class="fas fa-trash-restore"></i></button></a> 
                                                                &nbsp;<a href="manage-categories.php?rid=<?php echo htmlentities($values['idCate']);?>&&action=parmdel" onclick="return confirm('Do you really want to delete ?')"> <button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            $cnt++;
                                                    }}?>
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