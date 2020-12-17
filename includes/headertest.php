
<style>
.parent-link{
    color: white !important;
}
</style>

<nav class="navbar fixed-top navbar-expand-lg bg-nav fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php"><img src="images/Logo.png" height="50"></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
      data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
      aria-label="Toggle navigation">
          <span class="dot dot1"></span>
          <span class="dot dot2"></span>
          <span class="dot dot3"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav m-auto">
      <?php $query=mysqli_query($con,"select id,CategoryName from tblcategory where Is_Active = 1 limit 8");
      while($row=mysqli_fetch_array($query))
      {
      ?>
        <li class="nav-item">
          <a class="nav-link" href="category.php?catid=<?php echo htmlentities($row['id'])?>"><?php echo htmlentities($row['CategoryName']);?></a>
        </li>
      <?php } ?>
        <li onclick="toggleClick();" class="more">
          <span class="dot dot1"></span>
          <span class="dot dot2"></span>
          <span class="dot dot3"></span>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <form name="search" action="search.php" method="post">
          <div class="input-group">
            <input type="text" name="searchtitle" class="form-control" placeholder="Nhập nội dung cần tìm..." required>
            <span class="input-group-btn">
              <button class="btn btn-secondary" type="submit"><i class="fas fa-search"></i></button>
            </span>
        </form>
      </ul>
        <!-- <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="about-us.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">News</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact-us.php">Contact us</a>
          </li>
        </ul> -->
    </div>
  </div>
</nav>
<div class="category-popup">
    <div class="page-wrapper">
        <nav class="container category-menu">
            <ul>
                <?php $query=mysqli_query($con,"select id,CategoryName from tblcategory where Is_Active = 1");
                while($row=mysqli_fetch_array($query))
                     { ?>
                        <li class="nav-item">
                                <a class="parent-link" href="category.php?catid=<?php echo htmlentities($row['id'])?>"> <?php echo htmlentities($row['CategoryName']);?></a>
                                     <div class="subcate">
                                        <ul>
                                                <?php $query2=mysqli_query($con,"select * 
                                                                            from tblsubcategory join tblcategory on tblsubcategory.CategoryId=tblcategory.id 
                                                                            where tblcategory.id=tblsubcategory.CategoryId");
                                                while($row=mysqli_fetch_array($query2))
                                                    { ?>
                                                        <li class="nav-item">
                                                                <a class="parent-link" href="subcategory.php?subcatid=<?php echo htmlentities($row['SubCategoryId'])?>"> 
                                                                <?php echo htmlentities($row['Subcategory']);?></a>
                                                                    
                                                        </li>
                                                <?php } ?>

                                             
                                        </ul>
                                </div>
                        </li>
                <?php } ?>
                

                
                
            </ul>

        </nav>
    </div>
</div>
<script>
    function toggleClick(){
        $(".category-popup").toggleClass("active");
        $(".more").toggleClass("active");
    }
</script>