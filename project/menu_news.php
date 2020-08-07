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
  <title>인테리어 소식 페이지</title>
<link rel="stylesheet" type="text/css" href="/project/css/style_home.css">
<link rel="stylesheet" type="text/css" href="/project/css/style_news_page.css">
</head>
<body>
<div class = "wrap">
    <header>
      <div id="login_area">
        <ul>
          <li><a href = "/project/page/product_board/product_cart.php">장바구니 / </a></li>
          <?php
            session_start();
            if(!isset($_SESSION['userid'])) {
              echo "<li><a href = \"/project/test_login.php\">로그인</a></li>";
            } else {
              $id = $_SESSION['userid'];
              if ($id == "admin") {
                echo "<li><a href = \"/admin.php\">관리자 페이지 / </a></li>";
                echo "<li><a href = \"/project/logout_action.php\">로그아웃</a></li>";
              } else {
                echo "<li><a href = \"/mypage.php\">My Page / </a></li>";
                echo "<li><a href = \"/project/logout_action.php\">로그아웃</a></li>";
              }
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
        <li><a href = "/project/menu_news.php">인테리어 소식</a></li>
        <li><a href = "/project/menu_album.php">앨범</a></li>
        <li><a href = "/project/menu_product_list.php">소품</a></li>
        <li><a href = "/project/menu_board.php">게시판</a></li>
      </ul>
    </nav>

   <article>
    <div class="title">
      <h2>인테리어 소식 / News Page</h2>
    </div>

    <?php
    //  크롤링 파트
    ini_set("allow_url_fopen", 1);
    include ('simple_html_dom.php');
    $data_source = file_get_html('https://maisondebianco.tistory.com/category/%ED%99%88%EC%8A%A4%ED%83%80%EC%9D%BC%EB%A7%81');

    $list_articles = $data_source->find('div[class="index-list-content-inner"]');

    foreach($list_articles as $article) {?>
      <?php
      // url 불러오기
      $item[$i]['url'] = $data_source-> find('a.index-mobile', $i)->href;
      //echo $item[$i]['url'];
      // 제목 불러오기
      $item[$i]['title'] = $data_source-> find('strong[class="tit_post"]', $i)->plaintext;
      //echo $item[$i]['title'];
      // 이미지 불러오기
      $item[$i]['img'] = $data_source-> find('div[class="rgy-index-img-frame"]', $i)->style;
      // 기사 내용 불러오기
      $item[$i]['content'] = $data_source-> find('p[class="txt_post"]', $i)->plaintext;
      // 기사 날짜 불러오기
      $item[$i]['date'] = $data_source-> find('span[class="txt_bar"]', $i)->plaintext;

      if($i > 0) {
      ?>
    
      <!-- 가져온 데이터 html에 삽입 -->
      <a href= "https://maisondebianco.tistory.com/<?php echo $item[$i]['url'];?>">
      <div class="container">
          <div class="item" style= "<?php echo $item[$i]['img'];?> background-size: cover;"></div>
          <div class="item"> <?php echo $item[$i]['title']; ?> </div>
          <div class="item"> <?php echo $item[$i]['date']; ?> </div>
          <div class="item" id="article_content"> <?php echo $item[$i]['content']; ?> </div>
      </div>
      </a>
      <?php
      }
    $i++;
    }
  ?>

  
   </article>
    <footer>
      ::: Contact : sinsy@gmail.com :::
    </footer>
</div>

</body>
</html>
