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

        $pic = array();
        $title = array();
        $id = array();
        $followIcon = array();
        $followerIcon = array();
        $followName = array();
        $followerName = array();
        $userSearch = "";
        $page = 1;
        $fill = 1;      //１ページに表示するイラスト数
        $tab = "illust";
        $count = 0;

        if (isset($_GET["page"])) $page = $_GET['page'];
        if (isset($_GET["user"])) $user = $_GET["user"];
        if (isset($_GET["tab"])) $tab = $_GET["tab"];

        if ($user != $_SESSION["accountID"]){
            exit();
        }

        $acData = $db->sql_exe_oneLine('select icon, accountID, userName, introduction from account where accountID = '.$user.';');
        $img = $db->sql_exe_list("select picture, accountID, pictureID, title from picture where accountID like '%" . $user . "%';");

        $followerData = $db->sql_exe_list("select distinct * from follow as f,account as a where f.accountID = " . $user . " and f.follower = a.accountID");
        $followData = $db->sql_exe_list("select distinct * from follow as f,account as a where f.follower = " . $user . " and f.accountID = a.accountID");
        
        $icon = $acData["icon"];
        $userName = $acData["userName"];
        $introduction = htmlentities($acData["introduction"], ENT_QUOTES, 'UTF-8');
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
.data {
	position: relative;
	width: 300px;
}
.data input[type='text'] {
	font: 15px/24px sans-serif;
	box-sizing: border-box;
	width: 100%;
	padding: 0.3em;
	transition: 0.3s;
	letter-spacing: 1px;
	border: 1px solid #ffffff;
	box-shadow: 1px 1px 2px 0 #707070 inset;
	border-radius: 4px;
}
.ef input[type='text']:focus {
	outline: none;
	box-shadow: inset 1px 1px 2px 0 #c9c9c9;
}

#profile {
	position: relative;
    margin-left: 115px;
	width: 700px;
}
#profile textarea{
	font: 15px/24px sans-serif;
	box-sizing: border-box;
	width: 100%;
	padding: 0.3em;
	transition: 0.3s;
	letter-spacing: 1px;
	border: 1px solid #ffffff;
	box-shadow: 1px 1px 2px 0 #707070 inset;
	border-radius: 4px;
}
.ef textarea:focus {
	outline: none;
	box-shadow: inset 1px 1px 2px 0 #c9c9c9;
}
    </style>
</head>
<body>
    <form action="search_user.php?user=<?=$_SESSION['accountID']?>" method="POST" autocomplete="off" enctype="multipart/form-data">
        <div class="main">
            <div class="head">
                <div>
                    <img id="icon" src='iconimage.php?id=<?php echo $user?>' alt='画像' width='110' height='110'>
                    <label>
                        <span class="fileLabel" title="ファイルを選択">
                            <img id="edit" src="img/edit_icon.png">
                            <input type="file" src="img/edit_icon.png" id="fileSend" class="image" name="dataFile" accept="image/*" onchange="iconChange(this)" >
                        </span>
                    </label>                </div>
                    <div class="userData" >
                        <div class="data"><h3><?php echo "アカウント名 ";?> <label class="ef"><input type="text" value="<?=$userName?>" MaxLength = 20 name="newUserName" id="userN"></label></h3></div>
                        <div class="data" ><a href="search_user.php?user=<?php echo $user ?>&tab=follow"><h3 style="display:inline;">フォロー <?php echo count($followName);?></h3></a></div>
                        <div ><a href="search_user.php?user=<?php echo $user ?>&tab=follower"><h3 style="display:inline;">フォロワー <?php echo count($followerName);?></h3></a></div>
                    </div>
                    <div style="width:400px"></div>
                    <div id="button">
                        <input type="submit" id="btnImg" value="編集完了">
                    </div>
            </div>
            <div id="profile">
            <label class="ef"> <textarea name="introduction" class="introduction" cols="40" rows="3" placeholder="プロフィール文章を入力してください" maxlength="210"><?=$introduction?></textarea></label>
            </div>
                <hr style="margin-top:5px;">
            </div>
        </div>
    </form>
    <script>
            function iconChange(e) {
                var fileReader = new FileReader();
                fileReader.onload = (function() {
                //id属性が付与されているimgタグのsrc属性に、fileReaderで取得した値の結果を入力することで
                //プレビュー表示している
                document.getElementById('icon').src = fileReader.result;
                });
                fileReader.readAsDataURL(e.files[0]);
            }
    </script>
</body>
</html>