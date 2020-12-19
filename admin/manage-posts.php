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

    if($_GET['action']='del')
    {
        $postid=intval($_GET['pid']);
        $delQuery = $db->fetchsql("UPDATE tbl_baiviet SET trangThai = 0 WHERE idBaiviet ='$postid' ");
        if($delQuery)
        {
            $msg="Đã xóa bài viết!";
        }
        else
        {
            $error="Hãy thử lại!";    
        } 
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
            <meta name="author" content="Coderthemes">

            <!-- App favicon -->
            <link rel="shortcut icon" href="assets/images/favicon.ico">
            <!-- App title -->
            <title>Báo Đây | Manage Posts</title>

            <!--Morris Chart CSS -->
            <link rel="stylesheet" href="../plugins/morris/morris.css">

            <!-- jvectormap -->
            <link href="../plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />

            <!-- App css -->
            <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">

            <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
            <![endif]-->

            <script src="assets/js/modernizr.min.js"></script>

        </head>


        <body class="fixed-left">

            <!-- Begin page -->
            <div id="wrapper">

                <!-- Top Bar Start -->
            <?php include('includes/topheader.php');?>

                <!-- ========== Left Sidebar Start ========== -->
            <?php include('includes/leftsidebar.php');?>


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
                                        <h4 class="page-title">Manage Posts </h4>
                                        <ol class="breadcrumb p-0 m-0">
                                            <li>
                                                <a href="#">Admin</a>
                                            </li>
                                            <li>
                                                <a href="#">Posts</a>
                                            </li>
                                            <li class="active">
                                                Manage Post  
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
                                        <div class="table-responsive">
                                            <table class="table table-colored table-centered table-inverse m-0">
                                                <thead>
                                                    <tr>                              
                                                        <th>Title</th>
                                                        <th>Category</th>
                                                        <th>Subcategory</th>
                                                        <th>Admin</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php


                                                    $query="tbl_baiviet.idBaiviet postid, tbl_baiviet.tieuDe title, tbl_danhmuc.tenCate category, tbl_danhmuccon.tenSubCate subcategory, tbl_admin.AdminUserName admin";
                                                    $selBaiviet = $db->fetchsql("SELECT {$query} FROM (tbl_baiviet LEFT JOIN tbl_danhmuc ON tbl_danhmuc.idCate=tbl_baiviet.idCate LEFT JOIN tbl_danhmuccon ON tbl_danhmuccon.idSubCate=tbl_baiviet.idSubCate) 
                                                    LEFT JOIN tbl_admin ON tbl_admin.idAdmin = tbl_baiviet.idAdmin WHERE tbl_baiviet.trangThai = 1");
                                                    $rowcount=count($selBaiviet);
                                                    if($rowcount==0)
                                                    {
                                                        ?>
                                                        <tr>
                                                            <td colspan="5" align="center"><h3 style="color:red">No record found</h3></td>
                                                        <tr>
                                                        <?php 
                                                    } 
                                                    else 
                                                    {
                                                        foreach($selBaiviet as $values)
                                                        {
                                                        ?>
                                                        <tr>
                                                        <td><b><?php echo htmlentities($values['title']);?></b></td>
                                                        <td><?php echo htmlentities($values['category'])?></td>
                                                        <td><?php echo htmlentities($values['subcategory'])?></td>
                                                        <td><?php echo htmlentities($values['admin'])?></td>

                                                        <td>
                                                            <a href="edit-post.php?pid=<?php echo htmlentities($values['postid']);?>"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a> 
                                                            &nbsp;<a href="manage-posts.php?pid=<?php echo htmlentities($values['postid']);?>&&action=del" onclick="return confirm('Do you reaaly want to delete ?')"> <button class="btn btn-danger"><i class="fas fa-trash"></i></button></a> 
                                                        </td>
                                                        </tr>
                                                        <?php } 
                                                    }?>
                                            
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


                <!-- ============================================================== -->
                <!-- End Right content here -->
                <!-- ============================================================== -->


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

            <!-- CounterUp  -->
            <script src="../plugins/waypoints/jquery.waypoints.min.js"></script>
            <script src="../plugins/counterup/jquery.counterup.min.js"></script>

            <!--Morris Chart-->
            <script src="../plugins/morris/morris.min.js"></script>
            <script src="../plugins/raphael/raphael-min.js"></script>

            <!-- Load page level scripts-->
            <script src="../plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
            <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
            <script src="../plugins/jvectormap/gdp-data.js"></script>
            <script src="../plugins/jvectormap/jquery-jvectormap-us-aea-en.js"></script>


            <!-- Dashboard Init js -->
            <script src="assets/pages/jquery.blog-dashboard.js"></script>

            <!-- App js -->
            <script src="assets/js/jquery.core.js"></script>
            <script src="assets/js/jquery.app.js"></script>

        </body>
    </html>
<?php } ?>