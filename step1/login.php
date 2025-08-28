<?php

session_start();

    ?>

<!DOCTYPE html>

<html lang="ja">

<head>

    <meta charset="UTF-8">

    <title>Document</title>

<style>
*, *:before, *:after {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: "Open Sans", Helvetica, Arial, sans-serif;
  background: #f6f6f6;
}

input, button {
  border: none;
  outline: none;
  background: none;
  font-family: "Open Sans", Helvetica, Arial, sans-serif;
}

.tip {
  font-size: 25px;
  margin: 50px auto 30px;
  text-align: center;
  color: #a0a0a0;
}

.cont {
  overflow: hidden;
  position: relative;
  width: 900px;
  height: 550px;
  margin: 0 auto 100px;
  background: #fff;
}

.form {
  position: relative;
  width: 640px;
  height: 100%;
  transition: transform 1.2s ease-in-out;
  padding: 50px 30px 0;
}

.sub-cont {
  overflow: hidden;
  position: absolute;
  left: 640px;
  top: 0;
  width: 900px;
  height: 100%;
  padding-left: 260px;
  background: #fff;
  transition: transform 1.2s ease-in-out;
}
.cont.s--signup .sub-cont {
  transform: translate3d(-640px, 0, 0);
}

button {
  display: block;
  margin: 0 auto;
  width: 260px;
  height: 36px;
  border-radius: 30px;
  color: #fff;
  font-size: 15px;
  font-weight: 600;
  cursor: pointer;
}

.img {
  overflow: hidden;
  z-index: 2;
  position: absolute;
  left: 0;
  top: 0;
  width: 260px;
  height: 100%;
  padding-top: 360px;
}
.img:before {
  content: "";
  position: absolute;
  right: 0;
  top: 0;
  width: 900px;
  height: 100%;
  background-image: url("./img/banner.jpg");
  background-size: cover;
  transition: transform 1.2s ease-in-out;
}
.img:after {
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
}
.cont.s--signup .img:before {
  transform: translate3d(640px, 0, 0);
}
.img__text {
  z-index: 2;
  position: absolute;
  left: 0;
  top: 50px;
  width: 100%;
  padding: 0 20px;
  text-align: center;
  color: #fff;
  transition: transform 1.2s ease-in-out;
}
.img__text h2 {
  margin-bottom: 10px;
  font-weight: normal;
}
.img__text p {
  font-size: 14px;
  line-height: 1.5;
}
.cont.s--signup .img__text.m--up {
  transform: translateX(520px);
}
.img__text.m--in {
  transform: translateX(-520px);
}
.cont.s--signup .img__text.m--in {
  transform: translateX(0);
}
.img__btn {
  overflow: hidden;
  z-index: 2;
  position: relative;
  width: 100px;
  height: 36px;
  margin: 0 auto;
  background: transparent;
  color: #fff;
  text-transform: uppercase;
  font-size: 15px;
  cursor: pointer;
}
.img__btn:after {
  content: "";
  z-index: 2;
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  border: 2px solid #fff;
  border-radius: 30px;
}
.img__btn span {
  position: absolute;
  left: 0;
  top: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
  transition: transform 1.2s;
}
.img__btn span.m--in {
  transform: translateY(-72px);
}
.cont.s--signup .img__btn span.m--in {
  transform: translateY(0);
}
.cont.s--signup .img__btn span.m--up {
  transform: translateY(72px);
}

h2 {
  width: 100%;
  font-size: 26px;
  text-align: center;
}

label {
  display: block;
  width: 260px;
  margin: 25px auto 0;
  text-align: center;
}
label span {
  font-size: 12px;
  color: #cfcfcf;
  text-transform: uppercase;
}

input {
  display: block;
  width: 100%;
  margin-top: 5px;
  padding-bottom: 5px;
  font-size: 16px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.4);
  text-align: center;
}

.forgot-pass {
  margin-top: 15px;
  text-align: center;
  font-size: 12px;
  color: #cfcfcf;
}

.submit {
  margin-top: 40px;
  margin-bottom: 20px;
  background: #fcc800;
  text-transform: uppercase;
}



.sign-in {
  transition-timing-function: ease-out;
}
.cont.s--signup .sign-in {
  transition-timing-function: ease-in-out;
  transition-duration: 1.2s;
  transform: translate3d(640px, 0, 0);
}

.sign-up {
  transform: translate3d(-900px, 0, 0);
}
.cont.s--signup .sign-up {
  transform: translate3d(0, 0, 0);
}



.logo{
     position: absolute;
      top: 20px;
      left:38% ;
      width: 170px;
      height: 80px;
      object-fit: fill;
}

</style>

</head>

<body>
<p class="tip">Welcome omxiv.</p>
<div class="cont">

  <div class="form sign-in">
    <form action="insert/loginAC.php" method="post" name="f2">
    <img class="logo" src="./img/omxiv=st.png" onmouseover="this.src='./img/omxiv=.gif'" onmouseout="this.src='./img/omxiv=fi.png'">
    <br><br><br>
    <label>
      <span>UserName</span>
      <input type="text" name="id"/>
    </label>
    <label>
      <span>Password</span>
      <input type="password" name="pw" maxlength="16"/>
    </label>
    <button type="submit" class="submit">ログイン</button>
    <br><br><br><br><br>
    <label>
    <span>©︎ 2022-2023, We love omelet rice team</span>
    </label>
    </form>
  </div>


  <div class="sub-cont">
    <div class="img">
      <div class="img__text m--up">
        <h2>新規作成</h2>
        <p>アカウントをお持ちでない場合は<br>新規作成をしてください</p>
      </div>
      <div class="img__text m--in">
        <h2>ログイン</h2>
        <p>既にアカウントをお持ちの場合は<br>ログインしてください</p>
      </div>
      <div class="img__btn">
        <span class="m--up"><button>新規作成</button></span>
        <span class="m--in"><button>ログイン</button></span>
       
      </div>
    </div>

    <div class="form sign-up">
    <form action="insert/DBcheck.php" method="post" name="f1" >
    <img class="logo" src="./img/omxiv=st.png" onmouseover="this.src='./img/omxiv=.gif'" onmouseout="this.src='./img/omxiv=fi.png'">
    <br><br>
      <label>
        <span>UserName</span>
        <input type="text" name="name" id="name" maxlength="20"/>
      </label>
      <label>
        <span>Email</span>
        <input type="email" name="address" id="address"/>
      </label>
      <label>
        <span>Password</span>
        <input type="password" name="password" id="password" maxlength="16"/>
      </label>
      <button type="button" class="submit" onclick="check()">新規作成</button>
      <br><br><br>
      <label>
    <span>©︎ 2022-2023, We love omelet rice team</span>
    </label>
    </form>
    </div>
  </div>
</div>
</body>
<script>
    document.querySelector('.img__btn').addEventListener('click', function() {
  document.querySelector('.cont').classList.toggle('s--signup');
});
</script>

<script>
function check(){

      var name = document.getElementById("name").value;
      var add = document.getElementById("address").value;
      var pass = document.getElementById("password").value;
     
      var addpattern = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]+[.]{1}[A-Za-z0-9]+/;
      var passpattern = /^[a-zA-Z0-9.?/-]{8,16}$/;
      var flg_name = false;
      var flg_pass = false;
      var flg_add = false;
           
        if(name==null||name==""||name.length<=0||!name.match(/\S/g)){
          alert("名前を入力してください");
        }else{
          flg_name=true;
        }
        if (add.match(addpattern)) {
        /*パターンにマッチした場合*/
        flg_add = true;
        } else {
        /*パターンにマッチしない場合*/
        alert("メールアドレスの形式ではないです");
        }
        
        var length = pass.length;
        if(pass ==""||pass==null){
          alert("パスワードを入力してください");
        }else if(pass.match('( |　)+')){
          alert ("パスワードに半角または全角空白は入力しないでください");
        }else if(length <= 7){
           alert ('パスワードは8文字以上にしてください');
        }else if(!(pass.match(passpattern))){
          alert("パスワードに使えない文字が使われています");
        }else if(pass.match(passpattern)){
          flg_pass = true;
        }
      
        if(flg_add == true && flg_pass==true && flg_name==true){
          var form = document.f1;
          document.f1.submit();
        }
  }
   window.onload = function() {
    <?php 
    if(isset($_SESSION['flag'])){
      $flag = $_SESSION['flag'];
    }else{
      $flag = 0;
     }
     if(isset($_SESSION['err'])){
      
      $err = $_SESSION['err'];
     }else{
      $err = 0;
     }?>
    var flg = <?php echo $flag; ?>;
    var err = <?php echo $err; ?>;
    console.log(err);
  
    if(flg == 1){
      alert("アカウント作成ありがとうございます");
      <?php unset($_SESSION['flag']);  ?>
    }
      if(document.referrer == "http://localhost/training/branches/step1/login.php"){
        alert("入力したメールアドレスは既に使われていました\n別のメールアドレスを入力してください。");
      }
    if(err == 1){
      alert('正しいユーザID、パスワードを入力してください!');
    }
      
     }
   
    
    </script>
</html>
