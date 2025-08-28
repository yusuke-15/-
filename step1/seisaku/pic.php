<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="homeC.css">
</head>
<body>
    <?php
       if(isset($_POST["ssss"])) $t = $_POST["ssss"];
       print "次の作品を登録しました。<br>作品ID:".$t."<br>";
    ?>
    <?php
       require_once "PDO_cun.php";
       include "OriginalException.php";
      $dbconnect = new connect();
      $stmt = $dbconnect->sql_exe_list('select * from picture where pID = "'.$t.'"');
      while ($result = $stmt->fetch()) {
        print('<span class="secondframe"><div class="inner">
        <input type="image" name="artwork" class="artwork" src="pic/' . $result['sauce'] . '">
        </div></span>');
      }
      $stmt = null;
    ?>
</body>
</html>