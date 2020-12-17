<div class="col-md-4">
  <!-- Search Widget -->
  <!-- <div class="card mb-4">
    <h5 class="card-header">Search</h5>
    <div class="card-body">
      <form name="search" action="search.php" method="post">
        <div class="input-group">
          <input type="text" name="searchtitle" class="form-control" placeholder="Search for..." required>
          <span class="input-group-btn">
            <button class="btn btn-secondary" type="submit">Go!</button>
          </span>
      </form>
    </div>
  </div>
  </div> -->

<!-- Categories Widget -->
<!-- <div class="card my-4">
  <h5 class="card-header">Categories</h5>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-6">
        <ul class="list-unstyled mb-0">
          <?php $query=mysqli_query($con,"select id,CategoryName from tblcategory");
          while($row=mysqli_fetch_array($query))
          {
          ?>
          <li>
            <a
              href="category.php?catid=<?php echo htmlentities($row['id'])?>"><?php echo htmlentities($row['CategoryName']);?></a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </div>
</div> -->

<!-- Side Widget -->
<div class="card mb-4">
  <h5 class="card-header">Tin nổi bật</h5>
  <div class="card-body">
    <ul class="mb-0 p-0">
        <?php 
        $listCate = $db->fetchsql('SELECT * FROM tbl_baiviet LEFT JOIN tbl_danhmuc ON tbl_danhmuc.idCate = tbl_baiviet.idCate LEFT JOIN tbl_danhmuccon ON tbl_danhmuccon.idSubCate = tbl_baiviet.idSubCate WHERE tbl_baiviet.trangthai=1 LIMIT 5');
        foreach($listCate as $values)
        {
        ?>
        <li class="pb-2">
        <a href="news-details.php?nid=<?php echo htmlentities($values['idBaiViet'])?>">
          <img class="card-img-top" src="admin/postimages/<?php echo htmlentities($values['hinhAnh']);?>" alt="<?php echo htmlentities($values['tieuDe']);?>"> 
          <?php echo htmlentities($values['tieuDe']);?>
        </a>
        </li>        
        <?php } ?>
    </ul>
    <!-- <ul class="mb-0 p-0">
      <?php
      $query=mysqli_query($con,"select tblposts.PostImage,tblposts.id as pid,tblposts.PostTitle as posttitle from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId limit 8");
      while ($row=mysqli_fetch_array($query)) 
      {?>
      <li class="pb-2">
        <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>">
          <img class="card-img-top" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>"> 
          <?php echo htmlentities($row['posttitle']);?>
        </a>
      </li>
      <?php } ?>
    </ul> -->
  </div>
</div>
<!--Widget Weather-->
<div class="card my-4">
  <h5 class="card-header">Tiện ích</h5>
  <div class="card-body" style="padding: 1rem !important;">
  <a class="weatherwidget-io" href="https://forecast7.com/en/10d75106d68/ho-chi-minh/" data-label_1="Hồ Chí Minh" data-label_2="Thời tiết" data-icons="Climacons Animated" data-theme="pure" >Thời tiết tại Hồ Chí Minh</a>
  <script>
    !function(d,s,id)
    {
      var js,fjs=d.getElementsByTagName(s)[0];
      if(!d.getElementById(id))
      {
        js=d.createElement(s);
        js.id=id;
        js.src='https://weatherwidget.io/js/widget.min.js';
        fjs.parentNode.insertBefore(js,fjs);
      }
    }
    (document,'script','weatherwidget-io-js');
  </script>
  </div>
</div>
</div>
