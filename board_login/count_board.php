<?php
  include_once "db/db.php";

  //Today
  $YY = date('Y');
  $MM = date('m');
  $DD = date('d');
  $dat = $YY."-".$MM."-".$DD;
  $sql = "SELECT * FROM count_db WHERE redate = '$dat'";

  $conn = get_conn();
  $result = mysqli_query($conn, $sql);

  $list = mysqli_num_rows($result);
  if(!$list){
    $count = 0;
  }
  else{
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];
  }

  if($count === 0){
    $count++;
    $sql = "INSERT INTO count_db VALUES ($count, '$dat')";
  }
  else{
    $count++;
    $sql = "UPDATE count_db SET count = $count WHERE redate = '$dat'";
  }
  mysqli_query($conn, $sql);

  //Total
  $totalQuery = "SELECT SUM(count) FROM count_db";
  $totalCount = mysqli_fetch_array(mysqli_query($conn, $totalQuery))[0];
  mysqli_close($conn);

  echo "<br><center><h2> 방문자수 통계입니다 </h2><hr>";
  echo "[ Today: <font color=red>";
  echo $count;
  echo "</font>]<br>";
  echo "[ Total: <font color=blue>";
  echo $totalCount;
  echo "</font>]<br>";
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>방문자수 통계</title>
</head>
<body>
  
</body>
</html>