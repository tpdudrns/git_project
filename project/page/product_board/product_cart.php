<?php
        // GET 으로 action이란 변수의 데이터를 받았을 때의 작동
        // 장바구니의 데이터를 추가, 삭제하기 위해 action이란 변수를 이용하여 구현
        if(isset($_GET["action"])) {
            if($_GET["action"] == "delete") {
                // 쿠키에 데이터를 구분하고 있는 slash를 제거하고 json 을 변환한다.
                $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                $cart_data = json_decode($cookie_data, true);
                // 쿠키데이터에 배열로 저장되어 있는 cart_data에서 key 값 별로 데이터를 불러온다.
                foreach($cart_data as $keys => $values) {
                    if($cart_data[$keys]['item_id'] == $_GET["id"]) {
                        unset($cart_data[$keys]);
                        $item_data = json_encode($cart_data);
                        // 쿠키 데이터의 보존시간
                        $preserve_time = 360;
                        setcookie("shoppig_cart", $item_data, time() - $preserve_time);
                        header("location:cart.php?remove=1");
                    }
                    
                }
            }
            if($_GET["action"] == "clear") {
                // clear 버튼을 눌렀을 때에 데이터 보존시간을 0으로 만들어서 데이터를 삭제한다.
                setcookie("shopping_cart", "", time() - $preserve_time);
                header("location:cart.php?clearall=1");
            }

        }

    	if(isset($_GET["success"])) {
            $message = '
            <div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                장바구니에 상품이 추가되었습니다.
            </div>
            ';
        }
        if(isset($_GET["remove"])) {
            $message = '
                <div class="alert alert-success alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Item removed from Cart
                </div>
            ';
        }
        if (isset($_GET["clearall"])) {
            $message = '
            <div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                장바구니를 비웠습니다...
            </div>
            ';
        }
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Welcome, 메인 페이지</title>
<link rel="stylesheet" type="text/css" href="/git_project/project/css/style_home.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<style>
  td {
    text-align: center;
    border-bottom:1px solid #CCC;
  }
   th {
    height:40px;
	  border-top:2px solid black;
	  border-bottom:1px solid #CCC;
	  font-weight: bold;
	  font-size: 17px;
  }
  #clear_cart_text {
    color:white;
    background-color:black;
  }
</style>
<body>
  <div class = "wrap">
    <header>
      <div id="login_area">
        <ul>
        <li><a href = "page/product_board/cart.php" target="main_area">장바구니 / </a?</li>
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
        <li><a href = "menu_intro.html" target="main_area">인테리어 소식</a></li>
        <li><a href = "/git_project/project/menu_album.php">앨범</a></li>
        <li><a href = "/git_project/project/menu_product_list.php">소품</a></li>
        <li><a href = "/git_project/project/menu_board.php">게시판</a></li>
      </ul>
    </nav>

   <article>
   <div style="clear:both"></div>
<br />
<h3>Order Details</h3>
<h1> Shopping Cart </h1>
<div class="table-responsive">
    <?php echo $message; ?>
<div align="right">
    <a href="cart.php?action=clear" id="clear_cart_text"><b>Clear Cart</b></a>
</div>
<table class="table table-bordered">
    <tr>
        <th width="40%">상품명</th>
        <th width="10%">수량</th>
        <th width="40%">가격</th>
        <th width="40%">Total</th>
        <th width="40%">Action</th>
    </tr>
<?php
    // 해당이름의 쿠키가 존재하는지 확인하기 위해 체크.
    if(isset($_COOKIE["shopping_cart"])) {
        // 장바구니 물품의 총 금액
        $total = 0;
        // 쿠키 데이터 배열에서 각 키값마다 가지고 있는 데이터를 구분하는 slash를 제거한다.
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        // slash를 제거하고 json을 번역한다.
        $cart_data = json_decode($cookie_data, true);
        // 번역한 데이터를 각 키값마다 뿌린다.
        foreach($cart_data as $keys => $values) {
    ?>
        <tr>
            <td>
              <img src="<?php echo $values["item_imgurl"];?>">
              <?php echo $values["item_name"]; ?>
            </td>
            <td><?php echo $values["item_quantity"]; ?>
            </td>
            <td><?php echo number_format ($values["item_price"]); ?>원
            </td>
            <td><?php echo number_format($values["item_quantity"] * $values["item_price"], 0); ?>원
            </td>
            <td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
        </tr>
        
    <?php
        $total = $total + ($values["item_quantity"] * $values["item_price"]);
        }
    ?>
    <?php
    } else {
        echo '
        <tr>
            <td colspan="5" align="center">No Item in Cart</td>
        </tr>
        ';
    }
    ?>
    </table>
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
