<?php
include_once "db/db_board.php";

// session_start();

$question = $_POST["question"];
$i_user=$_POST["i_user"];

// $login_user = $_SESSION["login_user"]; // 로그인 pk값
// $i_user = $login_user["i_user"]; // 글쓴이 pk값

$param = [
    "i_user" => $i_user, // Q 왜받아오지? 어디쓰려고?
    "question" => $question,
];

$result = ins_board($param); // 배열로 묶어서 보내줌. 결과는 1넘어옴(true)
if($result) { // 1 넘어왔으니(true) 주소값이동
    Header("Location: main.php?i_user=$i_user");
}
//t_board에 insert 완료 후 main.php로 이동.