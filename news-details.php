<?php 
include('admin/includes/autoload.php');

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $timeEng = ['Sun','Mon','Tue','Wed', 'Thu', 'Fri', 'Sat', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    $timeVie = ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy','1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
  
    /**
     * 09h52, Thứ Bảy ngày 28 tháng Mười năm 2017
     */

//Genrating CSRF Token

if (empty($_SESSION['token'])) 
{
 $_SESSION['token'] = bin2hex(random_bytes(32));
}
if(isset($_POST['submit']))
{
  //Verifying CSRF Token
  if (!empty($_POST['csrftoken']))
  {
    if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) 
    {
      $postid=intval($_GET['nid']);
      $st1='0';
      $data = [
        "UserName" => postInput('name'),
        "UserEmail" => postInput('email'),
        "noiDungBl" => postInput('comment'),
        "idBaiviet" => $postid,
        "trangthai" => $st1,
      ];

      $cmt_insert = $db->insert("tbl_binhluan",$data);

      if($cmt_insert):
        echo "<script>alert('Bình luận đã được gửi. Bạn đọc vui lòng chờ Admin xét duyệt!!');</script>";
        unset($_SESSION['token']);
      else :
      echo "<script>alert('Something went wrong. Please try again.');</script>";  

      endif;

    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Báo Đây! Báo người Việt</title>

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
        <div class="col-md-8">

          <!-- Blog Post -->
          <?php
          $pid=intval($_GET['nid']);

          $baiviet = $db->fetchSql("SELECT tbl_baiviet.tieude as posttitle, tbl_baiviet.hinhanh,tbl_danhmuc.tenCate as category,tbl_danhmuc.idCate as cid,tbl_danhmuccon.tenSubCate as subcategory,tbl_baiviet.noidung as postdetails,tbl_baiviet.ngaytao as postingdate,tbl_baiviet.Url as url 
          from tbl_baiviet 
          left join tbl_danhmuc on tbl_danhmuc.idCate=tbl_baiviet.idCate
          left join  tbl_danhmuccon on  tbl_danhmuccon.idSubCate=tbl_baiviet.idSubCate 
          where tbl_baiviet.idBaiviet='$pid'");
          foreach($baiviet as $values) {
          ?>

          <div class="card mb-4">
            <div class="card-body">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="text-transform:uppercase">
                  <li class="breadcrumb-item"><a href="category.php?catid=<?php echo htmlentities($values['cid'])?>"><?php echo htmlentities($values['category']);?></a></li>
                  <li class="breadcrumb-item active" aria-current="page"><a href="#"><?php echo htmlentities($values['subcategory']);?></a></li>
                </ol>
              </nav>
              <h2 class="card-title"><?php $title=$values['posttitle']; echo htmlentities($values['posttitle']);?></h2>
              <p class="card-date">&#9679; 
                <?php 
                $time = strtotime($values['postingdate']);
                $time = date('D, d/M/Y H\:i',$time);
                $time = str_replace( $timeEng, $timeVie, $time);
                echo $time;
                ?>
              </p>
              <hr />
              <!-- <img class="img-fluid rounded" src="admin/postimages/<?php echo htmlentities($values['PostImage']);?>" alt="<?php echo htmlentities($values['posttitle']);?>"> -->
  
              <p class="card-text"><?php 
              $pt=$values['postdetails'];
              echo  (substr($pt,0));?>
              </p>
             
            </div>
            <div class="card-footer text-muted">
             
            </div>
            <!---Comment Section --->

      <div class="row" style="margin-top: -8%">
        <div class="col-md-8">
          <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
              <form name="Comment" method="post">
                <input type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']); ?>" />
                <div class="form-group">
                  <input type="text" name="name" class="form-control" placeholder="Enter your fullname" required>
                </div>

                <div class="form-group">
                  <input type="email" name="email" class="form-control" placeholder="Enter your Valid email" required>
                </div>

                <div class="form-group">
                  <textarea class="form-control" name="comment" rows="3" placeholder="Comment" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
              </form>
            </div>
          </div>

            <!---Comment Display Section --->

            <?php 
            $sts=1;

            $binhluan = $db->fetchSql("SELECT username,noidungbl,ngaytao from tbl_binhluan where idbaiviet='$pid' and trangthai='$sts'");

            foreach($binhluan as $values) {
            ?>
            <div class="media mb-4">
              <img class="d-flex mr-3 rounded-circle" src="images/usericon.png" alt="">
              <div class="media-body">
                <h5 class="mt-0"><?php echo htmlentities($values['username']);?> <br />
                  <span style="font-size:11px;"><b>at</b> <?php echo htmlentities($values['ngaytao']);?></span>
                  </h5>
           
                <?php echo htmlentities($values['noidungbl']);?>            
              </div>
            </div>
            <?php } ?>

        </div>
      </div>
          </div>
          <?php } ?>

        </div>

        <!-- Sidebar Widgets Column -->
        <?php include('includes/sidebar.php');?>
      </div>
      <!-- /.row -->
      
    </div>

  
      <?php include('includes/footer.php');?>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
