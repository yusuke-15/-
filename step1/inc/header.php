<!DOCTYPE html>
<html lang="ja">
<?php

$acc = "";
if (isset($_SESSION['accountID'])) $acc = $_SESSION['accountID'];
?>

<head>
  <meta charset="utf-8">
  <title>PHP</title>
  <style>
    * {
      font-family: 'メイリオ', sans-serif;
      text-decoration: none;
    }

    header {
      padding: 0;
      margin: 0;
      height: 40px;
      width: 1519px;
      padding: 15px 0;
      background-color: white;
      color: white;
      box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.5)
    }

    .logo {
      position: absolute;
      top: 0px;
      left: 46%;
      width: 170px;
      height: 70px;
      object-fit: fill;
    }



    a.btn--yellow {
      color: #000;
      background-color: #fcf818;
    }

    a.btn--yellow:hover {
      color: #000;
      background: #fcf818;
    }

    a.btn--yellow.btn--cubic {
      border-bottom: 5px solid #ccc100;
    }

    a.btn--yellow.btn--cubic:hover {
      margin-top: 3px;
      border-bottom: 2px solid #ccc100;
    }

    a.btn-c {
      font-size: 18px;
      font-weight: 600;
      padding: 10px 20px 10px 20px;
      border-radius: 200px;
      position: absolute;
      top: 10px;
      left: 15%;
    }

    a.btn-c i.fa {
      margin-right: 10px;
    }






    .search-box {
      position: absolute;
      top: 37px;
      left: 73%;
      transform: translate(-50%, -50%);
      background: #fcf818;
      height: 30px;
      border-radius: 30px;
      padding: 10px;
    }

    .search-btn {
      float: right;
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background: #fcf818;
      display: flex;
      justify-content: center;
      align-items: center;
      text-decoration: none;
      transition: .3s;
      border: none;
    }

    .search-box:focus-within>.search-txt {
      width: 20vw;
    }

    .search-box:focus-within>.search-btn {
      background: #F7F6F8;
    }

    .search-btn i {
      background: none;
      color: #212121;
    }

    .search-txt {
      border: none;
      background: none;
      outline: none;
      float: left;
      padding: 0;
      color: #333;
      font-weight: 600;
      font-size: 16px;
      transition: .4s;
      line-height: 30px;
      width: 0px;
    }






    .icon {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      position: absolute;
      top: 10px;
      left: 92%;
      border: solid 2px snow;
      object-fit: cover;
    }





    .demobox-header {
      background: #ddd;
      height: 64px;
      padding: 1em;
    }

    .demobox-sitename {
      font-weight: 700;
      font-size: 18px;
    }

    /* 全体調整CSS */
    .hamburger-demo-menubox * {
      font-size: 16px;
    }

    .hamburger-demo-menubox li {
      font-size: 14px;
    }

    /* hamburgerここから */
    /* input非表示 */
    .input-hidden {
      display: none;
    }

    /* label */
    .hamburger-demo-switch {
      cursor: pointer;
      position: absolute;
      left: 3%;
      top: 0;
      z-index: 9999;
      width: 4em;
      height: 4em;
    }

    /* メニュー展開時のlabelをfixed化 */
    #hamburger-demo8:checked~.hamburger-demo-switch {
      position: fixed;
    }

    /* メニューエリア */
    .hamburger-demo-menuwrap {
      position: fixed;
      height: 100%;
      background: #fafafa;
      /* メニューエリアの背景色 */
      padding: 5em 3% 2em;
      z-index: 9998;
      transition: .3s;
      overflow-y: hidden;
      /* メニュー項目が多い場合に縦スクロール */
      top: 0;
      right: 100%;
      width: 15%;
    }

    /* メニューリスト */
    .hamburger-demo-menulist {
      margin-left: 3%;
      padding-right: 5% !important;
      /* !importantは不要な場合あり */
      list-style: none;
    }

    .hamburger-demo-menulist li a {
      text-decoration: none;
      color: #333;
      /* メニューリスト項目の文字色 */
      display: block;
      font-weight: 550;
    }

    .hamburger-demo-menulist li a:hover {
      color: #f62e36;
    }

    /* メニューエリアchecked */
    /* 右から */
    #hamburger-demo8:checked~.hamburger-demo-menuwrap {
      right: 80%;
    }

    /* コンテンツカバー */
    #hamburger-demo8:checked~.hamburger-demo-cover {
      position: fixed;
      width: 100%;
      height: 100%;
      top: 0;
      right: 0;
      z-index: 9997;
      background: rgba(3, 3, 3, .5);
      display: block;
    }

    /* ハーフセパレート･デザイン */
    /* ハンバーガーアイコン */
    .hamburger-switch-half,
    .hamburger-demo-switch8:before {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      transition: .3s;
      content: "";
    }

    .hamburger-demo-switch8:before {
      width: 25px;
      height: 3px;
      background: #333;
      /* ハンバーガー中央線の色 */
    }

    .hamburger-switch-half:before,
    .hamburger-switch-half:after {
      content: "";
      position: absolute;
      width: 12.5px;
      height: 3px;
      background: #333;
      /* ハンバーガー上下線の色 */
      top: 50%;
      left: 50%;
      transition: .3s;
    }

    .hamburger-switch-half:before {
      transform: translate(-100%, -300%);
    }

    .hamburger-switch-half:after {
      transform: translate(0, 200%)
    }

    /* アイコンアニメーション */
    #hamburger-demo8:checked~.hamburger-demo-switch .hamburger-switch-half:before {
      transform: translate(-85%, -200%) rotate(45deg);
    }

    #hamburger-demo8:checked~.hamburger-demo-switch .hamburger-switch-half:after {
      transform: translate(-15%, 100%) rotate(45deg);
    }

    #hamburger-demo8:checked~.hamburger-demo-switch8:before {
      transform: rotate(-45deg) translate(-32%, -335%);
    }

    /* メニューリストのセパレートボーダー */
    .hamburger-menulist-half li {
      position: relative;
      margin-bottom: .5em;
    }

    .hamburger-menulist-half a {
      padding: 0.5em 1em;
    }

    .hamburger-menulist-half a:before,
    .hamburger-menulist-half a:after {
      position: absolute;
      content: "";
      width: 2em;
      height: 1em;
      z-index: -1;
    }


  
    .naname {
      /*コレ*/
      width: 310px;
      border: 0;
      border-top: 200px solid #fcf818;
      position: absolute;
      bottom: -50px;
      right: 0px;
      margin: 0;
      padding: 0;
    }


    .eo {
      background-color: red;
      width: 500px;
      height: 500px;
    }


    .aaa {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      font-size: 2vw;
    }
  </style>
  <!-- <link rel="stylesheet" href="style.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

</head>

<body>

  <div class="hamburger-demo-menubox">

    <input id="hamburger-demo8" type="checkbox" class="input-hidden">
    <label for="hamburger-demo8" class="hamburger-demo-switch hamburger-demo-switch8">

      <span class="hamburger-switch-half"></span>
    </label>
    <div class="hamburger-demo-menuwrap hamburger-menuwrap-right">
      <hr class="naname">
      <ul class="hamburger-demo-menulist hamburger-menulist-half">
        <li><a href="tagsearch.php">タグ検索</a></li>
        <li><a onclick="logout()">ログアウト</a></li>
      </ul>
    </div>
    <div class="hamburger-demo-cover"></div>
  </div>
  <header>
    <form name="nextPhp" action="search.php">
      <div class="search-box">
        <input type='hidden' id='tab' name='tab' value='top'>
        <input class="search-txt" type="text" id="searchText" name="search" placeholder=" 検索...">
        <button class="search-btn"><i class="fas fa-search"></i></button>
      </div>
      <div method="GET" id="getSend">

      </div>
      <a href="./homeP.php">
        <img class="logo" src="./img/omxiv=st.png" onmouseover="this.src='./img/omxiv=.gif'" onmouseout="this.src='./img/omxiv=fi.png'">
      </a>
      <a class="btn btn-c btn--yellow btn--cubic" href="imageupload.php">
        作品の投稿
      </a>
    </form>

    <a href="./search_user.php?user=<?= $acc; ?>"><img class="icon" src="iconimage.php?id=<?= $acc; ?>"></img></a>

  </header>
  <script>
    function logout() {
      if (confirm("ログアウトしますか?")) {
        location.href = "http://localhost/sysdev/branches/step1/logout.php";
      }
    }

    // Enterキー押下時、送信処理が実行する
    window.document.onkeydown = function(event) {
      if (document.getElementById("searchText") === document.activeElement) {
        if (event.key === 'Enter') {
          var repText = document.getElementById("searchText").value;
          repText = repText.replace(/\s+/g, ' ');
          // 変数に空白が入っていた場合はif文内に入る
          if (~repText.indexOf(' ')) {
            document.getElementById("tab").value = "tag";
            document.getElementById("searchText").value = repText;
          }
        }
      }
    }
  </script>
</body>

</html>