<?php
// answer.php에서 답변하기 클릭시 동작. db t_board 해당 row answer컬럼에 insert 됨.
// 동작 후 해당 row의 detail.php 페이지로 이동함

include_once "db/db_board.php";
session_start();
$login_user=$_SESSION["login_user"];
$i_user=$login_user["i_user"];

$i_board=$_POST["i_board"];
$answer=$_POST["answer"];

$param=
[
    "i_user"=>$i_user,
    "i_board"=>$i_board,
    "answer"=>$answer,
];

$result=upd_board($param);
if($result)
{
    header("location:main.php?i_user=$i_user");
}

