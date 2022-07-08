<?php
  include_once "db/db_board.php";
  $i_board = $_GET['i_board'];

  session_start();
  if(isset($_SESSION['login_user']))
  {
    $login_user = $_SESSION['login_user'];
    $i_user = $login_user['i_user'];
  }

  $param = [
    "i_board" => $i_board,
    "i_user" => $i_user
  ];

  $result = del_board($param);
  if($result)
  {
    header("Location: list.php");
  }
?>