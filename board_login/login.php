<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>로그인</title>
</head>
<body>
  <h1>로그인</h1>
  <form action="login_proc.php" method="post">
    <div><input type="text" name="uid" placeholder="아이디"></div>
    <div><input type="password" name="upw" placeholder="비밀번호"></div>
    <div><input type="submit" value="로그인"></div>
  </form>
  <a href="join.php"><button>회원가입</button></a>
</body>
</html>