<?php
  error_reporting(E_ALL);
  ini_set("display_errors", 1);
  session_start();
  $URL = "/";
  if(!isset($_SESSION['userid'])) {
  ?>
  <script>
  alert("로그인이 필요합니다");
  location.replace("<?php echo $URL?>");
  </script>
  <?php
  }
?>

<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Welcome, 메인 페이지</title>
<link rel="stylesheet" type="text/css" href="/git_project/project/css/style_home.css">
<link rel="stylesheet" type="text/css" href="/git_project/project/css/style_product_write.css" />
</head>
<body>
  <div class = "wrap">
    <header>
      <div id="login_area">
        <ul>
        <li><a href = "page/product_board/cart.php" target="main_area">장바구니 / </a?</li>
          <?php
            
            if(!isset($_SESSION['userid'])) {
              echo "<li><a href = \"test_login.php\">로그인 / </a></li>";
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
        <li><a href = "menu_intro.html" target="main_area">인테리어 소식</a></li>
        <li><a href = "/git_project/project/menu_album.php">앨범</a></li>
        <li><a href = "/git_project/project/page/product_board/menu_product.php" target="main_area">소품</a></li>
        <li><a href = "/git_project/project/menu_board.php">게시판</a></li>
      </ul>
    </nav>

   <article>
   <div id="board_write">
     <h1>상품 업로드</h1>
            <div id="write_area">
            <form enctype="multipart/form-data" action="upload.php" method="post">
                    <h2> 제품명 </h2>
                    <div id="in_title">
                        <textarea name="name" id="utitle" rows="1" cols="55" placeholder="제품명 입력" maxlength="100" required></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <h2> 금액 (원) </h2>
                    <div id="in_name">
                        <textarea name="price" id="uname" rows="1" cols="55" placeholder="제품 금액" maxlength="100" required></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <h2> 상품 한마디 </h2>
                    <div id="in_content">
                        <textarea name="comment" id="ucontent" placeholder="내용" required></textarea>
                    </div>
                    <h2> 상품 상세설명 </h2>
                    <div id="in_pw">
                      <textarea name="content" id="ucontent" placeholder="내용" required></textarea> 
                    </div>
                    <h2> 제품 사진 첨부 </h2>
                    <div>
				              <input type="file" name="fileToUpload" id="fileToUpload">
			              </div>
                    
                    <div class="bt_se">
                        <button type="submit">글 작성</button>
                    </div>
                </form>
            </div>
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
