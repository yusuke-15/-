<?php
session_start();
if (isset($_SESSION['accountID']) && isset($_SESSION['ok'])) {
} else {
    header("Location: http://localhost/sysdev/branches/step1/login.php");
}
include 'inc/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            background: #f0f0f0;
            font-family: 'メイリオ', sans-serif;
        }

        #artblock {
            /* height: 80%; */
            text-align: center;
            height: auto;
            margin: 0 5px 0 5px;
        }

        #artwork_bl {

            width: 800px;
            height: auto;
        }

        #art {
            height: auto;
            width: 750px;
            border-radius: 3px;
        }

        #container {
            display: flex;
            width: 1100px;
            padding: 20px 5% 0 5%;
            margin: auto;
        }

        #artwork_name {
            font-size: 23px;
            font-weight: 700;
        }

        #artwork_info {
            font-size: 15px;
            width: 795px;
            word-wrap: break-word;
            color: #808080;
            margin-bottom: 5px;
        }

        #artwork_date {
            font-size: 12px;
            color: #808080;
            margin-top: 5px;
        }

        #artwork_comment {
            margin-left: 5px;
        }

        #follow_bl {
            width: 500px;
            background-color: white;
            border-radius: 10px 10px 0px 0px;
        }

        #icon {
            width: 125px;
            height: 125px;
            margin-left: 10px;
            border-radius: 10px;
            cursor: pointer;
        }

        #userName {
            margin: 0px 0px 0px 5px;
            font-weight: 700;
            font-size:22px;
        }

        #userJiko {
            margin: 0px 0px 0px 5px;
            font-size:13px;
            color:#808080;
        }

       
        #followbt {
    -webkit-box-pack: center;
    justify-content: center;
    cursor: pointer;
    user-select: none;
    white-space: nowrap;
    color: #ffffff;
    background-color: #0096fa;
    font-size: 14px;
    line-height: 30px;
    font-weight: bold;
    width:320px;
    margin-left: 10px;
    border-radius: 999999px;
    border: none;
}

#followbt:hover {
    background-color: #028de9;
}
        #other_art {
            display: flex;
            margin-left: 10px;
        }

        #profile {
            display: flex;
        }

        #other_art img {
            margin-left: 1px;
            width: 75px;
            height: 75px;
            border-radius: 2px;
            margin-right: 5px;
        }

        .list {
            list-style: none;
        }
        .list img{
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        #comN{
            position: relative;
    margin-left: 3px;
    top: -30px;
    font-weight: 700;
    font-size: 16px;
    color:#202020;
        }

        #comT{
            position: relative;
            margin-top: -2px;
    margin-left: 53px;
    top: -30px;
    color:#202020;
        }
#comTa{
    font-size: 15px;
}
     #comTb{
        font-size: 11px;
        color:#c0c0c0;
     }

        img {
            object-fit: cover;
        }

        #kanren{
            color:#202020;
            font-weight: bold;
            font-size: 13px;
            margin-left: 10px;
            margin-top: 20px;
            margin-bottom: 5px;
        }

        .artT {
            width: 1040px;
            padding: 2px 30px;
            border-radius: 10px 0px 10px 10px;
            background-color: #fff;
            position: absolute;
            z-index: 2;
        }

        .tagN {
            order: 5;
            font-size: 16px;
            font-weight: 700;
            margin: 5px 3px;
            padding: 2px 8px;
            color: #fff;
            border-radius: 5px;
        }


        hr {
            border: none;
            border-bottom: 10px solid #f0f0f0;
            margin-left: -30px;
            margin-right: -30px;
            margin-top: 10px;
        }

        .artwork_comment_add {
            margin-left: 30px;
            width: 250px;
            border: 2px solid #aaa;
            border-radius: 4px;
            outline: none;
            padding: 4px;
            box-sizing: border-box;
            transition: 0.3s;
        }

        .artwork_comment_add:focus {
            border-color: #4169e1;
            box-shadow: 0 0 2px 0 #4169e1;
        }

        .send {
            width: 80px;
            font-size: 15px;
            color: #fff;
            display: inline-block;
            padding: 4px 0px;
            text-align: center;
            background-color: #4169e1;
            border: 1px solid #f0f0f0;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 1s;
        }

        /*--hover--*/
        .send:hover {
            color:#4169e1;
            background-color: #ffffff;
            border: 1px solid #4169e1;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 1s;
        }
        #artwork_connection{
            text-align: right;
        }
        #follow_btn{
            color:#909090;
            font-size: 12px;
            margin-right: 10px;
        }
        #follow_btn:hover{
            color:#606060;
        }
        #fot{
            background: #f0f0f0;
            margin-left: -100px;
            margin-right: -100px;
            margin-bottom: -10px;
        }
        .foot{
  margin-left: 45%;
  margin-top: 80px;
  margin-bottom: -8px;
  width:150px;
  height:100px;
  opacity: .50;
}
#motto{
color:#909090;
}
#motto:hover{
            color:#606060;
        }


        #favobt{
            position:absolute;
            top:5px;
            margin-left: 585px;
            background-color: transparent;
        border: none;
        cursor: pointer;
        outline: none;
        padding: 0;
        appearance: none;
        }
       
        .nya {
  font-size: 18px;
  font-weight: 700;
  line-height: 1.5;
  position: relative;
  display: inline-block;
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
  border-radius: 0.5rem;
  border:solid 1px #f0f0f0;
}

a.nya {
  padding: 5px 10px 5px 60px;
}

a.nya:before {
  position: absolute;
  top: 0;
  left: 0;
  width: 50px;
  height: 100%;
  padding:0px -10px;
  content: "";

  border-radius: 0.4rem 0 0 0.4rem;
}

a.nya {
  color: #fff;
  background: #ee827c;
}

a.nya:before {
  background: #fff;
 
}

a.nya i {
  font-size: 120%;

  position: absolute;
  top: 0;
  left: 0;

  width: 50px;
  padding: 7px 0px;

  -webkit-transition: all 0.3s;

  transition: all 0.3s;
  text-align: center;
  letter-spacing: 0;

  color: #e6c0c0;
}

a.nya:hover {
  background: #ff4500;
}

a.nya:hover i {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
  color: #ff4500;
}
       
#view{
    position:absolute;
            top:5px;
            margin-left: 435px;
}

.gya {
  font-size: 18px;
  font-weight: 700;
  line-height: 1.5;
  position: relative;
  display: inline-block;
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
  border-radius: 0.5rem;
  border:solid 1px #f0f0f0;
}

a.gya {
  padding: 5px 60px 5px 10px;
}

a.gya:before {
  position: absolute;
  top: 0;
  right: 0;
  width: 50px;
  height: 100%;
  padding:0px -10px;
  content: "";

  border-radius: 0 0.4rem 0.4rem 0;
}

a.gya {
  color: #3366ff;
  background: #fff;
}

a.gya:before {
  background: #3366ff;
 
}

a.gya i {
  font-size: 100%;

  position: absolute;
  top: 0;
  right: 0;

  width: 50px;
  padding: 6px 0px;

  -webkit-transition: all 0.3s;

  transition: all 0.3s;
  text-align: center;
  letter-spacing: 0;

  color: #fff;
}


    </style>
</head>

<body>
    <?php

    //ログインしているかチェック
    if (isset($_SESSION['ok'])) {
    } else {
        echo "ログインしていません</br></br>";
        echo '<a href="login.php">Login画面へ</a>';
    }
    require_once "PDO_cun.php";


    //遷移時のpictureID取得
    $id = "";
    if (isset($_GET['picID'])) $id = $_GET['picID'];
    $db = new PDO_cun();
    $pic = $db->sql_exe_oneLine("SELECT * from picture where pictureID = " . $id);
    $com = $db->sql_exe_list("SELECT text,picture.pictureID,comment.pictureID,comment.accountID,account.userName,comment.comdate from comment join picture on comment.pictureID = picture.pictureID join account on comment.accountID = account.accountID where picture.pictureID='" . $id . "' order by comment.commentID desc");
    $view_plus = $db->sql_exe_list("UPDATE picture set view = view+1 where pictureID = " . $id);
    $tagName = $db->sql_exe_list("SELECT tagName from tagM where tagID in (select tagID from tag where pictureID =" . $id . ")");


    ?>
    <div id="container">
        <div id="artwork_bl">
            <div id="artblock">
                <img src="image.php?id=<?= $pic['pictureID']; ?>" class="artwork" alt="作品" id="art">
            </div>
            <div class="artT">
                <br>
                
           
                <div id="view"><a class="gya" id="ga">閲覧数<i  id="gas"><?= $pic['view']; ?></i></a></div>
                <form id="favo" action="" method="POST">
                    <button type="submit"  id="favobt"><a class="nya" id="na"><i class="fas fa-heart" id="nas"></i>いいね!</a></button>
                    <input type="hidden" name ="favoflg" value="1" id="favoflg" >
                </form>
                <a id="artwork_name"><?php echo $pic['title']; ?></a> 
                <br>
                <div id="artwork_info"><?php echo $pic['info']; ?></div>
                <div id="artwork_tag">
                    <?php
                    // $tagArr = array();
                    // while ($tagArr = $tagName->fetch()) {
                    // }
                    $tagArr = $tagName->fetchAll();
                    // print_r($tagArr);
                    //取得したtagを表示
                    $iro = ["#00ac9b", "#f39700", "#009bbf", "#f62e36", "#8f76d6"];
                    $i = 0;
                    foreach ($tagArr as $tagName) {
                        // echo "・" . $tagName["tagName"] . " ";
                        echo "<a class='tagN' style=background-color:" . $iro[$i] . " href=search.php?tab=tag&search=" . $tagName['tagName'] . ">#" . $tagName['tagName'] . " </a>";
                        $i++;
                    }
                    ?>
                </div>
                <div id="artwork_date"><?php echo date('Y年n月j日', strtotime($pic['date'])) ?></div>
                <br>

                <hr>
                <form action="insert/com_insert_m.php" method="POST">
                    <input type="text" name="artwork_comment_add" class="artwork_comment_add" placeholder="コメント">
                    <input type="hidden" name="artwork_id" value="<?php echo $id ?>">
                    <input type="submit" value="追加" name="send" class="send">
                </form>

                <div id="artwork_comment">
                    <ul class="list">

                        <?php
                        $count = 0;
                        $comarr = $com->fetchAll();
                        //取得したコメントをwhileで表示
                        foreach ($comarr as $com) {
                           
                            $count++;
                            if ($count <= 3) {
                                echo "<img src='iconimage.php?id=" . $com['accountID'] . "' alt=" . '作者のアイコン' . " id=" . 'comicon' . ">"."<a id='comN'>".$com['userName']."</a>";
                              echo "<li id='comT'>" ."<a id='comTa'>".$com['text']."</a><br><a id='comTb'>".date('Y年n月j日', strtotime($com['comdate']))."</a></li>";
                                
                            } else {
                        ?>
                                <a onclick="more_com()" href="#" id="motto">もっと見る</a>
                        <?php
                                break;
                            }
                        } ?>

                    </ul>
                </div>
                <div id="fot">
            <footer>
    <a><img class="foot" src="./img/supun2.jpg"></img></a>
  </footer>
            </div>
            </div>
      
         
          
        </div>

        <div id="follow_bl">
            <?php
            //画面右側の作品投稿者のデータを取得
            $acc_info = $db->sql_exe_oneLine("SELECT * from account join picture on picture.accountID = account.accountID where account.accountID=" . $pic['accountID']);
            

            //作品投稿者のほかの作品取得                                                           
            $otherart = $db->sql_exe_list("SELECT * from picture where picture.accountID ='" . $acc_info['accountID'] . "'order by picture.date desc");
            $name = $acc_info['userName']

            ?>


            <form action="" method="POST" name="follow">
                <br>
                <a id="jump"><input type="submit" value="フォローする" id="followbt"></a>
                <input type="hidden" value="1" name="followflg" id="followflg">
            </form>
            <br>
            <div id="profile">
               <img src="iconimage.php?id=<?php echo $acc_info['accountID']; ?>" alt="作者のアイコン" id="icon" onclick="location.href='search_user.php?user=<?= $acc_info['accountID']; ?>'">
                <div id="profile2">
                    <p id="userName"><?php echo $name; ?></p>
                    <p id="userJiko"><?php echo $acc_info['introduction']; ?></p>
                </div>
            </div>

            <p id="kanren"><?php echo $name; ?>の関連作品</p>
            <div id="other_art">


                <?php
                //作品投稿者の他の作品表示　条件は今表示されている作品以外&4件まで
                $count = 0;
                while ($other_art = $otherart->fetch()) {
                    $otherdate = base64_encode($other_art['picture']);
                    if ($other_art['pictureID'] != $id && $count < 4) { ?>
                        <a href="artwork_view.php?picID=<?php echo $other_art['pictureID'] ?>" class="inner">
                            <img src="image.php?id=<?= $other_art['pictureID']; ?>" class="artwork"> </a>
                    <?php $count++;
                    } else {
                        continue;
                    }
                    ?>
                <?php } ?>
            </div>

            <div id="artwork_connection">
                <a id="follow_btn"  onclick="location.href='search_user.php?user=<?= $acc_info['accountID']; ?>'"  href="#"><?php echo $name; ?>の他の作品を見る</a>
            </div>
        </div>
    </div>

    <footer>
        <img class="foot" src="./img/supun2.jpg"></img>
    </footer>
</body>
<script>
    function more_com() {
        document.getElementById("artwork_comment").innerHTML = 
        "<ul class='list'>" +
        <?php foreach ($comarr as $com) { ?>
            "<img src='iconimage.php?id=<?php echo $com['accountID']; ?>' alt='作者のアイコン' id='comicon'/><a id='comN'><?php echo $com['userName'] ?></a>"+
           "<li id='comT'><a id='comTa'><?php echo $com['text']; ?></a> <br> <a id='comTb'><?php echo date('Y年n月j日', strtotime($com['comdate'])) ; ?></a> </li>"+
        <?php } ?>
        "<li></li>"
       +"</ul>"
    }
    
</script>

<?php
if (isset($_POST['followflg'])) {
    if ($_POST['followflg'] == 1) {

        print $_POST['followflg'];
        $db->sql_insert("INSERT into follow(follower,accountID) values(" . $_SESSION["accountID"] . "," . $acc_info['accountID'] . ")");
        echo "<script> document.getElementById('followbt').value='フォロー済み';";
        echo "document.getElementById('followflg').value=2; </script>";
    } else {

        echo $_POST['followflg'];
        $db->sql_insert("DELETE from follow where follower = " . $_SESSION['accountID'] . " and accountID = " . $acc_info['accountID']);

        echo  "<script> document.getElementById('followbt').value='フォローする';";
        echo "document.getElementById('followflg').value=1; </script>";
    }
} else {
    if ($_SESSION['accountID'] == $acc_info['accountID']) {
        
        echo "<script>var followbt = document.getElementById('followbt').type='button'</script>";
        echo "<script>document.getElementById('followbt').value='アカウントページに飛ぶ'; </script>";
        echo "<script>document.getElementById('jump').href='./search_user.php?user=".$acc_info['accountID']. "'</script>";
        
    } else {
        $check = $db->sql_exe_oneColumn("SELECT count(follower) from follow where follower = " . $_SESSION['accountID'] . " and accountID = " . $acc_info['accountID'] . ";");
        if ($check == 1) {
            print  "<script>document.getElementById('followbt').value='フォロー済み';";
            print "document.getElementById('followflg').value=2; </script>";
        } else {
            print  "<script>document.getElementById('followbt').value='フォローする';";
            print "document.getElementById('followflg').value=1; </script>";
        }
    }
}
 if (isset($_POST['favoflg'])) {
    if ($_POST['favoflg'] == 1) {
      
        $db->sql_insert("INSERT into favorite(accountID,pictureID) values(" . $_SESSION["accountID"] . "," . $pic['pictureID'] . ")");
        print  "<script>document.getElementById('nas').style='color:#ff4500';";
        print  "document.getElementById('na').style='background-color:#ff4500';";
        echo "document.getElementById('favoflg').value=2; </script>";
    } else {
        
        
        $db->sql_insert("DELETE from favorite where accountID = " . $_SESSION['accountID'] . " and pictureID = " . $pic['pictureID']);
        print  "<script>document.getElementById('favobt').style='backgrond-color:white';";
        echo "document.getElementById('favoflg').value=1; </scripdocument.getElementById>";
    }
 } else {
    if ($_SESSION['accountID'] == $pic['accountID']) {
        
        print  "<script>document.getElementById('favobt').style.visibility = 'hidden'</scripdocument.getElementById>";
        
    } else {
        $check = $db->sql_exe_oneColumn("SELECT count(accountID) from favorite where accountID = " . $_SESSION['accountID'] . " and pictureID = " . $pic['pictureID'] . ";");
        if ($check >= 1) {
            //既に置きにだったら色変える
           
            echo  "<script>document.getElementById('nas').style='color:#ff4500';";
            print  "document.getElementById('na').style='background-color:#ff4500';";
            echo  "document.getElementById('favoflg').value=2; </script>";
        } else {
            //置きにしてなかったらそのまま
           
            echo  "<script>document.getElementById('favobt').style='background-color:white';";
            echo "document.getElementById('favoflg').value=1; </script>";
        }
    }
}
?>


</html>