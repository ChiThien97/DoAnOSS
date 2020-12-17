<script src="https://kit.fontawesome.com/95a19bc703.js" crossorigin="anonymous"></script>
    <footer class="bg-dark footer container" id="wrapper_footer">
    <div class="inner-footer width_common">
      <ul class="list-menu-footer">
        <li class="item-menu"><a href="#">Trang chủ</a></li>
        <li class="item-menu"><a href="#">Video</a></li>
        <li class="item-menu"><a href="#">Ảnh</a></li>
        <li class="item-menu"><a href="#">Infographics</a></li>
        <li class="item-menu border-top" style="padding-top: 15px;border-top: 1px solid #e5e5e5;"><a href="#">Mới nhất</a></li>
        <li class="item-menu"><a href="#">Xem nhiều</a></li>
        <li class="item-menu"><a href="#">Tin nóng</a></li>
      </ul>
      <ul class="list-menu-footer">
        <?php 
        $listCate = $db->fetchsql('SELECT * FROM tbl_danhmuc WHERE trangThai = 1 LIMIT 5');
        foreach($listCate as $values)
        {
        ?>
          <li class="item-menu"><a href="category.php?catid=<?php echo htmlentities($values['idCate'])?>"><?php echo htmlentities($values['tenCate']);?></a></li>
        <?php } ?>
      </ul>
      <ul class="list-menu-footer">
        <?php 
        $listCate = $db->fetchsql('SELECT * FROM tbl_danhmuc WHERE trangThai = 1 LIMIT 5,10');
        foreach($listCate as $values)
        {
        ?>
          <li class="item-menu"><a href="category.php?catid=<?php echo htmlentities($values['idCate'])?>"><?php echo htmlentities($values['tenCate']);?></a></li>
        <?php } ?>
      </ul>
      <ul class="list-menu-footer">
        <li class="item-menu"><a href="#">Ý kiến</a></li>
        <li class="item-menu"><a href="#">Tâm sự</a></li>
        <li class="item-menu"><a href="#">Hài</a></li>
      </ul>
      <ul class="list-menu-footer">
        <li class="item-menu"><a href="#" >Rao vặt</a></li>
        <li class="item-menu"><a href="#" >Shop Báo Đây !</a></li>
        <li class="item-menu"><a href="#" >Startup</a></li>
        <li class="item-menu"><a href="#" >Quà tặng</a></li>
        <li class="item-menu"><a href="#" >Kid-lab</a> </li>
        <li class="item-menu"><a href="#" >Mua ảnh Báo Đây !</a></li>
      </ul>
      <div class="wrap-contact">
            <div class="contact downloadapp">
                <p>Tải ứng dụng</p>
                <a href="#down-app-popup_vne" class="app_vne open-popup-link" title="Báo Đây !"><svg class="ic ic-vne">
                        <use xlink:href="#letter-E"></use>
                    </svg>Báo Đây !</a>
                <a style="margin-right:0 !important" href="#down-app-popup_evne" class="app_evne open-popup-link" title="International"><svg
                        class="ic ic-evne">
                        <use xlink:href="#letter-E-grey"></use>
                    </svg>International</a>
            </div>
        <div class="contact">
          <p>Liên hệ</p>
          <a href="#" class="mail"><i class="ic fas fa-envelope"></i>Tòa soạn</a>
          <a href="#" class="ads"><i class="ic fas fa-ad"></i>Quảng cáo</a>
        </div>
        <div class="hotline">
          <p>Đường dây nóng</p>
          <div class="left">
            <strong>090.909.9900</strong>
          </div>
          <div class="right">
            <strong>080.808.8800</strong>
          </div>
        </div>
      </div>    
    </div>
    <div class="copyright width_common">
        <p>
            <a href="#" class="logo_ft">
                <img src="images/Logo.png">
            </a>
            <span class="txt-copyright">© 1997-2020.Toàn bộ bản quyền thuộc Báo Đây !<br><strong>Báo tiếng Việt ít người xem nhất.</strong> Thuộc Khoa Công nghệ thông tin STU.</span>
        </p>
        <div class="right flexbox">
            <span class="txt-follow">Theo dõi Báo Đây! trên</span>
            <a href="#" class="social_ft face_ft" title="Facebook"><i class="ic fab fa-facebook"></i></a>
            <a href="#" class="social_ft twitter_ft" title="Twitter"><i class="ic fab fa-twitter"></i></a>
            <a href="#" class="social_ft youtube_ft" title="Youtube"><i class="ic fab fa-youtube"></i></a>
        </div>
      </div>
      <!-- /.container -->
    </footer>