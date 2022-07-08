<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            box-sizing: border-box;
            padding: 0; margin: 0;
        }
        html {
            background-color: #eee;
        }
        .logo, .login {
            margin-top: 30px;
            text-align: center;
        }
        .login__bt input{
            background-color: #0aaaaa;
            color: #fff;
            font-size: 15px;
            font-weight: bold;
        }
        input {
            padding: 10px;
            margin: 5px;
            width: 200px;
            height: 35px;
            border: 0px;
            border-radius: 10px;
        }
        a.login__agreement {
            margin-top: 30px;
            text-decoration: none;
            color: #0aaaaa;
            font-size: 5px;
        }
    </style>
</head>
<body>
    <div class="logo"><img src="img/atm_logo.png" width="200px"/></div>
        <div class="login">
            <form action="login_proc.php" method="post">
                <div><input type="text" name="email" placeholder="이메일"></div>
                <div><input type="password" name="upw" placeholder="비밀번호"></div>
                <div class="login__bt"><input type="submit" value="로그인"></div>
            </form>
            <div class="login">
                <a class="login__agreement" href="join.php">회원가입</a>
                <br>
                <a class="login__agreement" href="find.php">아이디/비밀번호 찾기</a>
                <br>
            </div>
            <div class="login">
                <a class="login__agreement" href="info.php">개인정보처리방침 | </a>
                <a class="login__agreement" href="service.php">이용약관</a>
                <br>
                <a class="login__agreement">help@asktm.kr</a>
            </div>
        </div>
</body>
</html>