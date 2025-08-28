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
      if(isset($_POST["result"])){
        $re = $_POST["result"];
        print "検索:".$re."<br>";
       }
       require_once "PDO_cun.php";
       include "OriginalException.php";
      $dbconnect = new PDO_cun();
      $stmt = $dbconnect->sql_exe_list('select * from picture where title like "%'.$re.'%"');
      while ($result = $stmt->fetch()) {
        print('<span class="secondframe"><div class="inner" align="center">
        <input type="image" name="artwork" class="artwork" src="pic/' . $result['sauce'] . '">
        <p>'.$result['title'].'</p>
        </div></span>');
      }
      $stmt = null;
    ?>
</body>
</html>