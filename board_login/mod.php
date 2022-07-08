<?php
  include_once "db/db_board.php";
  $i_board = $_GET['i_board'];
  $param = ["i_board" => $i_board];

  $result = sel_board($param);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>글수정</title>
</head>
<body>
  <h1>글수정</h1>
  <form action="mod_proc.php" method="post">
    <div><input type="text" name="title" value="<?=$result['title']?>"></div>
    <div><textarea name="ctnt"><?=$result['ctnt']?></textarea></div>
    <input type="hidden" name="i_board" value="<?=$i_board?>">
    <div>
      <input type="submit" value="글수정">
      <input type="reset" value="초기화">
    </div>
  </form>
</body>
</html>