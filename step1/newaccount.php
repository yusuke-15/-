<?php
require_once "PDO_cun.php";
include "OriginalException.php";
$db = new PDO_cun();
session_start();

  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        form{
            text-align: center;
        }
        #ran{
            text-align: right;
            width: 60%;
        }
        #can{
            margin: 10px;
        }
        #attention{
          text-align: center;
        }
        #title,#info,#accountID{
            text-align: right;
        }
        img{
        width: 100px;
        height: auto;
        }
    </style>
  
</head>
<body>
  <h1>アカウント新規登録</h1>

<form action="insert/DBcheck.php" method="post" name="f1" enctype="multipart/form-data">
        <img id="preview">
        <input type="file" name="image" required onchange="previewFile(this);" ><br>
        <input type="hidden" name="url" id="url" >
        <div id="ran">
        ユーザー名<input type="text" name="name" id="name" maxlength="20"><br>
        メールアドレス<input type="e-mail" name="address" id="address" maxlength="319"><br>
        <span id="attention">
        パスワードは8文字以上16文字以内で設定してください。<br>
        パスワード入力欄に空白は入力しないでください。<br>
        使える文字はアルファベットの大文字小文字、数字、ピリオド、クエスチョンマーク、スラッシュ、ハイフンです。<br>
        </span>
        パスワード<input type="password" name="password" id="password" maxlength="16"><br></div>
        <button type="button" onclick="check()" >登録</button>
  
 </form>
</body>
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
      if(document.referrer == "http://localhost/sysdev/branches/step1/newaccount.php"){
        alert("入力したメールアドレスは既に使われていました\n別のメールアドレスを入力してください。");
      }
      console.log(document.referrer);
     }
    function previewFile(hoge){
    var fileData = new FileReader();
    fileData.onload = (function() {
      //id属性が付与されているimgタグのsrc属性に、fileReaderで取得した値の結果を入力することで
      //プレビュー表示している
      document.getElementById('preview').src = fileData.result;
    });
    fileData.readAsDataURL(hoge.files[0]);
  }
   
    </script>
</html>