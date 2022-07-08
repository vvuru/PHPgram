<?php
    include_once "db/db_board.php";

    session_start();
    $login_user = $_SESSION["login_user"];
    // $i_user = $login_user["i_user"]; //     $i_user = $item["i_user"]; nono 돌겠네

    // if(isset($_SESSION["login_user"])) {
    //   $login_user = $_SESSION["login_user"];
    //   $i_user = $login_user["i_user"];
    // } else {
    //   $i_user = 1;
    // }

    $i_user=$_GET["i_user"];

    $param = [
      "i_user" => $i_user
    ];

    $list1 = sel_board_list1($param);
    $list2 = sel_board_list2($param);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/main.css">
  <title>ATM 자유로운 질문답변! - <?=isset($_SESSION["login_user"]) ? $login_user["i_user"] : "익명"?></title>
</head>

<body>
  <div class="container">
    <header>
      <div class="a_header">
        <div class="a_header_1">
          <div class="a_header_profile">
            <?php
                
                $session_img = $_SESSION["login_user"]["profile_img"];
                $profile_img = $session_img === null ? "atm_basic.png" : $_SESSION["login_user"]["i_user"]."/".$session_img;
                          ?>
              <span class="profile_img"><img src="img/profile/<?=$profile_img?>"></span>
              <span class="profile_nm"><?=isset($_SESSION["login_user"]) ? $login_user["nm"] : "익명"?></span>
          </div>
          <nav class="a_header_menu">
          <?php if(isset($_SESSION["login_user"])) { ?>
            <a href="logout.php">로그아웃</a>
          <?php } else { ?>
            <a href="login.php">로그인</a>
            <a href="join.php">회원가입</a>
          <?php } ?>   
          </nav>
        </div>
      </div>
    </header>
    <main>
      <div class="a_main">
        <div class="a_main_write">
          <div class="a_main_write_1">
            <span class="a_main_write_1_url">localhost/atm/main.php?i_user=<?=$i_user?></span>
            <span class="abc">
              <a href="#"><img src="img/fb_share.png" class="shareimg"></a>
              <a href="#"><img src="img/tw_share.png" class="shareimg"></a>
              <a href="#"><img src="img/kt_share.png" class="shareimg"></a>
              <a href="#"><img src="img/url_share.png" class="shareimg"></a>
            </span>
          </div>
          <div class="a_main_write_2">
            <form action="write_proc.php" method="post">
              <input type="hidden" name="i_user" value="<?=$i_user?>" readonly >
              <div class="a_main_write_2_txt"><textarea name="question" placeholder="질문을 입력해주세요."></textarea></div>
              <div class="a_main_write_2_button">
                  <input type="submit" value="질문하기">
                  <input type="reset" value="초기화">
              </div>
            </form>
          </div>
        </div>
        <div class="main_list">
          <!-- 리스트 뿌리기 -->
          <div class="tabs">
            <input id="all" type="radio" name="tab_item" checked>
            <label class="tab_item" for="all">답변완료</label>
            <input id="programming" type="radio" name="tab_item">
            <label class="tab_item" for="programming">새질문</label>

            <div class="tab_content" id="all_content">
                <?php foreach($list1 as $item) { ?>
                  <a href="detail.php?i_board=<?=$item["i_board"]?>"> <!-- 유레카!!!!! item에 담긴 i_board-->
                  <div class="tab_content_set">
                    <div>
                    <img src="img/profile/atm_basic.png" class="main_list_img">
                    <?=$item["question"]?>
                    </div>
                    <span class="tab_content_each"><img class="tab_content_each_profile" src="img/profile/<?=$i_user?>/<?=$item['profile_img']?>"></span>
                    <span class="tab_content_each"><?=$item["nm"]?></span>
                    <span class="tab_content_each"><a href="del.php?i_board=<?=$item["i_board"]?>"><img src="img/del.png" class="tab_content_each_del_img"></a></span>
                    <div class="tab_content_each"><?=$item["ans_at"]?></div>
                    <div class="tab_content_each"><?=$item["answer"]?></div>
                  </div> <!-- tab_content_set -->
                  </a>
                <?php } ?>
            </div> <!--tab_content-->
            <div class="tab_content" id="programming_content">
            <table style="width:100%; border-collapse:seperate; border-spacing: 0 5px;">
                    <?php foreach($list2 as $item2) { ?>
                        <?php if(isset($_SESSION["login_user"]) && $i_user==$login_user["i_user"]) { ?>
                        <tr onclick="location.href='answer.php?i_board=<?=$item2['i_board']?>'"
                        style="background-color:#fff; height:100px;">
                        <?php } ?>
                            <td><img src="img/profile/atm_basic.png" class="main_list_img"></td>
                            <td style="font-weight:bold; color:#666; font-size:18px;"><?=$item2["question"]?></td>
                            <td style="color:#666;"><?=$item2["que_at"]?></td>
                            <td><?php if(isset($_SESSION["login_user"]) && $i_user==$login_user["i_user"]) { ?>
                                <a href="del.php?i_board=<?=$item2["i_board"]?>"><img src="img/del.png"
                                style="width:40px; height:40px; float:right; margin-right: 30px;"></a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>     
                </table>   
            </div>
          </div> <!--tabs-->
        </div> <!--main_list-->
      </div> <!--a_main-->
    </main>
    <footer>
    <div class="a_footer">
            <div class="a_footer_answer"><a href="main.php?i_user=<?=$i_user?>"><img src="img/answer.png" class="a_footer_answer_img"></a></div>
            <div class="a_footer_profile"><a href="myprofile.php?i_user=<?=$i_user?>"><img src="img/profile.png" class="a_footer_profile_img"></a></div>
            <div class="a_footer_notice"><a href="new_noti.php?i_user=<?=$i_user?>"><img src="img/notice.png" class="a_footer_notice_img"></a>
            <!-- <?php if($count>0){echo "
            <span class='circle'><span class='visually-hidden'>New alerts</span></span>"; }
            ?> -->
            </div>
        <?php if(!isset($_SESSION["login_user"])) { ?>
        <div class="a_footer_login">로그인 후 사용 가능합니다.</div>
        <?php } ?>
      </div>
    </footer>
  </div>
</body>
</html>



<!--
-문제점-

1. 로그아웃시 메인페이지 에러 (세션으로 받아와서?????)

2. 프로필수정하고 난 뒤 소개글 사라지는 현상
-->