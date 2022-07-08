<?php
  include_once "db/db_board.php";

  session_start();
  $login_user = $_SESSION['login_user'];
  $i_user = $login_user['i_user'];
  $title = $_POST['title'];
  $ctnt = $_POST['ctnt'];

  $param = [
    "i_user" => $i_user,
    "title" => $title,
    "ctnt" => $ctnt
  ];
  
  $result = ins_board($param);

  if($result)
  {
    header("Location: list.php");
  }