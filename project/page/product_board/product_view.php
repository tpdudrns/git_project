<?php
  //include $_SERVER['DOCUMENT_ROOT']."/db_connection.php"; /* db load */
  include "db_connection.php";
	$message = '';

	if(isset($_POST["add_to_cart"])) {
		if(isset($_COOKIE["shopping_cart"])) {
			$cookie_data = stripslashes($_COOKIE["shopping_cart"]);
			$cart_data = json_decode($cookie_data, true);
		} else {
			$cart_daata = array();
		}

		$item_id_list = array_column($cart_data, 'item_id');

		if(in_array($_POST["hidden_id"], $item_id_list)) {
			foreach($cart_data as $keys => $values) {
				if($cart_data[$keys]["item_id"] == $_POST["hidden_id"]) {
					$cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["quantity"];
				}
			}
		} else {
			$item_array = array(
			'item_id'        => $_POST["hidden_id"],
			'item_name'      => $_POST["hidden_name"],
			'item_price'     => $_POST["hidden_price"],
			'item_quantity'  => $_POST["quantity"]
			);
			$cart_data[] = $item_array;
		}

		$item_data = json_encode($cart_data);
		$preserve_time = 360;
		setcookie('shopping_cart', $item_data, time() + $preserve_time);
		header("location:cart.php?success=1");
	}

	if(isset($_GET["action"])) {
		if($_GET["action"] == "delete") {
			$cookie_data = stripslashes($_COOKIE['shopping_cart']);
			$cart_data = json_decode($cookie_data, true);
			foreach($cart_data as $keys => $values) {
				if($cart_data[$keys]['item_id'] == $_GET["id"]) {
					unset($cart_data[$keys]);
					$item_data = json_encode($cart_data);
					setcookie("shoppig_cart", $item_data, time() + $preserve_time);
					header("location:cart.php?remove=1");
				}
				
			}
		}
	}

	if(isset($_GET["success"])) {
		$message = '
		<div class="alert alert-success alert-dismissable">
			<a href="/project/main.php" class="close" data-dismiss="alert"
				aria-label="close">$times;</a?
			Item Added into Cart
		</div>
		';
	}
	if(isset($_GET["remove"])) {
		$message = '
			<div class="alert alert-success alert-dismissable">
				<a href="/project/main.php" class="close" data-dismiss="alert"
					aria-label="close">$times;</a>
				Item removed from Cart
			</div>
		';
	}
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Welcome, 메인 페이지</title>
<link rel="stylesheet" type="text/css" href="/git_project/project/css/style_home.css">
<link rel="stylesheet" type="text/css" href="/git_project/project/css/style_product_view.css">
</head>
<body>
  <div class = "wrap">
    <header>
      <div id="login_area">
        <ul>
        <li><a href = "page/product_board/cart.php" target="main_area">장바구니 / </a?</li>
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
        <li><a href = "main.php">홈</a></li>
        <li><a href = "menu_intro.html" target="main_area">인테리어 소식</a></li>
        <li><a href = "/git_project/project/menu_album.php">앨범</a></li>
        <li><a href = "/git_project/project/menu_product_list.php">소품</a></li>
        <li><a href = "/git_project/project/menu_board.php">게시판</a></li>
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
      <div class="grid-item" style=padding-left:60px;>
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
		    <form method="post">
        <div class= "product_description">
            배송비: 착불
        </div>
        <div id="bo_line"></div>
        <div class= "product_description">수량</div>

		      <input type="text" name="quantity" value="1" class="form-control" style= width:50px; />
          <input type="hidden" name="hidden_name" value="<?php echo $board["name"];?>" />
          <input type="hidden" name="hidden_price" value="<?php echo $board["price"];?>" />
          <input type="hidden" name="hidden_id" value="<?php echo $board["idx"];?>" />
        <div id="bo_line"></div>
        <div class= "product_description">Total Price</div>
        <div class="button_area">
		      <input type="submit" name="add_to_cart" class="button" value="Add to Cart" />
        </div>
        <div class="button_area">
          <button class="button">바로구매</button>
        </div>
		    </form>
      </div>
    </div>
    <div class="grid-item">상품설명</div>

	  <!-- 목록, 수정, 삭제 -->
	  <div id="bo_ser">
		<ul>
			<li><a href="/">[목록으로]</a></li>
			<li><a href="modify_alpha.php?idx=<?php echo $board['idx']; ?>">[수정]</a></li>
			<li><a href="delete.php?idx=<?php echo $board['idx']; ?>">[삭제]</a></li>
		</ul>
	  </div>
    </article>
    <footer>
      ::: Contact : sinsy@gmail.com :::
    </footer>
  </div>
<script type="text/javascript">   
  function calc(val){
    var origin = parseInt(val);
    var quantity = parseInt(val);
    var total = quantity*origin;
    
    if(val == ""){
        document.getElementById('result').value = "0";
    }else{
        document.getElementById('result').value = interest;
    }
  }

</script>
<body onload="javascript:openPopup('popup.html')">

</body>
</html>
