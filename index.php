<?php 
//CODE HERE THIEN
?><?php 
//session_start();
include('admin/includes/autoload.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Báo Đây! Báo người Việt</title>
  <link rel="icon" href="http://news.baoday.tk/images/favicon.ico" sizes="32x32">
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/main-style.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
 <?php include('includes/header.php');?>

  <!-- Page Content -->
  <div class="container">
   
    <div class="row" style="margin-top: 4%">
      <!-- Blog Entries Column -->
      <div class="col-md-12" style="margin-bottom:10px !important; display: flex; justify-content:center;">
        <button class="btn btn-info">
          <a style="color:white !important;" target="_blank" href="https://github.com/ChiThien97/News.BaoDay.Tk.git">
            Link Repo Github: https://github.com/ChiThien97/News.BaoDay.Tk.git
          </a>
        </button>
      </div>
      <div class="col-md-8">
        <!-- Blog Post -->
        <?php 
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
        
        $query="SELECT tbl_baiviet.idBaiviet AS pid,tbl_baiviet.tieude AS posttitle,tbl_baiviet.hinhanh, tbl_danhmuc.tenCate AS category, tbl_danhmuc.idCate AS cid,tbl_danhmuccon.tenSubCate AS subcategory,tbl_baiviet.noidung AS postdetails,tbl_baiviet.ngaytao AS postingdate,tbl_baiviet.url AS url from tbl_baiviet left join tbl_danhmuc on tbl_danhmuc.idCate=tbl_baiviet.idCate left join  tbl_danhmuccon on  tbl_danhmuccon.idSubCate=tbl_baiviet.idSubCate where tbl_baiviet.trangthai=1 order by tbl_baiviet.idbaiviet desc LIMIT $offset, $no_of_records_per_page";
        // while ($row=mysqli_fetch_array($query)) {
        $selectQuery = $db->fetchSql($query);  
        foreach($selectQuery as $row){
        ?>
          
          <div class="card mb-4">
            <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>">
              <img class="card-img-top" src="admin/postimages/<?php echo htmlentities($row['hinhanh']);?>" alt="<?php echo htmlentities($row['posttitle']);?>">
              <div class="card-body ">
                <h2 class="card-title"><?php echo htmlentities($row['posttitle']);?></h2>
                <!-- <p>
                  <b>Category : </b> 
                  <a href="category.php?catid=<?php echo htmlentities($row['cid'])?>"><?php echo htmlentities($row['category']);?></a> 
                </p> -->
              </div>
            </a>
            
          </div>
          
        <?php }?>
     
        <!-- Pagination -->
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
