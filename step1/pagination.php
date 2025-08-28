<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
                function user($allPage, $page, $user){  //総ページ数、現在のページ、ユーザーID
                    if($allPage == 1) return false;      
                    $count = 0;
                    echo '<nav style="text-align: center; padding: 50px; ">';
                    switch($page){
                        case 1:
                        case 2:
                        case 3:
                            for ($i = 1; $i <= $allPage; $i++) {      //page選択
                                $count++;
                                if ($page == $i) {  //現在のpageか
                                    echo "<div class='num' id='now'><p class='inner' style='color:white;'>$i</p></div>";
                                }else{
                                    echo "<a href= search_user.php?page=" . $i . "&user=" . $user ."><div class='num' id=others><p class='inner' >$i</p></div></a>";
                                }
                                if($count == 5){
                                    break;
                                }
                            }
                            break;
                        case $allPage:
                        case $allPage-1:
                            if($allPage <= 4){
                                $display = 1;
                            }else{
                                $display = $allPage-4;
                            }
                            for ($i = $display; $i <= $allPage; $i++) {      //page選択
                                $count++;
                                    if ($page == $i) {  //現在のpageか
                                        echo "<div class='num' id='now'><p class='inner' style='color:white; '>$i</p></div>";
                                    }else{
                                        echo "<a href=search_user.php?page=" . $i . "&user=" . $user ."><div class='num' id=others><p class='inner' >$i</p></div></a>";
                                    }
                                if($count == 5){
                                    break;
                                }
                            }
                            break;
                        default:
                            for ($i = 1; $i <= $allPage; $i++) {      //page選択
                                if($page - 3 < $i && $page + 3 > $i){ 
                                    if ($page == $i) {  //現在のpageか
                                        echo "<div class='num' id='now'><p class='inner' style='color:white; '>$i</p></div>";
                                    }else{
                                        echo "<div class='num' id=others><a href=search_user.php?page=" . $i . "&user=" . $user ."><p class='inner' >$i</p></a></div>";
                                    }
                                }
                            }
                    }
                    echo "</nav>";
                }

                function follow($allPage, $page, $user, $tab){  //総ページ数、現在のページ、ユーザー、フォロー数
                    if($allPage == 1) return false;      
                    $count = 0;
                    echo '<nav style="text-align: center; padding: 50px; ">';
                    switch($page){
                        case 1:
                        case 2:
                        case 3:
                            for ($i = 1; $i <= $allPage; $i++) {      //page選択
                                $count++;
                                if ($page == $i) {  //現在のpageか
                                    echo "<div class='num' id='now'><p class='inner' style='color:white;'>$i</p></div>";
                                }else{
                                    echo "<a href= search_user.php?page=".$i."&user=".$user."&tab=".$tab."><div class='num' id=others><p class='inner' >$i</p></div></a>";
                                }
                                if($count == 5){
                                    break;
                                }
                            }
                            break;
                        case $allPage:
                        case $allPage-1:
                            if($allPage <= 4){
                                $display = 1;
                            }else{
                                $display = $allPage-4;
                            }
                            for ($i = $display; $i <= $allPage; $i++) {      //page選択
                                $count++;
                                    if ($page == $i) {  //現在のpageか
                                        echo "<div class='num' id='now'><p class='inner' style='color:white; '>$i</p></div>";
                                    }else{
                                        echo "<a href=search_user.php?page=" . $i . "&user=" . $user ."&tab=".$tab."><div class='num' id=others><p class='inner' >$i</p></div></a>";
                                    }
                                if($count == 5){
                                    break;
                                }
                            }
                            break;
                        default:
                            for ($i = 1; $i <= $allPage; $i++) {      //page選択
                                if($page - 3 < $i && $page + 3 > $i){ 
                                    if ($page == $i) {  //現在のpageか
                                        echo "<div class='num' id='now'><p class='inner' style='color:white; '>$i</p></div>";
                                    }else{
                                        echo "<div class='num' id=others><a href=search_user.php?page=".$i."&user=".$user."&tab=".$tab."><p class='inner' >$i</p></a></div>";
                                    }
                                }
                            }
                    }
                    echo "</nav>";
                }

                function search($allPage, $page, $tab, $search){     ////総ページ数、現在のページ、タブ
                    if($allPage == 1) return false;
                    $count = 0;
                    echo '<nav style="text-align: center; padding: 50px; ">';
                    switch($page){
                        case 1:
                        case 2:
                        case 3:
                            for ($i = 1; $i <= $allPage; $i++) {      //page選択
                                $count++;
                                if ($page == $i) {  //現在のpageか
                                    echo "<div class='num' id='now'><p class='inner' style='color:white; '>$i</p></div>";
                                }else{
                                    echo "<a href=search.php?page=" . $i . "&tab=" . $tab . "&search=" . $search . "><div class='num' id='others'><p class='inner' >$i</p></div></a>";
                                }
                                if($count == 5){
                                    break;
                                }
                            }
                            break;
                        case $allPage:
                        case $allPage-1:
                            if($allPage <= 4){
                                $display = 1;
                            }else{
                                $display = $allPage-4;
                            }
                            for ($i = $display; $i <= $allPage; $i++) {      //page選択
                                $count++;
                                    if ($page == $i) {  //現在のpageか
                                        echo "<div class='num' id='now'><p class='inner' style='color:white; '>$i</p></div>";
                                    }else{
                                        echo "<a href=search.php?page=" . $i . "&tab=" . $tab . "&search=" . $search . "><div class='num' id='others'><p class='inner' >$i</p></div></a>";
                                    }
                                if($count == 5){
                                    break;
                                }
                            }
                            break;
                        default:
                            for ($i = 1; $i <= $allPage; $i++) {      //page選択
                                if($page - 3 < $i && $page + 3 > $i){ 
                                    if ($page == $i) {  //現在のpageか
                                        echo "<div class='num' id='now'><p class='inner' style='color:white; '>$i</p></div>";
                                    }else{
                                        echo "<a href=search.php?page=" . $i . "&tab=" . $tab . "&search=" . $search . "><div class='num' id='others'><p class='inner' >$i</p></div></a>";
                                    }
                                }
                            }
                    }
                    echo "</nav>";
                }

                function tag($allPage, $page, $tag){     ////総ページ数、現在のページ、タグ
                    if($allPage == 1) return false;
                    $count = 0;
                    echo '<nav style="text-align: center; padding: 50px; ">';
                    switch($page){
                        case 1:
                        case 2:
                        case 3:
                            for ($i = 1; $i <= $allPage; $i++) {      //page選択
                                $count++;
                                if ($page == $i) {  //現在のpageか
                                    echo "<div class='num' id='now'><p class='inner' style='color:white; '>$i</p></div>";
                                }else{
                                    echo "<a href=tagsearch.php?page=" . $i . "&search=" . $tag . "><div class='num' id='others'><p class='inner' >$i</p></div></a>";
                                }
                                if($count == 5){
                                    break;
                                }
                            }
                            break;
                        case $allPage:
                        case $allPage-1:
                            if($allPage <= 4){
                                $display = 1;
                            }else{
                                $display = $allPage-4;
                            }
                            for ($i = $display; $i <= $allPage; $i++) {      //page選択
                                $count++;
                                    if ($page == $i) {  //現在のpageか
                                        echo "<div class='num' id='now'><p class='inner' style='color:white; '>$i</p></div>";
                                    }else{
                                        echo "<a href=tagsearch.php?page=" . $i . "&search=" . $tag . "><div class='num' id='others'><p class='inner' >$i</p></div></a>";
                                    }
                                if($count == 5){
                                    break;
                                }
                            }
                            break;
                        default:
                            for ($i = 1; $i <= $allPage; $i++) {      //page選択
                                if($page - 3 < $i && $page + 3 > $i){ 
                                    if ($page == $i) {  //現在のpageか
                                        echo "<div class='num' id='now'><p class='inner' style='color:white; '>$i</p></div>";
                                    }else{
                                        echo "<a href=tagsearch.php?page=" . $i . "&search=" . $tag . "><div class='num' id='others'><p class='inner' >$i</p></div></a>";
                                    }
                                }
                            }
                    }
                    echo "</nav>";
                }
    ?>
</body>
</html>