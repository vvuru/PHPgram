<?php   
    include_once "db/db_user.php";

    session_start(); // 세션키고
    if(isset($_SESSION["login_user"])) { // 로그아웃시 에러x (예외처리) // if문 안 ture false
        $login_user = $_SESSION["login_user"];
    }
    $i_user = $login_user["i_user"];

    $param = [
        "i_user" => $i_user
    ];
    $item = sel_profile($param);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>프로필설정</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/myprofile.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .Profile input {
        display: none;
        }

        .Profile img {
            margin: 20px 0 0 0;
            width: 200px;
            height: 200px;
            object-fit: cover;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="Title">
        <div class="Title__top--name">프로필설정</div>
    </div>
    <form action="myprofile_proc.php" method="post" enctype="multipart/form-data">
        <div class="Profile"> 
            <label class="input-file-button" for="input-file"><img src="img/profile/<?=$i_user?>/<?=$item['profile_img']?>" id="preview"></label>
            <input onchange="readURL(this);" type="file" name="img" id="input-file" accept="image/*">
            <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('preview').src = e.target.result;
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    document.getElementById('preview').src = "";
                }
            }
            </script>
        </div>
        <div class="line">   
            <a class="tc__un">이메일</a>
            <a class="pr__un"><?=$item["email"]?></a>
            <!--db t_user 해당 row의 email 값 불러오기-->
        </div>
        <div class="line">
            <a class="tc__un">주&nbsp;&nbsp;&nbsp;소</a>
            <a class="pr__un">http://asktm.kr/<?=$item["i_user"]?></a>
        </div>
        <div class="line">   
            <a class="tc__ch">닉네임</a>
            <a class="pr__ch"><input type="text" value="<?=$item["nm"]?>" placeholder="닉네임을 작성해주세요."></a>
            <!-- css 모바일 크기로 볼 시 줄 밀림, 위치고정 후 줄바뀜시 해당 위치에서 세로길이 늘어나게끔 -->
        </div>
        <div class="line"> 
            <a class="tc__ch">소&nbsp;&nbsp;&nbsp;개</a>
            <a class="pr__ch"><input type="text" value="<?=$item["intro"]?>" placeholder="소개글을 작성해주세요."></a>
        </div>
        <div class="line__pi">개인정보</div>
        <div class="line">  
            <a class="tc__ch">비밀번호 변경</a>
            <a><input type="button" class="pr__bt" src="img/go.png" onClick="location.href='chg_pw.php'"></a>
            <!--css 인풋 타입 이미지로 변경시 myprofile_proc 실행됨, 백그라운드 이미지로 이미지 우측정렬 구현 필요-->
        </div>
        <div class="line">  
            <a class="tc__ch">회원탈퇴</a>
            <a><input type="button" class="pr__bt" src="img/go.png" onClick="location.href='del_user.php'"></a>
        </div>
        <div class="save__bt">
            <input type="submit" value="저장하기">
        </div> 
        <!-- css 모바일 크기로 볼 시 버튼 푸터랑 겹침, 띄워주기 -->
    </form>
    <footer class="a_footer">
        <div class="a_footer_answer"><a href="main.php?i_user=<?=$i_user?>"><img src="img/answer.png" class="a_footer_answer_img"></a></div>
        <div class="a_footer_profile"><a href="myprofile.php"><img src="img/profile.png" class="a_footer_profile_img"></a></div>
        <div class="a_footer_notice"><a href="new_noti.php"><img src="img/notice.png" class="a_footer_notice_img"></a></div>
    </footer>
    </div>
</body>
</html>