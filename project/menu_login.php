<form method="POST" id="loginForm">
    <div>
        <label for="loginId">아이디</label>
        <input type = "email" id="loginId" name="loginId" placeholder="ID">
        <p>
        <label for="loginPw">비밀번호</label>
        <input type="password" id = "loginPw" name="password" placeholder="Password">
        </p>
    </div>
    <button type="submit" disabled="disabled">로그인</button>
    <div>
        <input type="checkbox" id="keepLogin" name="keepLogin">
        <label for="keepLogin"><span>로그인 상태 유지</span></label>
    </div>
</form>