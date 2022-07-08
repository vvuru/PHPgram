<?php
//chg_pw.php에서 저장하기 버튼 누를시 동작하며 t_user 해당 row의 upw 컬럼 수정됨
//동작 후 myprofile.php로 돌아감

include_once "db/db_user.php";

$upw = $_POST["upw"];
$new_upw = $_POST["new_upw"];
$confirm_new_upw = $_POST["confirm_new_upw"];

$param = [
    "upw" => $upw,
    "new_upw" => $new_upw,
    "confirm_new_upw" => $confirm_new_upw,
];

$result = upd_upw($param);


if($result)
{
    header("location:myprofile.php");
}
    