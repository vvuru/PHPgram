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
            cursor: pointer;
        }
        .cg_info {
            color: red;
            text-align: center;
            font-weight: bold;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="logo"><img src="img/atm_logo.png" width="200px"/></div>
    <div class="cg_info"><br>회원탈퇴 페이지입니다.<br>
     모든 정보는 삭제되고 복구할 수 없습니다.
    </div>
        <div class="login">
            <form action="del_user_proc.php" method="post">
                <div><input type="text" name="email" placeholder="이메일"></div>
                <div><input type="password" name="upw" placeholder="비밀번호"></div>
                <div class="login__bt"><input type="submit" value="회원탈퇴"></div>
            </form>
            <div class="join">
                <a class="login__agreement" onclick="history.back()">돌아가기</a>
                <br>
                <a class="login__agreement" href="service.php">이용약관 | </a>
                <a class="login__agreement">help@asktm.kr</a>
            </div>
        </div>
</body>
</html>