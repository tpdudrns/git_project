<?php
    $product_name = $_POST['hidden_name'];
    $imgurl = $_POST['hidden_imgurl'];
    $price = $_POST['hidden_price'];
    $quantity = $_POST['hidden_quantity'];

?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Welcome, 메인 페이지</title>
<link rel="stylesheet" type="text/css" href="/git_project/project/css/style_home.css">
</head>
<style>
    td {
        text-align: center;
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
        <li><a href = "menu_intro.html" target="main_area">인테리어 소식</a></li>
        <li><a href = "/git_project/project/menu_album.php">앨범</a></li>
        <li><a href = "/git_project/project/menu_product_list.php">소품</a></li>
        <li><a href = "/git_project/project/menu_board.php">게시판</a></li>
      </ul>
    </nav>

   <article>
       <h1>Order / 주문하기</h1>
       <h2>회원 정보</h2>
       <table>
           <tr>
               <th>이름:</th>
               <th><textarea></textarea></th>
           </tr>
           <tr>
               <th>연락처:</th>
               <th><textarea></textarea></th>
           </tr>
           <tr>
               <th>이메일:</th>
               <th><textarea></textarea></th>
           </tr>
        </table>
        <h2>배송지 정보</h2>
            <input type="text" id="sample4_postcode" placeholder="우편번호">
            <input type="button" onclick="sample4_execDaumPostcode()" value="우편번호 찾기"><br>
            <input type="text" id="sample4_roadAddress" placeholder="도로명주소">
            <input type="text" id="sample4_jibunAddress" placeholder="지번주소"><br>
            <span id="guide" style="color:#999;display:none"></span>
            <input type="text" id="sample4_detailAddress" placeholder="상세주소">
            <input type="text" id="sample4_extraAddress" placeholder="참고항목">
        <h2>상품 정보</h2>
        <table>
        <tr>
            <th width="200px">상품 이미지</th>
            <th width="200px">상품명</th>
            <th width="200px">수량</th>
            <th width="200px">가격</th>
        </tr>
        <tr>
            <td id="product_name">
                <img src="<?php echo $imgurl?>">
            </td>
            <td>
                <?php echo $product_name ?>
            </td>
            <td>
                1
            </td>
            <td>
                <?php echo number_format ($price); ?> 원   
            </td>
        </tr>



        </table>


       

   

           


       





   </article>
    <footer>
      ::: Contact : sinsy@gmail.com :::
    </footer>
  </div>
<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
    //본 예제에서는 도로명 주소 표기 방식에 대한 법령에 따라, 내려오는 데이터를 조합하여 올바른 주소를 구성하는 방법을 설명합니다.
    function sample4_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 도로명 주소의 노출 규칙에 따라 주소를 표시한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var roadAddr = data.roadAddress; // 도로명 주소 변수
                var extraRoadAddr = ''; // 참고 항목 변수

                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraRoadAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                   extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraRoadAddr !== ''){
                    extraRoadAddr = ' (' + extraRoadAddr + ')';
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('sample4_postcode').value = data.zonecode;
                document.getElementById("sample4_roadAddress").value = roadAddr;
                document.getElementById("sample4_jibunAddress").value = data.jibunAddress;
                
                // 참고항목 문자열이 있을 경우 해당 필드에 넣는다.
                if(roadAddr !== ''){
                    document.getElementById("sample4_extraAddress").value = extraRoadAddr;
                } else {
                    document.getElementById("sample4_extraAddress").value = '';
                }

                var guideTextBox = document.getElementById("guide");
                // 사용자가 '선택 안함'을 클릭한 경우, 예상 주소라는 표시를 해준다.
                if(data.autoRoadAddress) {
                    var expRoadAddr = data.autoRoadAddress + extraRoadAddr;
                    guideTextBox.innerHTML = '(예상 도로명 주소 : ' + expRoadAddr + ')';
                    guideTextBox.style.display = 'block';

                } else if(data.autoJibunAddress) {
                    var expJibunAddr = data.autoJibunAddress;
                    guideTextBox.innerHTML = '(예상 지번 주소 : ' + expJibunAddr + ')';
                    guideTextBox.style.display = 'block';
                } else {
                    guideTextBox.innerHTML = '';
                    guideTextBox.style.display = 'none';
                }
            }
        }).open();
    }
</script>


</body>
</html>
