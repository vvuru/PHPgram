<?php
    include_once "db/db_board.php";

    session_start(); // 세션키고
    if(isset($_SESSION["login_user"])) { // 로그아웃시 에러x (예외처리) // if문 안 ture false
        $login_user = $_SESSION["login_user"];
    }
    $i_board = $_GET["i_board"];
    $param = [
        "i_board" => $_GET["i_board"],
    ];
    $item = sel_board($param);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>상세보기</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/detail.css">
</head>
<body>
    <div class="Title">
        <div class="Title__top--name">상세보기</div>
    </div>
    <div class="line">
    <span class="Profile__img"><img src="img/profile/atm_basic.png"></span>
        <!-- 익명일 시 기본프사, 로그인 후 프로필 공개 질문시 해당 회원 프사 띄워야하나 보류기능이므로 우선 기본프사 이미지 삽입 -->
        <a class="question"><?=$item["question"]?></a> <!--질문내용-->
        <!-- db t_board 테이블의 해당 row question 컬럼 데이터 가져오기 -->
        <a><?=$item["que_at"]?></a> <!--질문 작성시간-->
        <!-- db t_board 테이블의 해당 row que_at 컬럼 SNS 방식?으로 띄우기 -->
    </div>
    <!-- css 상하 가운데정렬하고 좌우 간격줘서 좌측정렬 -->
    <div class="line">
        <div>
            <a> <?php
                
                $session_img=$_SESSION["login_user"]["profile_img"];
                $profile_img= $session_img==null ? "atm_basic.png" : $_SESSION["login_user"]["i_user"]."/".$session_img;
                          ?>
              <img src="img/profile/<?=$profile_img?>" class="profile"></a> <!--답변자 프사-->
            <!-- t_board 테이블과 t_user테이블 i_user 값으로 묶어줘서 t_user 테이블의 해당 row profile_img 컬럼 값 가져오기 -->
            <!-- css 간격줘서 좌측에 -->
            <a><?=$item["nm"]?></a> <!--답변자 닉네임-->
            <!-- t_board 테이블과 t_user테이블 i_user 값으로 묶어줘서 t_user 테이블의 해당 row nm 컬럼 값 가져오기 -->
            <!-- css 프사 공간만큼 띄우고 좌상단 -->
            <a><?=$item["ans_at"]?></a> <!--답변 작성시간-->
            <!-- db t_board 테이블의 해당 row ans_at 컬럼 SNS 방식?으로 띄우기 -->
            <!-- css 닉네임과 같은 간격 띄우고 좌 하단 -->
        </div>
        <div><?=$item["answer"]?></div><!--답변 내용-->
        <!-- db t_board 테이블의 해당 row answer 컬럼 데이터 가져오기 -->
        <!-- css 프사공간만큼 띄우고 간격줘서 좌측정렬 -->
</div>
    <div class="bt">
        <?php if(isset($_SESSION["login_user"]) && $login_user["i_user"] === $item["i_user"]) { ?>
            <a class="bt__a" href="answer_mod.php?i_board=<?=$i_board?>"><button>수정하기</button></a>
            <!-- answer_mod.php로 이동 -->
            <a class="bt__a" href="del.php?i_board=<?=$i_board?>"><button>삭제하기</button></a>
            <!-- del.php 작동전 js로 삭제할건지? 팝업창. 확인 후 바로 삭제되도록. -->
                <?php } ?>

            <a class="bt__b" href="main.php?i_user=<?=$item["i_user"]?>"><button id="backBt">돌아가기</button></a>
            <!-- <a class="bt__b"><button id="backBt" onclick="history.back()">돌아가기</button></a> -->
            <!-- 직전 페이지로 이동 -->
    </div>
    <!-- css 모바일 화면에서 버튼 밀림 -->
</body>
</html>