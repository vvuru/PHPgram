<?php
  include_once "db/db_user.php";

  $uid = $_POST['uid'];
  $upw = $_POST['upw'];
  $confirm_upw = $_POST['confirm_upw'];
  $nm = $_POST['nm'];
  $gender = $_POST['gender'];

  $param = [
    "uid" => $uid,
    "upw" => $upw,
    "nm" => $nm,
    "gender" => $gender
  ];

  $result = ins_user($param);

  header("Location: login.php");
?>