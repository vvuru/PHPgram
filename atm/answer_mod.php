<?php
    include_once "db/db_board.php";   
    $i_board = $_GET["i_board"];
    $param = [
        "i_board" => $i_board
    ];
    $item = sel_board($param);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/answer_mod.css">
    <title>수정하기</title>
</head>
<body>
    <div class="Title">
        <div class="Title__top--name">수정하기</div>
    </div>
    <form action="answer_mod_proc.php" method="post">
        <input type="hidden" name="i_board" value="<?=$i_board?>" readonly>
        <div class="line">
        <span class="Profile__img"><img src="img/ATM_basic.png"></span>
            <!-- 익명일 시 기본프사, 로그인 후 프로필 공개 질문시 해당 회원 프사 띄워야하나 보류기능이므로 기본프사 이미지 삽입 -->
            <a class="question"><?=$item["question"]?></a>
            <!-- db t_board 테이블의 해당 row question 컬럼 데이터 가져오기 -->
            <a><?=$item["que_at"]?></a>
            <!-- db t_board 테이블의 해당 row que_at 컬럼 SNS 방식?으로 띄우기 -->
        </div>
        <!-- css 상하 가운데정렬하고 좌우 간격줘서 좌측정렬 -->
        <!-- 이 부분 detail.php와 코드 동일함 -->
        <div>
            <span class="ta_md"><textarea name="answer" placeholder="성희롱 및 욕설은 처벌대상입니다. 최대 1000자까지 작성 가능합니다."><?=$item["answer"]?></textarea></span>
            <!-- db t_board 테이블의 해당 row answer 컬럼 데이터 가져오기 -->
        </div>
        <div class="bt">
            <span class="bt__md"><input type="submit" value="수정하기"></span>
            <!-- answer_mod_proc.php 실행됨 -->
            <span class="bt__cs">
                <a href="detail.php?i_board=<?=$i_board?>"><input type="button" value="취소하기"></a>
            </span>
            <!-- detail.php 페이지로 돌아감 -->
        </div>
    </form>
</body>
</html>