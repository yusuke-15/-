<?php
session_start();
if (isset($_SESSION['accountID']) && isset($_SESSION['ok'])) {
} else {
  header("Location: http://localhost/sysdev/branches/step1/login.php");
}
?>

<?php
    require_once "PDO_cun.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
       h1{
        font-size: large;
       }
       button{
        align-items: center;
       }
       body{
        margin:0;
  font-family: "Open Sans", Helvetica, Arial, sans-serif;
  overflow-y: scroll;
}

.logoer {
    margin-top:-30px;
      width: 500px;
      height: 500px;
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
    <script>
    
    </script>
</head>
<body>
<?php include 'inc/header.php'; ?>
    <center>
    <img class="logoer" src="img/toukouS.png" onmouseover="this.src='img/toukouF.gif'" >
    <br><br>
    <button onclick="location.href='imageupload.php'"  class="btn btn-flat"><span>投稿を続ける</span></button>
    <br><br>
    <button onclick="location.href='homeP.php'"  class="btn btn-flat"><span>ホーム画面に戻る</span></button></center>
    <br><br>
    <footer>
    <a><img class="foot" src="./img/supun.jpg"></img></a>
  </footer>
</body>
</html>