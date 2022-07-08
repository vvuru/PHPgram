<?php
    session_start();
    $login_user = $_SESSION["login_user"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>글쓰기</title>
</head>
<body>
  <h1>글쓰기</h1>
  <form action="write_proc.php" method="post">
    <div><input type="text" name="title" placeholder="제목"></div>
    <div><textarea name="ctnt" placeholder="내용"></textarea></div>
    <div>
      <input type="submit" value="글쓰기">
      <input type="reset" value="초기화">
    </div>
  </form>
</body>
</html>