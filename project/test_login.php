<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>로그인</title>
</head>
<style>
  ul {padding: 0;}
  li {list-style:none;}
  .login { width: 410px; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);}
  .login h2 { padding: 0 0 10px; font-size: 32px; color: #111; border-bottom: 2px solid #000;
  text-align: center;}
  .login li { padding: 0 0 12px;}
  .login li input { width: 100%; height: 46px; box-sizing: border-box; }
  .login button { border: 0; outline: 0; width: 100%; height: 56px; box-sizing: border-box; background: red; color: white; font-size: 18px;}

</style>
<body>
  <form action="login_action.php" method="post">
  <section class="login">
    <h2>로그인</h2>
    <ul>
      <li><input type="text" name= "id" placeholder="아이디" title="아이디 입력"></li>
      <li><input type="password" name= "pw" placeholder="비밀번호" title="비밀번호 입력"></li>
      <li><input type="submit" value="로그인"></li>
    </ul>
    <div>
      <a href= "open_account.php">"회원가입"</a>
    </div>
  </section>
  </form>


</body>
</html>
