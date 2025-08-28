<?php
require_once 'function.php';

$pdo = connectDB();

$sql = 'SELECT * FROM picture where pictureID = :pictureID LIMIT 1';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':pictureID', (int)$_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$image = $stmt->fetch();

echo $image['picture'];
exit();
?>