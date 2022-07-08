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
    .logo, .join{
            margin-top: 30px;
            text-align: center;
        }
    input {
        padding: 10px;
        margin: 5px;
        width: 200px;
        height: 35px;
        border: 0px;
        border-radius: 10px;
    }
    .join__bt input{
        color: #fff;
        background-color: #0aaaaa;
        font-size: 15px;
        font-weight: bold;
    }
    a.join__agreement {
            margin-top: 30px;
            text-decoration: none;
            color: #0aaaaa;
            font-size: 5px;
    }   
    </style>
</head>
<body>
    <div class="logo"><img src="img/atm_logo.png" width="200px"/></div>
        <div class="join">
            <form action="join_proc.php" method="post">
                <div><input type="text" name="nm" placeholder="닉네임"></div>
                <div><input type="email" name="email" placeholder="이메일" maxLength="30" required></div>
                <div><input type="password" name="upw" placeholder="비밀번호"></div>
                <div><input type="password" name="confirm_upw" placeholder="비밀번호 확인"></div>
                <div class="join__bt">
                    <input type="submit" value="회원가입">
                </div>
            </form>
        </div>
        <div class="join">
            <a class="join__agreement" href="login.php">돌아가기</a>
            <br>
            <a class="join__agreement" href="service.php">이용약관 | </a>
            <a class="join__agreement">help@asktm.kr</a>
        </div>
</body>
</html>