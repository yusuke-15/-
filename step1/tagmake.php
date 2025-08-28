<?php
session_start();
if (isset($_SESSION['accountID']) && isset($_SESSION['ok'])) {
} else {
    header("Location: http://localhost/sysdev/branches/step1/login.php");
}
?><?php
    require_once('function.php');
    require_once('PDO_cun.php');
    // include "OriginalPDOException.php";

    $pdo = new PDO_cun();
    $pdo2 = connectDB();
    $msg = "";

    ?>
<?php
$tag = array($_SESSION["tag1"],$_SESSION["tag2"],$_SESSION["tag3"],$_SESSION["tag4"],$_SESSION["tag5"]);
$count=count($tag);
$i=0;
while($i<$count){
    $tag[$i] = str_replace(" ","",$tag[$i]);
    $tag[$i] = str_replace("　","",$tag[$i]);
    ++$i;
}
$tag = array_filter($tag);
$account = $_SESSION['accountID'];
$tagID = array();

//今使ってるアカウントの一番新しいpictureIDを持ってくる
$picid = $pdo->sql_exe_oneColumn("SELECT MAX(pictureID) AS picture  FROM picture where accountID = ".$account);

//$picID = $stmt->fetch();

print "現在使用中のアカウント:".$account . "<br>" . "一番新しい絵のID:".$picid."<br>";

//被ってないタグをtagNameに格納する。
foreach ($tag as $value) {
    print $value.",";
    $result = $pdo->sql_exe_list("SELECT count(tagName='" . $value . "'or null) from tagm");
    $result2 = $result->fetchColumn();
    if ($result2 >= 1) {
        print "被った/";
    } else if ($result2 == 0) {
        print "被ってない/";
        $sql = "INSERT INTO `tagm` (`tagID`, `tagName`) VALUES (NULL,'$value')";
        $stmt = $pdo2->prepare($sql);
        $stmt->execute();
    }else{
        print "よくわからん";
    }
}
foreach ($tag as $value) {
    $stmt2 = $pdo->sql_exe_oneColumn("select tagID from tagm where tagName = '$value';");
    array_push($tagID,$stmt2);
}
print "<br>";
print_r($tagID);
foreach ($tagID as $value) {
    $result3 = $pdo->sql_exe_list("SELECT count(pictureID ='" . $picid . "'and tagID = '".$value."') from tag");
    $result4 = $result3->fetchColumn();
    // if ($result4 >= 1) {
    //     print "被った/";
    // } else if ($result2 == 0) {
    //     print "被ってない/";
        $sql = "INSERT INTO `tag` (`pictureID`, `tagID`) VALUES ('$picid','$value')";
        $stmt3 = $pdo2->prepare($sql);
        $stmt3->execute();
    // }else{
    //     print "よくわからん";
    // }
   
}

header('Location:uploadcom.php');
exit();




?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>Image Test</title>
</head>

<body>
</body>

</html>