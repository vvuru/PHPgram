<?php
  session_start();
  if(!isset($_SESSION['login_user'])){
    print 
    " <script>
        alert('로그인 해주세요');
        history.back();
      </script>
    ";
    exit();
  }

  include_once "db/db_board.php";

  $i_board = $_GET['i_board'];
  $page = $_GET['page'];
  $listing = "";
  if(isset($_GET['listing'])){
    $listing = "&listing={$_GET['listing']}";
  }
  $row_count = $_GET['row_count'];
  if(isset($_GET['search_input_txt'])){
    $search_select = "&search_select={$_GET['search_select']}";
    $search_input_txt = "&search_input_txt={$_GET['search_input_txt']}";
  }
  $param = [
    "i_board" => $i_board
  ];

  upd_views($param);
  header("Location: detail.php?i_board=$i_board&page=$page{$listing}&row_count=$row_count{$search_select}{$search_input_txt}");