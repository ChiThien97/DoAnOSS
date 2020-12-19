<?php 
  include('admin/includes/autoload.php');
  //session_start();
  error_reporting(0);
  // include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Báo Đây! Trang tìm kiếm</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/main-style.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
   <?php include('includes/header.php');?>

    <!-- Page Content -->
    <div id="wrap" class="container">
      <div class="row" style="margin-top: 4%">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

          <!-- Blog Post -->
          <?php 
              if($_POST['searchtitle']!='')
              {
                $st=$_SESSION['searchtitle']=$_POST['searchtitle'];
                $st=clean_sql_injection($st); 
                $temp = explode(" ",$st);
              }
              
              if (isset($_GET['pageno'])) 
              {
                $pageno = $_GET['pageno'];
              } 
              else 
              {
                $pageno = 1;
              }
              $no_of_records_per_page = 8;
              $offset = ($pageno-1) * $no_of_records_per_page;

              $total_pages_sql = "SELECT COUNT(*) FROM tbl_baiviet";
              $result = $db->fetchsql($total_pages_sql);
              $total_rows= $result[0]['COUNT(*)']; 
              $total_pages = ceil($total_rows / $no_of_records_per_page);
              //Code tìm đúng nhất
              //$exaclyQuery="SELECT tbl_baiviet.idbaiviet as pid,tbl_baiviet.tieude as posttitle,tbl_danhmuc.tenCate as category,tbl_danhmuccon.tenSubcate as subcategory,tbl_baiviet.noidung as postdetails,tbl_baiviet.ngaytao as postingdate,tbl_baiviet.Url as url from tbl_baiviet left join tbl_danhmuc on tbl_danhmuc.idCate=tbl_baiviet.idCate left join  tbl_danhmuccon on  tbl_danhmuccon.idSubCate=tbl_baiviet.idSubCate where  tbl_baiviet.tieude like '%$st%'";
              $query="SELECT tbl_baiviet.idbaiviet as pid,tbl_baiviet.tieude as posttitle,tbl_danhmuc.tenCate as category,tbl_danhmuccon.tenSubcate as subcategory,tbl_baiviet.noidung as postdetails,tbl_baiviet.ngaytao as postingdate,tbl_baiviet.Url as url from tbl_baiviet left join tbl_danhmuc on tbl_danhmuc.idCate=tbl_baiviet.idCate left join  tbl_danhmuccon on  tbl_danhmuccon.idSubCate=tbl_baiviet.idSubCate
              WHERE MATCH(tbl_baiviet.tieude) AGAINST('$st')";
              $search=$db->fetchSql($query);
              $rowcount=count($search);
              if($rowcount==0)
              {    
                $exQuery="SELECT tbl_baiviet.idbaiviet as pid,tbl_baiviet.tieude as posttitle,tbl_danhmuc.tenCate as category,tbl_danhmuccon.tenSubcate as subcategory,tbl_baiviet.noidung as postdetails,tbl_baiviet.ngaytao as postingdate,tbl_baiviet.Url as url from tbl_baiviet left join tbl_danhmuc on tbl_danhmuc.idCate=tbl_baiviet.idCate left join  tbl_danhmuccon on  tbl_danhmuccon.idSubCate=tbl_baiviet.idSubCate where  tbl_baiviet.tieude like '%$st%'";
                $exSearch=$db->fetchSql($exQuery);
                $exrowcount=count($exSearch);
                if($exrowcount==0){
                  echo "No record found";
                }
                else {
                  //while ($row=mysqli_fetch_array($query)) 
                  ?>
                  <p>Có <?php echo $exrowcount ?> kết quả tìm kiếm</p>
                  <?php
                  foreach($exSearch as $row)
                  {
                  ?>
                  <div class="card mb-4">
                    <div class="card-body">
                      
                      <h2 class="card-title"><?php echo htmlentities($row['posttitle']);?> <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>" class="btn"><i>Xem chi tiết &rarr;</i></a></h2>
                    </div>
                    <div class="text-muted">
                      Đăng vào <?php echo htmlentities($row['postingdate']);?>
                    </div>
                  </div>
                  <?php } ?>
  
                  <ul class="pagination justify-content-center mb-4">
                      <li class="page-item"><a href="?pageno=1"  class="page-link">First</a></li>
                      <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?> page-item">
                          <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" class="page-link">Prev</a>
                      </li>
                      <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?> page-item">
                          <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?> " class="page-link">Next</a>
                      </li>
                      <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
                  </ul>
                <?php }
              }
              else {
                //while ($row=mysqli_fetch_array($query)) 
                ?>
                <p>Có <?php echo $rowcount ?> kết quả tìm kiếm</p>
                <?php
                foreach($search as $row)
                {
                ?>
                <div class="card mb-4">
                  <div class="card-body">
                    
                    <h2 class="card-title"><?php echo htmlentities($row['posttitle']);?> <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>" class="btn"><i>Xem chi tiết &rarr;</i></a></h2>
                  </div>
                  <div class="text-muted">
                    Đăng vào <?php echo htmlentities($row['postingdate']);?>
                  </div>
                </div>
                <?php } ?>

                <ul class="pagination justify-content-center mb-4">
                    <li class="page-item"><a href="?pageno=1"  class="page-link">First</a></li>
                    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?> page-item">
                        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" class="page-link">Prev</a>
                    </li>
                    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?> page-item">
                        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?> " class="page-link">Next</a>
                    </li>
                    <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
                </ul>
              <?php } ?>
              <!-- Pagination -->
        </div>
          <!-- Sidebar Widgets Column -->
          <?php include('includes/sidebar.php');?>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->

          <!-- Footer -->
            <?php include('includes/footer.php');?>
          <!-- Bootstrap core JavaScript -->
          <script src="vendor/jquery/jquery.min.js"></script>
          <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

      </head>
  </body>

</html>
