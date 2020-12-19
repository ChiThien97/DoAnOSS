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
    if($_GET['action']=='del' && $_GET['scid'])
    {
        $id=intval($_GET['scid']);
        $delQuery = $db->fetchsql("UPDATE tbl_danhmuccon SET trangThai = 0 WHERE idSubCate ='$id' ");
        $msg="Xóa danh mục con thành công !!!";
    }
    // Code for restore
    if($_GET['resid'])
    {
        $id=intval($_GET['resid']);
        $restoreQuery = $db->fetchsql("UPDATE tbl_danhmuccon SET trangThai = 1 WHERE idSubCate ='$id' ");
        $msg="Khôi phục danh mục con thành công !!!";
    }

    // Code for Forever deletionparmdel
    if($_GET['action']=='perdel' && $_GET['scid'])
    {
        $id=intval($_GET['scid']);
        $delQuery= $db->delete('tbl_danhmuccon','idSubCate',$id);
        if($delQuery=-1){
            $delmsg = "Không thành công!!!";
        }else{
            $msg="Đã xóa vĩnh viễn danh mục con !!!!";        
        }
    }

    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <title> Báo Đây | Manage SubCategories</title>
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
                                        <h4 class="page-title">Manage SubCategories</h4>
                                        <ol class="breadcrumb p-0 m-0">
                                            <li>
                                                <a href="#">Admin</a>
                                            </li>
                                            <li>
                                                <a href="#">SubCategory </a>
                                            </li>
                                            <li class="active">
                                            Manage SubCategories
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
                                            <a href="add-subcategory.php">
                                                <button id="addToTable" class="btn btn-success waves-effect waves-light">Add <i class="mdi mdi-plus-circle-outline" ></i></button>
                                            </a>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table m-0 table-colored-bordered table-bordered-primary">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Category</th>
                                                        <th>Sub Category</th>
                                                        <th>Description</th>
                                                        <th>Posting Date</th>
                                                        <th>Last updation Date</th>
                                                        <th>Admin</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 

                                                    $querySel = "tenCate,AdminUserName, idSubCate, tenSubCate, moTaSubCate, tbl_danhmuccon.ngayTao ngTao, tbl_danhmuccon.ngaySua ngSua";

                                                    $listSubCategory = $db->fetchsql("SELECT {$querySel} FROM ((tbl_danhmuccon JOIN tbl_danhmuc ON tbl_danhmuccon.idCate = tbl_danhmuc.idCate) JOIN tbl_admin ON tbl_danhmuccon.idAdmin=tbl_admin.idAdmin)  WHERE tbl_danhmuccon.trangThai = 1");
                                                    $cnt=1;
                                                    // echo "<pre>" ; print_r($listSubCategory); exit();

                                                    $rowcount=count($listSubCategory);
                                                    if($rowcount==0)
                                                    {
                                                        ?>
                                                        <tr>
                                                            <td colspan="8" align="center"><h3 style="color:red">No record found</h3></td>
                                                        </tr>
                                                        <?php 
                                                    } 
                                                    else 
                                                    {
                                                        foreach($listSubCategory as $values)
                                                        {
                                                        ?>

                                                        <tr>
                                                            <th scope="row"><?php echo htmlentities($cnt);?></th>
                                                            <td><?php echo htmlentities($values['tenCate']);?></td>
                                                            <td><?php echo htmlentities($values['tenSubCate']);?></td>
                                                            <td><?php echo htmlentities($values['moTaSubCate']);?></td>
                                                            <td><?php echo htmlentities($values['ngTao']);?></td>
                                                            <td><?php echo htmlentities($values['ngSua']);?></td>
                                                            <td><?php echo htmlentities($values['AdminUserName']);?></td>
                                                            <td><a href="edit-subcategory.php?scid=<?php echo htmlentities($values['idSubCate']);?>"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a> 
                                                                &nbsp;<a href="manage-subcategories.php?scid=<?php echo htmlentities($values['idSubCate']);?>&&action=del" onclick="return confirm('Do you really want to delete ?')"> <button class="btn btn-danger"><i class="fas fa-trash"></i></button></a> 
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
                                            <h4><i class="fa fa-trash-o" ></i> Deleted SubCategories</h4>
                                        </div>

                                        <div class="table-responsive">
                                        <table class="table m-0 table-colored-bordered table-bordered-danger">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th> Category</th>
                                                    <th>Sub Category</th>
                                                    <th>Description</th>
                                                    <th>Posting Date</th>
                                                    <th>Last updation Date</th>
                                                    <th>Admin</th>
                                                    <th>Action</th>
                                               </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    
                                                    $listSubCategory = $db->fetchsql("SELECT {$querySel} FROM ((tbl_danhmuccon JOIN tbl_danhmuc ON tbl_danhmuccon.idCate = tbl_danhmuc.idCate) JOIN tbl_admin ON tbl_danhmuccon.idAdmin=tbl_admin.idAdmin)  WHERE tbl_danhmuccon.trangThai = 0");
                                                    $cnt=1;
                                                    
                                                    $rowcount=count($listSubCategory);
                                                    if($rowcount==0)
                                                    {
                                                        ?>
                                                        <tr>
                                                            <td colspan="8" align="center"><h3 style="color:red">Không có danh mục con bị xóa</h3></td>
                                                        </tr>
                                                        <?php 
                                                    } 
                                                    else 
                                                    {
                                                        foreach($listSubCategory as $values)
                                                        {
                                                        ?>

                                                        <tr>
                                                            <th scope="row"><?php echo htmlentities($cnt);?></th>
                                                            <td><?php echo htmlentities($values['tenCate']);?></td>
                                                            <td><?php echo htmlentities($values['tenSubCate']);?></td>
                                                            <td><?php echo htmlentities($values['moTaSubCate']);?></td>
                                                            <td><?php echo htmlentities($values['ngTao']);?></td>
                                                            <td><?php echo htmlentities($values['ngSua']);?></td>
                                                            <td><?php echo htmlentities($values['AdminUserName']);?></td>
                                                            <td><a href="manage-subcategories.php?resid=<?php echo htmlentities($values['idSubCate']);?>"><button class="btn btn-primary" title="Restore this SubCategory"><i class="fas fa-trash-restore"></i></button></a> 
                                                                &nbsp;<a href="manage-subcategories.php?scid=<?php echo htmlentities($values['idSubCate']);?>&&action=perdel" onclick="return confirm('Do you really want to delete ?')"> <button class="btn btn-danger"><i class="fas fa-trash"></i></button></a> 
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