<?php
   include_once "db/db_board.php";
//    session_start();
//    $login_user=$_SESSION["login_user"];
//    $i_user=$login_user["i_user"];

   $i_board=$_GET["i_board"];
   
//    $question=$_POST["question"];
//    $que_at=$_POST["que_at"];
//    $profile_img=$_POST["profile_img"];
//    $nm=$_POST["nm"];
//    $ans_at=$_POST["ans_at"];
//    $created_at=$_POST["created_at"];
//    $answer=$_POST["answer"];
   
   $param=
   [
    //    "i_user"=>$i_user,
    //    "question"=>$question,
    //    "que_at"=>$que_at,
    //    "profile_img"=>$profile_img,
    //    "nm"=>$nm,
    //    "ans_at"=>$ans_at,
    //    "created_at"=>$created_at,
    //    "answer"=>$answer,
       "i_board"=>$i_board
   ];

   $item=sel_question($param);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>답변하기</title>
    <style>
    * {
        box-sizing: border-box;
        padding: 0; margin: 0;
        }
    html {
        background-color: #eee;
        }

    .Title__top--name {
            font-size: 17px;
            font-weight: bold;
            color: #fff;
            background-color: #0aaaaa;
            text-align: center;
            line-height: 50px;
        }

    .line {
        margin: 8px 0px;
        background-color: #ffffff;
        line-height: 50px;
        }
    .Profile__img img {
        width: 50px;
        height: 50px;
        }
    .ta_an textarea {
        width: 100%;
        height: 300px;
        font-size: 17px;
        border: 0;
        outline: none;
        background-color: #fff;
        resize: none;
        }
    .bt {
        margin: 30px;
        text-align: center; 
        } 
    .bt input {
        font-size: 15px;
        font-weight: bold;
        padding: 10px;
        margin: 5px;
        width: 200px;
        height: 35px;
        border: 0px;
        border-radius: 10px;
        }
    .bt .bt__an input {
        color: #fff;
        background-color: #0aaaaa;
        }

    .bt .bt__cs input {
        color: #0aaaaa;
        background-color: #fff;
        }
    </style>
</head>
<body>
    <div class="Title">
        <div class="Title__top--name">답변하기</div>
    </div>
    <form action="answer_proc.php" method="post">
        <div class="line">
        <span class="Profile__img"><img src="img/profile/atm_basic.png"></span>
            <!-- 익명일 시 기본프사, 로그인 후 프로필 공개 질문시 해당 회원 프사 띄워야하나 보류기능이므로 기본프사 이미지 삽입 -->
            <a>질문내용: <?=$item["question"]?></a>
            <!-- db t_board 테이블의 해당 row question 컬럼 데이터 가져오기 -->
            <a>질문 작성시간: <?=$item["que_at"]?></a>
            <!-- db t_board 테이블의 해당 row que_at 컬럼 SNS 방식?으로 띄우기 -->
            <!-- css 상하 가운데정렬하고 좌우 간격줘서 좌측정렬 -->
            <!-- 이 부분 detail.php와 코드 동일함 -->
        </div>
        <div>
            <a class="ta_an"><textarea name="answer" placeholder="성희롱 및 욕설은 처벌대상입니다. 최대 1000자까지 작성 가능합니다."></textarea></a>
            <!-- css textarea 좌우 간격 띄우기 -->
            <input type="hidden" name="i_board" value="<?=$i_board?>" readonly>
        </div>
        <div class="bt">
            <span class="bt__an"><input type="submit" value="답변하기"></span>
            <!-- answer_proc.php 동작함 -->
            <span class="bt__cs"><input type="button" value="취소하기" onClick="history.back()"></span>
            <!-- 직전 페이지로 돌아감 -->
        </div>
    </form>
</body>
</html>