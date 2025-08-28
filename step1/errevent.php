<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            color:black;
            margin:0;
        }
        .logo2{
            height:450px;
            width:450px;
        }

 .btn,
a.btn,
button.btn {
    top:-50px;
  font-size: 1.4rem;
  font-weight: 700;
  line-height: 1.5;
  position: relative;
  display: inline-block;
  text-decoration: none;

}

.btn-flat {
  overflow: hidden;
  padding: 0.5rem 1.5rem;
  background: #000;
  color: #fff;
}

.btn-flat span {
  position: relative;
}


.btn-flat:before {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  content: '';
  -webkit-transition: all .5s ease-in-out;
  transition: all .5s ease-in-out;
  -webkit-transform: translateX(-96%);
  transform: translateX(-96%);
  background: #fcf818;
}
.btn-flat :hover{
    color:#000;
}
.btn-flat:hover:before {
  -webkit-transform: translateX(0%);
  transform: translateX(0%);
  
}
.foot{
  margin-left: 45%;
  margin-bottom: -10px;
  width:150px;
  height:100px;
  opacity: .50;
}
    </style>
</head>
<body>
    <!-- header.php の読み込み -->
<?php include 'inc/header.php'; ?>
    <div  align="center">
    <img class="logo2" src="./img/om_error.png">
<br>
<a href="login.php" class="btn btn-flat"><span>ログイン画面に戻る</span></a>
<br>
<br>
<a href="homeP.php" class="btn btn-flat"><span>ホーム画面に戻る</span></a>
   </div>
   <footer>
    <a><img class="foot" src="./img/supun.jpg"></img></a>
  </footer>
</body>
</html>