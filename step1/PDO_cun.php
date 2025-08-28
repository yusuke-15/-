<?php
//コンストラクタで接続して、デストラクタで切断する
class PDO_cun{
    public $db;
    function __construct(){
   try{
        $this->db = new PDO('mysql:host=localhost;dbname=A_step1;charset=utf8','root','admin');
        $this->db ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "<script>window.location.href = 'errevent.php';</script>";
        exit();
    } catch (Exception $e) {
        print $e->getMessage();
    
    }
}
    public function sql_exe_list($sql){
        return $this->db->query($sql);
    }
    public function sql_exe_oneLine($sql){
        $stmt =  $this->db->query($sql);
        return $stmt->fetch();

    }
    //homePで使う
    public function home_date(){
        return $stmt =  $this->db->query("select picture.pictureID,picture.picture,picture.title,account.userName,account.accountID from picture join account on picture.accountID = account.accountID");
     }
     //artwork_viewで使う
      public function artwork($id){
          $stmt =  $this->db->query("SELECT * from picture where pictureID = " . $id);
         return $stmt->fetch();
     }
     //artwork_viewでコメントを探す
     public function artwork_view_com($id){
         return $stmt =  $this->db->query("SELECT text,picture.pictureID,comment.pictureID from comment join picture on comment.pictureID = picture.pictureID where picture.pictureID='" . $id."'order by comment.commentID desc");
        
     }
     //閲覧数を増やす
     public function view_plus($id){
         $this->db->query("UPDATE picture set view = view+1 where pictureID = " . $id);
     }
     //artwork_viewで使う　投稿者のデータ取得
     public function acc_info($id){
          $stmt =  $this->db->query("SELECT * from account join picture on picture.accountID = account.accountID where account.accountID=" . $id);
          return $stmt -> fetch();
     }
      //artwork_viewで使う　投稿者の他の作品取得
     public function otherart($id){
         return $stmt =  $this->db->query("SELECT * from picture where picture.accountID ='" . $id ."'order by picture.date desc");
      }
      //作者検索
     public function search_name($search){
         return $stmt = $this ->db->query('select accountID, userName from account where userName like "%' . $search . '%";');
     }
      //タイトル検索
      public function search_title($search){
         return $stmt = $this ->db->query("select picture, accountID, pictureID, title from picture where title like '%" . $search . "%';");
     }
     public function sql_insert($sql){
         return $this->db->query($sql);
     }
     public function acc_insert($sql){
        return $this ->db->prepare($sql);
    }
    //特定のカラムを1行ずつよむ関数
    public function sql_exe_oneColumn($sql){
        $stmt =  $this->db->query($sql);
        return $stmt->fetchColumn();
    }

    function __destruct()
    {
        $this->db= null;
    }
}
?>