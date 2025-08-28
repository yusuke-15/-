<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  if (isset($_POST["result"])) {
    $re = $_POST["result"];

    // 全角空白を半角空白にする
    $re = str_replace('　', ' ', $re);
    // 変数に空白が入っていた場合はif文内に入る
    if (strpos($re, ' ') !== false) {
      // 空白で配列を区切る
      $ary1 = explode(' ', $re);
      // 配列に入った空白を消す
      $ary2 = array_filter($ary1);
      // 配列を詰める
      $ary2 = array_values($ary2);

      print_r($ary2);
    }
    print "検索:" . $re . "<br>";
  }
  include 'err.php';
  require_once "origin.php";
  
    $dbconnect = new connect();
    $stmt = $dbconnect->sql_exe_list('select * from picture where title like "%' . $re . '%"');
    while ($result = $stmt->fetch()) {
      print('<span class="secondframe"><div class="inner" align="center">
          <input type="image" name="artwork" class="artwork" src="pic/' . $result['sauce'] . '">
          <p>' . $result['title'] . '</p>
          </div></span>');
    }
    $stmt = null;
  

  ?>
  <input type="hidden" value="<?php print $re?>" name="a">
</body>

</html>