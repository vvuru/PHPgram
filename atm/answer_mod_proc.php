<?php
// answer_mod에서 수정하기 버튼 누를 시 동작함. db t_board 해당 row answer컬럼에 등록 되어있던 내용이 수정됨.
// 동작 후 해당 row의 detail.php 페이지로 이동함
    include_once "db/db_board.php";
    
    session_start();
    $login_user = $_SESSION["login_user"];
    $i_user = $login_user["i_user"];

    $i_board = $_POST["i_board"];
    $answer = $_POST["answer"];

    $param = [
        "i_board" => $i_board,
        "i_user" => $i_user,
        "answer" => $answer
    ];

    $result = upd_board($param);
    if($result){
        header("Location: detail.php?i_board=$i_board");
    }
?>

<!-- 세션 i_user 써야함 -->
<!-- mod = 로직detail + 화면write -->
<!-- mod = 로직detail(sel_board함수 또씀) + 화면write -->