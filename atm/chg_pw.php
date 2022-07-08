<?php
        include_once "db/db_user.php";

        session_start(); // 세션키고
        if(isset($_SESSION["login_user"])) { // 로그아웃시 에러x (예외처리) // if문 안 ture false
            $login_user = $_SESSION["login_user"];
        }
        $i_user = $login_user["i_user"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>비밀번호변경</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/chg_pw.css">
</head>
<body>
    <div class="Title">
        <div class="Title__top--name">비밀번호변경</div>
    </div>
    <form action="chg_pw_proc.php" method="post">
        <div class="line">
            <a class="tc__pw">현재 비밀번호</a>
            <span class="pr__ch"><input type="password" name="upw"  placeholder="현재 비밀번호를 입력하세요."></span>
        </div>
        <!--현재 비밀번호 : db에 현재 등록된 데이터와 일치하는지 확인-->
        <!-- css input 열 맞추기 -->
        <div class="line">
            <a class="tc__pw">새 비밀번호</a>
            <span class="pr__ch"><input type="password"  name="new_upw"  placeholder="새 비밀번호를 입력하세요."></span>
        </div>
        <!--새 비밀번호 : 변경할 비밀번호 입력-->
        <div class="line">
            <a class="tc__pw">새 비밀번호 확인</a>
            <span class="pr__ch"><input type="password" name="confirm_new_upw"  placeholder="새 비밀번호를 재입력하세요."></span>
        </div>
        <!--새 비밀번호 확인 : 위에 입력한 데이터와 일치하는지 확인-->
        <div class="bt">
            <span class="bt__sv"><input type="submit" value="저장하기"></span>
            <!--전부 일치할 시 동작해야함. 불일치 항목 js팝업? 혹은 하나라도 불일치시 팝업?-->
            <span class="bt__cs"><input type="button" value="취소하기" onClick="location.href='myprofile.php'"></span>
            <!-- myprofile.php페이지로 이동 -->
        </div>
    </form>
</body>
</html>