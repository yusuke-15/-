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
  <!--slickを導入-->
  <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" /> -->
  <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
  <link rel="stylesheet" href="slick.css">
  <link rel="stylesheet" href="slick-theme.css">
  <!--homeC.cssを導入-->
  <link rel="stylesheet" href="homeB.css">
</head>

<body>
  <!--slick用のcss-->
  <style>
    /*--スライダーの位置とサイズ調整--*/
    .slider {
      width: 50%;
      margin: 0 auto;
    }

    /*--------画像サイズ調整---------*/
    img {
      width: 100%;
    }

    /*-----------height調整----------*/
    .slick-slide {
      height: auto !important;
    }

    /*-----------矢印表示----------*/
    .slick-next {
      top: 120px;
      right: -30px !important
    }

    .slick-prev {
      top: 120px;
      left: -10px !important;
    }

    .slick-arrow {
      z-index: 2 !important;
      width: 60px !important;
      height: 60px !important;
    }

    .slick-arrow:before {
      content: "" !important;
      width: 100% !important;
      height: 100% !important;
      position: absolute;
      top: 0;
      left: 0;
    }

    .slick-next:before {
      background: url(img/yaji_l.png) !important;
      background-size: contain !important;
    }

    .slick-prev:before {
      background: url(img/yaji_r.png) !important;
      background-size: contain !important;
    }
  </style>
  <?php
  ?>
  <!-- ヘッダー -->
  <?php include 'inc/header.php'; ?>
  <!--データベースに接続-->
  <?php
  //表示したいタグ見出しの数
  $watchMoreLimit = 2;  

  require_once "PDO_cun.php";
  $dbconnect = new PDO_cun();
  $pickuptag = array();
  // $rantag = $dbconnect->sql_exe_list("SELECT tagName FROM tagm ORDER BY RAND() LIMIT 2");
  $ranTagSql = "SELECT tagName FROM tagm ORDER BY RAND() LIMIT " . $watchMoreLimit;

  $rantag = $dbconnect->sql_exe_list("$ranTagSql");

  while ($result = $rantag->fetch()) {
    array_push($pickuptag, $result["tagName"]);
  };
  for ($i = 0; $i < $watchMoreLimit; $i++) {
    if (empty($pickuptag[$i]))
      $pickuptag[$i] = "";
  }
  $stmt = $dbconnect->sql_exe_list("select picture.pictureID,picture.picture,picture.title,account.userName,account.accountID from picture join account on picture.accountID = account.accountID order by view desc");

  $stmtAry = array();
  for ($i = 0; $i < $watchMoreLimit; $i++) {
    array_push($stmtAry, '$stmt' . $i);
    $stmtAry[$i] = $dbconnect->sql_exe_list("select * from picture as p,account as a where p.pictureID in (select distinct(pictureID) as 
  pid from tag where tagID in(select tagID as tid from tagM where tagName = '$pickuptag[$i]')) and p.accountID = a.accountID;  ");
  }
  ?>

  <br>

  <a><img class="bann_img" src="./img/banner.jpg"></img></a>
  <div class="bann_txt" align="right">
    <a class="btxt1">地球の外の世界</a>
    <br>
    <a class="btxt2">umiaoiyo</a>
  </div>
  <div align="center">
    <div align="left">
      <div class="list_name">
        オムムメ一覧
      </div>
    </div>

    <form action="" method="GET" id="f1" name="getTo">
      <div align="right">
        <a class="watchmore" href="watchmore.php?moreid=オムムメ">もっと見る</a>
      </div>
      <div id="firstframe" class="single-item">
        <?php
        while ($result = $stmt->fetch()) {
        ?>
          <span class="frame2">
            <a href="artwork_view.php?picID=<?php echo $result['pictureID'] ?>" class="inner">
              <img src="image.php?id=<?= $result['pictureID']; ?>" class="artwork"></a>
            <div align="left" class="artwork_frame">
              <a class="artwork_name"> <?php echo $result['title'] ?> </a>
              <br>
              <a class="account_name" href="search_user.php?user=<?= $result['accountID']; ?>">
                <img src="iconimage.php?id=<?= $result['accountID']; ?>" class="user_icon"></img></a>
              <a class="account_name" href="search_user.php?user=<?= $result['accountID']; ?>"><?php echo $result['userName'] ?> </a>
            </div>
          </span>
        <?php } ?>
      </div>


      <br><br>

      <?php
      for ($i = 0; $i < $watchMoreLimit; $i++) {
        echo "
              <div align='left'>
                <div class='list_name'>
                #" . $pickuptag[$i] . "一覧
                </div>
              </div>

              <div align='right'>
                <a class='watchmore' href='tagsearch.php?&search=" . $pickuptag[$i] . "'>
                  もっと見る
                </a>
              </div>

              <div id='secondframe' class='single-item'>
              ";
        while ($result = $stmtAry[$i]->fetch()) {
          $img = base64_encode($result[1]);
          echo "
                  <span class='frame2'>
                    <a href='artwork_view.php?picID=" . $result['pictureID'] . "' class='inner'>
                     <img src='image.php?id=" . $result['pictureID'] . "' class='artwork'>
                   </a>
                   <div align='left' class='artwork_frame'>
                      <a class='artwork_name'> 
                        " . $result['title'] . " 
                     </a>
                      <br>
                      <a class='account_name' href='search_user.php?user=" . $result['accountID'] . "'>
                        <img class='user_icon' src='iconimage.php?id=" . $result['accountID'] . "'>
                        </img>
                      </a>
                      <a href='search_user.php?user=" . $result['accountID'] . " 'class='account_name'>
                        " . $result['userName'] . " 
                     </a>
                    </div>
                  </span>
                  ";
        }
        echo "
              </div>
              <br><br>
              ";
      }
      ?>

    </form>
  </div>
 
  <!--slick用のscript -->
  <script>
    $(function() {
      $('.single-item').slick({
        accessibility: true,
        swipe: false,
        arrows: true,
        infinite: true,
        slidesToShow: 6,
        slidesToScroll: 3
      });
    });
    const CLASSNAME = "-visible";
    const TIMEOUT = 1500;
    const $target = $(".title1");

    setInterval(() => {
      $target.addClass(CLASSNAME);
      setTimeout(() => {
        $target.removeClass(CLASSNAME);
      }, TIMEOUT);
    }, TIMEOUT * 2);
  </script>
  <br><br><br><br><br><br><br><br><br><br>

</body>
<footer>
        <img class="foot" src="./img/supun.jpg"></img>
    </footer>
</html>