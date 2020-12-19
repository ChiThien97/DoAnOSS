<?php
include('includes/autoload.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
{ 
    header('location:index.php');
}
else{
    if( $_GET['disid'])
    {
        $id=intval($_GET['disid']);
        $idAdmin = $_SESSION['idAdmin'];
        $data = [
            "trangthai" => 0,
            "idAdmin" => $idAdmin,
        ];
        $condition = ['idcomment' => $id];
        $cmt_update = $db->update("tbl_binhluan",$data,$condition);
        $msg="Comment unapprove ";
    }
    // Code for restore
    if($_GET['appid'])
    {
        $id=intval($_GET['appid']);
        $idAdmin = $_SESSION['idAdmin'];
        $data = [
            "trangthai" => 1,
            "idAdmin" => $idAdmin,
        ];
        $condition = ['idcomment' => $id];
        $cmt_update = $db->update("tbl_binhluan",$data,$condition);
        $msg="Comment approved";
    }

    // Code for deletion
    if($_GET['action']=='del' && $_GET['rid'])
    {
        $id=intval($_GET['rid']);
        $delQuery= $db->delete('tbl_binhluan','idcomment',$id);
        $delmsg="Comment deleted forever";
    }

    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>

            <title> Báo Đây | Manage Categories</title>
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
                                        <h4 class="page-title">Manage Comments</h4>
                                        <ol class="breadcrumb p-0 m-0">
                                            <li>
                                                <a href="#">Admin</a>
                                            </li>
                                            <li>
                                                <a href="#">Comments </a>
                                            </li>
                                            <li class="active">
                                            Unapprove Comments
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
                                        <strong>Well done!</strong> <?php echo htmlentities($msg);?>
                                    </div>
                                    <?php } ?>

                                    <?php if($delmsg){ ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Oh snap!</strong> <?php echo htmlentities($delmsg);?>
                                    </div>
                                    <?php } ?>

                                </div>
                                    
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="demo-box m-t-20">
                                            <div class="m-b-30">
                                                <h4><i class="fas fa-comments"></i> Unapprove</h4>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table m-0 table-colored-bordered table-bordered-primary">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th> Name</th>
                                                            <th>Email Id</th>
                                                            <th width="200">Comment</th>
                                                            <th>Status</th>
                                                            <th>Post / News</th>
                                                            <th>Posting Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>        
                                                    <tbody>                 
                                                        <?php 
                                                        $list_cmt = $db->fetchSql("SELECT tbl_binhluan.idcomment, tbl_binhluan.username,tbl_binhluan.useremail,tbl_binhluan.ngaytao,tbl_binhluan.noidungbl,tbl_baiviet.idbaiviet as postid,tbl_baiviet.tieude from  tbl_binhluan join tbl_baiviet on tbl_baiviet.idbaiviet=tbl_binhluan.idbaiviet where tbl_binhluan.trangthai=0");
                                                        $cnt=1;
                                                        $rowcount = count($list_cmt);
                                                        if($rowcount==0){
                                                            ?>
                                                            <tr>
                                                                <td colspan="8" align="center"><h3 style="color:red">Không có bình luận nào chờ duyệt!!!</h3></td>
                                                            </tr>
                                                            <?php 
                                                        }else{
                                                            foreach($list_cmt as $values)
                                                            {
                                                            ?>
                                                            <tr>
                                                                <th scope="row"><?php echo htmlentities($cnt);?></th>
                                                                <td><?php echo htmlentities($values['username']);?></td>
                                                                <td><?php echo htmlentities($values['useremail']);?></td>
                                                                <td><?php echo htmlentities($values['noidungbl']);?></td>
                                                                <td>
                                                                    <?php $st=$values['trangthai'];
                                                                    if($st=='0'):
                                                                    echo "Approved";
                                                                    else:
                                                                    echo "Wating for approval";
                                                                    endif; 
                                                                    ?>
                                                                </td>
                                                                <td><a href="edit-post.php?pid=<?php echo htmlentities($values['idbaiviet']);?>"><?php echo htmlentities($values['tieude']);?></a> </td>
                                                                <td><?php echo htmlentities($values['ngaytao']);?></td>
                                                                <td>
                                                                        <a href="unapprove-comment.php?appid=<?php echo htmlentities($values['idcomment']);?>" title="Approve this comment"><button class="btn btn-primary"><i class="fas fa-check"></i></button></a>
                                                                    &nbsp;<a href="unapprove-comment.php?rid=<?php echo htmlentities($values['idcomment']);?>&&action=del" onclick="return confirm('Do you really want to delete ?')"> <button class="btn btn-danger"><i class="fas fa-trash"></i></button></a> 
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
                                                <h4><i class="fas fa-comments"></i> Approved</h4>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table m-0 table-colored-bordered table-bordered-success">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th> Name</th>
                                                            <th>Email Id</th>
                                                            <th width="200">Comment</th>
                                                            <th>Status</th>
                                                            <th>Post / News</th>
                                                            <th>Posting Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>        
                                                    <tbody>                 
                                                        <?php 
                                                        $list_cmt = $db->fetchSql("SELECT tbl_binhluan.idcomment, tbl_binhluan.username,tbl_binhluan.useremail,tbl_binhluan.ngaytao,tbl_binhluan.noidungbl,tbl_baiviet.idbaiviet as postid,tbl_baiviet.tieude from  tbl_binhluan join tbl_baiviet on tbl_baiviet.idbaiviet=tbl_binhluan.idbaiviet where tbl_binhluan.trangthai=1");
                                                        $cnt=1;
                                                        $rowcount = count($list_cmt);
                                                        if($rowcount==0){
                                                            ?>
                                                            <tr>
                                                                <td colspan="8" align="center"><h3 style="color:red">Không có bình luận nào được duyệt!!!</h3></td>
                                                            </tr>
                                                            <?php 
                                                        }else{
                                                            foreach($list_cmt as $values)
                                                            {
                                                            ?>

                                                            <tr>
                                                                <th scope="row"><?php echo htmlentities($cnt);?></th>
                                                                <td><?php echo htmlentities($values['username']);?></td>
                                                                <td><?php echo htmlentities($values['useremail']);?></td>
                                                                <td><?php echo htmlentities($values['noidungbl']);?></td>
                                                                <td>
                                                                    <?php $st=$values['trangthai'];
                                                                    if($st=='0'):
                                                                    echo "Approved";
                                                                    else:
                                                                    echo "Wating for approval";
                                                                    endif; 
                                                                    ?>
                                                                </td>
                                                                <td><a href="edit-post.php?pid=<?php echo htmlentities($values['idbaiviet']);?>"><?php echo htmlentities($values['tieude']);?></a> </td>
                                                                <td><?php echo htmlentities($values['ngaytao']);?></td>
                                                                <td><a href="unapprove-comment.php?disid=<?php echo htmlentities($values['idcomment']);?>" title="Unapprove this comment"><button class="btn btn-primary"><i class="fas fa-backspace"></i></button></a> 
                                                                    &nbsp;<a href="unapprove-comment.php?rid=<?php echo htmlentities($values['idcomment']);?>&&action=del" onclick="return confirm('Do you really want to delete ?')"> <button class="btn btn-danger"><i class="fas fa-trash"></i></button></a> 
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