

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
      <?php
        
      $listCate = $db->fetchsql('SELECT * FROM tbl_danhmuc WHERE trangThai = 1 LIMIT 8');
     
      foreach($listCate as $values)
      {
      ?>
        <li class="nav-item">
          <a class="nav-link" href="category.php?catid=<?php echo htmlentities($values['idCate'])?>"><?php echo htmlentities($values['tenCate']);?></a>
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
            <input type="text" name="searchtitle" class="form-control" placeholder="Nhập nội dung cần tìm..." required value="<?php echo isset($_POST['searchtitle'])?$_POST['searchtitle']:''">
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

                <li class="parent thoi-su ">
                    <a href="/thoi-su.html" title="Xã hội">Xã hội</a>
                    <div class="subcate">
                        <ul>
                            <li class="chinh-tri">
                                <a href="/chinh-tri.html">Chính trị</a>
                            </li>


                            <li class="nhan-su-moi">
                                <a href="/nhan-su-moi.html">Nhân sự mới</a>
                            </li>


                            <li class="giao-thong">
                                <a href="/giao-thong.html">Giao thông</a>
                            </li>


                            <li class="do-thi">
                                <a href="/do-thi.html">Đô thị</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="parent phap-luat ">
                    <a href="/phap-luat.html" title="Pháp luật">Pháp luật</a>
                    <div class="subcate">
                        <ul>

                            <li class="phap-dinh">
                                <a href="/phap-dinh.html">Pháp đình</a>
                            </li>


                            <li class="vu-an">
                                <a href="/vu-an.html">Vụ án</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="parent the-gioi ">
                    <a href="/the-gioi.html" title="Thế giới">Thế giới</a>
                    <div class="subcate">
                        <ul>

                            <li class="quan-su-the-gioi">
                                <a href="/quan-su-the-gioi.html">Quân sự</a>
                            </li>


                            <li class="tu-lieu-the-gioi">
                                <a href="/tu-lieu-the-gioi.html">Tư liệu</a>
                            </li>


                            <li class="phan-tich-the-gioi">
                                <a href="/phan-tich-the-gioi.html">Phân tích</a>
                            </li>


                            <li class="nguoi-viet-4-phuong">
                                <a href="/nguoi-viet-4-phuong.html">Người Việt 4 phương</a>
                            </li>


                            <li class="chuyen-la-the-gioi">
                                <a href="/chuyen-la-the-gioi.html">Chuyện lạ</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="parent kinh-doanh-tai-chinh ">
                    <a href="/kinh-doanh-tai-chinh.html" title="Kinh doanh">Kinh doanh</a>
                    <div class="subcate">
                        <ul>

                            <li class="bat-dong-san">
                                <a href="/bat-dong-san.html">Bất động sản</a>
                            </li>


                            <li class="hang-khong">
                                <a href="/hang-khong.html">Hàng không</a>
                            </li>


                            <li class="tai-chinh">
                                <a href="/tai-chinh.html">Tài chính</a>
                            </li>


                            <li class="tieu-dung">
                                <a href="/tieu-dung.html">Tiêu dùng</a>
                            </li>


                            <li class="thuong-mai-dien-tu">
                                <a href="/thuong-mai-dien-tu.html">Thương mại điện tử</a>
                            </li>


                            <li class="TTDN">
                                <a href="/ttdn.html">Thông tin doanh nghiệp</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="parent cong-nghe ">
                    <a href="/cong-nghe.html" title="Công nghệ">Công nghệ</a>
                    <div class="subcate">
                        <ul>

                            <li class="mobile">
                                <a href="/mobile.html">Mobile</a>
                            </li>


                            <li class="internet">
                                <a href="/internet.html">Internet</a>
                            </li>


                            <li class="esports">
                                <a href="/esports.html">Game</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="parent suc-khoe ">
                    <a href="/suc-khoe.html" title="Sức khỏe">Sức khỏe</a>
                    <div class="subcate">
                        <ul>

                            <li class="khoe-dep">
                                <a href="/khoe-dep.html">Khỏe đẹp</a>
                            </li>


                            <li class="dinh-duong">
                                <a href="/dinh-duong.html">Dinh dưỡng</a>
                            </li>


                            <li class="me-va-be">
                                <a href="/me-va-be.html">Mẹ và Bé</a>
                            </li>


                            <li class="benh-thuong-gap">
                                <a href="/benh-thuong-gap.html">Bệnh thường gặp</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="parent the-thao ">
                    <a href="/the-thao.html" title="Thể thao">Thể thao</a>
                    <div class="subcate">
                        <ul>

                            <li class="bong-da-viet-nam">
                                <a href="/bong-da-viet-nam.html">Bóng đá Việt Nam</a>
                            </li>


                            <li class="bong-da-anh">
                                <a href="/bong-da-anh.html">Bóng đá Anh</a>
                            </li>


                            <li class="vo-thuat">
                                <a href="/vo-thuat.html">Võ thuật</a>
                            </li>


                            <li class="esports-the-thao">
                                <a href="/esports-the-thao.html">eSports</a>
                            </li>


                            <li class="hau-truong-the-thao">
                                <a href="/hau-truong-the-thao.html">Hậu trường</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="parent giai-tri ">
                    <a href="/giai-tri.html" title="Giải trí">Giải trí</a>
                    <div class="subcate">
                        <ul>

                            <li class="sao-viet">
                                <a href="/sao-viet.html">Sao</a>
                            </li>


                            <li class="am-nhac">
                                <a href="/am-nhac.html">Âm nhạc</a>
                            </li>


                            <li class="phim-anh">
                                <a href="/phim-anh.html">Phim ảnh</a>
                            </li>


                            <li class="thoi-trang">
                                <a href="/thoi-trang.html">Thời trang</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="parent doi-song ">
                    <a href="/doi-song.html" title="Đời sống">Đời sống</a>
                    <div class="subcate">
                        <ul>

                            <li class="gioi-tre">
                                <a href="/gioi-tre.html">Giới trẻ</a>
                            </li>


                            <li class="xu-huong">
                                <a href="/xu-huong.html">Xu hướng</a>
                            </li>


                            <li class="song-dep">
                                <a href="/song-dep.html">Sống đẹp</a>
                            </li>


                            <li class="su-kien">
                                <a href="/su-kien.html">Sự kiện</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="parent giao-duc ">
                    <a href="/giao-duc.html" title="Giáo dục">Giáo dục</a>
                    <div class="subcate">
                        <ul>

                            <li class="tuyen-sinh-dai-hoc-2020">
                                <a href="/tuyen-sinh-dai-hoc-2020.html">Tuyển sinh 2020</a>
                            </li>


                            <li class="tu-van-giao-duc">
                                <a href="/tu-van-giao-duc.html">Tư vấn</a>
                            </li>


                            <li class="du-hoc">
                                <a href="/du-hoc.html"> Du học</a>
                            </li>


                            <li>
                                <a href="/tieu-diem/hoc-tieng-anh.html">Học Tiếng Anh</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="parent du-lich ">
                    <a href="/du-lich.html" title="Du lịch">Du lịch</a>
                    <div class="subcate">
                        <ul>

                            <li class="dia-diem-du-lich">
                                <a href="/dia-diem-du-lich.html">Địa điểm du lịch</a>
                            </li>


                            <li class="kinh-nghiem-du-lich">
                                <a href="/kinh-nghiem-du-lich.html">Kinh nghiệm du lịch</a>
                            </li>


                            <li class="am-thuc">
                                <a href="/am-thuc.html">Ẩm thực</a>
                            </li>


                            <li class="phuot">
                                <a href="/phuot.html">Phượt</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="parent oto-xe-may ">
                    <a href="/oto-xe-may.html" title="Xe">Xe</a>
                    <div class="subcate">
                        <ul>

                            <li class="oto">
                                <a href="/oto.html">Ôtô</a>
                            </li>


                            <li class="xe-may">
                                <a href="/xe-may.html">Xe máy</a>
                            </li>


                            <li class="danh-gia">
                                <a href="/danh-gia.html">Đánh giá</a>
                            </li>


                            <li class="xe-the-thao">
                                <a href="/xe-the-thao.html">Xe thể thao</a>
                            </li>

                        </ul>
                    </div>
                
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