<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!--slickを導入-->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

  <!--homeC.cssを導入-->
  <link rel="stylesheet" href="homeC.css">
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
      right: -60px !important;
    }

    .slick-prev {
      left: -60px !important;
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
      background: url(img/Yajirushi_R.png) !important;
      background-size: contain !important;
    }

    .slick-prev:before {
      background: url(img/Yajirushi_L.png) !important;
      background-size: contain !important;
    }
  </style>
  <script>
    $(function() {
      $('.artwork').click(function() {
        var val = 0;
        val = this.value;
        $('.ssss').val(val); 
      });
    });
  </script>
  <!--仮で入れていいるヘッダー-->


  <!--データベースに接続-->
  <?php
 require_once "../PDO_cun.php";
 include "../OriginalException.php";
  $dbconnect = new PDO_cun();
  $stmt = $dbconnect->sql_exe_list("select * from picture");
  $stmt2 = $dbconnect->sql_exe_list("select * from picture");
  ?>

  <br>

  <!---->
  <h1 style="text-align:center">よそうこ、Omsivへ。</h1>

  <div align="center">
    <div align="left">
      <div class="list_name">
        オムライス一覧
      </div>
    </div>
    <form action="artwork_view.php" method="post" id="f1">
      <input type="hidden" name="ssss" class="ssss" value="">
      <div id="firstframe" class="single-item">
        <?php
        while ($result = $stmt->fetch()) {
          $img = base64_encode($result[1]);?>
           <span class="secondframe"><div class="inner">
           <a href="artwork_view.php?picID=<?php echo $result[0]?>"><img src="data:<?php echo $result[7]?>;base64,<?php echo $img;?>"class="artwork" > </a>
          </div></span>
          
        <?php } ?>
        
      </div>
      <div align="center">
        <input type="button" value="もっと見る" class="watchmore">
      </div>
    <div align="left">
      <div class="list_name">
        オムムメ一覧
      </div>
    </div>
    <div id="secondframe" class="single-item">

      <!--二列目-->
      <?php
      while ($result = $stmt2->fetch()) {
        print('<span class="secondframe"><div class="inner">
          <input type="image"  class="artwork" src="pic/' . $result['sauce'] . '">
          </div></span>');
      }
      $stmt2 = null;
      ?>
    </div>
    <div align="center">
      <input type="button" value="もっと見る" class="watchmore">
    </div>
    </form>
  </div>

  <!--slick用のscript-->
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
  </script>
</body>

</html>