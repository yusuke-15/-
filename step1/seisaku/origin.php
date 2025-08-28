<!doctype html>
<html dir="ltr" lang="ja">
  <head>
    <meta charset="utf-8">
    <title>新しいタブ</title>
   
  </head>
  <body>
   <?php
   class Origin extends Exception{
    /*function _construct(Exception $e){
        $msg = 'SQL接続エラー';
        switch($e->getCode()){
            case'1045':
                $msg='DB接続エラー(ユーザー名)';
                break;
            case'2002':
            case'2003':
                $msg='DB接続エラー(サーバー停止)';
                break;
            case'2005':
                $msg='DB接続エラー(ホストエラー)';
                break;
        }
        switch(get_class($e)){
            case'PDOException':
                exit($msg.'メンテナンスへ連絡してください<br>');
                break;
            case'Exception':
                exit('エラー:メンテナンスへ連絡してください<br>');
                break;
            default:
            print'予想外のエラーが発生しました。';
        }
    }*/
    static public function error_show(Exception $e){
        $msg = 'SQL接続エラー';
        switch($e->getCode()){
            case'1045':
                $msg='DB接続エラー(ユーザー名)';
                break;
            case'2002':
            case'2003':
                $msg='DB接続エラー(サーバー停止)';
                break;
            case'2005':
                $msg='DB接続エラー(ホストエラー)';
                break;
        }
        switch(get_class($e)){
            case'PDOException':
                exit($msg.'メンテナンスへ連絡してください<br>');
                break;
            case'Exception':
                exit('エラー:メンテナンスへ連絡してください<br>');
                break;
            default:
            print'予想外のエラーが発生しました。';
        }
    }
   }
   ?>
  </body>
</html>