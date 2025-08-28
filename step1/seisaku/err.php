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
   class connect{
    public $db;
    
    function __construct() {
        $this->db = new PDO('mysql:host = localhost; dbname=teama; charset=utf8','root','admin');
        $this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    public function sql_exe_list($sql){
        return $this->db->query($sql);
    }
    public function sql_exe_oneList($sql){
        $stmt = $this->db->query($sql);
        return $stmt->fetch();
    }
    public function sql_exe_oneColum($sql){
        $stmt = $this->db->query($sql); 
        return $stmt->fetchColumn();
    }
    function __destruct(){
        $this->db = null;
    }
   } 
   ?>
</body>
</html>