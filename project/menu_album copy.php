<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Welcome, 메인 페이지</title>
    <link rel="stylesheet" type="text/css" href="style_album.css">
    <link rel="stylesheet" type="text/css" href="style_home.css">
    <script src="/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class = "wrap">
        <header>
            <div id="login_area">
                <ul>
                    <li><a href = "test_login.php">로그인</a></li>
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
                <li><a href = "menu_album.php" target="main_area">앨범</a></li>
                <li><a href = "menu_album.php" target="main_area">소품</a></li>
                <li><a href = "menu_board.php" target="main_area">게시판</a></li>
            </ul>
        </nav>
        <!-- Control buttons -->
        <div id="myBtnContianer">
            <button class ="btn active" onclick= "filterSelection('all')"> Show All</button>
            <button class ="btn" onclick="filterSelection('concept')"> Concepts </button>
            <button class ="btn" onclick="filterSelection('size')"> Type </button>
        </div>
        <!-- The filterable elements. Note that some have multiple class names (this can be used if they belong to multiple categories) -->
        <div class="container">
            <form action = "menu_album_modern.php" method="get">  
                <button class="filterDiv concepts" name="modern">모던</button>
            </form>
            <form action = "menu_album_vintage.php" method="get"> 
                <button class="filterDiv concepts" name="vintage">빈티지</button>
            </form>
            <form action = "menu_album_europe.php" method="get"> 
                <button class="filterDiv concepts" name="europe">북유럽</button>
            </form>
            <form action = "menu_album_room.php" method="get">  
                <button class="filterDiv size" name="room">원룸</button>
            </form>
            <form action = "menu_album_furniture.php" method="get">  
                <button class="filterDiv size" name="20py">주택</button>
            </form>
            <form action = "menu_album_deco.php" method="get">  
                <button class="filterDiv size" name="30py">상업공간</button>
            </form>
        </div>    
        <section id="main">
            <section class="thumbnails">
                <div>
                    <div class="image_description">
                        <a href="images/vintage/vintage16.jpg">
                            <img src="images/vintage/vintage16.jpg" alt="" />
                            <h3> 텍스트 자리 </h3>    
                        </a>
                    </div>
                    <div class="image_description">
                        <a href="images/vintage/vintage17.jpg">
                            <img src="images/vintage/vintage17.jpg" alt="" />
                            <h3> 텍스트 자리 </h3>
                        </a>
                    </div>
                    <div class="image_description">
                        <a href="images/vintage/vintage18.jpg">
                            <img src="images/vintage/vintage18.jpg" alt="" />
                            <h3> 텍스트 자리 </h3>
                        </a>
                    </div>
                </div>
                <div>
                    <div class="image_description">
                        <a href="images/vintage/vintage10.jpg">
                            <img src="images/vintage/vintage10.jpg" alt="" />
                            <h3> 텍스트 자리 </h3>    
                        </a>
                    </div>
                    <div class="image_description">
                        <a href="images/vintage/vintage11.jpg">
                            <img src="images/vintage/vintage11.jpg" alt="" />
                            <h3> 텍스트 자리 </h3>
                        </a>
                    </div>                     
                    <div class="image_description">
                        <a href="images/vintage/vintage12.jpg">
                            <img src="images/vintage/vintage12.jpg" alt="" />
                            <h3> 텍스트 자리 </h3>
                        </a>
                    </div>
                </div>
                <div>
                    <div class="image_description">
                        <a href="images/vintage/vintage13.jpg">
                            <img src="images/vintage/vintage13.jpg" alt="" />
                            <h3> 텍스트 자리 </h3>    
                        </a>
                    </div>
                    <div class="image_description">
                        <a href="images/vintage/vintage14.jpg">
                            <img src="images/vintage/vintage14.jpg" alt="" />
                            <h3> 텍스트 자리 </h3>
                        </a>
                    </div>
                    <div class="image_description">
                        <a href="images/vintage/vintage15.jpg">
                            <img src="images/vintage/vintage15.jpg" alt="" />
                            <h3> 텍스트 자리 </h3>
                        </a>
                    </div>
                </div> 
            </div>
        </section>
        <footer>
            ::: Contact : sinsy@gmail.com :::
        </footer>
    </div>

<script>
filterSelection("all")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("filterDiv");
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}

function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);     
    }
  }
  element.className = arr1.join(" ");
}

// Add active class to the current button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}

    //Javascript
    var count = 0;
    //스크롤 바닥 감지
    window.onscroll = function(e) {
    //추가되는 임시 콘텐츠
        //window height + window scrollY 값이 document height보다 클 경우,
        if((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
    	//실행할 로직 (콘텐츠 추가)
        count++;
        var addContent = '<div class="image_description"><a href="images/vintage/vintage16.jpg"><img src="images/vintage/vintage16.jpg" alt="" /><h3> '+ count +'번째로 추가된 콘텐츠 </h3></a></div>';
                        
/*                             <a href="images/vintage/vintage16.jpg">
                            <img src="images/vintage/vintage16.jpg" alt="" />
                            <h3> 텍스트 자리 </h3>    
                            </a>
                        </div>';
                        '<div class="block"><p>'+ count +'번째로 추가된 콘텐츠</p></div>';
 */
        //article에 추가되는 콘텐츠를 append
        $('section').append(addContent);
        }
    };


</script>

</body>
</html>
