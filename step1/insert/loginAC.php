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

session_start();

    ?>

<!DOCTYPE html>

<html lang="ja">
   
<?php

    require_once "../PDO_cun.php";
    $db = new PDO_cun();
    
    
            if(isset($_POST["id"]) && isset($_POST["pw"])){
                $id = $_POST["id"];
                $pw = $_POST["pw"];
                //echo "ようこそ".$id."さん".$pw;
    
                $acc = $db->sql_exe_oneColumn("select accountID from account where userName='".$id."' and password='".$pw."'");
                //echo "<br>".$acc;
                
                if($acc!=""){
                    $_SESSION['accountID']=$acc;
                    $_SESSION['ok']="ok";
                    echo $_SESSION['accountID'];
                    echo "ようこそ".$id."さん";
                    echo $acc;
                    header("Location:../homeP.php");
                    exit();
                }else{
                   $_SESSION['err'] = 1;
                   header("Location: http://localhost/sysdev/branches/step1/login.php");
                } 
            }else{
                  $_SESSION['err'] = 1;
                   header("Location: http://localhost/sysdev/branches/step1/login.php");
            }
      

?>

</body>
</html>