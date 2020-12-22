<?php
//session_start();
include('includes/autoload.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
{ 
    header('location:index.php');
}
else{
    if(isset($_POST['submitsubcat']))
    {
        $subcatid=intval($_GET['scid']);  
        $idAdmin = $_SESSION['idAdmin'];
        $data=[
            'idSubCate' => $subcatid,
            'idCate' => postInput('category'),
            'tenSubCate' => postInput('subcategory'),
            'moTaSubCate' => postinput('sucatdescription'),
            'idAdmin' => $idAdmin,
        ];

        $condition = ['idSubCate' => $subcatid];

        $editQuery = $db->update('tbl_danhmuccon',$data, $condition );
        
        if($editQuery)
        {
            $msg="Danh mục con đã được sửa thành công !!!";
        }
        else{
            $error="Hãy thử lại";    
        }  
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
        <head>

            <title>Báo Đây | Edit Sub Category</title>

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
                                        <h4 class="page-title">Add Sub-Category</h4>
                                        <ol class="breadcrumb p-0 m-0">
                                            <li>
                                                <a href="#">Admin</a>
                                            </li>
                                            <li>
                                                <a href="#">Category </a>
                                            </li>
                                            <li class="active">
                                                Add Sub-Category
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
                                        <h4 class="m-t-0 header-title"><b>Add Sub-Category </b></h4>
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
                                        //fetching Category details
                                        $subcatid=intval($_GET['scid']);
                                        $SelSubcate = $db->fetchID('tbl_danhmuccon JOIN tbl_danhmuc ON tbl_danhmuccon.idcate = tbl_danhmuc.idCate','idSubCate',$subcatid);
                                        ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form class="form-horizontal" name="category" method="post">
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Category</label>
                                                        <div class="col-md-10">
                                                            <select class="form-control" name="category" required>
                                                                <option value="<?php echo htmlentities($SelSubcate['idCate']);?>"><?php echo htmlentities($SelSubcate['tenCate']);?></option>
                                                                <?php
                                                                // Feching active categories
                                                                $ret=$db->fetchsql("SELECT idCate,tenCate FROM tbl_danhmuc where trangThai=1");
                                                                foreach($ret as $values)
                                                                {    
                                                                ?>
                                                                <option value="<?php echo htmlentities($values['idCate']);?>"><?php echo htmlentities($values['tenCate']);?></option>
                                                                <?php } ?>
                                                            </select> 
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Sub-Category</label>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control" value="<?php echo htmlentities($SelSubcate['tenSubCate']);?>" name="subcategory" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Sub-Category Description</label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" rows="5" name="sucatdescription" required><?php echo htmlentities($SelSubcate['moTaSubCate']);?></textarea>
                                                        </div>
                                                    </div>                                               

                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">&nbsp;</label>
                                                        <div class="col-md-10">
                                                            <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" name="submitsubcat">
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