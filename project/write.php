<!doctype html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" type="text/css" href="style_write.css" />
</head>
<body>
    <div id="board_write">
        <h1><a href="/">게시글 작성</a></h1>
            <div id="write_area">
<!--                 form 태그를 이용하여 post 형식으로 데이터 전달 -->
                    <form action="write_ok.php" method="post">
                    <div id="in_title">
                        <textarea name="title" id="user_title" rows="1" cols="55" placeholder="제목" maxlength="100" required></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_name">
                        <textarea name="name" id="user_name" rows="1" cols="55" placeholder="글쓴이" maxlength="100" required></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_content">
                        <textarea name="content" id="user_content" placeholder="내용" required></textarea>
                    </div>
                    <div id="in_pw">
                        <input type="password" name="pw" id="user_pw"  placeholder="비밀번호" required />  
                    </div>
                    <div class="btn_submit">
                        <button type="submit">글 작성</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
