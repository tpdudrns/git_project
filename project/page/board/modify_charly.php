<!--- 게시글 수정 -->
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
	include $_SERVER['DOCUMENT_ROOT']."/db_connection.php";

    //session_start();
    $URL = "/project/menu_board.php";


	$index = $_GET['idx'];
	$sql = mq("select * from freeboard where idx='$index';");
    $board = $sql->fetch_array();
    
    if(!isset($_SESSION['userid'])) {
        ?>              <script>
                                alert("권한이 없습니다.");
                                location.replace("<?php echo $URL?>");
                        </script>
        <?php   }
                else if($_SESSION['userid']==$board['name']) {
        ?>

<!doctype html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" type="text/css" href="/project/css/style_home.css">
<link rel="stylesheet" href="/project/css/style_board_write.css" />
</head>
<body>
<div class = "wrap">
<header>
      <div id="login_area">
        <ul>
        <li><a href = "/git_project/project/page/product_board/product_cart.php">장바구니 / </a?</li>
          <?php
            
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
    <div id="board_write">
        <h1><a href="/">게시글 수정</a></h1>
            <div id="write_area">
                <form action="modify_ok.php?idx=<?php echo $index; ?>" method="POST">
                    <h2>제목</h2>
                    <div id="in_title">
                        <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="100" required><?php echo $board['title']; ?></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <h2>작성자</h2>
                    <div id="in_name">
                        <input type="hidden" name="name" id="uname" rows="1" cols="55" placeholder="작성자" maxlength="100" value="<?=$_SESSION['userid']?>"><?=$_SESSION['userid']?>
                    </div>
                    <div class="wi_line"></div>
                    <h2>내용</h2>
                    <div id="in_content">
                        <textarea name="content" id="ucontent" placeholder="내용을 입력하세요" required><?php echo $board['content']; ?></textarea>
                    </div>
<!--                     <div id="in_pw">
                        <input type="password" name="pw" id="upw"  placeholder="비밀번호" required />  
                    </div> -->
                    <div class="bt_se">
                        <button type="submit">수정</button>
                    </div>
                </form>
            </div>
        </div>
        <?php   }
                else {
        ?>              <script>
                                alert("권한이 없습니다.");
                                location.replace("<?php echo $URL?>");
                        </script>
        <?php   }
        ?>
    </article>
    <footer>
      ::: Contact : sinsy@gmail.com :::
    </footer>
</div>
</body>
</html>