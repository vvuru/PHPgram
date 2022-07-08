<?php
  include_once "db/db_board.php";

  session_start();
  $nm = "";
  $ment = "";
  $log = "";
  $write = "";
  $profile = "";

  //헤더
  if(isset($_SESSION['login_user']))
  {
    $login_user = $_SESSION['login_user'];
    $nm = $login_user['nm'];
    $ment = "${nm}님 환영합니다.";
    $log = "<a href='logout.php'><button>로그아웃</button></a>";
    $write = "<a href='write.php'><button>글쓰기</button></a>";
    $profile = "<a href='profile.php'><button>프로필 사진 수정</button></a>";
  }
  else
  {
    $log = "<a href='login.php'><button>로그인</button></a>";
  }

  //페이징
  $page = isset($_GET['page'])? intval($_GET['page']) : 1;
  // if(!$page) {$page = 1;}
  // else{$page = intval($page);}
  $row_count = isset($_GET['row_count']) ? intval($_GET['row_count']) : 5;
  $param = [
    "row_count" => $row_count,
    "start_idx" => ($page - 1) * $row_count,
  ];
  $paging_count = sel_paging_count($param);
  $list = sel_board_list($param);

  //검색
  $search_select = "";
  $search_input_txt = "";
  if(isset($_GET['search_input_txt'])){
    if($_GET['search_input_txt'] != ""){
      $search_input_txt1 = $_GET['search_input_txt'];
      $search_select = "&search_select={$_GET['search_select']}";
      $search_input_txt = "&search_input_txt={$_GET['search_input_txt']}";
      $param += [
        "search_select" => $_GET["search_select"],
        "search_input_txt" => $_GET["search_input_txt"],
        "row_count" => $row_count,
        "start_idx" => ($page - 1) * $row_count
      ];
      $list = search_board($param);
      $paging_count = sel_paging_count($param);
      // $total_data = 0;
      // foreach($list as $item){
      //   $total_data++;
      // }
    }else{
      header("location: list.php");
    }
  }

  //정렬
  $row_count_list = [5, 10, 15, 20];
  $listing_list = ["A.i_board DESC", "A.views DESC"];
  $listing = "";
  $listing_txt = "";
  if(isset($_GET['listing']))
  {
    $listing = $_GET['listing'];
    $listing_txt = "&listing={$_GET['listing']}";
    $param = [
      "row_count" => $row_count,
      "start_idx" => ($page - 1) * $row_count,
      "listing" => $_GET['listing']
    ];
    $list = sel_listing($param);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="common.css">
  <style>
  </style>
  <title>리스트</title>
</head>
<body>
  <div id="container">
    <header>
      <div><?=$ment?></div>
      <div>
        <?=$write?>
        <?=$log?>
        <?=$profile?>
        <?php
          $session_img = isset($_SESSION['login_user']) ? $_SESSION['login_user']['profile_img'] : "";
          $profile_img = $session_img == null ? "basic.jpg" : $_SESSION['login_user']['i_user'] . "/" . $session_img;
          if(isset($_SESSION['login_user'])){
            print "<img class='circular__img circular__size40' src='/board_login/img/profile/$profile_img'>";
          }
        ?>
      </div>
    </header>
    <main>
      <h1>리스트</h1>
      <form action="" method="GET" id="listing">
        <select name="listing" onchange="this.form.submit()">
          <?php
            for ($i=0; $i < count($listing_list); $i++) { 
              sel_listing_val($listing, $listing_list[$i]);
            }
          ?>
        </select>
        <select name="row_count" onchange="this.form.submit()">
          <?php
            for($i=0; $i<count($row_count_list); $i++)
            { 
              echo sel_check($row_count, $row_count_list[$i]) . $row_count_list[$i] . "개</option>";
            }
          ?>
        </select>
      </form>
      <table>
        <tr>
          <th>글번호</th>
          <th>제목</th>
          <th>작성자명</th>
          <th>등록일시</th>
          <th>조회수</th>
        </tr>
        <?php
          while($row = mysqli_fetch_assoc($list))
          {
            $i_board = $row['i_board'];
            $title = $row['title'];
            if(isset($_GET['search_input_txt']) && $_GET['search_input_txt'] != ""){
              $title = str_replace($search_input_txt1, "<mark>$search_input_txt1</mark>", $title);
            }
            $nm = $row['nm'];
            $created_at = $row['created_at'];
            $views = $row['views'];
            $profile_img = $row['profile_img'];
            $i_user = $row['i_user'];

            print "<tr>";
            print "<td>$i_board</td>";
            print "<td><a href='views_proc.php?i_board=$i_board&page=$page{$listing_txt}&row_count=$row_count{$search_select}{$search_input_txt}'>$title</a></td>";
            if($profile_img == null){
              print "<td><img class='circular__img circular__size40' src='/board_login/img/profile/basic.jpg'>$nm</td>"; 
            }else{
              print "<td><img class='circular__img circular__size40' src='/board_login/img/profile/$i_user/$profile_img'>$nm</td>";
            }
            print "<td>$created_at</td>";
            print "<td>$views</td>";
            print "</tr>";
          }
        
        ?>
        <!-- foreach문
          <?php foreach($result as $item) { ?>
            <tr>
              <td><?=$item["i_board"]?></td>
              <td><a href="detail.php?i_board=<?=$item['i_board']?>"><?=$item["title"]?></a></td>
              <td><?=$item["nm"]?></td>
              <td><?=$item["created_at"]?></td>
            </tr>
          <?php } ?>
        -->
      </table>
      <div class="paging">
        <?php
          $total_data = sel_total_count();
          $block_page_num = 5;
          $now_block = ceil($page / $block_page_num);
          //$paging_count = ceil($total_data/$row_count);
          $total_block = ceil($paging_count / $block_page_num);
          $s_pageNum = ($now_block - 1) * $block_page_num + 1;
          if($s_pageNum <= 0)
          {
            $s_pageNum = 1;
          }
          $e_pageNum = $now_block * $block_page_num;
          if($e_pageNum > $paging_count)
          {
            $e_pageNum = $paging_count;
          }

          if($now_block > 1)
          {
            print "<a href='list.php?page=1{$listing_txt}&row_count=$row_count{$search_select}{$search_input_txt}'><button><<<</button></a>";
            print "<a href='list.php?page=" . $block_page_num * ($now_block - 2) + 1 . "{$listing_txt}&row_count=$row_count{$search_select}{$search_input_txt}'><button><<</button></a>";
          }
          if($page > 1)
          {
            print "<a href='list.php?page=" . $page - 1 . "{$listing_txt}&row_count=$row_count{$search_select}{$search_input_txt}'><button><</button></a>";           
          }
          for($i=$s_pageNum; $i<=$e_pageNum; $i++)
          { 
            $pageSelected = $i == $page ? "pageSelected" : "";
            print "<a href='list.php?page=$i{$listing_txt}&row_count={$row_count}{$search_select}{$search_input_txt}'><span class='$pageSelected'>$i  </span></a>";
          }
          if($page < $paging_count)
          {
            print "<a href='list.php?page=" . $page + 1 . "{$listing_txt}&row_count=$row_count{$search_select}{$search_input_txt}'><button>></button></a>";
          }
          if($now_block < $total_block)
          {
            print "<a href='list.php?page=" . $block_page_num * $now_block + 1 . "{$listing_txt}&row_count=$row_count{$search_select}{$search_input_txt}'><button>>></button></a>";
            print "<a href='list.php?page=" . $block_page_num * ($total_block - 1) + 1 . "{$listing_txt}&row_count=$row_count{$search_select}{$search_input_txt}'><button>>>></button></a>";
          }
        ?>
      </div>
        <form method="GET" action="list.php" id="search">
          <div>
            <select name="search_select">
              <option value="search_writer">작성자</option>
              <option value="search_title">제목</option>
              <option value="search_ctnt">제목+내용</option>
            </select>
            <div>
              <input type="search" name="search_input_txt">
              <input type="submit" value="검색">
            </div>
          </div>
        </form>
    </main>
  </div>

</body>
</html>