<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="search_user.css">
    <?php
        session_start();
        if(isset($_SESSION['accountID']) && isset($_SESSION['ok'])){
        }else{
            header("Location: http://localhost/sysdev/branches/step1/login.php");
        }
        //header include
        include 'inc/header.php';
        include 'pagination.php';
        
        include "OriginalException.php";
        require_once "PDO_cun.php";

        $db = new PDO_cun();
        $user = 0;
        $msg = "";
        $switch = 0;

        $newUserName = "";
        $newIntroduction = "";
        $newIcon = "";
        

       
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'&& $_SESSION['accountID'] == $_GET['user']){
            if(isset($_POST['newUserName'])){   
                $newUserName = $_POST['newUserName'];
            }
            if(!empty($_FILES["dataFile"]["name"])){
                $newIcon = file_get_contents ($_FILES['dataFile']['tmp_name']);
            }else{
                $newIcon = $db->sql_exe_oneColumn('select icon from account where accountID = '.$_SESSION['accountID'].';');
            }
        
        if(isset($_POST["introduction"]))   $newIntroduction = htmlentities($_POST["introduction"], ENT_QUOTES, 'UTF-8');
        
            try{
                $sql = "UPDATE account SET icon=:icon, userName=:newUserName, introduction=:introduction WHERE accountID = ".$_SESSION["accountID"]."";
                $stmt = $db->acc_insert($sql);

                $size = $_FILES['dataFile']['size'];

                $stmt->bindValue(':icon', $newIcon, PDO::PARAM_STR);
                $stmt->bindValue(':newUserName', $newUserName, PDO::PARAM_STR);
                $stmt->bindValue(':introduction', $newIntroduction, PDO::PARAM_STR);
                $stmt->execute();
                if(!$stmt){
                    echo "\nPDO::errorInfo():\n";
                    print_r($pdo->errorInfo());
                }
            }catch(PDOException $e){
                //throw new OriginalException($e); 
                //$a =$e->errorInfo[1];
                // print_r($a);
                switch($e->errorInfo[1]){
                    case'1045':
                    $msg='DB接続エラー（ユーザ名エラー）';
                    break;
                    case'2002':
                    case'2003':
                    $msg='DB接続エラー（サーバ停止）';
                    break;
                    case'2005':
                    $msg='DB接続エラー（ホストエラー）';
                    break;
                    case'1153':
                    case'2006':
                    echo "<script>window.location.href = 'overerrevent.php';</script>";
                    break;
                }
                switch(get_class($e)){
                    case 'PDOException':
                        exit($msg.'メンテナンスへ連絡してください<br>');
                        break;
                    case'Exception':
                        exit('エラー：メンテナンスへ連絡してください<br>');
                    break;
                    default:
                    echo('想定外のエラーが発生しました');
                }
            }
        }
        

        $user = 0;

        $pic = array();
        $title = array();
        $id = array();
        $followIcon = array();
        $followerIcon = array();
        $followName = array();
        $followerName = array();
        $userSearch = "";
        $page = 1;
        $fill = 10;      //１ページに表示するイラスト数
        $tab = "illust";
        $count = 0;

        if (isset($_GET["page"])) $page = $_GET['page'];
        if (isset($_GET["user"])) $user = $_GET["user"];
        if (isset($_GET["tab"])) $tab = $_GET["tab"];
        $db = new PDO_cun();

        if (isset($_POST['followflg'])) {
            if ($_POST['followflg'] == 1) {
                $db->sql_insert("INSERT into follow(follower,accountID) values(" . $_SESSION["accountID"] . "," . $_GET['user'] . ")");
            } else {
                $db->sql_insert("DELETE from follow where follower = " . $_SESSION['accountID'] . " and accountID = " . $_GET['user']);
            }
        }

        $acData = $db->sql_exe_oneLine('select icon, accountID, userName, introduction from account where accountID = '.$user.';');
        $img = $db->sql_exe_list("select picture, accountID, pictureID, title from picture where accountID like '%" . $user . "%';");
        $acc_info = $db->sql_exe_oneLine("SELECT * from account  where accountID=" . $_GET['user'].";");
        $followerData = $db->sql_exe_list("select distinct * from follow as f,account as a where f.accountID = " . $user . " and f.follower = a.accountID");
        $followData = $db->sql_exe_list("select distinct * from follow as f,account as a where f.follower = " . $user . " and f.accountID = a.accountID");
        
        $icon = $acData["icon"];
        $userName = htmlentities($acData["userName"]);
        $introduction = $acData["introduction"];
        while ($result = $img->fetch()) {
            $pic += array($result["pictureID"] => $result["picture"]);
            $title += array($result["pictureID"] => $result["title"]);
            $id += array($result["pictureID"] => $result["accountID"]);
        }
        while ($result = $followData->fetch()){ //フォロー
            $followName += array($result["userName"] => $result["accountID"]);
            $followIcon += array($result["accountID"] => $result["icon"]);
        }
        while ($result = $followerData->fetch()){ //フォロワーs
            $followerName += array($result["userName"] => $result["accountID"]);
            $followerIcon += array($result["accountID"] => $result["icon"]);
        }

        $iCount = count($pic);

    ?>
    <style>
        #follow {
            <?php
            if ($tab == "follow") {
                echo 
                "border-top:3px solid #fcf818;
                color:black;";
            }
            ?>
        }

        #follower {
            <?php
            if ($tab == "follower") {
                echo 
                "border-top:3px solid #fcf818;
                color:black;";
            }
            ?>
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="head">
            <img id="icon" src='iconimage.php?id=<?php echo $user?>' alt='画像' width='110' height='110'>
                <div class="userData" >
                    <div class="data"><h3><?php echo "アカウント名：".$userName;?></h3></div>
                    <div class="data" ><a href="search_user.php?user=<?php echo $user ?>&tab=follow"><h3 style="display:inline;">フォロー：<?php echo count($followName);?></h3></a></div>
                    <div ><a href="search_user.php?user=<?php echo $user ?>&tab=follower"><h3 style="display:inline;">フォロワー：<?php echo count($followerName);?></h3></a></div>
                </div>
                <div style="width:400px"></div>
                <?php
                    if($_SESSION['accountID'] == $user){
                        echo '<div id="button"><a href=edit.php?user='.$_SESSION['accountID'].'><input type="button" id="btnImg" value="編集する"></input></a></div>';
                    }else{
                        echo '<div id="button"><form action="" method="POST" name="follow">
                        <input type="submit" value="フォローする" id="btnImg" >
                        <input type="hidden" value="1" name="followflg" id="followflg">
                    </form></div>';
                    }
                    if ($_SESSION['accountID'] != $_GET['user']) {
                        
                        $check = $db->sql_exe_oneColumn("SELECT count(follower) from follow where follower = " . $_SESSION['accountID'] . " and accountID = " . $_GET['user'] . ";");
                        if ($check >= 1) {
                            print  "<script>document.getElementById('btnImg').value='フォロー済み';";
                            print "document.getElementById('followflg').value=2; </script>";
                            
                        } else {
                            print  "<script>document.getElementById('btnImg').value='フォローする';";
                            print "document.getElementById('followflg').value=1; </script>";
                        }
                    }
                ?>
        </div>
        <div id="profile"><?=$introduction?></div>
        <hr style="margin-top:5px;">

        <?php
            switch($tab){
                    case "follow":
                    case "follower";
                    echo '<div id="tab">
                            <a href="search_user.php?user='. $user .'&tab=follow" style="padding:24px;">
                                <h3 class="tab" id="follow">フォロー</h3>
                            </a>
                            <a href="search_user.php?user='. $user .'&tab=follower" style="padding:24px;">
                                <h3 class="tab" id="follower">フォロワー</h3>
                            </a>
                        </div>';
                }
            echo '<div id="illustArea">';


            
                switch($tab){
                    case "illust":
                        $j = 0;
                        $allPage = ceil($iCount / $fill);
                        foreach ($pic as $pictureID => $picture) {      // 画像の表示ループ
                            $j++;
                            if ($j > ($page-1) * $fill && $j <= $page * $fill) {
                                echo "<li>
                                    <div>
                                        <div class='box'>
                                            <a href=artwork_view.php?picID=" . $pictureID . ">
                                                <img id='img' src='image.php?id=" . $pictureID . "' alt='画像' width='160' height='160'>
                                            </a>
                                        </div>
                                        <div id=ellipsis>
                                            <a href=artwork_view.php?picID=" . $pictureID . ">
                                                " . $title[$pictureID] . "
                                            </a>
                                        </div>
                                    </div>
                                </li>";
                            }
                        }
                        user($allPage, $page, $user);
                        break;
                    case "follow":
                        $allPage = ceil(count($followName) / $fill);
                        $j = 0;
                            foreach ($followName as $userName => $accountID) {    // illustTAB時の画面
                                $j++;
                                if ($j > ($page - 1) * $fill && $j <= $page * $fill) {
                                    echo "<li>
                                            <div>
                                                <div class='box'>
                                                    <a href=search_user.php?user=" . $accountID . ">
                                                        <img id=img src='iconimage.php?id=" . $accountID . "' alt='画像'>
                                                </div>
                                                <div>
                                                        <div id=ellipsis>
                                                            " . $userName . "
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>";
                                }
                            }
                            follow($allPage, $page, $user, "follow");
                        break;
                    case "follower":
                        $allPage = ceil(count($followerName) / $fill);
                        $j = 0;
                            foreach ($followerName as $userName => $accountID) {    // illustTAB時の画面
                                $j++;
                                if ($j > ($page - 1) * $fill && $j <= $page * $fill) {
                                    echo "<li>
                                            <div>
                                                <div class='box'>
                                                    <a href=search_user.php?user=" . $accountID . ">
                                                    <img id=img src='iconimage.php?id=" . $accountID . "' alt='画像'>
                                                </div>
                                                <div>
                                                    <div id=ellipsis>
                                                        " . $userName . "
                                                    </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>";
                                }
                            }
                            follow($allPage, $page, $user, "follower");
                        break;
                }
                if (isset($_POST['followflg'])) {
                    if ($_POST['followflg'] == 1) {
                        //$db->sql_insert("INSERT into follow(follower,accountID) values(" . $_SESSION["accountID"] . "," . $_GET['user'] . ")");
                        echo "<script> document.getElementById('btnImg').value='フォロー済み';";
                        echo "document.getElementById('followflg').value=2; </script>";
                    } else {
                       // $db->sql_insert("DELETE from follow where follower = " . $_SESSION['accountID'] . " and accountID = " . $_GET['user']);
                        echo  "<script> document.getElementById('btnImg').value='フォローする';";
                        echo "document.getElementById('followflg').value=1; </script>";
                    }
                }
                ?>
            
        </div>
    </div>
</body>
<footer>
        <img class="foot" src="./img/supun.jpg"></img>
    </footer>
</html>