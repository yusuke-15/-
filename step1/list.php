<?php
session_start();
if (isset($_SESSION['accountID']) && isset($_SESSION['ok'])) {
} else {
  header("Location: http://localhost/sysdev/branches/step1/login.php");
}
?><?php
require_once('function.php');
// include "OriginalPDOException.php";

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
        $name = $_FILES['image']['name'];
        $type = $_FILES['image']['type'];
        $content = file_get_contents($_FILES['image']['tmp_name']);
        $size = $_FILES['image']['size'];
        $title = $_POST["title"];
        $info = $_POST["info"];
        $account = $_SESSION['accountID'];
            // if($size<900000){
                
            // }
        $sql = 'INSERT INTO picture(pictureID,picture,ext,date,title,info,view,bookmark,accountID)
                VALUES (null,:image_content,:image_name,now(),:image_title,:image_info,0,0,:image_account)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':image_content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':image_name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':image_title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':image_info', $info, PDO::PARAM_STR);
        $stmt->bindValue(':image_account', $account, PDO::PARAM_INT);

        $stmt->execute();
        if(!$stmt){
            echo "\nPDO::errorInfo():\n";
            print_r($pdo->errorInfo());
        }
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
        $msg='画像サイズが大きすぎます！！！！！';
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
    header('Location:list.php');
    exit();

}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Image Test</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <!-- <div class="row">
        <div class="col-md-8 border-right">
            <ul class="list-unstyled">
                <?php for($i = 0; $i < count($images); $i++): ?>
                    <li class="media mt-5">
                        <a href="#lightbox" data-toggle="modal" data-slide-to="<?= $i; ?>">
                            <img src="image.php?id=<?= $images[$i]['image_id']; ?>" width="100" height="auto" class="mr-3">
                        </a>
                        <div class="media-body">
                            <h5><?= $images[$i]['image_name']; ?> (<?= number_format($images[$i]['image_size']/1000, 2); ?> KB)</h5>
                            <a href="#"><i class="far fa-trash-alt"></i> 削除</a>
                        </div>
                    </li>
                <?php endfor; ?>
            </ul>
        </div> -->
        <div class="col-md-4 pt-4 pl-4">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>画像を選択</label>
                    <input type="file" name="image" required><br>
                    タイトル<input type="text" name="title" id="title"><br>
                    概要<input type="text" name="info" id="info"><br>
                </div>
                <button type="submit" class="btn btn-primary">保存</button>
            </form>
        </div>
    </div>
</div>

<!-- <div class="modal carousel slide" id="lightbox" tabindex="-1" role="dialog" data-ride="carousel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-body">
            <ol class="carousel-indicators">
                <?php for ($i = 0; $i < count($images); $i++): ?>
                    <li data-target="#lightbox" data-slide-to="<?= $i; ?>" <?php if ($i == 0) echo 'class="active"'; ?>></li>
                <?php endfor; ?>
            </ol>
            <div class="carousel-inner">
                <?php for ($i = 0; $i < count($images); $i++): ?>
                    <div class="carousel-item <?php if ($i == 0) echo 'active'; ?>">
                    <img src="image.php?id=<?= $images[$i]['image_id']; ?>" class="d-block w-100">
                    </div>
                <?php endfor; ?>
            </div>
            <a class="carousel-control-prev" href="#lightbox" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#lightbox" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
</div> -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>