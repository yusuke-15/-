<?php 
session_start();


require_once '../PDO_cun.php';
$db = new PDO_cun();
        $comment = null;
        $data = array(null);
        $time = new DateTime();
        $date = $time->format('Y-m-d');
        $picID = $_POST['artwork_id']; //$picId;
        $acc = $_SESSION['accountID'];
        $uri = $_SERVER['HTTP_REFERER'];
        $com = htmlentities($_POST['artwork_comment_add'], ENT_QUOTES, 'UTF-8');
        $coment = str_replace(' ', '', $com);
        $comment = str_replace('　', '', $coment);
        $time->setTimeZone(new DateTimeZone('Asia/Tokyo'));
if(!empty($_POST['artwork_comment_add'])&&$_SERVER['REQUEST_METHOD'] === 'POST'&&$acc!=null&&!(empty($comment))){
        $sql = 'Insert into comment values(?,?,?,?,?)';
       
        array_push($data, $comment, $date, $picID, $acc);
        
        $stmt = $db->acc_insert($sql);
        $stmt -> execute($data);
      header('Location:'.$uri,true,303);
}else{
        header('Location:'.$uri,true,303);
}

exit();
?>