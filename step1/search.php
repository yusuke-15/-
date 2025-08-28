<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="search.css">
    <?php
    $tab = "top";
    if (isset($_GET["tab"])) $tab = $_GET["tab"];
    ?>
    <style>
        #top {
            <?php
            if ($tab == "top") {
                echo "border-top:3px solid #fcf818;
                color:black;";
            }
            ?>
        }

        #illust {
            <?php
            if ($tab == "illust") {
                echo "border-top:3px solid #fcf818;
                color:black;";
            }
            ?>
        }

        #user {
            <?php
            if ($tab == "user") {
                echo "border-top:3px solid #fcf818;
                color:black;";
            }
            ?>
        }
    </style>
</head>

<body>
    <?php

    session_start();
    if (isset($_SESSION['accountID']) && isset($_SESSION['ok'])) {
    } else {
        header("Location: http://localhost/sysdev/branches/step1/login.php");
    }

    //header include
    include 'inc/header.php';
    include 'pagination.php';

    include "OriginalException.php";
    require_once "PDO_cun.php";
    $icon = array();
    $pic = array();
    $title = array();
    $id = array();
    $name = array();
    $acSearch = array();
    $acIcon = array();
    $acName = array();
    $page = 1;          //現在のページ数
    $search = "";       //検索単語
    $countIll = 0;      //イラスト数
    $countAc = 0;       //アカウント数
    $fill = 1;          //1ページに表示するイラスト数
    $emptyTag = false;

    $searchCt = 0; //$searchの内容量をカウント

    //pageのGETを取得
    if (isset($_GET["page"])) $page = $_GET['page'];
    $db = new PDO_cun();


    if (isset($_GET["search"])) {
        $search = htmlentities($_GET["search"], ENT_QUOTES, 'UTF-8');
        $search_tags = explode(' ', $search);
    }

    if ($tab == "tag") {
        // echo "配列です";
        $stack = array();
        $getPid = array();

        foreach ($search_tags as $stag) {
            $tag_get_list = $db->sql_exe_list("select distinct(tagID) as tid from tagM where tagName like('%" . $stag . "%')");
            while ($result = $tag_get_list->fetch()) {
                array_push($stack, $result["tid"]);
            }
        }


        $search_tags_id = array_unique($stack);
        $stack = implode(',', $search_tags_id);
        $emptyTag = empty($stack);
        if (!$emptyTag) {
            $tag_get_list = $db->sql_exe_list("select distinct(pictureID) as pid from tag where tagID in(" . $stack . ")");

            while ($result = $tag_get_list->fetch()) {
                array_push($getPid, $result["pid"]);
            }
            $tmp = implode(',', $getPid);
            $img = $db->sql_exe_list("select * from picture as p,account as a where p.pictureID in (" . $tmp . ") and p.accountID = a.accountID;");
        }
    } else {
        /*searchのget or postを取得
        searchに関係するデータベースを取得*/
        if (isset($_GET["search"])) {
            $img = $db->sql_exe_list("select * from picture as p,account as a where p.title like '%" . $search . "%' and p.accountID=a.accountID;");
            $ac = $db->sql_exe_list('select * from account where userName like "%' . $search . '%";');
        } else {
            $img = $db->sql_exe_list('select * from picture as p,account as a;');
            $ac = $db->sql_exe_list('select * from account;');
        }
        while ($result = $ac->fetch()) {
            $acSearch += array($result["userName"] => $result["accountID"]);

            $acIcon += array($result["accountID"] => $result["icon"]);
            $acName += array($result["accountID"] => $result["userName"]);
        }
    }
    //連想配列searchに対応したuserNameをキーにしてaccountIDを紐づける
    if (!$emptyTag) {
        while ($result = $img->fetch()) {
            $icon += array($result["accountID"] => $result["icon"]);
            $name += array($result["accountID"] => $result["userName"]);
            $title += array($result["pictureID"] => $result["title"]);
            $id += array($result["pictureID"] => $result["accountID"]);
            $pic += array($result["pictureID"] => $result["picture"]);
        }
    }

    $countIll = count($pic);
    $countAc = count($acSearch);

    ?>
    <div class="main">
        <div>
            <br>
            <h3 class="kensaku">検索単語：<?php echo $search ?></h3>
            <div class="fav"><input type="button" onclick="onc()" id="btnImg" value="お気に入り登録"></div>
            <h3 class="kensakuW">ヒット件数</h3>
            <h3 class="kensakuW" id="mainIllustCt">イラスト：<?= " " . $countIll; ?><br>
                <?php
                if ($tab != "tag") {
                    echo "ユーザー： " . $countAc . "</h3>";
                } else {
                    echo "
                    <style>
                    #mainIllustCt{
                        padding-bottom: 23px;
                    }
                    </style>";
                }
                ?>

        </div>
        <hr>
        <!-- 別のページに飛ぶTAB -->
        <?php
        if ($tab != "tag") {
            echo "
            <div id='tab'>
                <a href='search.php?tab=top&search=" . $search . "' style=padding:24px;>
                    <h3 class='tab' id='top'>トップ</h3>
                </a>
                <a href='search.php?tab=illust&search=" . $search . "' style=padding:24px;>
                    <h3 class='tab' id='illust'>イラスト</h3>
                </a>
                <a href='search.php?tab=user&search=" . $search . "' style=padding:24px;>
                    <h3 class='tab' id='user'>ユーザー</h3>
                </a>
            </div>
            ";
        }
        ?>

        <div>
            <?php
            if ($tab == "top" && $countIll != 0) {        // topTAB時の画面
                echo '
                        <div>
                            <h3 style="display:inline;">イラスト</h3>
                            <a href="search.php?tab=illust&search=' . $search . '"><div id="headName" style="float: right;">すべて見る</div></a>
                            </div>';
            }
            ?>
            <div>
                <div id="illustArea">
                    <ul>
                        <?php
                        if ($tab == "top") {    //$tab がtopだった時true
                            $j = 0;
                            foreach ($pic as $pictureID => $picture) {      // 画像の表示ループ
                                $j++;
                                if ($j <= 5) {       //page内か
                                    echo "<li>
                                            <div>
                                                <div class='box'>
                                                    <a href=artwork_view.php?picID=" . $pictureID . ">
                                                        <img id=img src='image.php?id=" . $pictureID . "' alt='画像'>
                                                    </a>
                                                </div>
                                                <div class='leader'>
                                                    <a href=artwork_view.php?picID=" . $pictureID . ">
                                                    " . $title[$pictureID] . "
                                                    </a>
                                                </div>
                                                <div>
                                                    <a href=search_user.php?user=" . $id[$pictureID] . ">
                                                        <div class='leader'>
                                                            <img src='iconimage.php?id=" . $id[$pictureID] . "'id=icon><a class='iconN'>"
                                        . $name[$id[$pictureID]] . "</a>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    ";
                                }
                            }
                            echo "</div><br>";
                            $j = 0;
                            if ($tab == "top" && $countAc != 0) {
                                echo '<div>
                                            <h3 style="display:inline;">ユーザー</h3>
                                            <a href="search.php?tab=user&search=' . $search . '"><div id="headName" style="float: right;">すべて見る</div></a>
                                            </div>';
                            }
                            echo '<div id="illustArea">';
                            foreach ($acSearch as $userName => $accountID) {        // 画像の表示ループ
                                $j++;
                                if ($j <= 5) {
                                    echo "<li>
                                            <div>
                                            <a href=search_user.php?user=" . $accountID . ">
                                                <div class='box'>
                                                        <img id=img src='iconimage.php?id=" . $accountID . "' alt='画像'>
                                                </div>
                                                <div>
                                                        <div class='leader'>
                                        " . $acName[$accountID] . "
                                                        </div>
                                                </div>
                                                </a>
                                            </div>
                                        </li>";
                                }
                            }
                            echo "</div>";
                        }
                        if ($tab == "illust") {
                            $j = 0;
                            foreach ($pic as $pictureID => $picture) {      // 画像の表示ループ
                                $j++;
                                if ($j > ($page - 1) * $fill && $j <= $page * $fill) {
                                    echo "<li>
                                            <div>
                                                <div class='box'>
                                                <a href=artwork_view.php?picID=" . $pictureID . ">
                                                        <img id=img src='image.php?id=" . $pictureID . "' alt='画像'>
                                                    </a>
                                                </div>
                                                <div class='leader'>
                                                    <a href=artwork_view.php?picID=" . $pictureID . ">
                                                    " . $title[$pictureID] . "
                                                    </a>
                                                </div>
                                                <div>
                                                    <a href=search_user.php?user=" . $id[$pictureID] . ">
                                                        <div class='leader'>
                                                            <img id=icon src='iconimage.php?id=" . $id[$pictureID] . "' id=icon><a class='iconN'>"
                                        . $name[$id[$pictureID]] . "</a>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>";
                                }
                            }
                        }
                        if ($tab == "user") {       //userTAB時の画面
                            $j = 0;
                            foreach ($acSearch as $userName => $accountID) {    // illustTAB時の画面
                                $j++;
                                if ($j > ($page - 1) * $fill && $j <= $page * $fill) {
                                    echo "<li>
                                            <div>
                                                <div class='box'>
                                                <a href=search_user.php?user=" . $accountID . ">
                                                        <img id=img src='iconimage.php?id=" . $accountID . "' alt='画像'>
                                                </div>
                                                <div>
                                                        <div class='leader'>
                                        " . $acName[$accountID] . "
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>";
                                }
                            }
                        }
                        if ($tab == "tag") {
                            $j = 0;
                            foreach ($pic as $pictureID => $picture) {      // 画像の表示ループ
                                $j++;
                                if ($j > ($page - 1) * $fill && $j <= $page * $fill) {
                                    echo "<li>
                                            <div>
                                                <div class='box'>
                                                <a href=artwork_view.php?picID=" . $pictureID . ">
                                                        <img id=img src='image.php?id=" . $pictureID . "' alt='画像'>
                                                    </a>
                                                </div>
                                                <div>
                                                    <a href=artwork_view.php?picID=" . $pictureID . ">
                                                    " . $title[$pictureID] . "
                                                    </a>
                                                </div>
                                                <div>
                                                    <a href=search_user.php?user=" . $id[$pictureID] . ">
                                                        <div>
                                                            <img id=icon src='iconimage.php?id=" . $id[$pictureID] . "' id=icon><a class='iconN'>"
                                        . $name[$id[$pictureID]] . "</a>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>";
                                }
                            }
                        }
                        ?>

                    </ul>
                </div>
            </div>

            <?php
            $pageIll = ceil($countIll / $fill);
            $pageUser = ceil($countAc / $fill);
            if ($tab != "top") {
                if ($tab == "illust") {
                    search($pageIll, $page, $tab, $search);
                } else {
                    search($pageUser, $page, $tab, $search);
                }
            }
            ?>
        </div>
    </div>
    <script>
        function onc() {
            //お気に入り登録変更済み画像挿入
            var before = document.getElementById("btnImg").value;
            if (before == "お気に入り登録") {
                document.getElementById("btnImg").value = "お気に入り登録済み";
            } else {
                document.getElementById("btnImg").value = "お気に入り登録";
            }
        }
    </script>
    <footer>
        <img class="foot" src="img/supun.jpg"></img>
    </footer>
</body>

</html>