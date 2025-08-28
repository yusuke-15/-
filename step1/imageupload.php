<?php
session_start();
if (isset($_SESSION['accountID']) && isset($_SESSION['ok'])) {
} else {
  header("Location: http://localhost/sysdev/branches/step1/login.php");
}
?><?php
require_once('function.php');
// include "OriginalPDOException.php";
//function.phpのfunction conecctDBにアクセス
$pdo = connectDB();
$msg = "";


if ($_SERVER['REQUEST_METHOD'] != 'POST') {
     // 画像を取得
     $sql = 'SELECT * FROM picture ORDER BY pictureID DESC';
     $stmt = $pdo->prepare($sql);
     $stmt->execute();
     $images = $stmt->fetchAll();

} else {
    // 画像を保存
    try{  
    if (!empty($_FILES['image']['name'])) {
       $name = htmlentities($_FILES['image']['name'], ENT_QUOTES, 'UTF-8');
        $type = $_FILES['image']['type'];
        $content = file_get_contents ($_FILES['image']['tmp_name']);
        $size = $_FILES['image']['size'];
        if(!empty($_POST['title'])){$title = htmlentities($_POST["title"], ENT_QUOTES, 'UTF-8');
        }else{
          $title="無題の作品";
        }
        
        //$info = $_POST["info"];
        $info = htmlentities($_POST["info"], ENT_QUOTES, 'UTF-8');
        $account = $_SESSION['accountID'];

       
        //sql文
        $sql = 'INSERT INTO picture(pictureID,picture,ext,date,title,info,view,bookmark,accountID)
                VALUES (null,:image_content,:image_name,now(),:image_title,:image_info,0,0,:image_account)';
         //function.phpにsql文を送る
        $stmt = $pdo->prepare($sql);
         //insertのvaluesに入っている「:〇〇」とPHPの変数を紐づける
        $stmt->bindValue(':image_content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':image_name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':image_title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':image_info', $info, PDO::PARAM_STR);
        $stmt->bindValue(':image_account', $account, PDO::PARAM_INT);
        //sql文の実行
        $stmt->execute();
         //executeが完了していればtrueが入るため、falseの場合のエラー処理（ここが必要か正直わからない）
        if(!$stmt){
            echo "\nPDO::errorInfo():\n";
            print_r($pdo->errorInfo());
        }
        //タグをセッションに入れる
       
        $_SESSION["tag1"] = htmlentities($_POST["tag1"], ENT_QUOTES, 'UTF-8');
        $_SESSION["tag2"] = htmlentities($_POST["tag2"], ENT_QUOTES, 'UTF-8');
        $_SESSION["tag3"] = htmlentities($_POST["tag3"], ENT_QUOTES, 'UTF-8');
        $_SESSION["tag4"] = htmlentities($_POST["tag4"], ENT_QUOTES, 'UTF-8');
        $_SESSION["tag5"] = htmlentities($_POST["tag5"], ENT_QUOTES, 'UTF-8');
        //sql実行して完了したら「投稿完了しました！」のページに飛ぶ
        header('Location:tagmake.php');
        exit();

      
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
    header('Location:imageupload.php');
    exit();

}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Image Test</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <style>
      *{
         margin: 0;
  padding: 0;
}
      img{
        width: 500px;
        height: auto;
      }
      #info{
        resize: none;
        overflow: hidden;
        width:600px;
        height:150px;
        box-sizing: border-box;
      }
      #word-count{
        color:#737373;
        text-align: right;
      }
      form{
        text-align: center;
        height: auto;
        margin-left: 350px;
        margin-right: 350px;
        margin-top: 100px;
      }

body{
  
  font-family: "Open Sans", Helvetica, Arial, sans-serif;
  background: #f0f0f0;
  overflow-y: scroll;
}

.image_in{
  background: #fff;
  border-radius: 10px;

}
.pre{
  border: solid #999 0.1px;
}

.tytle{
  background: #fff;
  border-radius: 10px;
}

hr{
    border: none;
    border-bottom: 1.5px solid #e0e0e0;
    margin-left: 30px;
    margin-right: 30px;
    margin-top: 10px;
}

.fileim {
    padding: 10px 40px;
    color: #ffffff;
    background-color: #4a4a4a;
    cursor: pointer;
}
input[type="file"] {
    display: none;
}

.tou{
  text-align: center;
  background-color: #404040;
  color:#efefef;
  height:60px;
}
.tou a{
  font-size:21px ;
  position: absolute;
  top:85px;
  left:730px;
}

.irasuto{
  position: absolute;
  width:40px;
  height:40px;
  top:80px;
  left:680px;
}


.cp_iptxt {
	position: relative;
	width: 80%;
	margin: 15px 10%;
}
.cp_iptxt .title {
	font: 15px/24px sans-serif;
	box-sizing: border-box;
	width: 600px;
	padding: 0.3em;
	transition: 0.3s;
	letter-spacing: 1px;
	color: #565656;
	border: 1px solid #b6b6b6;
	border-radius: 4px;
}
.ef .title:focus {
	border: 1px solid #fcf818;
	outline: none;
	box-shadow: 0 0 5px 1px rgba(218,60,65, .5);
}

.cp_iptxt textarea {
	font: 15px/24px sans-serif;
	box-sizing: border-box;
	width: 500px;
	padding: 0.3em;
	transition: 0.3s;
	letter-spacing: 1px;
	color: #565656;
	border: 1px solid #b6b6b6;
	border-radius: 4px;
}
.ef textarea:focus {
	border: 1px solid #fcf818;
	outline: none;
	box-shadow: 0 0 5px 1px rgba(218,60,65, .5);
}

.cp_iptxt .tag {
	font: 15px/24px sans-serif;
	box-sizing: border-box;
	width: 100px;
	padding: 0.3em;
	transition: 0.3s;
	letter-spacing: 1px;
	color: #565656;
	border: 1px solid #b6b6b6;
	border-radius: 4px;
  float: left;
  margin-left: 25px;
}
.ef .tag:focus {
	border: 1px solid #fcf818;
	outline: none;
	box-shadow: 0 0 5px 1px rgba(218,60,65, .5);
}

.flC{
  clear: both;
}


.btn,
button.btn {
  font-size: 20px;
  font-weight: 600;
  line-height: 1.5;
  position: relative;
  display: inline-block;
  padding: 10px 40px;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  -webkit-transition: all 0.3s;
  transition: all 0.3s;
  text-align: center;
  vertical-align: middle;
  text-decoration: none;
  letter-spacing: 0.1em;
  color: #212529;
  border-radius: 0.5rem;
  border:none;
}

button.btn--yellow {
  color: #000;
  background-color: #fff100;
  border-bottom: 5px solid #ccc100;
}

button.btn--yellow:hover {
  margin-top: 3px;
  color: #000;
  background: #fff20a;
  border-bottom: 2px solid #ccc100;
}

.dai{
  text-align: left;
  margin-left: 100px;
  font-size: 20px;
  color: #909090;
}

.foot{
  margin-left: 45%;
  margin-bottom: -10px;
  width:150px;
  height:100px;
  opacity: .50;
}
.oup{
  color: #909090;
}
    </style>
  </head>

<body>

    <!-- header.php の読み込み -->
<?php include 'inc/header.php'; ?>
  <div class="zen">
    <div class="tou">
    <img src="img/irasuto.png" class="irasuto">
      <a class="irasutoT">作品投稿</a>
    </div>
  <form method="post" enctype="multipart/form-data">
    <div class="image_in"> 
    <img id="preview" class="pre"><br><br>
    <label class="fileim">
    <input type="file" id="File1" class="image" name="image"  onchange="previewFile(this);"  />ファイルを選択
    </label>
    <br><br>
    <div id="output" class="oup"></div>
   

    </div>
    <br>
<div class="tytle">
<br>
<p class="dai">タイトル(半角30文字まで)</p>
 <div class="cp_iptxt">
	<label class="ef">
	<input type="text" name="title" id="title" class="title" maxlength="<?php print $titlemax;?>">
	</label>
</div>
<hr>
<br>
<?php $tagmax = 8; ?>
<?php $titlemax = 30; ?>
<p class="dai">タグ(最大5つまで/1つあたり<?php print $tagmax;?>文字まで)</p>
 <div class="cp_iptxt">
	<label class="ef">
	<input type="text"  name="tag1" id="tag1" class="tag" maxlength="<?php print $tagmax;?>">
	</label>
</div> 
<div class="cp_iptxt">
	<label class="ef">
	<input type="text"  name="tag2" id="tag2" class="tag" maxlength="<?php print $tagmax;?>">
	</label>
</div>

<div class="cp_iptxt">
	<label class="ef">
	<input type="text"  name="tag3" id="tag3" class="tag" maxlength="<?php print $tagmax;?>">
	</label>
</div>
<div class="cp_iptxt">
	<label class="ef">
	<input type="text"  name="tag4" id="tag4" class="tag" maxlength="<?php print $tagmax;?>">
	</label>
</div>
<div class="cp_iptxt">
	<label class="ef">
	<input type="text"  name="tag5" id="tag5" class="tag" maxlength="<?php print $tagmax;?>">
	</label>
</div>
<br class="flC">
<hr > <br>
<p class="dai">キャプション</p>
    <div class="cp_iptxt">
	<label class="ef">
  <textarea  name="info"   maxlength="300" id="info"></textarea><br>
	</label>
  <p id="word-count">0/300</p>
</div>
    
</div>
    <button type="submit" class="btn btn--yellow btn--cubic">投稿する</button>
    <input type="hidden" name="tags" value="<?php echo $pID; ?>">
  </form>   
  </div>
  <br>
  <br>
  <footer>
    <a><img class="foot" src="./img/supun2.jpg"></img></a>
  </footer>

<script>
  function previewFile(hoge){
    var fileData = new FileReader();
    fileData.onload = (function() {
      //id属性が付与されているimgタグのsrc属性に、fileReaderで取得した値の結果を入力することで
      //プレビュー表示している
      document.getElementById('preview').src = fileData.result;
    });
    fileData.readAsDataURL(hoge.files[0]);
    var fileRef = document.getElementById('File1');
      var outFrame = document.getElementById('output');

      for (i = 0; i < fileRef.files.length; i++) {
        outFrame.innerHTML = fileRef.files[i].name +"<br/>";
      }
}



  document.querySelector(`textarea`).addEventListener(`input`, function () {
    document.querySelector(`#word-count`).textContent = `${0 + document.querySelector(`textarea`).value.length}/300`;
  })
</script>
</body>
</html>