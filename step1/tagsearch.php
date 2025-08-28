<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="search.css">
    <?php
    session_start();
    if (isset($_SESSION['accountID']) && isset($_SESSION['ok'])) {
    } else {
        header("Location: http://localhost/sysdev/branches/step1/login.php");
    }
    $icon = array();
    $pic = array();
    $title = array();
    $id = array();
    $name = array();
    $page = 1;
    $fill = 20;
    $count = 0;
    $search = "0";
    $comit = "";
    $searchlength = 10;
    try {
        include "OriginalException.php";
        include 'pagination.php';
        require_once "PDO_cun.php";
        include 'inc/header.php';

        $db = new PDO_cun();
        if (isset($_GET["page"])) $page = $_GET["page"];
        if (isset($_GET["search"])) {


            // $array = explode(" ", $_GET[$search]);

            $search_add = htmlentities($_GET["search"], ENT_QUOTES, 'UTF-8');
            $comit =  $search_add . "";
            $search = $_GET["search"];
            $search_tags = preg_split('/[\s|\x{3000}]+/u', $search_add);

            $stack = array();
            $getPid = array();

            foreach ($search_tags as $stag) {
                $tag_get_list = $db->sql_exe_list("select distinct(tagID) as tid from tagM where tagName like('%" . $stag . "%')");
                while ($result = $tag_get_list->fetch()) {
                    array_push($stack, $result["tid"]);
                }
            }

            $search_tags_id = array_unique($stack);
            $stack = implode(',', $search_tags_id);

            $tag_get_list = $db->sql_exe_list("select distinct(pictureID) as pid from tag where tagID in(" . $stack . ")");
            while ($result = $tag_get_list->fetch()) {
                array_push($getPid, $result["pid"]);
            }
            $tmp = implode(',', $getPid);

            $img = $db->sql_exe_list("select * from picture as p,account as a where p.pictureID in (" . $tmp . ") and p.accountID = a.accountID;");
            while ($result = $img->fetch()) {
                $icon += array($result["accountID"] => $result["icon"]);
                $name += array($result["accountID"] => $result["userName"]);
                $title += array($result["pictureID"] => $result["title"]);
                $id += array($result["pictureID"] => $result["accountID"]);
                $pic += array($result["pictureID"] => $result["picture"]);
            }
            $count = count($pic);
        }
    } catch (Exception $e) {
    }
    ?>

    <style>
        .example{
            border: none;
            font-size: 18px;
            font-weight: 700;
            margin: 8px 6px;
            padding: 2px 10px;
            color: #fff;
            border-radius: 5px;
        }

        .search_container{
            
    text-align: center;
  box-sizing: border-box;
}
.search_container input[type="text"]{
  border: 1px solid #999;
  padding: 3px 5px;
  border-radius: 20px;
  height: 30px;
  width: 300px;
  overflow: hidden;
  font-size: 20px;
  vertical-align: middle;
}
.search_container input[type="text"]:focus {
  outline: 0;
}
.search_container input[type="submit"]{
  cursor: pointer;
  font-family: FontAwesome;
  font-size: 35px;
  border: none;
  background: none;
  color: #3879D9;
  outline : none;
  display: inline-block;
  vertical-align: middle;
}

hr{
    border: none;
    border-top: 2px solid gray;
}
.iconN {
    position: relative;
    margin-left: 3px;
    top: -5px;
    color:#505050;
}

#img{
    border: 1px solid #e6e6fa;
}

#Area{
    margin-left:10%;
    margin-right:10%;
}

.foot{
  margin-left: -5%;
  margin-top: 80px;
  margin-bottom: -8px;
  width:150px;
  height:100px;
  opacity: .50;
}
.tou{
  text-align: center;
  background-color:#00a7db;
  color:#fff;
  height:60px;
}
.tou a{
  font-size:29px ;
  font-weight: 700;
  position: absolute;
  top:80px;
  left:700px;
}
    </style>
</head>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<body>
<div class="tou">
      <a class="irasutoT">#タグ検索</a>
    </div>
    <div id="illustArea">
        <form  method="GET" action="#" class="search_container">
            <br>
  <input type="text"  name="search" placeholder=" 検索...">
  <input type="submit" value="&#xf002">

            <br><br>
            <?php
            $rantag = $db->sql_exe_list("SELECT tagName FROM tagm ORDER BY RAND() LIMIT $searchlength");
            $iro = ["#00ac9b", "#f39700", "#009bbf", "#f62e36", "#8f76d6","#a9cc51","#00a0de","#e44d93","#d7c447","#9c5e31"];
            $i = 0;
            while ($result = $rantag->fetch()) {
                echo '<a class="example" style=background-color:'. $iro[$i] . ' href="tagsearch.php?search=' . $result["tagName"] . '">#' . $result["tagName"] . '</a>';
                $i++;
            };
            ?>
              </form>
              <div id="Area">
            <?php
            if (isset($_GET["search"])) {
                print ' <div>
                <br>
                <h3 class="kensaku"><a id="ken">検索結果:</a>' . $comit . '</h3>
                <h3 class="kensaku2"><a id="ken">ヒット件数:</a>'.$count.'</h3>
                    <hr>
            </div>';
            }
            ?>
            <br><br>
        
        <ul>
            <?php
            $j = 0;
            foreach ($pic as $pictureID => $picture) {      // 画像の表示ループ
                $j++;
                if ($j > ($page - 1) * $fill && $j <= $page * $fill) {
                    echo "<li>
                     <div>
                         <div class='box'>
                         <a href=artwork_view.php?picID=" . $pictureID . ">
                                 <img id=img src='image.php?id=" . $pictureID . "' alt='画像'>
                             </a>
                         </div>
                         <div>
                             <a href=artwork_view.php?picID=" . $pictureID . ">
                             " . $title[$pictureID] . "
                             </a>
                         </div>
                         <div>
                             <a href=search_user.php?user=" . $id[$pictureID] . ">
                                 <div>
                                     <img id=icon src='iconimage.php?id=" . $id[$pictureID] . "' id=icon><a class='iconN'>"
                                     . $name[$id[$pictureID]] . "</a>
                                 </div>
                             </a>
                         </div>
                     </div>
                 </li>";
                }
            }
            $allPage = ceil($count / $fill);

            tag($allPage, $page, $search);
            ?>
            </div>
            <footer>
        <img class="foot" src="./img/supun.jpg"></img>
    </footer>
</body>

</html>