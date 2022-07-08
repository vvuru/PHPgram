<?php
  include_once "db/db_board.php";
  $i_board = $_GET['i_board'];
  $page = $_GET['page'];
  $listing = "";
  if(isset($_GET['listing'])){
    $listing = "&listing={$_GET['listing']}";
  }
  $row_count = $_GET['row_count'];
  $search_select = "";
  $search_input_txt = "";
  if(isset($_GET['search_input_txt'])){
    $search_select = "&search_select={$_GET['search_select']}";
    $search_input_txt = "&search_input_txt={$_GET['search_input_txt']}";
    $search_input_txt1 = $_GET['search_input_txt'];
  }

  $param = ["i_board" => $i_board];
  $result = sel_board($param);
  $i_user = $result['i_user'];
  $mod = ""; $del = "";

  session_start();
  if(isset($_SESSION['login_user']))
  {
    $login_user = $_SESSION['login_user'];
    if($login_user['i_user'] === $i_user)
    {
      $mod = "<a href='mod.php?i_board=$i_board'><button>수정</button></a>";
      $del = "<button onclick='isDel()'>삭제</button>";
    }
  }
  
  //글이동
  $next_board = sel_next_board($param);
  $prev_board = sel_prev_board($param);

  $title = $result['title'];
  if(isset($_GET['search_input_txt']) && $_GET['search_input_txt'] != ""){
    $title = str_replace($search_input_txt1, "<mark>$search_input_txt1</mark>", $title);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$title?></title>
</head>
<body>
  <div><a href="list.php?page=<?=$page?><?=$listing?>&row_count=<?=$row_count?><?=$search_select?><?=$search_input_txt?>"><button>리스트</button></a></div>
  <div>
    <?php
      if($prev_board !== 0)
      {print "<a href='detail.php?i_board=$prev_board&page=$page&listing=$listing&row_count=$row_count'><button>이전글</button></a>";}
      if($next_board !== 0)
      {print "<a href='detail.php?i_board=$next_board&page=$page&listing=$listing&row_count=$row_count'><button>다음글</button></a>";}
    ?>
    </div>
  <div>
    <?=$mod?>
    <?=$del?>
  </div>
  <div>제목 : <?=$title?></div>
  <div>글쓴이 : <?=$result['nm']?></div>
  <div>등록일시 : <?=$result['created_at']?></div>
  <div>내용 : <?=$result['ctnt']?></div>
  <script>
    function isDel(){
      console.log('isDel 실행 됨!!');
      const result = confirm('삭제하시겠습니까?');

      if(result){
       location.href = "del.php?i_board=<?=$i_board?>";
      }
      
    }
  </script>
</body>
</html>