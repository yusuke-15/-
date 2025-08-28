<?php
// データベースに接続
function connectDB() {
    $param = 'mysql:dbname=a_step1;host=localhost';
    try {
        $pdo = new PDO($param, 'root', 'admin');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;

    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}
?>