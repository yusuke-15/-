<?php
session_start();
if (isset($_SESSION['accountID']) && isset($_SESSION['ok'])) {
} else {
  header("Location: http://localhost/sysdev/branches/step1/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="watchmoreC.css">
</head>

<body>
    <!-- ヘッダー -->
    <?php include 'inc/header.php'; ?>
    <!--データベースに接続-->
    <?php
    require_once "PDO_cun.php";
    // $acc[]=null;
    $dbconnect = new PDO_cun();
    $stmt = $dbconnect->sql_exe_list("select picture.pictureID,picture.view,picture.picture,picture.title,account.userName,account.accountID,account.icon from picture join account on picture.accountID = account.accountID ORDER BY view DESC");
    $result = $stmt->fetchAll();
    // foreach($result as $pii){
    //     $acc = $dbconnect->sql_exe_list("SELECT userName from account ); 
    // }
    //$acs = $acc->fetchAll();

    ?>
    <?php
    $more = ($_GET['moreid']);
    ?>
    <br>
    <div id="watchhead"><?php print $more; ?>一覧</div>
    <form action="artwork_view.php" method="GET" id="f1" name="getTo">
        <br>
        <br>

        <div id="frame1">
            <?php
            foreach ($result as $pic) {
                // $img = base64_encode($result[1]);

            ?>
                <div id="frame2" align="center">
                    <div class="frame3">
                        <a href="artwork_view.php?picID=<?php echo $pic['pictureID'] ?>">
                            <img src="image.php?id=<?= $pic['pictureID']; ?>" class="artwork"></a>
                        <br>
                        <a><?php print $pic['title'] ?> 閲覧回数:<?php print $pic['view'] ?></a>
                        <br>
                        <a><img src="iconimage.php?id=<?= $pic['accountID']; ?>" class="user_icon"> <?php print $pic['userName'] ?></a>
                    </div>

                </div>

            <?php } ?>
        </div>

</body>

</html>