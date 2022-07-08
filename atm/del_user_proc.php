<?php
include_once "db/db_user.php";

//detail.php의 삭제버튼 클릭시 데이터베이스에서 t_board 해당 row 삭제


session_start();
$login_user = $_SESSION["login_user"];
$i_user = $login_user["i_user"];

$email = $_POST["email"];
$upw = $_POST["upw"];

$param = [
    "i_user" => $i_user,
    "email" => $email,
    "upw" => $upw
];
if ($email === $login_user["email"] && $upw === $login_user["upw"]) {
    $result = del_user($param);
    header("Location: login.php");
} else {
    header("Location: del_user.php");
}
?>

<!--
함수호출시
return값 있으면 =
없으면 그냥
-->