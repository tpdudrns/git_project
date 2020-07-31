<!DOCTYPE html>
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-172988251-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-172988251-2');
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Welcome, 메인 페이지</title>
<link rel="stylesheet" type="text/css" href="/project/css/style_home.css">
</head>
<style>

.border_line {
      border-bottom:1px solid #CCC;
}
.container_img {
  float:left;
  width: 300px;
  text-align:center;
  margin-top: 20px;
  margin-left: 20px;
  
}
.container_article_title {
  width: 500px;
  float:left;
  margin-top: 20px;
}

.item {
  display: block;
  height: 250px;
}
dd {
  padding-top: 10px;
/*   width:200px;
  height:300px; */
}
dt {
  padding-top: 10px;
}


</style>
<body>
  <div class = "wrap">
    <header>
      <div id="login_area">
        <ul>
        <li><a href = "/git_project/project/page/product_board/product_cart.php">장바구니 / </a?</li>
          <?php
            session_start();
            if(!isset($_SESSION['userid'])) {
              echo "<li><a href = \"test_login.php\">로그인</a></li>";
            } else {
              $id = $_SESSION['userid'];
              echo "<li>$id 님 환영합니다. / </a></li>";
              echo "<li><a href = \"/logout_action.php\">로그아웃</a></li>";
            }
          ?>
          <!-- <li><a href = "test_login.php">로그인</a></li> -->
        </ul>
      </div>
      <div id="title">
        <h1>SY's Interior Story</h1> 
      </div>
    </header>
    <nav>
      <ul>
        <li><a href = "/">홈</a></li>
        <li><a href = "/git_project/project/menu_news.php">인테리어 소식</a></li>
        <li><a href = "/git_project/project/menu_album.php">앨범</a></li>
        <li><a href = "/git_project/project/menu_product_list.php">소품</a></li>
        <li><a href = "/git_project/project/menu_board.php">게시판</a></li>
      </ul>
    </nav>

   <article>
  
  <h2>
    최근 인테리어 소식
    <div class="border_line"></div>
  </h2>

  <div class="container_img">
    <?php 
    include ('simple_html_dom.php');
    $data = file_get_html('http://nsearch.chosun.com/search/total.search?query=%EC%8B%A4%EB%82%B4+%EC%9D%B8%ED%85%8C%EB%A6%AC%EC%96%B4&cs_search=gnbtotal');
    $crowling_article_img = $data->find('dd[class="thumb"]');
    foreach($crowling_article_img as $article_img) {?>
    <div class="item">
      <?php echo $article_img; ?>
    </div>
    <div class="border_line"></div>
    
  <?php
    }
  ?>

  </div>
  <div class="container_article_title">
    <?php 
    $data2 = file_get_html('http://nsearch.chosun.com/search/total.search?query=%EC%8B%A4%EB%82%B4+%EC%9D%B8%ED%85%8C%EB%A6%AC%EC%96%B4&cs_search=gnbtotal');
    $c = $data2->find('dt[discription="기사 제목"]');
    foreach($c as $d) {?>
      <div class="item">
        <?php echo $d; ?>
      </div>
      <div class="border_line"></div>
  <?php
    }
  ?>
  
  </div>



   </article>
    <footer>
      ::: Contact : sinsy@gmail.com :::
    </footer>
  </div>
<script type="text/javascript"> 
  function getCookie(name) {
     var cookie = document.cookie; 
     if (document.cookie != "") { 
       var cookie_array = cookie.split("; ");
        for ( var index in cookie_array) { 
          var cookie_name = cookie_array[index].split("=");
           if (cookie_name[0] == "popupYN") {
              return cookie_name[1];
               }
        } 
      } return ;
  } 
                 
  function openPopup(url) {
      var cookieCheck = getCookie("popupYN");
      if (cookieCheck != "N") window.open(url, '', 'width=450,height=750,left=0,top=0')
  } 
</script>
<body onload="javascript:openPopup('popup.html')">

</body>
</html>
