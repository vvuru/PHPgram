<?php
  include_once "db.php";

  function ins_board(&$param)
  {
    $i_user = $param['i_user'];
    $title = $param['title'];
    $ctnt = $param['ctnt'];

    $sql =
    " INSERT INTO t_board (title, ctnt, i_user)
      VALUES ('$title', '$ctnt', $i_user)
    ";

    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    return $result;
  }

  function sel_paging_count(&$param)
  {
    $row_count = $param['row_count'];
    $sql = 
    " SELECT ceil(count(i_board) / $row_count) as cnt
      FROM t_board
    ";
    if(isset($param['search_input_txt']) && $param['search_input_txt'] !== ""){
      $sql .= 
      " WHERE title LIKE '%{$param['search_input_txt']}%'";
    }
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    $row = mysqli_fetch_assoc($result);
    return $row['cnt'];
  }

  function sel_board_list(&$param)
  {
    $row_count = $param['row_count'];
    $start_idx = $param['start_idx'];

      $sql =
    " SELECT A.i_board, A.title, B.nm, A.created_at, A.views, B.profile_img, B.i_user
      FROM t_board A
      INNER JOIN t_user B
      ON A.i_user = B.i_user
      ORDER BY A.i_board DESC
      LIMIT $start_idx, $row_count
    ";
    
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    return $result;
  }

  function sel_board(&$param)
  {
    $i_board = $param['i_board'];
    $sql = 
    " SELECT A.title, B.nm, A.created_at, A.ctnt, A.i_user
      FROM t_board A
      INNER JOIN t_user B
      ON A.i_user = B.i_user
      WHERE A.i_board = $i_board
    ";

    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    return mysqli_fetch_assoc($result);
  }

  function sel_next_board(&$param)
  {
    $i_board = $param['i_board'];
    $sql = 
    " SELECT i_board
      FROM t_board
      WHERE i_board > $i_board
      ORDER BY i_board
      LIMIT 1
    ";

    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    $row = mysqli_fetch_assoc($result);
    if($row)
    {
      return $row['i_board'];
    }
    else{return 0;}
  }

  function sel_prev_board(&$param)
  {
    $i_board = $param['i_board'];
    $sql = 
    " SELECT i_board
      FROM t_board
      WHERE i_board < $i_board
      ORDER BY i_board DESC
      LIMIT 1
    ";

    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    $row = mysqli_fetch_assoc($result);
    if($row)
    {
      return $row['i_board'];
    }
    else{return 0;}
  }

  function sel_total_count()
  {
    $sql = "SELECT count(i_board) as total FROM t_board";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
  }

  function sel_check(&$row_count, &$count)
  {
    if($row_count == $count)
    {
      print "<option value=$count selected>";
    }
    else
    {
      print "<option value=$count>";
    }
  }

  function search_board(&$param)
  {
    $search_select = $param['search_select'];
    $search_input_txt = $param['search_input_txt'];
    $textArray = explode(" ", $search_input_txt); //검색어를 공백으로 나눈다
    $start_idx = $param['start_idx'];
    $row_count = $param['row_count'];
    $where = [];
    $query = 
    " SELECT A.i_board, A.title, B.nm, A.created_at, A.views, A.i_user, A.ctnt, B.profile_img
      FROM t_board A
      INNER JOIN t_user B
      ON A.i_user = B.i_user
      WHERE ";

    switch($search_select){
      case "search_writer":
        $where += ["B.nm"];
        break;
      case "search_title":
        $where += ["A.title"];
        break;
      case "search_ctnt":
        $where += ["A.ctnt", "A.title"];
        break;
      default:
    }

    for($i=0; $i<count($textArray); $i++){
      for ($j=0; $j<count($where); $j++) { 
        $query = "$query $where[$j] LIKE '%$textArray[$i]%'";
        if($i !== count($textArray) - 1 || $j !== count($where) - 1){
          $query = "$query OR";
        }
      }
    }
    
    $query = $query . " ORDER BY i_board DESC LIMIT $start_idx, $row_count";

    $conn = get_conn();
    $result = mysqli_query($conn, $query);
    mysqli_close($conn);
    return $result; 
  }

  function sel_listing(&$param)
  {
    $row_count = $param['row_count'];
    $start_idx = $param['start_idx'];
    switch($param['listing'])
    {
      case "new":
        $order = "A.i_board DESC";
        break;
      case "hot":
        $order = "A.views DESC";
        break;
    }
    $sql =
    " SELECT A.i_board, A.title, B.nm, A.created_at, A.views, B.profile_img, B.i_user
      FROM t_board A
      INNER JOIN t_user B
      ON A.i_user = B.i_user
      ORDER BY $order
      LIMIT $start_idx, $row_count
    ";

    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
  }

  function sel_listing_val(&$listing, &$param)
  {
    switch($param)
    {
      case "A.i_board DESC":
        $val = "new";
        $koval = "최신순";
        break;
      case "A.views DESC":
        $val = "hot";
        $koval = "인기순";
        break;
    }
    if($listing === $val)
    {
      print "<option value='$val' selected>$koval</option>";
    }
    else
    {
      print "<option value='$val'>$koval</option>";
    }
  }

  function upd_board(&$param)
  {
    $i_board = $param['i_board'];
    $i_user = $param['i_user'];
    $title = $param['title'];
    $ctnt = $param['ctnt'];
    $sql = 
    " UPDATE t_board
      SET title = '$title', ctnt = '$ctnt', updated_at = now()
      WHERE i_board = $i_board AND i_user = $i_user";

    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    return $result;
  }

  function upd_views(&$param)
  {
    $i_board = $param['i_board'];
    $sql ="UPDATE t_board SET views = views + 1 WHERE i_board = $i_board";

    $conn = get_conn();
    mysqli_query($conn, $sql);
    mysqli_close($conn);
  }

  function del_board(&$param)
  {
    $i_board = $param['i_board'];
    $i_user = $param['i_user'];
    $sql = "DELETE FROM t_board WHERE i_board = $i_board AND i_user = $i_user";
    
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    
    return $result;
  }