<?php
  include_once "db/db_board.php";

  $i_board = $_POST['i_board'];
  $title = $_POST['title'];
  $ctnt = $_POST['ctnt'];

  session_start();
  if(isset($_SESSION['login_user']))
  {
    $login_user = $_SESSION['login_user'];
    $i_user = $login_user['i_user'];
  }

  $param = [
    "i_board" => $i_board,
    "i_user" => $i_user,
    "title" => $title,
    "ctnt" => $ctnt
  ];
  $result = upd_board($param);
  if($result)
  {
    header("Location: detail.php?i_board=$i_board");
  }
?>