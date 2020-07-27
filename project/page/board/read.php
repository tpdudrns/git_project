<?php
	include $_SERVER['DOCUMENT_ROOT']."/db_connection.php"; /* db load */
	session_start();
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Welcome, 메인 페이지</title>
<link rel="stylesheet" type="text/css" href="/project/css/style_home.css">
<link rel="stylesheet" type="text/css" href="/project/css/style_board_read.css">
</head>

<body>
  <div class = "wrap">
    <header>
      <div id="login_area">
        <ul>
        <li><a href = "/git_project/project/page/product_board/product_cart.php">장바구니 / </a?</li>
          <?php
            session_start();
            if(!isset($_SESSION['userid'])) {
              echo "<li><a href = \"/project/test_login.php\">로그인</a></li>";
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
        <li><a href = "/project/menu_news.php">인테리어 소식</a></li>
        <li><a href = "/project/menu_album.php">앨범</a></li>
        <li><a href = "/project/menu_product_list.php">소품</a></li>
        <li><a href = "/project/menu_board.php">게시판</a></li>
      </ul>
    </nav>

   <article>
   <?php
		$number = $_GET['idx']; /* bno함수에 idx값을 받아와 넣음*/
		$hit = mysqli_fetch_array(mq("select * from freeboard where idx ='".$number."'"));
		$hit = $hit['hit'] + 1;
		$fet = mq("update freeboard set hit = '".$hit."' where idx = '".$number."'");
		$sql = mq("select * from freeboard where idx='".$number."'"); /* 받아온 idx값을 선택 */
		$board = $sql->fetch_array();
	?>
    <!-- 글 불러오기 -->
  <div id="board_read">
	  <h2><?php echo $board['title']; ?></h2>
		<div id="user_info">
			<?php echo $board['name']; ?> / <?php echo $board['date']; ?> / 조회:<?php echo $board['hit']; ?>
    </div>
		<div id="bo_line"></div>
		<div id="bo_content">
			<?php echo nl2br("$board[content]"); ?>
		</div>
	  <!-- 목록, 수정, 삭제 -->
    <div id="bo_line"></div>
	  <div id="bo_ser">
		  <ul>
			  <li><a href="/project/menu_board.php">[목록으로]</a></li>
			  <li><a href="modify_charly.php?idx=<?php echo $board['idx']; ?>">[수정]</a></li>
			  <li><a href="delete.php?idx=<?php echo $board['idx']; ?>">[삭제]</a></li>
		  </ul>
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

