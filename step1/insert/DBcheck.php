<?php
session_start();
?>
<!DOCTYPE html>
<html lang="jp">

<head>
</head>

<body>
</body>
<?php
require_once '../PDO_cun.php';
$db = new PDO_cun();
include "../OriginalException.php";
$msg = "";
$test = "../img/icon.png";
$icon = file_get_contents($test);
$name = htmlentities($_POST["name"], ENT_QUOTES, 'UTF-8');
$address = $_POST["address"];
$password = $_POST["password"];
$uri = $_SERVER['HTTP_REFERER'];
$result = $db->sql_exe_list("SELECT count(address='" . $address . "'or null) from account");
$result2 = $result->fetchColumn();
if ($result2 >= 1) {
  header('Location:' . $uri, true, 303);
  print "<script>document.f1.icon.value ='" . $_POST["tmpcanvas"] . "';";
  print "document.f1.submit();</script>";
} else if ($result2 == 0) {
  $sql = 'INSERT INTO account(accountID,username,address,password,icon)
            VALUES (null,:user_name,:user_address,:user_pass,:user_icon)';
  $stmt = $db->acc_insert($sql);
  $stmt->bindValue(':user_name', $name, PDO::PARAM_STR);
  $stmt->bindValue(':user_address', $address, PDO::PARAM_STR);
  $stmt->bindValue(':user_pass', $password, PDO::PARAM_STR);
  $stmt->bindValue(':user_icon', $icon, PDO::PARAM_STR);
  $stmt->execute();
  $_SESSION["flag"] = 1;
  header('Location:../login.php');
}
switch ($e->errorInfo[1]) {
  case '1045':
    $msg = 'DB接続エラー（ユーザ名エラー）';
    break;
  case '2002':
  case '2003':
    $msg = 'DB接続エラー（サーバ停止）';
    break;
  case '2005':
    $msg = 'DB接続エラー（ホストエラー）';
    break;
}
switch (get_class($e)) {
  case 'PDOException':
    exit($msg . 'メンテナンスへ連絡してください<br>');
    break;
  case 'Exception':
    exit('エラー：メンテナンスへ連絡してください<br>');
    break;
  default:
    echo ('想定外のエラーが発生しました');
}
?>

</html>