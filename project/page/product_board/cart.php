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
<html>
 <head>
 </head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <body>
<div style="clear:both"></div>
<br />
<h3>Order Details</h3>
<h1> Shopping Cart </h1>
<div class="table-responsive">
    <?php echo $message; ?>
<div align="right">
    <a href="cart.php?action=clear"><b>Clear Cart</b></a>
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
            <td><?php echo $values["item_name"]; ?>
            </td>
            <td><?php echo $values["item_quantity"]; ?>
            </td>
            <td><?php echo $values["item_price"]; ?>
            </td>
            <td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?>
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
    </body>
    </html>