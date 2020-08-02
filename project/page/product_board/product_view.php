<?php
  include $_SERVER['DOCUMENT_ROOT']."/db_connection.php"; /* db load */
	$message = '';
	// 장바구니에 추가 버튼을 눌렀을 때의 작동
	if(isset($_POST["add_to_cart"])) {
		// 기존에 이미 장바구니 쿠키 데이터가 있었을 때의 작동
		if(isset($_COOKIE["shopping_cart"])) {
			// 기존의 쿠키 데이터의 slash를 분리하여 json 객체의 요소들을 분리한다.
			$cookie_data = stripslashes($_COOKIE["shopping_cart"]);
			$cart_data = json_decode($cookie_data, true);
		} else {
			// 기존의 쿠키 데이터가 존재하지 않는다면 새로운 배열을 만든다.
			$cart_data = array();
		}

		$item_id_list = array_column($cart_data, 'item_id');
		// 배열에 같은 아이템이 들어가 있을 경우의 작동
		if(in_array($_POST["hidden_id"], $item_id_list)) {
			// 같은 아이템이 이미 있었다면 수량만 더 추가된다.
			foreach($cart_data as $keys => $values) {
				if($cart_data[$keys]["item_id"] == $_POST["hidden_id"]) {
					$cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["quantity"];
				}
			}
		} else {
			// 배열에 같은 아이템이 없었을 때에는 새로운 배열에 아이템 정보를 넣는다.
			$item_array = array(
			'item_id'        => $_POST["hidden_id"],
			'item_name'      => $_POST["hidden_name"],
			'item_price'     => $_POST["hidden_price"],
      		'item_quantity'  => $_POST["quantity"],
      		'item_imgurl'    => $_POST["hidden_imgurl"]
			);
			$cart_data[] = $item_array;
		}
		// 만들어진 배열을 json 객체로 encode 한다.
		$item_data = json_encode($cart_data, JSON_UNESCAPED_UNICODE);
		$preserve_time = 3600;
		// 만들어진 json 객체를 쿠키 데이터로 생성한다.
		setcookie('shopping_cart', $item_data, time() + $preserve_time);
		// 쿠키 데이터를 장바구니 페이지로 넘긴다.
		header("location:product_cart.php?success=1");
	}

?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Welcome, 메인 페이지</title>
<link rel="stylesheet" type="text/css" href="/project/css/style_home.css">
<link rel="stylesheet" type="text/css" href="/project/css/style_product_view.css">
<script src="jquery-3.5.1.min.js"></script>
</head>
<body onload="init();">
<script language="JavaScript">

var hidden_price;
var quantity;

function init () {
	hidden_price = document.form.hidden_price.value;
	quantity = document.form.quantity.value;
  document.form.sum.value = hidden_price;

	change();
}

function add () {
	hm = document.form.quantity;
	sum = document.form.sum;
	hm.value ++ ;

  sum.value = parseInt(hm.value) * hidden_price;

}

function del () {
	hm = document.form.quantity;
	sum = document.form.sum;
		if (hm.value > 1) {
			hm.value -- ;
			sum.value = parseInt(hm.value) * hidden_price;
    }

}

function change () {
	hm = document.form.quantity;
	sum = document.form.sum;

		if (hm.value < 0) {
			hm.value = 0;
		}
  sum.value = parseInt(hm.value) * hidden_price;
}  



</script>
  <div class = "wrap">
    <header>
      <div id="login_area">
        <ul>
        <li><a href = "/project/page/product_board/product_cart.php">장바구니 / </a?</li>
          <?php
            //session_start();
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
        <li><a href = "/project/menu_album.php">앨범</a></li>
        <li><a href = "/project/menu_product_list.php">소품</a></li>
        <li><a href = "/project/menu_board.php">게시판</a></li>
      </ul>
    </nav>
    <?php
		$number = $_GET['idx']; /* bno함수에 idx값을 받아와 넣음*/
		//$hit = mysqli_fetch_array(mq("select * from products where idx ='".$number."'"));
		//$hit = $hit['hit'] + 1;
		//$fet = mq("update board set hit = '".$hit."' where idx = '".$number."'");
		$sql = mq("select * from products where idx='".$number."'"); /* 받아온 idx값을 선택 */
		$board = $sql->fetch_array();
	  ?>
    <article>
    <div class="grid-container" id="board_read">
      <div class="grid-item">
        <img src="<?php echo $board["imgurl"];?>">
      </div>
      <div class="grid-item">
        <h2><?php echo $board['name']; ?></h2>
        <div id="bo_line"></div>
			  <div class="product_description">
          가격: <?php echo number_format ($board['price']); ?> 원
        </div>
			  <div id="bo_line"></div>
		    <div class="product_description" id="bo_content">
			    "<?php echo nl2br("$board[comment]"); ?>"
		    </div>
			<div id="bo_line"></div>
			
		    <form method="post" name="form">
        <div class= "product_description">
            배송비: 착불
        </div>
        <div id="bo_line"></div>
        <div class= "product_description">수량</div>
          <input type="text" name="quantity" value="1" size="3" onchange="change();" class="form-control" style= width:50px; />
          <!-- //수량 변경 버튼 -->
          <input type="button" value=" + " onclick="add();"><input type="button" value=" - " onclick="del();"><br>
          <input type="hidden" name="hidden_name" value="<?php echo $board["name"];?>" />
          <input type="hidden" name="hidden_price" value="<?php echo $board["price"];?>" />
          <input type="hidden" name="hidden_id" value="<?php echo $board["idx"];?>" />
          <input type="hidden" name="hidden_imgurl" value="<?php echo $board["imgurl"];?>" />
        <div id="bo_line"></div>
        <div class= "product_description">Total Price</div>
        <div class= "product_description"><input type="text" name="sum" size="11" readonly />원</div>
        <div class="button_area">
		      <input type="submit" name="add_to_cart" class="button" value="Add to Cart" />
		</div>
		</form>
        <div class="button_area">
			<form method="post" action="product_buy.php">
				<input type="hidden" name="hidden_name" value="<?php echo $board["name"];?>" />
				<input type="hidden" name="hidden_price" value="<?php echo $board["price"];?>" />
				<input type="hidden" name="hidden_id" value="<?php echo $board["idx"];?>" />
				<input type="hidden" name="hidden_imgurl" value="<?php echo $board["imgurl"];?>" />
				

          	<input type="submit" name="buy" class="button" value="바로구매">
		</div>
			</form>
		    
      </div>
    </div>
    <div class="grid-item">
      <h1 id="product_details">상품설명</h1>
    </div>

	  <!-- 목록, 수정, 삭제 -->
	  <div id="bo_ser">
	  <ul>
	  <?php
		if(isset($_SESSION['userid'])) {
  			if ($_SESSION['userid'] == "admin") { ?>
			  		<li><a href="/">[목록으로]</a></li>
					<li><a href="modify_product.php?idx=<?php echo $board['idx']; ?>">[수정]</a></li>
					<li><a href="delete.php?idx=<?php echo $board['idx']; ?>">[삭제]</a></li>
		<?php
  			}
		} 
	  ?>
	  </ul>
	  </div>

    </article>
    <footer>
      ::: Contact : sinsy@gmail.com :::
    </footer>
  </div>

<body onload="javascript:openPopup('popup.html')">

</body>
</html>
