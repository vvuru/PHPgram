<?php
  define("URL", "localhost");
  define("USERNAME", "root");
  define("PASSWORD", "506greendg@");
  define("DBNAME", "board_login");
  define("PORT", "3306");

  function get_conn()
  {
    return mysqli_connect(URL, USERNAME, PASSWORD, DBNAME, PORT);
  }
?>